<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once 'config.php';

$erro = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // A consulta aceita nome de usuário OU e-mail, como diz no seu layout
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE (email = ? OR nome = ?) AND senha = ?");
    $stmt->execute([$usuario, $usuario, $senha]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['usuario_logado'] = true;
        $_SESSION['usuario_nome'] = $user['nome'];
        header("Location: public/home.php");
        exit();
    } else {
        $erro = "Falha na sincronização neural. Verifique suas credenciais.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sincronizando Interface Neural | SENAI VR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;700&family=Manrope:wght@400;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        body {
            font-family: 'Manrope', sans-serif;
            background: radial-gradient(circle at center, #0f172a 0%, #020617 100%);
            overflow: hidden;
        }
        .headline { font-family: 'Space Grotesk', sans-serif; line-height: 0.9; }
        .glass-card {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
        .glow-text {
            text-shadow: 0 0 20px rgba(129, 236, 255, 0.5);
        }
        .input-dark {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
       .bg-spatial {
        background-image: url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=2072&auto=format&fit=crop'); /* Link de uma imagem espacial de alta qualidade */
        background-size: cover;
        background-position: center;
        position: fixed;
        inset: 0;
        z-index: -10;
    }
    /* Camada de cor por cima da foto para dar o efeito azulado da sua imagem */
    .bg-spatial::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at center, rgba(15, 23, 42, 0.4) 0%, #020617 90%);
    }
    </style>
</head>
<body class="text-white min-h-screen flex flex-col">

    <div class="fixed inset-0 -z-10 bg-spatial"></div>

    <main class="flex-1 flex items-center justify-center px-6 lg:px-24">
        <div class="container max-w-7xl flex flex-col lg:flex-row items-center justify-between gap-12">
            
            <div class="max-w-2xl text-left">
                <span class="bg-slate-800/60 px-4 py-1 rounded-full text-[10px] tracking-[0.2em] uppercase font-bold text-slate-400 border border-white/5 mb-8 inline-block">
                    Sistema Educacional Espacial
                </span>
                <h1 class="headline text-6xl lg:text-8xl font-bold mb-6">
                    Entre na nossa <br>
                    <span class="text-primary text-cyan-400 glow-text">EDUCAÇÃO <br> IMERSIVA!</span>
                </h1>
                <p class="text-slate-400 text-lg max-w-md font-light leading-relaxed">
                    Acesse seu ambiente de aprendizado imersivo e continue sua jornada através da web espacial.
                </p>
            </div>

            <div class="glass-card p-10 rounded-[2rem] w-full max-w-[440px] relative overflow-hidden">
                <div class="mb-10">
                    <h2 class="text-2xl font-light text-cyan-400 inline-block">token</h2>
                    <h2 class="text-2xl font-bold inline-block ml-2 uppercase tracking-tighter">SENAI VR</h2>
                    <p class="text-xs text-slate-500 mt-1 italic">Sincronizando interface ...</p>
                </div>

                <form method="POST" class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] uppercase tracking-widest font-bold text-slate-400">Nome de usuário ou E-mail</label>
                        <div class="relative">
                            <input type="text" name="usuario" placeholder="usuario@gmail.com" 
                                class="w-full input-dark rounded-xl p-4 text-white focus:outline-none focus:ring-2 focus:ring-cyan-500/50 transition-all placeholder:text-slate-600">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] uppercase tracking-widest font-bold text-slate-400">Chave de acesso</label>
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-4 text-slate-500 text-sm">lock</span>
                            <input type="password" name="senha" placeholder="••••••••" 
                                class="w-full input-dark rounded-xl p-4 pl-12 text-white focus:outline-none focus:ring-2 focus:ring-cyan-500/50 transition-all">
                            <span class="material-symbols-outlined absolute right-4 text-slate-500 cursor-pointer hover:text-cyan-400 transition-colors">visibility</span>
                        </div>
                    </div>

                    <?php if($erro): ?>
                        <div class="bg-red-500/10 border border-red-500/50 p-3 rounded-lg text-red-400 text-xs text-center">
                            <?php echo $erro; ?>
                        </div>
                    <?php endif; ?>

                    <button type="submit" class="w-full bg-cyan-400 hover:bg-cyan-300 text-slate-950 font-extrabold py-4 rounded-xl flex items-center justify-center gap-2 transition-all transform active:scale-95 shadow-[0_0_30px_rgba(34,211,238,0.3)]">
                        Entrar <span class="material-symbols-outlined font-bold">arrow_forward</span>
                    </button>
                </form>
            </div>
        </div>
    </main>

    <footer class="p-6 flex justify-center gap-8 text-[10px] font-bold tracking-widest text-slate-600 border-t border-white/5 bg-black/20">
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
            MAINFRAME LINK: SEGURO
        </div>
        <div>LANGUAGE: PT-BR</div>
        <div>TERMINAL: V2.4.0-ESTÁVEL</div>
    </footer>

</body>
</html>