<?php

// Incluir o arquivo com a conexão com banco de dados
include_once './conexao.php';

// Receber o id enviado pelo JavaScript
$idTarefa = filter_input(INPUT_GET, 'idTarefa', FILTER_SANITIZE_NUMBER_INT);

// Acessar o IF quando exite o id do evento
if (!empty($idTarefa)) {

    // Criar a QUERY para apagar o evento no banco de dados
    $query_apagar_evento = "DELETE FROM tarefas WHERE IdTarefas=:idTarefa";

    // Preparar a QUERY
    $apagar_evento = $conn->prepare($query_apagar_evento);

    // Substituir o marcador de posição pelo valor do ID
    $apagar_evento->bindParam(':IdTarefa', $IdTarefa);

    // Verificar se conseguiu apagar corretamente
    if($apagar_evento->execute()){
        $retorna = ['status' => true, 'msg' => 'Evento apagado com sucesso!'];
    } else {
        $retorna = ['status' => false, 'msg' => 'Erro: Evento não apagado!'];
    }

} else { // Acessar o ELSE quando o id está vazio
    $retorna = ['status' => false, 'msg' => 'Erro: Necessário enviar o id do evento!'];
}

// Converter o array em objeto e retornar para o JavaScript
echo json_encode($retorna);
?>
