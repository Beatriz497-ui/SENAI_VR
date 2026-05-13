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
            <p class='text-cyan-500/80 text-[10px] uppercase tracking-[0.3em] font-bold mt-1'>SENAI VR | Protocolo Meta Quest 3S</p>
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
            
    
        <div id='s1' class='content-section active space-y-8'>
    <div class='flex items-center gap-4 text-cyan-400 font-bold tracking-widest text-xs uppercase'>
        <span class='h-[1px] w-8 bg-cyan-400'></span> Iniciação de Hardware
    </div>
    <h2 class='text-4xl font-bold text-white headline'>01. Setup Inicial & QR Code</h2>
    <div class='space-y-6'>
        <p class='text-slate-300 text-lg text-justify'>
            Escaneie o código QR abaixo para acessar os vídeos. Você pode fazer isso diretamente pela câmera do seu smartphone ou através das lentes do Meta Quest 3S.
        </p>
        <img src='./img/Passo1.jpg' class='w-full rounded-[2rem] border border-white/10 shadow-2xl aspect-video object-cover'>
        <img src='./img/passo_1.jpg' class='w-full rounded-[2rem] border border-white/10 shadow-2xl aspect-video object-cover'>
    </div>
</div>

<div id='s2' class='content-section space-y-8'>
    <div class='flex items-center gap-4 text-cyan-400 font-bold tracking-widest text-xs uppercase'>
        <span class='h-[1px] w-8 bg-cyan-400'></span> Calibração Óptica
    </div>
    <h2 class='text-4xl font-bold text-white headline'>02. Ajuste de Lentes</h2>
    <div class='space-y-6'>
        <p class='text-slate-300 text-lg text-justify'>
            Mova as lentes manualmente para a esquerda ou direita até que a imagem central fique perfeitamente nítida. O ajuste correto evita fadiga ocular e garante a melhor imersão.
        </p>
        <img src='./img/Passo2.jpg' class='w-full rounded-[2rem] border border-white/10 shadow-2xl aspect-video object-cover'>
    </div>
</div>

<div id='s3' class='content-section space-y-8'>
    <div class='flex items-center gap-4 text-cyan-400 font-bold tracking-widest text-xs uppercase'>
        <span class='h-[1px] w-8 bg-cyan-400'></span> Protocolo de Ergonomia
    </div>
    <h2 class='text-4xl font-bold text-white headline'>03. Uso com Óculos</h2>
    <div class='space-y-6'>
        <div class='flex gap-4 items-start'>
            <span class='bg-cyan-500 text-slate-900 w-8 h-8 rounded-full flex items-center justify-center font-bold shrink-0'>1</span>
            <p class='text-slate-300 text-lg text-justify'>Remova a <strong>interface facial</strong> puxando firmemente pelas bordas laterais. Este componente é magnético ou de encaixe por pressão, projetado para sair sem danificar o hardware.</p>
        </div>
        <div class='flex gap-4 items-start'>
            <span class='bg-cyan-500 text-slate-900 w-8 h-8 rounded-full flex items-center justify-center font-bold shrink-0'>2</span>
            <p class='text-slate-300 text-lg text-justify'>Encaixe o <strong>espaçador de óculos</strong> entre o headset e a interface facial. Este acessório cria a profundidade necessária para acomodar a armação dos seus óculos com segurança e conforto.</p>
        </div>
        <img src='./img/Passo3.jpg' class='w-full rounded-[2rem] border border-white/10 shadow-2xl aspect-video object-cover'>
    </div>
</div>

<div id='s4' class='content-section space-y-8'>
    <div class='flex items-center gap-4 text-cyan-400 font-bold tracking-widest text-xs uppercase'>
        <span class='h-[1px] w-8 bg-cyan-400'></span> Energia do Sistema
    </div>
    <h2 class='text-4xl font-bold text-white headline'>04. Tampa da Bateria</h2>
    <div class='space-y-6'>
        <p class='text-slate-300 text-lg text-justify'>
            Pressione o botão de ejeção na lateral do controle para liberar a tampa. Deslize-a para baixo para substituir a pilha AA. Verifique sempre a polaridade correta.
        </p>
        <img src='./img/Passo4.jpg' class='w-full rounded-[2rem] border border-white/10 shadow-2xl aspect-video object-cover'>
    </div>
</div>

<div id='s5' class='content-section space-y-8'>
    <div class='flex items-center gap-4 text-red-500 font-bold tracking-widest text-xs uppercase'>
        <span class='h-[1px] w-8 bg-red-500'></span> Alerta de Segurança
    </div>
    <h2 class='text-4xl font-bold text-white headline'>05. Cuidado Crítico: Luz Solar</h2>
    <div class='space-y-6 text-red-100 bg-red-950/20 p-6 rounded-3xl border border-red-500/20'>
        <p class='text-lg text-justify'>
            <strong>IMPORTANTE:</strong> Nunca exponha as lentes internas ao sol. A luz solar direta pode queimar permanentemente os ecrãs LCD do headset em poucos segundos.
        </p>
        <img src='./img/Passo5.jpg' class='w-full rounded-[2rem] border border-red-500/30 shadow-2xl aspect-video object-cover'>
    </div>
</div>

<div id='s6' class='content-section space-y-8'>
    <div class='flex items-center gap-4 text-cyan-400 font-bold tracking-widest text-xs uppercase'>
        <span class='h-[1px] w-8 bg-cyan-400'></span> Sensores Ópticos
    </div>
    <h2 class='text-4xl font-bold text-white headline'>06. Rastreamento (Tracking)</h2>
    <div class='space-y-6'>
        <p class='text-slate-300 text-lg text-justify'>
            Mantenha as câmeras de rastreamento externas limpas. O sistema utiliza estas câmeras para mapear o ambiente e reconhecer as mãos e os comandos.
        </p>
        <img src='./img/Passo6.jpg' class='w-full rounded-[2rem] border border-white/10 shadow-2xl aspect-video object-cover'>
    </div>
</div>

<div id='s7' class='content-section space-y-8'>
    <div class='flex items-center gap-4 text-cyan-400 font-bold tracking-widest text-xs uppercase'>
        <span class='h-[1px] w-8 bg-cyan-400'></span> Ergonomia
    </div>
    <h2 class='text-4xl font-bold text-white headline'>07. Ajuste de Faixa (Strap)</h2>
    <div class='space-y-6'>
        <p class='text-slate-300 text-lg text-justify'>
            Posicione a parte traseira da faixa na base do crânio. Ajuste as alças laterais e a alça de topo até que o headset esteja firme, mas confortável no rosto.
        </p>
        <img src='./img/Passo7.jpg' class='w-full rounded-[2rem] border border-white/10 shadow-2xl aspect-video object-cover'>
    </div>
</div>

<div id='s8' class='content-section space-y-8'>
    <div class='flex items-center gap-4 text-cyan-400 font-bold tracking-widest text-xs uppercase'>
        <span class='h-[1px] w-8 bg-cyan-400'></span> Hardware Overview
    </div>
    <h2 class='text-4xl font-bold text-white headline'>08. Anatomia do Headset</h2>

    <div class='space-y-6'>
        <div class='grid grid-cols-1 gap-4 bg-slate-800/30 p-6 rounded-3xl border border-white/5'>
            <div class='space-y-4'>
                <p class='text-slate-300 text-lg text-justify'>
                    <strong class='text-cyan-400'>[Liga/Desliga (Power Button)]:</strong> Geralmente localizado na lateral esquerda ou próximo à parte traseira da alça, é o botão utilizado para ligar, desligar ou colocar o dispositivo em modo de suspensão.
                </p>
                
                <p class='text-slate-300 text-lg text-justify'>
                    <strong class='text-cyan-400'>[Botões de Volume]:</strong> Normalmente posicionados na parte inferior ou lateral do visor, permitindo aumentar (+) e diminuir (-) o som do sistema de forma rápida.
                </p>

                <p class='text-slate-300 text-lg text-justify'>
                    <strong class='text-cyan-400'>[Entrada USB-C]:</strong> Localizada na lateral esquerda do headset, usada para carregar a bateria interna e para transferência de dados ou conexão via Link com o PC.
                </p>
            </div>
        </div>

        <div class='relative rounded-[2rem] border border-white/10 shadow-2xl overflow-hidden bg-slate-900 aspect-video'>
            <img src='./img/Passo8.jpg' alt='Anatomia Meta Quest 3S' 
                 class='w-full h-full object-cover'>
            
            <div class='absolute top-6 right-6 bg-black/60 backdrop-blur-md px-4 py-2 rounded-xl border border-white/10'>
                <span class='text-white text-xs font-black tracking-tighter uppercase'></span>
            </div>
        </div>
    </div>
</div>

<div id='s9' class='content-section space-y-8'>
    <div class='flex items-center gap-4 text-cyan-400 font-bold tracking-widest text-xs uppercase'>
        <span class='h-[1px] w-8 bg-cyan-400'></span> Controladores Touch Plus
    </div>
    <h2 class='text-4xl font-bold text-white headline'>09. Anatomia dos Controles & Como Ligar</h2>
    
    <div class='space-y-8'>
        <div class='bg-slate-800/40 p-6 rounded-3xl border border-white/5'>
            <h3 class='text-cyan-400 font-bold mb-3 flex items-center gap-2'>
                <span class='material-icons text-sm'></span> ATIVAÇÃO E PAREAMENTO
            </h3>
            <p class='text-slate-300 text-lg text-justify'>
                Para ligar os controles do <strong>Meta Quest 3S</strong>, basta colocar as pilhas AA e movimentá-los ou apertar qualquer botão; eles ligam automaticamente. Se não conectarem, segure o <strong>botão Meta (direito) e B</strong> por 4 segundos, ou o <strong>Menu (esquerdo) e Y</strong> até a luz piscar. O pareamento é confirmado com uma vibração.
            </p>
        </div>

        <div class='grid grid-cols-1 md:grid-cols-2 gap-6 px-2'>
            <div class='space-y-2'>
                <p class='text-white font-semibold'>• Botões A e B (Direito):</p>
                <p class='text-slate-400 text-sm text-justify'>A (Ação/Pular), B (Menu/Voltar).</p>
                
                <p class='text-white font-semibold pt-2'>• Botões X e Y (Esquerdo):</p>
                <p class='text-slate-400 text-sm text-justify'>X (Ação/Menu), Y (Voltar).</p>
            </div>
            <div class='space-y-2'>
                <p class='text-white font-semibold'>• Botão Meta (Direito):</p>
                <p class='text-slate-400 text-sm text-justify'>Abre o menu universal (toque) ou recentraliza a visão (segurar).</p>
                
                <p class='text-white font-semibold pt-2'>• Botão Menu (Esquerdo):</p>
                <p class='text-slate-400 text-sm text-justify'>Abre menus específicos dentro de jogos e aplicações.</p>
            </div>
        </div>

        <div class='relative'>
            <img src='./img/Passo9.jpg' class='w-full rounded-[2rem] border border-white/10 shadow-2xl aspect-video object-cover'>
            <div class='absolute bottom-6 right-6 bg-cyan-500/20 backdrop-blur-md px-4 py-2 rounded-full border border-cyan-400/30'>
                <span class='text-cyan-400 text-xs font-bold uppercase tracking-widest'>Touch Plus Controllers</span>
            </div>
        </div>

                <div class='relative'>
            <img src='./img/Passo9_1.jpg' class='w-full rounded-[2rem] border border-white/10 shadow-2xl aspect-video object-cover'>
            <div class='absolute bottom-6 right-6 bg-cyan-500/20 backdrop-blur-md px-4 py-2 rounded-full border border-cyan-400/30'>
                <span class='text-cyan-400 text-xs font-bold uppercase tracking-widest'>Touch Plus Controllers</span>
            </div>
        </div>

                <div class='relative'>
            <img src='./img/Passo9_2.jpg' class='w-full rounded-[2rem] border border-white/10 shadow-2xl aspect-video object-cover'>
            <div class='absolute bottom-6 right-6 bg-cyan-500/20 backdrop-blur-md px-4 py-2 rounded-full border border-cyan-400/30'>
                <span class='text-cyan-400 text-xs font-bold uppercase tracking-widest'>Touch Plus Controllers</span>
            </div>
        </div>
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