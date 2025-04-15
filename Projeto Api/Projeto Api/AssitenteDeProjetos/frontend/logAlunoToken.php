<?php
session_start(); // Inicia a sessão para acessar a variável de sessão

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém o token inserido pelo usuário
    $token_inserido = $_POST['token'];

    // Obtém o token enviado por email armazenado na variável de sessão
    $token_enviado = $_SESSION['token_enviado'];

    // Verifica se os tokens correspondem
    if ($token_inserido === $token_enviado) {
        // Tokens correspondem, redireciona para a página de sucesso ou executa outra ação
        header("Location: sucesso.php"); // Substitua "sucesso.php" pelo destino desejado
        exit();
    } else {
        // Tokens não correspondem, redireciona para a página de erro ou executa outra ação
        header("Location: erro.php"); // Substitua "erro.php" pelo destino desejado
        exit();
    }
} else {
    // Se o formulário não foi submetido, redireciona para alguma página ou exibe uma mensagem de erro
    header("Location: erro.php"); // Substitua "erro.php" pelo destino desejado
    exit();
}
?>

