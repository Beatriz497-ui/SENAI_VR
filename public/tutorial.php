<!DOCTYPE html>
<html class="dark" lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual Técnico | SENAI VR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Manrope:wght@300;500;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        /* Fundo Animado e Tipografia Profissional */
        body { 
            background: linear-gradient(-45deg, #010204, #061621, #010204, #0a1f2e);
            background-size: 400% 400%;
            animation: gradientBG 20s ease infinite;
            font-family: 'Manrope', sans-serif; 
            color: #fff; 
            overflow: hidden; 
            height: 100vh; 
            margin: 0;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .glass-panel { 
            background: rgba(18, 22, 33, 0.4); 
            backdrop-filter: blur(20px); 
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        
        .sidebar-menu { height: calc(100vh - 160px); display: flex; flex-direction: column; overflow-y: auto; padding-right: 10px; }
        .sidebar-menu::-webkit-scrollbar { width: 4px; }
        .sidebar-menu::-webkit-scrollbar-thumb { background: rgba(6, 182, 212, 0.5); border-radius: 10px; }
        
        .nav-btn { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: 1px solid rgba(255,255,255,0.05); margin-bottom: 0.6rem; text-align: left; padding: 1rem; width: 100%; border-radius: 1rem; font-size: 0.85rem; }
        .nav-btn:hover { background: rgba(6, 182, 212, 0.08); transform: translateX(8px); border-color: rgba(6, 182, 212, 0.3); }
        .nav-btn.active { background-color: rgba(6, 182, 212, 0.15); border-color: #06b6d4; color: #06b6d4; font-weight: 700; box-shadow: 0 0 20px rgba(6, 182, 212, 0.2); }
        
        .content-section { display: none; }
        .content-section.active { display: block; animation: slideIn 0.5s ease forwards; }
        
        @keyframes slideIn { 
            from { opacity: 0; transform: translateX(20px); } 
            to { opacity: 1; transform: translateX(0); } 
        }

        .step-img { 
            width: 100%; 
            border-radius: 1.5rem; 
            border: 1px solid rgba(255, 255, 255, 0.1); 
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
            transition: all 0.4s;
        }

        .status-badge {
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
        .status-dot { width: 6px; height: 6px; background: #4ade80; border-radius: 50%; margin-right: 8px; animation: pulse 2s infinite; }
        @keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.3; } 100% { opacity: 1; } }

        /* Estilo do Botão de Demonstração */
        .btn-demo {
            margin-top: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 0.75rem;
            font-weight: bold;
            font-size: 0.875rem;
            transition: all 0.2s;
            cursor: pointer;
        }
        .btn-demo:hover { background: rgba(16, 185, 129, 0.2); transform: scale(1.02); }
    </style>
</head>
<body class="p-8">

    <header class="flex justify-between items-end mb-8 px-4">
        <div>
            <div class="status-badge mb-2">
                <span class="status-dot"></span> SISTEMA OPERACIONAL ATIVO
            </div>
            <h1 class="text-3xl font-bold font-['Space_Grotesk'] tracking-tight">Manual de Operação Técnica</h1>
            <p class="text-cyan-500/80 text-xs uppercase tracking-[0.3em] font-bold mt-1">Spatial Core | Protocolo Meta Quest 3S</p>
        </div>
        <a href="dashboard.php" class="px-8 py-3 bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl hover:bg-white/10 hover:border-cyan-500/50 transition-all text-sm font-bold flex items-center gap-2">
            <span>Voltar ao Dashboard</span>
        </a>
    </header>

    <div class="flex gap-8 h-[78%]">
        <aside class="w-1/4 sidebar-menu px-2">
            <button onclick="selectTopic(this, 's1')" class="nav-btn active glass-panel">01. Setup Inicial & QR</button>
            <button onclick="selectTopic(this, 's2')" class="nav-btn glass-panel">02. Ajuste de Lentes (IPD)</button>
            <button onclick="selectTopic(this, 's3')" class="nav-btn glass-panel">03. Espaçador de Óculos</button>
            <button onclick="selectTopic(this, 's4')" class="nav-btn glass-panel">04. Tampa da Bateria</button>
            <button onclick="selectTopic(this, 's5')" class="nav-btn glass-panel text-red-400">05. Cuidado Crítico (Sol)</button>
            <button onclick="selectTopic(this, 's6')" class="nav-btn glass-panel">06. Rastreamento</button>
            <button onclick="selectTopic(this, 's7')" class="nav-btn glass-panel">07. Ajuste de Faixa (Strap)</button>
            <button onclick="selectTopic(this, 's8')" class="nav-btn glass-panel">08. Anatomia do Headset</button>
            <button onclick="selectTopic(this, 's9')" class="nav-btn glass-panel">09. Anatomia dos Controles</button>
            <div class="mt-6">
                <button onclick="showAll(this)" class="nav-btn glass-panel border-cyan-500/30 text-center font-bold text-cyan-400 hover:bg-cyan-500/20">VISUALIZAR TUDO</button>
            </div>
        </aside>

        <main id="main-content" class="w-3/4 glass-panel p-16 rounded-[2.5rem] overflow-y-auto">
            
            <div id="s1" class="content-section active space-y-6">
                <div class="flex items-center gap-4 text-cyan-400 font-bold tracking-widest text-sm uppercase">
                    <span class="h-[1px] w-8 bg-cyan-400"></span> Iniciação de Hardware
                </div>
                <h2 class="text-4xl font-bold text-white font-['Space_Grotesk']">01. Setup Inicial & QR Code</h2>
                <p class="text-slate-400 leading-relaxed text-lg max-w-2xl">Escaneie o código QR para ver os vídeos de configuração e instruções no aplicativo Meta Horizon. Visite <span class="text-cyan-400">meta.com/help/quest</span> para suporte técnico avançado.</p>
                <div class="bg-black/20 p-2 rounded-[2rem] inline-block">
                    <img src="img/passo1.jpg" alt="QR Code Setup" class="step-img max-w-[500px]">
                </div>
                
            </div>

            <div id="s2" class="content-section space-y-6">
                <h2 class="text-4xl font-bold text-cyan-400 font-['Space_Grotesk']">02. Ajuste das Lentes (IPD)</h2>
                <p class="text-slate-400 leading-relaxed text-lg">O ajuste de Distância Interpupilar é vital. Mova as lentes manualmente até que a imagem central fique perfeitamente nítida.</p>
                <img src="img/passo2.jpg" alt="Ajuste Lentes" class="step-img">
                <button onclick="abrirModal('img/foto_real_2.jpg')" class="btn-demo"><span class="material-symbols-outlined">person</span> VER DEMONSTRAÇÃO REAL</button>
            </div>

            <div id="s3" class="content-section space-y-6">
                <h2 class="text-4xl font-bold text-cyan-400 font-['Space_Grotesk']">03. Uso com Óculos</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                    <div class="space-y-4">
                        <div class="flex gap-4 items-start">
                            <span class="bg-cyan-500/20 text-cyan-400 w-8 h-8 rounded-lg flex items-center justify-center font-bold shrink-0">1</span>
                            <p class="text-slate-300">Remova a interface facial de tecido com cuidado puxando pelas bordas.</p>
                        </div>
                        <div class="flex gap-4 items-start">
                            <span class="bg-cyan-500/20 text-cyan-400 w-8 h-8 rounded-lg flex items-center justify-center font-bold shrink-0">2</span>
                            <p class="text-slate-300">Encaixe o espaçador de óculos para aumentar a distância interna.</p>
                        </div>
                        <div class="flex gap-4 items-start">
                            <span class="bg-cyan-500/20 text-cyan-400 w-8 h-8 rounded-lg flex items-center justify-center font-bold shrink-0">3</span>
                            <p class="text-slate-300">Pressione a interface de volta até sentir o travamento completo.</p>
                        </div>
                        <button onclick="abrirModal('img/foto_real_3.jpg')" class="btn-demo"><span class="material-symbols-outlined">person</span> VER DEMONSTRAÇÃO REAL</button>
                    </div>
                    <img src="img/passo3_completo.jpg" alt="Instalação Espaçador" class="step-img">
                </div>
            </div>

            <div id="s4" class="content-section space-y-6">
                <h2 class="text-4xl font-bold text-cyan-400 font-['Space_Grotesk']">04. Gestão de Energia</h2>
                <p class="text-slate-400 leading-relaxed text-lg">Utilize apenas pilhas AA de alta qualidade. O sistema de ejeção por botão previne danos à carcaça do controle.</p>
                <img src="img/passo4.jpg" alt="Troca de Bateria" class="step-img max-w-[500px]">
                <button onclick="abrirModal('img/foto_real_4.jpg')" class="btn-demo"><span class="material-symbols-outlined">person</span> VER DEMONSTRAÇÃO REAL</button>
            </div>

            <div id="s5" class="content-section space-y-6">
                <h2 class="text-4xl font-bold text-red-500 font-['Space_Grotesk'] uppercase italic tracking-tighter">05. ALERTA: Fotossensibilidade</h2>
                <div class="bg-red-500/10 border-l-4 border-red-500 p-8 rounded-2xl">
                    <p class="text-red-200 leading-relaxed text-xl"><strong>DANO IRREVERSÍVEL:</strong> As lentes do Quest agem como lupas térmicas. 5 segundos de exposição direta ao sol destroem permanentemente os pixels do display.</p>
                </div>
                <img src="img/passo5.jpg" alt="Alerta Luz Solar" class="step-img border-red-500/40">
            </div>

            <div id="s6" class="content-section space-y-4">
                <h2 class="text-3xl font-bold text-cyan-400 font-['Space_Grotesk']">06. Rastreamento (Mão/Corpo)</h2>
                <p class="text-slate-300 leading-relaxed text-lg">O headset utiliza as câmeras frontais para rastrear movimentos. Mantenha as lentes externas limpas e o ambiente bem iluminado para evitar perda de rastreio.</p>
                <div class="bg-cyan-900/20 border border-cyan-500/30 p-6 rounded-xl mt-4 mb-4">
                    <p class="text-cyan-100 italic font-medium">"O sistema Spatial Core monitora os sensores em tempo real para garantir 6 graus de liberdade (6DOF)."</p>
                </div>
                
            </div>

            <div id="s7" class="content-section space-y-6">
                <h2 class="text-4xl font-bold text-cyan-400 font-['Space_Grotesk']">07. Ergonomia do Strap</h2>
                <p class="text-slate-400 text-lg leading-relaxed">O conforto térmico e mecânico depende do ajuste triplo: lateral, traseiro e de topo.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white/5 p-4 rounded-3xl"><img src="img/passo7_1.jpg" alt="Ajuste Traseiro" class="step-img"></div>
                    <div class="bg-white/5 p-4 rounded-3xl"><img src="img/passo7_2.jpg" alt="Ajuste Superior" class="step-img"></div>
                </div>
                <button onclick="abrirModal('img/foto_real_7.jpg')" class="btn-demo"><span class="material-symbols-outlined">person</span> VER DEMONSTRAÇÃO REAL</button>
            </div>

            <div id="s8" class="content-section space-y-8">
                <h2 class="text-4xl font-bold text-cyan-400 font-['Space_Grotesk']">08. Anatomia do Headset</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="glass-panel p-6 rounded-3xl border-white/5">
                        <img src="img/passo8_1.jpg" alt="Anatomia Frontal" class="step-img mb-6">
                        <ul class="grid grid-cols-1 gap-2 text-sm text-slate-400">
                            <li><strong class="text-cyan-400">01.</strong> Tira Traseira</li>
                            <li><strong class="text-cyan-400">02.</strong> Tira Superior</li>
                            <li><strong class="text-cyan-400">03.</strong> Entrada de Carga USB-C</li>
                            <li><strong class="text-cyan-400">04.</strong> Power On/Off</li>
                        </ul>
                        <button onclick="abrirModal('img/foto_real_8a.jpg')" class="btn-demo w-full justify-center"><span class="material-symbols-outlined">person</span> VER POSIÇÃO</button>
                    </div>
                    <div class="glass-panel p-6 rounded-3xl border-white/5">
                        <img src="img/passo8_2.jpg" alt="Anatomia Inferior" class="step-img mb-6">
                        <ul class="grid grid-cols-1 gap-2 text-sm text-slate-400">
                            <li><strong class="text-cyan-400">06.</strong> Controle de Volume</li>
                            <li><strong class="text-cyan-400">07.</strong> Botão de Ação Rápida</li>
                            <li><strong class="text-cyan-400">08.</strong> Interface Facial Ergonômica</li>
                        </ul>
                        <button onclick="abrirModal('img/foto_real_8b.jpg')" class="btn-demo w-full justify-center"><span class="material-symbols-outlined">person</span> VER POSIÇÃO</button>
                    </div>
                </div>
            </div>

            <div id="s9" class="content-section space-y-8">
                <h2 class="text-4xl font-bold text-cyan-400 font-['Space_Grotesk']">09. Anatomia dos Controles</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <img src="img/passo9_1.jpg" alt="Controle Topo" class="step-img">
                    <img src="img/passo9_2.jpg" alt="Controle Lado" class="step-img">
                </div>
                <button onclick="abrirModal('img/foto_real_9.jpg')" class="btn-demo"><span class="material-symbols-outlined">person</span> VER PEGADA CORRETA</button>
            </div>
        </main>
    </div>

    <div id="modalManual" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/90 backdrop-blur-md" onclick="fecharModal()"></div>
        <div class="relative bg-slate-900 border border-white/10 rounded-[2.5rem] max-w-2xl w-full overflow-hidden shadow-2xl transition-all duration-300 scale-95 opacity-0" id="modalContainer">
            <button onclick="fecharModal()" class="absolute top-4 right-4 bg-red-500 text-white w-10 h-10 rounded-full flex items-center justify-center z-10">X</button>
            <img id="imgModal" src="" class="w-full h-auto">
            <div class="p-6 bg-slate-900 text-center text-slate-400 text-sm italic">Observe o exemplo real para garantir o uso correto.</div>
        </div>
    </div>

    <script>
        const mainContent = document.getElementById('main-content');
        function selectTopic(btn, id) {
            document.querySelectorAll('.nav-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            document.querySelectorAll('.content-section').forEach(c => c.classList.remove('active'));
            document.getElementById(id).classList.add('active');
            mainContent.scrollTop = 0;
        }
        function showAll(btn) {
            document.querySelectorAll('.nav-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            document.querySelectorAll('.content-section').forEach(c => c.classList.add('active'));
            mainContent.scrollTop = 0;
        }
        function abrirModal(src) {
            const modal = document.getElementById('modalManual');
            const container = document.getElementById('modalContainer');
            document.getElementById('imgModal').src = src;
            modal.classList.remove('hidden');
            setTimeout(() => { container.classList.remove('scale-95', 'opacity-0'); container.classList.add('scale-100', 'opacity-100'); }, 10);
        }
        function fecharModal() {
            const container = document.getElementById('modalContainer');
            container.classList.add('scale-95', 'opacity-0');
            setTimeout(() => { document.getElementById('modalManual').classList.add('hidden'); }, 300);
        }
    </script>
</body>
</html>