<?php
include 'conexao.php';

$id = $_POST['id'];

$sql = "DELETE FROM produtos WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "Produto deletado com sucesso!";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
