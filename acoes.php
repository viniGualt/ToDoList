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

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "Tarefa com ID {$idTarefa} excluída com sucesso!";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = "Ops! Não foi possível excluir a tarefa";
        $_SESSION['type'] = 'error';
    }
    
    mysqli_query($conn, $sql);

    header('Location: index.php');
    exit;
}

?>

<div>
    <p><?php echo $sql?></p>
</div>