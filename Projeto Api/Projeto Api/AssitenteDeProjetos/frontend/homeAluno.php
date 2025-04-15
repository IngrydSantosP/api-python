<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Inicial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>

    <link href="calendario/css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="calendario/css/h.css">
<style>

</style>
</head>
<body>
    <header>
    <nav class="nav-main">
    <div class="menu-toggle">Menu <i class="fas fa-chevron-down"></i></div>
    <ul class="menu">
        <li><a href="meusProjetos.html">Meus Projetos</a></li>
        <li><a href="#">Avaliações</a></li>
        <li><a href="home.html">Sair</a></li>
    </ul>
</nav>

    </header>
<br>
    <span id="msg"></span>
    <div id='calendarConteiner'>
        <div id='calendar'></div>
    </div>
    <!-- Modal Visualizar -->
    <div class="modal fade" id="visualizarModal" tabindex="-1" aria-labelledby="visualizarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="visualizarModalLabel">Visualizar o Evento</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <dl class="row">

                        <dt class="col-sm-3">IdTarefas: </dt>
                        <dd class="col-sm-9" id="visualizar_IdTarefas"></dd>

                        <dt class="col-sm-3">Título: </dt>
                        <dd class="col-sm-9" id="visualizar_nome"></dd>

                        <dt class="col-sm-3">Aluno Responsavel: </dt>
                        <dd class="col-sm-9" id="visualizar_AlunoResponsavel"></dd>

                        <dt class="col-sm-3">arquivo: </dt>
                        <dd class="col-sm-9" id="visualizar_arquivo"></dd>

                        <dt class="col-sm-3">Data: </dt>
                        <dd class="col-sm-9" id="visualizar_dataTarefa"></dd>

                        <dt class="col-sm-3">Início: </dt>
                        <dd class="col-sm-9" id="visualizar_start"></dd>

                        <dt class="col-sm-3">dataTarefa: </dt>
                        <dd class="col-sm-9" id="visualizar_end"></dd>

                        <dt class="col-sm-3">Nome do Cliente: </dt>
                            <dd class="col-sm-9" id="visualizar_client_name"></dd>

                            <dt class="col-sm-3">E-mail do Cliente: </dt>
                            <dd class="col-sm-9" id="visualizar_client_email"></dd>

                        </dl>

                        <button type="button" class="btn btn-warning" id="btnViewEditEvento">Editar</button>

                        <button type="button" class="btn btn-danger" id="btnApagarEvento">Apagar</button>

                    </dl>

                    <div id="editarTarefa" style="display: none;">
    <span id="msgEditTarefa"></span>

    <form method="POST" id="formEditTarefa">
        <input type="hidden" name="edit_IdTarefas" id="edit_IdTarefas">

        <div class="row mb-3">
            <label for="edit_nome" class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-10">
                <input type="text" name="edit_nome" class="form-control" id="edit_nome" placeholder="Nome da tarefa">
            </div>
        </div>

        <div class="row mb-3">
            <label for="edit_AlunoResponsavel" class="col-sm-2 col-form-label">Aluno Responsável</label>
            <div class="col-sm-10">
                <input type="text" name="edit_AlunoResponsavel" class="form-control" id="edit_AlunoResponsavel" placeholder="Aluno responsável pela tarefa">
            </div>
        </div>

        <div class="row mb-3">
            <label for="edit_concluido" class="col-sm-2 col-form-label">Concluído</label>
            <div class="col-sm-10">
                <input type="checkbox" name="edit_concluido" id="edit_concluido" value="1">
            </div>
        </div>

        <div class="row mb-3">
            <label for="edit_arquivo" class="col-sm-2 col-form-label">Arquivo</label>
            <div class="col-sm-10">
                <input type="file" name="edit_arquivo" id="edit_arquivo">
            </div>
        </div>

        <div class="row mb-3">
            <label for="edit_start" class="col-sm-2 col-form-label">Início</label>
            <div class="col-sm-10">
                <input type="datetime-local" name="edit_start" class="form-control" id="edit_start">
            </div>
        </div>

        <div class="row mb-3">
            <label for="edit_end" class="col-sm-2 col-form-label">Fim</label>
            <div class="col-sm-10">
                <input type="datetime-local" name="edit_end" class="form-control" id="edit_end">
            </div>
        </div>

        <button type="button" name="btnViewTarefa" class="btn btn-primary" id="btnViewTarefa">Cancelar</button>

        <button type="submit" name="btnEditTarefa" class="btn btn-warning" id="btnEditTarefa">Salvar</button>

    </form>
</div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cadastrar -->
    <div class="modal fade" id="cadastrarModal" tabindex="-1" aria-labelledby="cadastrarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="cadastrarModalLabel">Cadastrar o Tarefa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <span id="msgCadEvento"></span>

                    <form method="POST" id="formCadEvento">

                        <div class="row mb-3">
                            <label for="cad_title" class="col-sm-2 col-form-label">Título</label>
                            <div class="col-sm-10">
                                <input type="text" name="cad_nome" class="form-control" id="cad_nome" placeholder="Nome da tarefa">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cad_start" class="col-sm-2 col-form-label">Data</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" name="cad_dataTarefa" class="form-control" id="cad_dataTarefa">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cad_start" class="col-sm-2 col-form-label">Aluno Responsavel</label>
                            <div class="col-sm-10">
                                <input type="text" name="cad_AlunoResponsavel" class="form-control" id="cad_AlunoResponsavel">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="cad_start" class="col-sm-2 col-form-label">Arquivo</label>
                            <div class="col-sm-10">
                                <input type="file" name="cad_arquivo" class="form-control" id="cad_arquivo">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="cad_start" class="col-sm-2 col-form-label">Inicio</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" name="cad_start" class="form-control" id="cad_start">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="cad_end" class="col-sm-2 col-form-label">Fim</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" name="cad_end" class="form-control" id="cad_end">
                            </div>
                        </div>

                        <button type="submit" name="btnCadEvento" class="btn btn-success" id="btnCadEvento">Cadastrar</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <footer><p>ⒸCopyright</p></footer>
    <script src="menuVert.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src='calendario/js/index.global.min.js'></script>
    <script src="calendario/js/bootstrap5/index.global.min.js"></script>
    <script src='calendario/js/core/locales-all.global.min.js'></script>
    <script src='calendario/js/custom.js'></script>
    <script src='calendario/js/apagar.js'></script>
    <script src='calendario/js/editar.js'></script>
    <script>
    // Chamar a função carregarEventos após o carregamento completo do documento HTML
    document.addEventListener('DOMContentLoaded', function () {
        carregarEventos();
    });
</script>
</body>
</html>
