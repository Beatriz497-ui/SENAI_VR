<?php
session_start();
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../layout.php';

$nome_usuario = $_SESSION['usuario_nome'] ?? 'Pesquisador';

// Montagem do conteúdo da Dashboard (Interface de Chat IA sem os banners da direita)
$conteudo = "
<div class='flex flex-col h-[calc(100vh-80px)] p-6 gap-6'>
    
    <div class='flex justify-between items-center'>
        <div>
            <span class='text-cyan-400 text-[10px] font-bold tracking-[0.2em] uppercase'>Sessão Interativa</span>
            <h1 class='text-3xl font-bold text-white'>Assistente Espacial IA</h1>
        </div>
        <div class='flex items-center gap-3 bg-slate-900/50 px-4 py-2 rounded-full border border-white/5'>
            <div class='w-2 h-2 bg-green-500 rounded-full animate-pulse'></div>
            <span class='text-[10px] font-bold text-slate-300 tracking-widest uppercase'>Link Neural Ativo</span>
        </div>
    </div>

    <div class='flex flex-1 gap-6 overflow-hidden'>
        
        <div id='chatContainer' class='flex-1 flex flex-col gap-4 overflow-y-auto pr-2 scrollbar-hide'>
            
            <div class='flex gap-4 mb-4'>
                <div class='w-10 h-10 rounded-xl bg-cyan-500/20 flex items-center justify-center border border-cyan-500/30 flex-shrink-0'>
                    <span class='material-symbols-outlined text-cyan-400'>smart_toy</span>
                </div>
                <div class='glass-panel p-6 rounded-2xl rounded-tl-none max-w-2xl border border-white/5'>
                    <p class='text-slate-300 leading-relaxed'>
                        Saudações, $nome_usuario. Eu sou o seu Assistente Virtual. O que vamos investigar hoje?
                    </p>
                    </p>
                </div>
            </div>

        </div>
        </div>

    <div class='relative mt-auto'>
        <div class='absolute left-5 top-1/2 -translate-y-1/2 flex gap-4 text-slate-500'>
            <input type='file' id='fileInput' class='hidden' onchange='handleFile(this)'>
            <span class='material-symbols-outlined cursor-pointer hover:text-white transition-colors' onclick='document.getElementById(\"fileInput\").click()'>attachment</span>
        </div>
        
        <input type='text' id='userInput' placeholder='Pergunte sobre módulos espaciais, atualizações ou hardware...' 
            class='w-full bg-slate-900/50 border border-white/10 rounded-2xl py-5 pl-14 pr-32 text-sm text-white focus:outline-none focus:border-cyan-500/50 transition-all'>
        
        <div class='absolute right-3 top-1/2 -translate-y-1/2 flex items-center gap-2'>
            <button onclick='enviarMensagem()' class='bg-cyan-400 hover:bg-cyan-300 text-slate-950 p-2 rounded-xl transition-all shadow-lg shadow-cyan-500/20'>
                <span class='material-symbols-outlined font-bold'>send</span>
            </button>
        </div>
    </div>
    
    <div class='text-center'>
        <p class='text-[9px] text-slate-600 font-bold tracking-[0.3em] uppercase'>Link Neural Criptografado de Ponta-a-Ponta • Spatial Engine v4.2.0</p>
    </div>
</div>

<script>
    function enviarMensagem() {
        const input = document.getElementById('userInput');
        const container = document.getElementById('chatContainer');
        const texto = input.value.trim();

        if (texto !== '') {
            // Adiciona mensagem do usuário
            const userMsg = `
                <div class='flex gap-4 justify-end mb-4'>
                    <div class='glass-panel p-6 rounded-2xl rounded-tr-none max-w-xl border border-cyan-500/20 bg-cyan-500/5'>
                        <p class='text-slate-200'>\${texto}</p>
                    </div>
                    <div class='w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center border border-white/10 flex-shrink-0'>
                        <span class='material-symbols-outlined text-slate-400'>person</span>
                    </div>
                </div>
            `;
            container.innerHTML += userMsg;
            
            input.value = '';
            container.scrollTop = container.scrollHeight;

            // Simula resposta da IA após 1 segundo
            setTimeout(() => {
                const aiMsg = `
                    <div class='flex gap-4 mb-4'>
                        <div class='w-10 h-10 rounded-xl bg-cyan-500/20 flex items-center justify-center border border-cyan-500/30 flex-shrink-0'>
                            <span class='material-symbols-outlined text-cyan-400'>smart_toy</span>
                        </div>
                        <div class='glass-panel p-6 rounded-2xl rounded-tl-none max-w-2xl border border-white/5 text-slate-300 italic'>
                            Analisando dados neurais para sua consulta... Acesso concedido ao módulo de conhecimento. Como posso ajudar mais com \"\${texto}\"?
                        </div>
                    </div>
                `;
                container.innerHTML += aiMsg;
                container.scrollTop = container.scrollHeight;
            }, 1000);
        }
    }

    // Enviar com a tecla ENTER
    document.getElementById('userInput').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') enviarMensagem();
    });

    // Função para o Anexo
    function handleFile(input) {
        if (input.files && input.files[0]) {
            alert('Arquivo \"' + input.files[0].name + '\" detectado. Iniciando upload para o núcleo espacial...');
        }
    }
</script>
";

renderizar_pagina("Assistente IA", $conteudo);
?>