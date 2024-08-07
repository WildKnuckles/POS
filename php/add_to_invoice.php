<?php
session_start();

// Verifica se o item foi enviado
if (isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['preco'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = (float) $_POST['preco'];

    // Verifica se a sessão da fatura já existe, caso contrário, cria uma
    if (!isset($_SESSION['invoice'])) {
        $_SESSION['invoice'] = array();
    }

    // Atualiza a quantidade do item na fatura ou adiciona um novo
    if (isset($_SESSION['invoice'][$id])) {
        $_SESSION['invoice'][$id]['quantity'] += 1;
    } else {
        $_SESSION['invoice'][$id] = array('nome' => $nome, 'preco' => $preco, 'quantity' => 1);
    }

    // Prepara a resposta com o estado atualizado da fatura
    echo json_encode($_SESSION['invoice']);
} else {
    // Se os dados não foram enviados corretamente, retorna um erro
    echo json_encode(array('error' => 'Dados não enviados corretamente'));
}
?>
