<?php
session_start();
require_once('conexao.php');

if (isset($_POST['editar_tarefa'])) {
    $tarefaId = mysqli_real_escape_string($conn, $_POST['editar_tarefa']);
    $sql = "SELECT * FROM tarefas WHERE id = '{$tarefaId}'";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $tarefa = mysqli_fetch_array($query);
    }
} else {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./css/index.css">
    <title>To-do-List</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark" id="nav">
        <div class="container-fluid p-3 pb-1 pt-1 align-bottom justify-content-between">
            <a href="index.php" class="navbar-brand text-light mb-0 h1">
                <img src="https://hooquest.com/wp-content/uploads/2020/05/listreports-logo-300.png" height="30vh" class="d-inline-block align-text-top">
                <span id="logo-title">2DO</span>
            </a>
            <a href="index.php" class="btn btn-info float-end text-light"><b>Voltar</b></a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card bg-secondary text-light">
                    <div class="card-header">
                        <h5 class="d-inline card-title"></h5>
                        <form action="acoes.php" method="POST">
                            <input type="text" name="txtId" id="txtId" class="d-none form-control" value="<?php echo $tarefa['id'];?>">
                            <input type="text" name="txtTitulo" id="txtTitulo" class="form-control" placeholder="<?php echo $tarefa['nome'];?>"></input>
                            <input type="text" name="placeholderTitulo" id="txtId" class="d-none form-control" value="<?php echo $tarefa['nome'];?>">
                    </div>
                    <div class="card-body d-flex-inline">
                        <label for="txtDescricao" class="text-info"><b>Digite uma descrição:</b></label>
                        <input name="txtDescricao" id="txtDescricao" class="form-control" placeholder="<?php echo $tarefa['descricao'];?>"></input>
                        <input type="text" name="placeholderDescricao" id="txtId" class="d-none form-control" value="<?php echo $tarefa['descricao'];?>">
                        <div class="d-flex justify-content-between text-center">
                            <h6 class="d-inline w-50 mt-2"><span class="text-info">Prioridade</span>
                                <div class="form-group">
                                    <select class="form-control" name="txtPrioridade" id="txtPrioridade">
                                        <option value="1" id="select-p1" <?php if ($tarefa['prioridade'] == '1') { echo 'selected'; }?>>Baixa</option>
                                        <option value="2" id="select-p2" <?php if ($tarefa['prioridade'] == '2') { echo 'selected'; }?>>Media</option>
                                        <option value="3" id="select-p3" <?php if ($tarefa['prioridade'] == '3') { echo 'selected'; }?>>Alta</option>
                                    </select>
                                </div>
                            </h6>
                            <h6 class="mt-2">
                                <span class="text-info">Data de criação:
                                    <input class="form-control text-center" readonly placeholder="<?php echo date('d/m/Y', strtotime($tarefa['data_criacao'])); ?>">
                                </span>
                            </h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-around">

                        <select class="form-select form-select-sm updateBg" id="status" type="text" name="txtStatus">
                            <option value="0" id="select-status" <?php if ($tarefa['status'] == '0') { echo 'selected'; }?>>Novo</option>
                            <option value="1" id="select-pendente" <?php if ($tarefa['status'] == '1') { echo 'selected'; }?>>Importante</option>
                            <option value="2" id="select-emandamento" <?php if ($tarefa['status'] == '2') { echo 'selected'; }?>>Em andamento</option>
                            <option value="3" id="select-concluido" <?php if ($tarefa['status'] == '3') { echo 'selected'; }?>>Concluído</option>
                        </select>
                        <button type="submit" name="editar_tarefa" class="btn btn-success text-light w-25"><i class="bi bi-floppy"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="./src/script.js"></script>
</body>

</html>