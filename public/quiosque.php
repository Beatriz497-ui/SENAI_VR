<?php
session_start();
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: ../login.php");
    exit();
}
require_once '../layout.php';

$conteudo = "
<div class='p-10 animate-in fade-in duration-500 bg-transparent'>
    <div class='max-w-6xl mx-auto space-y-10'>
        
        <header class='flex justify-between items-end'>
            <div>
                <div class='flex items-center gap-2 mb-2'>
                    <span class='material-symbols-outlined text-cyan-400 text-sm'>settings_input_antenna</span>
                    <span class='text-[10px] font-bold text-cyan-400 uppercase tracking-widest'>Admin Console</span>
                </div>
                <h1 class='text-4xl font-bold headline text-white'>Modo Quiosque</h1>
                <p class='text-slate-500 mt-2 text-sm'>Restrição de ambiente e imersão de segurança ativa.</p>
            </div>
            <div class='px-5 py-2.5 bg-emerald-500/10 border border-emerald-500/30 rounded-xl text-emerald-400 text-sm font-bold flex items-center gap-3 shadow-[0_0_20px_rgba(16,185,129,0.1)]'>
                <span class='relative flex h-3 w-3'>
                    <span class='animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75'></span>
                    <span class='relative inline-flex rounded-full h-3 w-3 bg-emerald-500'></span>
                </span>
                SISTEMA BLOQUEADO
            </div>
        </header>

        <div class='grid grid-cols-1 gap-6'>
            
            <section class='glass p-8 rounded-[2rem]'>
                <h2 class='text-xl font-bold flex items-center gap-2 mb-8'>
                    <span class='material-symbols-outlined text-slate-400 text-lg'>apps</span>
                    Aplicação em Execução
                </h2>
                
                <div class='flex flex-col md:flex-row items-center gap-8 p-8 bg-slate-900/40 rounded-2xl border border-white/5'>
                    <div class='relative'>
                        <div class='absolute -inset-1 bg-cyan-500/20 blur rounded-xl'></div>
                        <div class='relative w-24 h-24 bg-slate-800 rounded-xl flex items-center justify-center border border-white/10'>
                             <span class='material-symbols-outlined text-5xl text-cyan-400'>view_in_ar</span>
                        </div>
                    </div>
                    
                    <div class='text-center md:text-left flex-1'>
                        <h3 class='text-3xl font-bold text-white headline'>Ethereal Lab VR</h3>
                        <p class='text-slate-500 font-mono text-base mt-2'>v2.4.0-stable | Runtime: 01:24:12</p>
                    </div>

                    <div class='flex flex-col gap-3'>
                        <button class='px-10 py-4 bg-red-500/10 text-red-400 border border-red-500/20 rounded-xl hover:bg-red-600 hover:text-white font-bold transition-all duration-300 shadow-lg active:scale-95'>
                            Encerrar Sessão
                        </button>
                    </div>
                </div>
            </section>

        </div>

        <section class='glass p-8 rounded-[2rem]'>
            <h2 class='text-xl font-bold mb-8 flex items-center gap-2'>
                <span class='material-symbols-outlined text-slate-400 text-lg'>security</span>
                Controles Críticos
            </h2>
            <div class='grid grid-cols-2 md:grid-cols-4 gap-4'>
                <button class='p-8 bg-white/5 rounded-3xl flex flex-col items-center gap-4 border border-white/5 hover:bg-white/10 transition-all group'>
                    <span class='material-symbols-outlined text-cyan-400 text-3xl group-hover:scale-110 transition-transform'>lock</span>
                    <span class='text-sm font-bold uppercase tracking-wider text-slate-300'>Travar Menu</span>
                </button>
                
                <button class='p-8 bg-white/5 rounded-3xl flex flex-col items-center gap-4 border border-white/5 hover:bg-white/10 transition-all group'>
                    <span class='material-symbols-outlined text-purple-400 text-3xl group-hover:scale-110 transition-transform'>visibility_off</span>
                    <span class='text-sm font-bold uppercase tracking-wider text-slate-300'>Privacidade</span>
                </button>

                <button class='p-8 bg-white/5 rounded-3xl flex flex-col items-center gap-4 border border-white/5 hover:bg-white/10 transition-all group'>
                    <span class='material-symbols-outlined text-orange-400 text-3xl group-hover:scale-110 transition-transform'>wifi_off</span>
                    <span class='text-sm font-bold uppercase tracking-wider text-slate-300'>Off-line</span>
                </button>

                <button class='p-8 bg-red-500/5 rounded-3xl flex flex-col items-center gap-4 border border-red-500/10 hover:border-red-500 hover:bg-red-950/30 transition-all group'>
                    <span class='material-symbols-outlined text-red-500 text-3xl group-hover:scale-110 transition-transform'>power_settings_new</span>
                    <span class='text-sm font-bold uppercase tracking-wider text-red-200'>Desligar</span>
                </button>
            </div>
        </section>
    </div>
</div>
";

renderizar_pagina("Modo Quiosque", $conteudo);
?>