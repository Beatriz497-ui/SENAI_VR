<?php
session_start();
require_once '../layout.php';

$nome = $_SESSION['usuario_nome'] ?? 'User';

$conteudo = "
<div class='flex flex-col h-[calc(100vh-64px)] overflow-hidden bg-transparent'>
    
    <div id='chatContainer' class='flex-1 overflow-y-auto p-8 space-y-6 scrollbar-hide'>
        
        <div class='flex gap-4 animate-in fade-in slide-in-from-bottom-4 duration-700'>
            <div class='w-10 h-10 rounded-xl glass flex items-center justify-center border border-cyan-400/20 shadow-[0_0_15px_rgba(34,211,238,0.1)]'>
                <span class='material-symbols-outlined text-cyan-400'>smart_toy</span>
            </div>
            <div class='glass p-5 rounded-2xl rounded-tl-none max-w-2xl border border-white/5'>
                <p class='text-sm leading-relaxed text-slate-300'>
                    Olá <span class='text-white font-bold'>$nome</span>, sua interface neural está sincronizada. Como posso auxiliar em sua jornada imersiva hoje?
                </p>
            </div>
        </div>

    </div>

    <div class='p-6 bg-gradient-to-t from-slate-950 to-transparent'>
        <div class='max-w-4xl mx-auto relative'>
            <div class='glass rounded-[2rem] p-2 flex items-center border border-white/10 focus-within:border-cyan-400/50 transition-all shadow-2xl'>
                
                <button class='p-3 text-slate-500 hover:text-cyan-400 transition-colors' title='Anexar'>
                    <span class='material-symbols-outlined text-[22px]'>attach_file</span>
                </button>
                
                <input type='text' id='userInput' placeholder='Pergunte algo para a IA...' 
                    class='flex-1 bg-transparent border-none focus:ring-0 text-sm text-white px-2 placeholder:text-slate-600'>
                
                <button onclick='enviarMensagem()' class='bg-cyan-400 hover:bg-cyan-300 text-slate-950 w-11 h-11 rounded-full flex items-center justify-center transition-all shadow-lg hover:scale-105 active:scale-95'>
                    <span class='material-symbols-outlined font-bold'>arrow_upward</span>
                </button>
            </div>
            <p class='text-[9px] text-center mt-3 text-slate-600 tracking-widest uppercase font-bold'>Ethereal Neural Link • Senai VR Interface</p>
        </div>
    </div>
</div>

<script>
    function enviarMensagem() {
        const input = document.getElementById('userInput');
        const container = document.getElementById('chatContainer');
        const texto = input.value.trim();

        if (texto !== '') {
            // Bolha do Usuário
            container.innerHTML += `
                <div class='flex gap-4 justify-end items-start animate-in fade-in slide-in-from-bottom-2 duration-300'>
                    <div class='bg-cyan-400/10 border border-cyan-400/20 p-4 rounded-2xl rounded-tr-none max-w-xl shadow-lg'>
                        <p class='text-sm text-cyan-50 text-right'>\${texto}</p>
                    </div>
                </div>
            `;
            
            input.value = '';
            container.scrollTop = container.scrollHeight;

            // Resposta Simulada
            setTimeout(() => {
                const respostaIA = texto.toLowerCase().includes('quest') 
                    ? 'Para ligar o Meta Quest, pressione o botão lateral por 2 segundos. O logo da Meta aparecerá no visor.'
                    : 'Processando solicitação... Módulos de matérias carregados. Deseja que eu explique um tópico específico?';

                container.innerHTML += `
                    <div class='flex gap-4 animate-in fade-in slide-in-from-bottom-2 duration-300'>
                        <div class='w-10 h-10 rounded-xl glass flex items-center justify-center border border-cyan-400/20'>
                            <span class='material-symbols-outlined text-cyan-400'>smart_toy</span>
                        </div>
                        <div class='glass p-5 rounded-2xl rounded-tl-none max-w-2xl border border-white/5'>
                            <p class='text-sm leading-relaxed text-slate-300'>\${respostaIA}</p>
                        </div>
                    </div>
                `;
                container.scrollTop = container.scrollHeight;
            }, 1000);
        }
    }

    document.getElementById('userInput').addEventListener('keypress', (e) => { if (e.key === 'Enter') enviarMensagem(); });
</script>
";

renderizar_pagina("Painel de Controle", $conteudo);
?>