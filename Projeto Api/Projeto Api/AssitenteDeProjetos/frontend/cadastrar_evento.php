<?php

// Incluir o arquivo com a conexão com banco de dados
include_once './conexao.php';

// Receber os dados enviados pelo JavaScript
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// Verificar se o campo 'nome' não está vazio
if (empty($dados['cad_nome'])) {
    // Se estiver vazio, retorna uma mensagem de erro
    $retorna = ['status' => false, 'msg' => 'Erro: O campo nome não pode estar vazio.'];
    echo json_encode($retorna);
    exit; // Encerra o script
}

// Criar a QUERY para cadastrar evento no banco de dados
$query_cad_event = "INSERT INTO tarefas (dataTarefa, nome, AlunoResponsavel, arquivo, start, end) 
                    VALUES (:dataTarefa, :nome, :AlunoResponsavel, :arquivo, :start, :end)";

// Prepara a QUERY
$cad_event = $conn->prepare($query_cad_event);

// Substituir os placeholders pelos valores correspondentes
$cad_event->bindParam(':dataTarefa', $dados['cad_dataTarefa']);
$cad_event->bindParam(':nome', $dados['cad_nome']);
$cad_event->bindParam(':AlunoResponsavel', $dados['cad_AlunoResponsavel']);
$cad_event->bindParam(':arquivo', $dados['cad_arquivo']);
$cad_event->bindParam(':start', $dados['cad_start']);
$cad_event->bindParam(':end', $dados['cad_end']);

// Verificar se conseguiu cadastrar corretamente
if ($cad_event->execute()) {
    $retorna = [
        'status' => true,
        'msg' => 'Evento cadastrado com sucesso!',
        'IdTarefa' => $conn->lastInsertId(), // Corrigido para obter o último ID inserido
        'nome' => $dados['cad_nome'],
        'dataTarefa' => $dados['cad_dataTarefa'],
        'AlunoResponsavel' => $dados['cad_AlunoResponsavel'],
        'arquivo' => $dados['cad_arquivo'],
        'start' => $dados['cad_start'],
        'end' => $dados['cad_end']
    ];
} else {
    $retorna = ['status' => false, 'msg' => 'Erro: Evento não cadastrado!'];
}

// Converter o array em objeto JSON e retornar para o JavaScript
echo json_encode($retorna);
?>
