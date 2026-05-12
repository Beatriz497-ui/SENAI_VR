<?php
session_start();
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: ../login.php");
    exit();
}
require_once '../layout.php';

// Lista completa de matérias expandida
$materias = [
    ['nome' => 'Biologia', 'icon' => 'dna', 'cor' => 'emerald', 'desc' => 'Células, anatomia e ecossistemas em 3D.', 'link' => 'materia_biologia.php'],
    ['nome' => 'Português', 'icon' => 'menu_book', 'cor' => 'blue', 'desc' => 'Literatura e gramática aplicada imersiva.', 'link' => 'materia_portugues.php'],
    ['nome' => 'Matemática', 'icon' => 'calculate', 'cor' => 'purple', 'desc' => 'Geometria espacial e cálculos visualizados.', 'link' => 'materia_matematica.php'],
    ['nome' => 'Física', 'icon' => 'precision_manufacturing', 'cor' => 'orange', 'desc' => 'Simulações de leis da física e mecânica.', 'link' => 'materia_fisica.php'],
    ['nome' => 'Química', 'icon' => 'science', 'cor' => 'cyan', 'desc' => 'Laboratório de reações e estruturas atômicas.', 'link' => 'materia_quimica.php'],
    ['nome' => 'História', 'icon' => 'history', 'cor' => 'rose', 'desc' => 'Viagens no tempo para grandes eventos.', 'link' => 'materia_historia.php'],
    
    // NOVAS MATÉRIAS ADICIONADAS
    ['nome' => 'Geografia', 'icon' => 'public', 'cor' => 'lime', 'desc' => 'Geopolítica e análise de terrenos globais.', 'link' => 'materia_geografia.php'],
    ['nome' => 'Inglês', 'icon' => 'translate', 'cor' => 'indigo', 'desc' => 'Prática de conversação em cenários reais.', 'link' => 'materia_ingles.php'],
    ['nome' => 'Sociologia', 'icon' => 'groups', 'cor' => 'amber', 'desc' => 'Estudo das estruturas sociais e interação humana.', 'link' => 'materia_sociologia.php'],
    ['nome' => 'Filosofia', 'icon' => 'psychology_alt', 'cor' => 'violet', 'desc' => 'O pensamento humano e grandes dilemas éticos.', 'link' => 'materia_filosofia.php'],
    ['nome' => 'Artes', 'icon' => 'palette', 'cor' => 'pink', 'desc' => 'Exposição de galerias virtuais e criação 3D.', 'link' => 'materia_artes.php'],
    ['nome' => 'Ed. Física', 'icon' => 'fitness_center', 'cor' => 'red', 'desc' => 'Fisiologia do exercício e práticas esportivas.', 'link' => 'materia_ed_fisica.php']
];

$conteudo = "
<div class='p-10 animate-in fade-in duration-700'>
    <div class='max-w-6xl mx-auto'>
        
        <div class='mb-12'>
            <h1 class='text-4xl font-bold headline text-white mb-2'>Módulos de Aprendizado</h1>
            <p class='text-slate-400'>Selecione uma disciplina para iniciar a experiência em realidade virtual.</p>
        </div>

        <div class='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6'>";

foreach ($materias as $m) {
    $conteudo .= "
            <a href='{$m['link']}' class='glass group p-8 rounded-[2.5rem] hover:border-{$m['cor']}-500/50 hover:bg-{$m['cor']}-500/5 transition-all duration-300'>
                <div class='flex justify-between items-start mb-6'>
                    <div class='w-14 h-14 bg-{$m['cor']}-500/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform'>
                        <span class='material-symbols-outlined text-{$m['cor']}-400 text-3xl'>{$m['icon']}</span>
                    </div>
                    <span class='material-symbols-outlined text-slate-600 group-hover:text-{$m['cor']}-400 transition-colors'>arrow_outward</span>
                </div>
                
                <h3 class='text-xl font-bold text-white mb-3 headline'>{$m['nome']}</h3>
                <p class='text-slate-500 text-sm leading-relaxed mb-6'>
                    {$m['desc']}
                </p>
                
                <div class='h-1 w-full bg-slate-800 rounded-full overflow-hidden'>
                    <div class='h-full bg-{$m['cor']}-500 w-1/4 group-hover:w-full transition-all duration-700'></div>
                </div>
            </a>";
}

$conteudo .= "
        </div>
    </div>
</div>
";

renderizar_pagina("Matérias", $conteudo);
?>