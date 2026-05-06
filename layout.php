<?php
function renderizar_pagina($titulo, $conteudo) {
?>
<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <title><?php echo $titulo; ?> | Ethereal Lab</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk&family=Manrope&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <style>
        body { background-color: #0a0e14; }
        .glass-panel { background: rgba(32, 38, 47, 0.4); backdrop-filter: blur(20px); }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="text-white min-h-screen">
    <aside class="fixed left-0 top-0 h-screen w-72 bg-slate-900/60 border-r border-white/10 z-40">
        </aside>

    <header class="fixed top-0 left-72 right-0 h-20 bg-slate-950/40 backdrop-blur-xl border-b border-white/5 z-30">
        </header>

    <main class="ml-72 pt-20">
        <?php echo $conteudo; ?>
    </main>
</body>
</html>
<?php
}
?>