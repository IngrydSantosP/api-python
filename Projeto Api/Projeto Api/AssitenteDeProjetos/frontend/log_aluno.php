<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aluno</title>
    <link rel="stylesheet" href="css_1/styLog2.css">
    <script>
         // Função para exibir o botão após o PHP retornar true
         function showButton() {
            var success = <?php echo json_encode($_GET['success'] ?? null); ?>;
            if (success === 'token_sent') {
                document.getElementById('tokenForm').style.display = 'block';
            }
        }
    </script>
</head>
<body onload="showButton()">
    <fieldset>
        <h1>Login - Aluno</h1>
        <form id="emailFormAluno" action="verificarEmailAluno.php" method="post">
            <label style="color: aquamarine;" for="emailAluno">Email:</label>
            <input type="email" name="emailAluno" id="emailAluno" placeholder="Insira seu email" required><br>
            <button type="submit">Enviar</button>
        </form>

        <form id="tokenForm" style="display: none;" action="verificarTokenAluno.php" method="post">
            <label style="color: aquamarine;"  for="tokenInput">Confirme:</label>
            <input type="text" name="token" id="tokenInput" placeholder="Informe o código enviado ao email fornecido" required><br>
            <button type="submit">Enviar</button>
        </form>
    </fieldset>
    <script src="main.js"></script>
</body>
</html>
