<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $categoria_id = $_POST['categoria'];
    $preco = $_POST['preco'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO produtos (nome, categoria_id, preco) VALUES (?, ?, ?)");
    $stmt->bind_param("sid", $nome, $categoria_id, $preco);

    if ($stmt->execute()) {
        echo "Novo produto adicionado com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>
<title>Adicionar Produto</title>
<style>
    input, select {
        border-radius: 7px;
    }

    form h2{
        display: flex;
        justify-content: center;
    }

    form .cat{
        display: flex;
        justify-content: center;
    }

    input[type="submit"]{
        height: 2.5rem;
        width: 10rem;
        border: none;
        background-color: #11101d;
        color: white;
        cursor: pointer;
    }
    input[type="submit"]:hover{
        background-color: #141131;
    }
</style>

<form id="addForm" method="POST" onsubmit="addProduct(event)">
    <h2>Adicionar Produto</h2><br><br>
    <input type="text" id="nome" name="nome" placeholder="Nome do Produto" required><br>
    
    <br><label class="cat" for="categoria">Categoria:</label>
    <select id="categoria" name="categoria" required>
        <?php
        // Fetch categories from the database
        $sql = "SELECT id, nome FROM categorias";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($category = $result->fetch_assoc()) {
                echo '<option value="' . htmlspecialchars($category['id']) . '">' . htmlspecialchars($category['nome']) . '</option>';
            }
        } else {
            echo '<option value="">Nenhuma categoria encontrada</option>';
        }
        ?>
    </select><br>
    <br><label for="categoria">Preço:</label><br>
    <input type="number" id="preco" name="preco" step="0.01" required><br><br>
    
    <input type="submit" value="Adicionar Produto">
</form>

