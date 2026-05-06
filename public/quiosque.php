<!DOCTYPE html>
<html class="dark" lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Quiosque | Ethereal Lab</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Manrope:wght@300;500;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        body { 
            background: radial-gradient(circle at top left, #0a0f1a, #05070a); 
            font-family: 'Manrope', sans-serif; 
            color: #fff; 
            min-height: 100vh;
        }
        .glass-panel { 
            background: rgba(18, 22, 33, 0.6); 
            backdrop-filter: blur(20px); 
            border: 1px solid rgba(255,255,255,0.08); 
            transition: all 0.3s ease;
        }
        .glass-panel:hover {
            border-color: rgba(255,255,255,0.15);
            transform: translateY(-2px);
        }
        .active-glow { 
            box-shadow: 0 0 30px rgba(16, 185, 129, 0.1); 
        }
        .btn-action {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-action:hover {
            background: rgba(255,255,255,0.08);
            transform: scale(1.05);
        }
        .btn-action:active {
            transform: scale(0.95);
        }
        /* Animação suave para as barras de progresso */
        .progress-bar { transition: width 1.5s ease-in-out; }
    </style>
</head>
<body class="p-8 md:p-12">

    <div class="max-w-6xl mx-auto space-y-10">
        <header class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="material-symbols-outlined text-cyan-500">settings_input_antenna</span>
                    <span class="text-xs font-bold tracking-[0.2em] text-cyan-500 uppercase">Admin Dashboard</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold font-['Space_Grotesk'] text-white">Modo Quiosque</h1>
                <p class="text-slate-400 mt-2">Restrição de ambiente e imersão de segurança ativa.</p>
            </div>
            <div class="px-5 py-2.5 bg-emerald-500/10 border border-emerald-500/30 rounded-xl text-emerald-400 text-sm font-bold flex items-center gap-3 active-glow">
                <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                </span>
                SISTEMA BLOQUEADO
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <section class="col-span-1 md:col-span-2 glass-panel p-8 rounded-[2rem]">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-xl font-bold flex items-center gap-2">
                        <span class="material-symbols-outlined text-slate-400 text-lg">apps</span>
                        Aplicação em Execução
                    </h2>
                </div>
                
                <div class="flex flex-col sm:flex-row items-center gap-6 p-6 bg-white/[0.03] rounded-2xl border border-white/5">
                    <div class="relative">
                        <div class="absolute -inset-1 bg-cyan-500/20 blur rounded-full"></div>
                        <img src="https://cdn-icons-png.flaticon.com/512/869/869062.png" class="relative w-20 h-20 grayscale brightness-125" alt="App Icon">
                    </div>
                    <div class="text-center sm:text-left">
                        <h3 class="text-2xl font-bold text-white">Ethereal Lab VR</h3>
                        <p class="text-slate-400 font-mono text-sm">v2.4.0-stable | Runtime: 01:24:12</p>
                    </div>
                    <button class="sm:ml-auto w-full sm:w-auto px-8 py-3 bg-red-500/10 text-red-400 border border-red-500/20 rounded-xl hover:bg-red-600 hover:text-white font-bold transition-all duration-300">
                        Encerrar Sessão
                    </button>
                </div>
            </section>

            <section class="glass-panel p-8 rounded-[2rem] active-glow">
                <h2 class="text-xl font-bold mb-8 flex items-center gap-2">
                    <span class="material-symbols-outlined text-slate-400 text-lg">monitoring</span>
                    Telemetria
                </h2>
                <div class="space-y-8">
                    <div>
                        <div class="flex justify-between text-xs font-bold uppercase tracking-wider text-slate-500 mb-3">
                            <span>Uso de CPU</span>
                            <span class="text-cyan-400">42%</span>
                        </div>
                        <div class="h-1.5 bg-slate-800/50 rounded-full overflow-hidden">
                            <div class="h-full bg-cyan-500 progress-bar rounded-full" style="width: 42%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-xs font-bold uppercase tracking-wider text-slate-500 mb-3">
                            <span>Frame Rate</span>
                            <span class="text-emerald-400">72 FPS</span>
                        </div>
                        <div class="h-1.5 bg-slate-800/50 rounded-full overflow-hidden">
                            <div class="h-full bg-emerald-500 progress-bar rounded-full" style="width: 90%"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <section class="glass-panel p-8 rounded-[2rem]">
            <h2 class="text-xl font-bold mb-8 flex items-center gap-2">
                <span class="material-symbols-outlined text-slate-400 text-lg">security</span>
                Controles Críticos
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <button class="btn-action p-6 bg-white/5 rounded-3xl flex flex-col items-center gap-4 border border-white/5">
                    <div class="p-3 bg-cyan-500/10 rounded-xl">
                        <span class="material-symbols-outlined text-cyan-400">lock</span>
                    </div>
                    <span class="text-sm font-bold">Bloquear Menu</span>
                </button>
                
                <button class="btn-action p-6 bg-white/5 rounded-3xl flex flex-col items-center gap-4 border border-white/5">
                    <div class="p-3 bg-purple-500/10 rounded-xl">
                        <span class="material-symbols-outlined text-purple-400">visibility_off</span>
                    </div>
                    <span class="text-sm font-bold">Ocultar Sistema</span>
                </button>

                <button class="btn-action p-6 bg-white/5 rounded-3xl flex flex-col items-center gap-4 border border-white/5">
                    <div class="p-3 bg-orange-500/10 rounded-xl">
                        <span class="material-symbols-outlined text-orange-400">wifi_off</span>
                    </div>
                    <span class="text-sm font-bold">Bloquear Wi-Fi</span>
                </button>

                <button class="btn-action p-6 bg-red-500/5 rounded-3xl flex flex-col items-center gap-4 border border-red-500/10 hover:border-red-500/40">
                    <div class="p-3 bg-red-500/10 rounded-xl">
                        <span class="material-symbols-outlined text-red-500">power_settings_new</span>
                    </div>
                    <span class="text-sm font-bold text-red-200">Desligar Remoto</span>
                </button>
            </div>
        </section>
    </div>

</body>
</html>