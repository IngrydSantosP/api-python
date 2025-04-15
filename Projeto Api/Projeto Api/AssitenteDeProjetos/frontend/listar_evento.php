<?php
// Incluir o arquivo com a conexão com banco de dados
include_once './conexao.php';

// QUERY para recuperar os eventos
$query_events = "SELECT IdTarefas, dataTarefa, nome, AlunoResponsavel, arquivo, start, end FROM tarefas";

// Prepara a QUERY
$result_events = $conn->prepare($query_events);

// Executar a QUERY
if (!$result_events->execute()) {
    // Se houver um erro, exibir a mensagem de erro
    echo "Erro: " . implode(" ", $result_events->errorInfo());
    exit; // Encerrar o script para evitar que mais código seja executado
}

// Criar o array que recebe os eventos
$eventos = [];

// Percorrer a lista de registros retornados do banco de dados
while($row_events = $result_events->fetch(PDO::FETCH_ASSOC)){
    // Adicionar cada evento ao array de eventos
    $eventos[] = [
        'IdTarefa' => $row_events['IdTarefas'], // Corrigido o nome da coluna
        'dataTarefa' => $row_events['dataTarefa'],
        'nome' => $row_events['nome'],
        'AlunoResponsavel'=> $row_events['AlunoResponsavel'],
        'arquivo' => $row_events['arquivo'],
        'start' => $row_events['start'],
        'end' => $row_events['end'],
    ];
}

// Retornar os eventos como JSON
echo json_encode($eventos);
?>
