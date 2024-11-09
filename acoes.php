<?php
session_start();
require_once('conexao.php');

$sql = '';

if (isset($_POST['create_tarefa'])) {
    $titulo = trim($_POST['txtTitulo']);
    $descricao = trim($_POST['txtDescricao']);
    $prioridade = trim($_POST['txtPrioridade']);
    $status = trim($_POST['txtStatus']);


    $sql = "INSERT INTO tarefas (nome, descricao, `status`, prioridade) VALUES('$titulo', '$descricao', '$status', '$prioridade')";
    
    mysqli_query($conn, $sql);

    header('Location: index.php');
    exit();
}

if (isset($_POST['delete_tarefa'])) {
    $idTarefa = mysqli_real_escape_string($conn, $_POST['delete_tarefa']);
    $sql = "DELETE FROM tarefas WHERE id = '$idTarefa'";
    
    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "Tarefa com ID {$idTarefa} excluída com sucesso!";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = "Ops! Não foi possível excluir a tarefa";
        $_SESSION['type'] = 'error';
    }

    header('Location: index.php');
    exit;
}

if (isset($_POST['editar_tarefa'])) {
    $id = trim($_POST['txtId']);
    if (!empty(trim($_POST['txtTitulo']))) {
        $titulo = trim($_POST['txtTitulo']);
    } else {
        $titulo = trim($_POST['placeholderTitulo']); 
    }
    
    if (!empty(trim($_POST['txtDescricao']))) {
        $descricao = trim($_POST['txtDescricao']);
    } else {
        $descricao = trim($_POST['placeholderDescricao']); 
    }
    $prioridade = trim($_POST['txtPrioridade']);
    $status = trim($_POST['txtStatus']);


    $sql = "UPDATE tarefas SET nome = '$titulo', descricao = '$descricao', `status` = '$status', prioridade = '$prioridade' WHERE id = '$id'";
    
    mysqli_query($conn, $sql);

    header('Location: index.php');
    exit();
}

?>

<div>
    <p><?php echo $sql?></p>
</div>