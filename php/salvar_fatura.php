<?php
include 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

// Receber dados da fatura via POST
$data = json_decode(file_get_contents('php://input'), true);
$items = $data['items'];
$paidAmount = $data['paidAmount'];
$changeAmount = $data['changeAmount'];

// Calcular o total da fatura
$total = array_reduce($items, function ($sum, $item) {
    return $sum + $item['preco'] * $item['quantity'];
}, 0);

// Inserir a fatura na tabela `faturas`
$stmt = $conn->prepare("INSERT INTO faturas (total, pagou, troco, date) VALUES (?, ?, ?, NOW())");
$stmt->bind_param('ddd', $total, $paidAmount, $changeAmount);
$stmt->execute();
$faturaId = $stmt->insert_id;

// Inserir os itens da fatura na tabela `fatura_items`
foreach ($items as $item) {
    $stmt = $conn->prepare("INSERT INTO fatura_items (fatura_id, produto_id, quantity, preco) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('iiid', $faturaId, $item['id'], $item['quantity'], $item['preco']);
    $stmt->execute();
}

echo json_encode(['success' => true]);
$conn->close();
?>
