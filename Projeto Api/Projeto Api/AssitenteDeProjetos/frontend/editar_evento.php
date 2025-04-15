<?php

// Incluir o arquivo com a conexão com banco de dados
include_once './conexao.php';

// Simulação de usuário logado
$user_id = 1;

// QUERY para recuperar as tarefas do usuário logado
$query_tasks = "SELECT t.IdTarefa, t.dataTarefa, t.nome, t.AlunoResponsavel, t.arquivo, t.start, t.end
                FROM tarefas AS t
                INNER JOIN planejamento AS p ON t.IdTarefa = p.IdTarefa
                WHERE p.user_id = :user_id";

// Prepara a QUERY
$result_tasks = $conn->prepare($query_tasks);

// Atribuir o valor do parâmetro
$result_tasks->bindParam(':user_id', $user_id, PDO::PARAM_INT);

// Executar a QUERY
$result_tasks->execute();

// Criar o array que recebe as tarefas
$tarefas = [];

// Percorrer a lista de registros retornados do banco de dados
while ($row_task = $result_tasks->fetch(PDO::FETCH_ASSOC)) {
    // Extrair o array
    extract($row_task);

    $tarefas[] = [
        'IdTarefa' => $IdTarefa,
        'dataTarefa' => $dataTarefa,
        'nome' => $nome,
        'AlunoResponsavel' => $AlunoResponsavel,
        'arquivo' => $arquivo,
        'start' => $start,
        'end' => $end
    ];
}

echo json_encode($tarefas);
?>
