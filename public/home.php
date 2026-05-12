<?php
session_start();
// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: ../login.php");
    exit();
}
require_once '../layout.php';

$conteudo = "
<div class='p-10 animate-in fade-in duration-700'>
    <div class='max-w-6xl mx-auto space-y-10'>
        
        <header class='relative p-12 rounded-[3rem] overflow-hidden border border-white/5 shadow-2xl bg-slate-950/40'>
            <div class='absolute -top-24 -right-24 w-96 h-96 bg-cyan-500/10 blur-[100px] rounded-full'></div>
            
            <div class='relative z-10'>
                <div class='flex items-center gap-3 mb-4'>
                    <span class='material-symbols-outlined text-cyan-400'>partly_cloudy_day</span>
                    <span class='text-xs font-bold text-cyan-400 uppercase tracking-[0.3em]'>Bem-vindo de volta</span>
                </div>
                <h1 class='text-5xl font-bold headline text-white mb-4'>Olá, " . ($_SESSION['usuario_nome'] ?? 'Estudante') . "!</h1>
                <p class='text-slate-400 text-lg max-w-2xl leading-relaxed'>
                    O sistema <span class='text-white font-semibold'>SENAI VR</span> está operando em capacidade total. 
                    Explore seus módulos de treinamento e laboratórios virtuais abaixo.
                </p>
            </div>
        </header>

        <div class='grid grid-cols-1 md:grid-cols-3 gap-6'>
            
            <a href='tutorial.php' class='glass p-8 rounded-[2.5rem] hover:border-cyan-500/50 hover:bg-slate-900/40 transition-all group'>
                <div class='w-14 h-14 bg-cyan-500/10 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform'>
                    <span class='material-symbols-outlined text-cyan-400 text-3xl'>auto_stories</span>
                </div>
                <h3 class='text-xl font-bold text-white mb-2 headline'>Manual Técnico</h3>
                <p class='text-slate-500 text-sm'>Acesse os protocolos de segurança e setup do Quest 3S.</p>
                <div class='mt-6 flex items-center gap-2 text-cyan-400 text-xs font-bold uppercase tracking-widest'>
                    Acessar <span class='material-symbols-outlined text-sm'>arrow_forward</span>
                </div>
            </a>

            <a href='dashboard.php' class='glass p-8 rounded-[2.5rem] hover:border-purple-500/50 hover:bg-slate-900/40 transition-all group'>
                <div class='w-14 h-14 bg-purple-500/10 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform'>
                    <span class='material-symbols-outlined text-purple-400 text-3xl'>forum</span>
                </div>
                <h3 class='text-xl font-bold text-white mb-2 headline'>Chat Neural</h3>
                <p class='text-slate-500 text-sm'>Interaja com o suporte e tire dúvidas sobre os experimentos.</p>
                <div class='mt-6 flex items-center gap-2 text-purple-400 text-xs font-bold uppercase tracking-widest'>
                    Conversar <span class='material-symbols-outlined text-sm'>arrow_forward</span>
                </div>
            </a>

            <a href='quiosque.php' class='glass p-8 rounded-[2.5rem] hover:border-emerald-500/50 hover:bg-slate-900/40 transition-all group'>
                <div class='w-14 h-14 bg-emerald-500/10 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform'>
                    <span class='material-symbols-outlined text-emerald-400 text-3xl'>smart_display</span>
                </div>
                <h3 class='text-xl font-bold text-white mb-2 headline'>Modo Quiosque</h3>
                <p class='text-slate-500 text-sm'>Gerencie as aplicações VR em execução e telemetria.</p>
                <div class='mt-6 flex items-center gap-2 text-emerald-400 text-xs font-bold uppercase tracking-widest'>
                    Monitorar <span class='material-symbols-outlined text-sm'>arrow_forward</span>
                </div>
            </a>

        </div>

        <section class='glass p-8 rounded-[2.5rem] border-white/5'>
            <div class='flex items-center justify-between'>
                <div class='flex items-center gap-4'>
                    <div class='w-3 h-3 bg-green-500 rounded-full animate-pulse'></div>
                    <span class='text-xs font-bold text-slate-400 uppercase tracking-widest'>Status Global: Online</span>
                </div>
                <div class='text-slate-600 text-[10px] font-mono'>
                    LAST_SYNC: " . date('d/m/Y H:i') . "
                </div>
            </div>
        </section>

    </div>
</div>
";

renderizar_pagina("Início", $conteudo);
?>