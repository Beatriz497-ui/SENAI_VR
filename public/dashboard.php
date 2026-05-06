<?php
// 1. Ligar as ferramentas de erro e sessão
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// 2. Trava de Segurança: Só entra quem logou no login.php
if (!isset($_SESSION['usuario_logado']) || $_SESSION['usuario_logado'] !== true) {
    header("Location: ../login.php");
    exit();
}

// 3. Pegar o nome do usuário para exibir na tela
$nome_exibicao = $_SESSION['usuario_nome'] ?? "Explorador";
?>

<!DOCTYPE html>
<html class="dark" lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Central | SENAI VR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Manrope:wght@300;500;700&display=swap" rel="stylesheet"/>
    <style>
        body { 
            background: linear-gradient(-45deg, #010204, #061621, #010204, #0a1f2e);
            background-size: 400% 400%;
            animation: gradientBG 20s ease infinite;
            font-family: 'Manrope', sans-serif; 
            color: #fff; 
            height: 100vh;
            overflow: hidden;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .glass-sidebar {
            background: rgba(18, 22, 33, 0.6);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        .glass-card { 
            background: rgba(18, 22, 33, 0.4); 
            backdrop