<?php
function renderizar_pagina($titulo, $conteudo) {
    // Pega o nome do arquivo atual para o menu ativo
    $pagina_atual = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html class="dark" lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title><?php echo $titulo; ?> | Ethereal Lab</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;700&family=Plus+Jakarta+Sans:wght@300;400;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    <style>
        :root { --primary: #22d3ee; --bg: #020617; }
        body { 
            background-color: var(--bg); 
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-image: radial-gradient(circle at 50% -20%, #0f172a 0%, #020617 100%);
        }
        .headline { font-family: 'Space Grotesk', sans-serif; }
        .glass { background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.05); }
        
        .sidebar-link { transition: all 0.2s ease; border-right: 3px solid transparent; }
        .sidebar-link:hover { background: rgba(34, 211, 238, 0.05); color: var(--primary); }
        
        /* CLASSE ATIVA */
        .sidebar-link.active { 
            background: rgba(34, 211, 238, 0.1); 
            color: #22d3ee !important; 
            border-right-color: #22d3ee; 
        }
        .sidebar-link.active span { color: #22d3ee; }
    </style>
</head>
<body class="text-slate-200 min-h-screen flex overflow-x-hidden">

    <aside class="fixed left-0 top-0 h-screen w-72 bg-slate-950/50 border-r border-white/5 z-40 flex flex-col">
        <div class="p-8 mb-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-cyan-400 rounded-lg shadow-[0_0_15px_rgba(34,211,238,0.4)] flex items-center justify-center">
                <span class="material-symbols-outlined text-slate-950 text-xl font-bold">vrpano</span>
            </div>
            <h2 class="headline text-xl font-bold text-white tracking-tighter">SPATIAL CORE</h2>
        </div>

        <nav class="flex-1 px-4 space-y-1">
            <?php
            $menu = [
                'home.php' => ['Início', 'grid_view'],
                'dashboard.php' => ['Chat Neural', 'forum'],
                'tutorial.php' => ['Manual', 'auto_stories'],
                'quiosque.php' => ['Quiosque', 'smart_display'],
                'materias.php' => ['Matérias', 'history_edu']
            ];

            foreach ($menu as $url => $info): 
                $ativo = ($pagina_atual == $url) ? 'active' : '';
            ?>
                <a href="<?php echo $url; ?>" class="sidebar-link <?php echo $ativo; ?> flex items-center gap-3 p-3 rounded-xl text-slate-400 group">
                    <span class="material-symbols-outlined text-[20px]"><?php echo $info[1]; ?></span>
                    <span class="text-sm font-medium"><?php echo $info[0]; ?></span>
                </a>
            <?php endforeach; ?>
        </nav>

        <div class="p-4 mt-auto border-t border-white/5">
            <div class="flex items-center gap-3 p-2 bg-slate-900/50 rounded-xl">
                <div class="relative w-10 h-10 rounded-full bg-cyan-500/10 flex items-center justify-center border border-cyan-400/30">
                    <span class="material-symbols-outlined text-cyan-400 text-xl">person</span>
                    <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-slate-950 animate-pulse"></span>
                </div>
                <div class="overflow-hidden">
                    <p class="text-xs font-bold text-white truncate"><?php echo $_SESSION['usuario_nome'] ?? 'Estudante'; ?></p>
                    <p class="text-[10px] text-green-500 uppercase font-bold tracking-widest">Online</p>
                </div>
                <a href="../logout.php" class="ml-auto text-slate-600 hover:text-red-400 transition-colors">
                    <span class="material-symbols-outlined text-[20px]">logout</span>
                </a>
            </div>
        </div>
    </aside>

    <main class="ml-72 flex-1 flex flex-col">
        <header class="h-16 border-b border-white/5 flex items-center px-8 bg-slate-950/20 backdrop-blur-md sticky top-0 z-30">
            <span class="text-[10px] font-bold tracking-[0.3em] text-slate-600 uppercase italic">Central Neural • Spatial Engine v4.2</span>
        </header>
        <div class="flex-1">
            <?php echo $conteudo; ?>
        </div>
    </main>

</body>
</html>
<?php
}
?>