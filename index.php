<?php
session_start();
require_once('conexao.php');

$sql = "SELECT t.id, t.nome, t.descricao, s.nome AS status, p.nome AS prioridade, t.data_criacao, t.data_limite, s.id AS s_id, p.id AS p_id
    FROM tarefas t
    JOIN prioridade p ON p.id = t.prioridade
    JOIN status s ON s.id = t.status
    ORDER BY t.id";

$tarefas = mysqli_query($conn, $sql);

# Update no status via AJAX:

if (isset($_GET['status']) && isset($_GET['id'])) {
    $status = mysqli_real_escape_string($conn, $_GET['status']);
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "UPDATE tarefas SET status = $status WHERE id = $id";
    $query = mysqli_query($conn, $sql);

    // echo $sql;
    exit();
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
            <a href="#nav" class="navbar-brand text-light mb-0 h1">
                <img src="https://hooquest.com/wp-content/uploads/2020/05/listreports-logo-300.png" height="30vh" class="d-inline-block align-text-top">
                <span id="logo-title">2DO</span>
            </a>
            <a href="tarefa-create.php" class="btn btn-info float-end text-light"><b>Criar tarefa</b></a>
        </div>
    </nav>
    
    <?php include('mensagem.php'); ?>

    <div class="container mt-4">
        <div class="row">
            <?php foreach ($tarefas as $tarefa): ?>
            <div class="col-md-4 mb-4">
                <div class="card bg-secondary text-light">
                    <div class="card-header">
                        <h5 class="d-inline card-title"><?php echo $tarefa['nome'];?></h5>
                    </div>
                    <div class="card-body d-flex-inline">
                        <p class="card-text d-block"><?php echo $tarefa['descricao'];?></p>
                        <div class="d-flex justify-content-between text-center">
                            <h6 class="mb-0 d-inline w-50"><span class="text-info">Prioridade: </span><br><?php echo $tarefa['prioridade'];?></h6>
                            <h6 class="mb-0"><span class="text-info">Data de criação: </span><?php echo date('d/m/Y', strtotime($tarefa['data_criacao']));?></h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-around">

                        <select class="form-select form-select-sm updateBg" id="status" data-tarefaId="<?php echo $tarefa['id'];?>">
                            <option value="0" id="select-status" <?php if ($tarefa['s_id'] == '0') { echo 'selected'; }?>>Novo</option>
                            <option value="1" id="select-pendente" <?php if ($tarefa['s_id'] == '1') { echo 'selected'; }?>>Importante</option>
                            <option value="2" id="select-emandamento" <?php if ($tarefa['s_id'] == '2') { echo 'selected'; }?>>Em andamento</option>
                            <option value="3" id="select-concluido" <?php if ($tarefa['s_id'] == '3') { echo 'selected'; }?>>Concluído</option>
                        </select>
                        <form action="acoes.php" method="POST" class="d-inline">
                            <button onclick="return confirm('Tem certeza que deseja excluir?')" name="delete_tarefa" type="submit" value="<?php echo $tarefa['id']?>" class="btn btn-danger text-light" id="excluir-tarefa"><i class="bi bi-trash-fill"></i></button>
                        </form>
                        <form action="tarefa-edit.php" method="POST">
                            <button class="btn btn-info text-light" name="editar_tarefa" id="editar-tarefa" value="<?php echo $tarefa['id']?>"> <i class="bi bi-pencil-square"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="./src/script.js"></script>
</body>

</html>