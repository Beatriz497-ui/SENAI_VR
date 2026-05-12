<?php
session_start();
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: ../login.php");
    exit();
}
require_once '../layout.php';

// CSS específico para a área de conteúdo do manual
$extra_css = "
<style>
    .glass-panel { 
        background: rgba(18, 22, 33, 0.4); 
        backdrop-filter: blur(20px); 
        border: 1px solid rgba(255, 255, 255, 0.05);
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
    
    .sidebar-manual { height: calc(100vh - 200px); overflow-y: auto; }
    .sidebar-manual::-webkit-scrollbar { width: 4px; }
    .sidebar-manual::-webkit-scrollbar-thumb { background: rgba(34, 211, 238, 0.3); border-radius: 10px; }
    
    .nav-manual-btn { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: 1px solid rgba(255,255,255,0.05); margin-bottom: 0.6rem; text-align: left; padding: 1rem; width: 100%; border-radius: 1rem; font-size: 0.85rem; color: #94a3b8; }
    .nav-manual-btn:hover { background: rgba(34, 211, 238, 0.08); transform: translateX(8px); border-color: rgba(34, 211, 238, 0.3); color: #fff; }
    .nav-manual-btn.active { background-color: rgba(34, 211, 238, 0.15); border-color: #22d3ee; color: #22d3ee; font-weight: 700; box-shadow: 0 0 20px rgba(34, 211, 238, 0.1); }
    
    .content-section { display: none; }
    .content-section.active { display: block; animation: slideIn 0.5s ease forwards; }
    
    @keyframes slideIn { 
        from { opacity: 0; transform: translateY(10px); } 
        to { opacity: 1; transform: translateY(0); } 
    }

    .step-img { 
        width: 100%; 
        border-radius: 1.5rem; 
        border: 1px solid rgba(255, 255, 255, 0.1); 
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
    }

    .status-badge-manual {
        display: inline-flex;
        align-items: center;
        background: rgba(34, 197, 94, 0.1);
        color: #4ade80;
        padding: 4px 12px;
        border-radius: 99px;
        font-size: 10px;
        font-weight: bold;
        border: 1px solid rgba(34, 197, 94, 0.2);
    }
    .status-dot-manual { width: 6px; height: 6px; background: #4ade80; border-radius: 50%; margin-right: 8px; animation: pulse-manual 2s infinite; }
    @keyframes pulse-manual { 0% { opacity: 1; } 50% { opacity: 0.3; } 100% { opacity: 1; } }

    .btn-demo {
        margin-top: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background: rgba(34, 211, 238, 0.1);
        color: #22d3ee;
        border: 1px solid rgba(34, 211, 238, 0.3);
        border-radius: 0.75rem;
        font-weight: bold;
        font-size: 0.875rem;
        transition: all 0.2s;
    }
    .btn-demo:hover { background: rgba(34, 211, 238, 0.2); transform: translateY(-2px); }
</style>
";

$conteudo = $extra_css . "
<div class='p-8 h-[calc(100vh-64px)] overflow-hidden flex flex-col'>
    
    <header class='flex justify-between items-end mb-6'>
        <div>
            <div class='status-badge-manual mb-2'>
                <span class='status-dot-manual'></span> SISTEMA OPERACIONAL ATIVO
            </div>
            <h1 class='text-3xl font-bold headline tracking-tight text-white'>Manual de Operação Técnica</h1>
            <p class='text-cyan-500/80 text-[10px] uppercase tracking-[0.3em] font-bold mt-1'>Spatial Core | Protocolo Meta Quest 3S</p>
        </div>
    </header>

    <div class='flex gap-8 flex-1 overflow-hidden mb-4'>
        <aside class='w-1/4 sidebar-manual px-2 space-y-2'>
            <button onclick='selectTopic(this, \"s1\")' class='nav-manual-btn active glass-panel'>01. Setup Inicial & QR</button>
            <button onclick='selectTopic(this, \"s2\")' class='nav-manual-btn glass-panel'>02. Ajuste de Lentes (IPD)</button>
            <button onclick='selectTopic(this, \"s3\")' class='nav-manual-btn glass-panel'>03. Espaçador de Óculos</button>
            <button onclick='selectTopic(this, \"s4\")' class='nav-manual-btn glass-panel'>04. Tampa da Bateria</button>
            <button onclick='selectTopic(this, \"s5\")' class='nav-manual-btn glass-panel text-red-400'>05. Cuidado Crítico (Sol)</button>
            <button onclick='selectTopic(this, \"s6\")' class='nav-manual-btn glass-panel'>06. Rastreamento</button>
            <button onclick='selectTopic(this, \"s7\")' class='nav-manual-btn glass-panel'>07. Ajuste de Faixa (Strap)</button>
            <button onclick='selectTopic(this, \"s8\")' class='nav-manual-btn glass-panel'>08. Anatomia do Headset</button>
            <button onclick='selectTopic(this, \"s9\")' class='nav-manual-btn glass-panel'>09. Anatomia dos Controles</button>
            <div class='pt-4'>
                <button onclick='showAllManual(this)' class='nav-manual-btn glass-panel border-cyan-500/30 text-center font-bold text-cyan-400 hover:bg-cyan-500/20'>VISUALIZAR TUDO</button>
            </div>
        </aside>

        <main id='manual-content-area' class='w-3/4 glass-panel p-12 rounded-[2.5rem] overflow-y-auto custom-scrollbar'>
            
            <div id='s1' class='content-section active space-y-6'>
                <div class='flex items-center gap-4 text-cyan-400 font-bold tracking-widest text-xs uppercase'>
                    <span class='h-[1px] w-8 bg-cyan-400'></span> Iniciação de Hardware
                </div>
                <h2 class='text-4xl font-bold text-white headline'>01. Setup Inicial & QR Code</h2>
                <p class='text-slate-400 leading-relaxed text-lg'>Escaneie o código QR para ver os vídeos de configuração e instruções no aplicativo Meta Horizon.</p>
                <img src='img/passo1.jpg' alt='QR Code Setup' class='step-img max-w-[500px]'>
            </div>

            <div id='s2' class='content-section space-y-6'>
                <h2 class='text-4xl font-bold text-cyan-400 headline'>02. Ajuste das Lentes (IPD)</h2>
                <p class='text-slate-400 leading-relaxed text-lg'>Mova as lentes manualmente até que a imagem central fique perfeitamente nítida.</p>
                <img src='img/passo2.jpg' alt='Ajuste Lentes' class='step-img'>
                <button onclick='abrirModalManual(\"img/foto_real_2.jpg\")' class='btn-demo'><span class='material-symbols-outlined'>visibility</span> VER DEMONSTRAÇÃO REAL</button>
            </div>

            <div id='s3' class='content-section space-y-6'>
                <h2 class='text-4xl font-bold text-cyan-400 headline'>03. Uso com Óculos</h2>
                <div class='grid grid-cols-1 xl:grid-cols-2 gap-8'>
                    <div class='space-y-4'>
                        <div class='flex gap-4 items-start'>
                            <span class='bg-cyan-500/20 text-cyan-400 px-3 py-1 rounded-lg font-bold'>1</span>
                            <p class='text-slate-300'>Remova a interface facial puxando pelas bordas.</p>
                        </div>
                        <div class='flex gap-4 items-start'>
                            <span class='bg-cyan-500/20 text-cyan-400 px-3 py-1 rounded-lg font-bold'>2</span>
                            <p class='text-slate-300'>Encaixe o espaçador de óculos para aumentar a distância.</p>
                        </div>
                        <button onclick='abrirModalManual(\"img/foto_real_3.jpg\")' class='btn-demo'><span class='material-symbols-outlined'>add_circle</span> VER DEMONSTRAÇÃO</button>
                    </div>
                    <img src='img/passo3_completo.jpg' alt='Espaçador' class='step-img'>
                </div>
            </div>

            <div id='s5' class='content-section space-y-6'>
                <h2 class='text-4xl font-bold text-red-500 headline uppercase italic'>05. ALERTA: Luz Solar</h2>
                <div class='bg-red-500/10 border-l-4 border-red-500 p-8 rounded-2xl'>
                    <p class='text-red-200 leading-relaxed text-xl'><strong>DANO IRREVERSÍVEL:</strong> 5 segundos de sol direto destroem os pixels do display permanentemente.</p>
                </div>
                <img src='img/passo5.jpg' alt='Alerta Luz' class='step-img border-red-500/40'>
            </div>

            </main>
    </div>
</div>

<div id='modalManual' class='fixed inset-0 z-[100] hidden flex items-center justify-center p-4'>
    <div class='absolute inset-0 bg-black/90 backdrop-blur-md' onclick='fecharModalManual()'></div>
    <div class='relative bg-slate-900 border border-white/10 rounded-[2.5rem] max-w-2xl w-full overflow-hidden shadow-2xl transition-all duration-300 scale-95 opacity-0' id='modalContainerManual'>
        <button onclick='fecharModalManual()' class='absolute top-6 right-6 bg-red-500/20 hover:bg-red-500 text-red-500 hover:text-white w-10 h-10 rounded-full flex items-center justify-center z-10 transition-all'>
            <span class='material-symbols-outlined'>close</span>
        </button>
        <img id='imgModalManual' src='' class='w-full h-auto'>
        <div class='p-6 bg-slate-950/50 text-center text-slate-400 text-sm italic'>Referência visual para operação correta do equipamento.</div>
    </div>
</div>

<script>
    function selectTopic(btn, id) {
        document.querySelectorAll('.nav-manual-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        document.querySelectorAll('.content-section').forEach(c => c.classList.remove('active'));
        document.getElementById(id).classList.add('active');
        document.getElementById('manual-content-area').scrollTop = 0;
    }

    function showAllManual(btn) {
        document.querySelectorAll('.nav-manual-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        document.querySelectorAll('.content-section').forEach(c => c.classList.add('active'));
        document.getElementById('manual-content-area').scrollTop = 0;
    }

    function abrirModalManual(src) {
        const modal = document.getElementById('modalManual');
        const container = document.getElementById('modalContainerManual');
        document.getElementById('imgModalManual').src = src;
        modal.classList.remove('hidden');
        setTimeout(() => { 
            container.classList.remove('scale-95', 'opacity-0'); 
            container.classList.add('scale-100', 'opacity-100'); 
        }, 10);
    }

    function fecharModalManual() {
        const container = document.getElementById('modalContainerManual');
        container.classList.add('scale-95', 'opacity-0');
        setTimeout(() => { 
            document.getElementById('modalManual').classList.add('hidden'); 
        }, 300);
    }
</script>
";

renderizar_pagina("Manual Técnico", $conteudo);
?>