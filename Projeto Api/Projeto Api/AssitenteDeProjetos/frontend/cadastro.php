<?php
// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar ao banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "gestao_tarefas";

    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar conexão
    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    // Recuperando os dados do formulário
    $nome = $_POST['nome'];
    $cnpj = $_POST['cnpj'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $plano_selecionado = $_POST['plano'];
    $forma_pagamento = $_POST['forma_pagamento'];
    $acessoBDinfosProfs = $_POST['acessoBDinfosProfs'];
    $acessoBDinfosAlunos = $_POST['acessoBDinfosAlunos'];
    $cronograma = $_POST['cronograma'];
    $observacoes = $_POST['observacoes'];

    // Mapear o plano selecionado para o ID real do plano
    $plano = null;
    switch ($plano_selecionado) {
        case 'simple':
            $plano = 1; // ID do plano "Simples"
            break;
        case 'mediano':
            $plano = 2; // ID do plano "Intermediário"
            break;
        case 'completo':
            $plano = 3; // ID do plano "Completo"
            break;
        default:
            echo "Plano selecionado inválido.";
            exit; // Parar a execução do script se o plano não for válido
    }

    // Query para inserir os dados na tabela cliente
    $query_cliente = "INSERT INTO cliente (nome, senha, cnpj, acessoBDInfoProfs, acessoBDInfoAlunos, acessoBDcronograma, IdPlano)
                      VALUES ('$nome', '$senha', $cnpj, '$acessoBDinfosProfs', '$acessoBDinfosAlunos', '$cronograma', $plano)";

    // Executando a query
    if (mysqli_query($conn, $query_cliente)) {
        // Cliente inserido com sucesso, agora você pode enviar os dados para a API Flask

        // Dados que serão enviados para a API Flask
        $dados = array(
            'acessoBDinfosProfs' => $acessoBDinfosProfs,
            'acessoBDinfosAlunos' => $acessoBDinfosAlunos,
            'cronograma' => $cronograma,
        );

        // Convertendo os dados para o formato JSON
        $dados_json = json_encode($dados);

        // URL da API Flask
        $url_api_flask = 'http://localhost:5000/api/cadastro';

        // Inicializando uma sessão cURL
        $ch = curl_init($url_api_flask);

        // Configurando a requisição cURL para enviar dados POST no formato JSON
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dados_json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        // Configurando para receber a resposta da API Flask
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Enviando a requisição
        $resposta = curl_exec($ch);

        // Verificando se houve algum erro na requisição
        if(curl_errno($ch)) {
            echo 'Erro ao enviar requisição: ' . curl_error($ch);
        } else {
            // Exibindo a resposta da API Flask
            echo $resposta;
        }

        // Fechando a sessão cURL
        curl_close($ch);

        echo "Cliente cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar o cliente: " . mysqli_error($conn);
    }

    // Fechando a conexão com o banco de dados
    mysqli_close($conn);
}
?>

