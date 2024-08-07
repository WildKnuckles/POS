<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $categoria_id = $_POST['categoria'];
    $preco = $_POST['preco'];

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE produtos SET nome=?, categoria_id=?, preco=? WHERE id=?");
    $stmt->bind_param("sidi", $nome, $categoria_id, $preco, $id);

    if ($stmt->execute()) {
        echo "Produto atualizado com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    exit();
}

// Obtém o ID do produto a ser editado
$id = $_GET['id'];

// Prepara a consulta para buscar o produto
$stmt = $conn->prepare("SELECT * FROM produtos WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$stmt->close();
?>
<title>Editar Produto</title>
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
    label{
        margin-top: 1rem;
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

<form id="editForm" method="POST" onsubmit="updateProduct(event)">
    <h2>Editar Produto</h2><br><br>
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
    <label class="cat" for="categoria">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($row['nome']); ?>" required><br>
    <label class="cat" for="categoria">Categoria:</label>
    <select id="categoria" name="categoria" required>
        <?php
        // Fetch categories from the database
        $sql = "SELECT id, nome FROM categorias";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($category = $result->fetch_assoc()) {
                $selected = ($category['id'] == $row['categoria_id']) ? 'selected' : '';
                echo '<option value="' . htmlspecialchars($category['id']) . '" ' . $selected . '>' . htmlspecialchars($category['nome']) . '</option>';
            }
        } else {
            echo '<option value="">Nenhuma categoria encontrada</option>';
        }
        ?>
    </select><br><br>
    <label for="categoria">Preço:</label><br>
    <input type="number" id="preco" name="preco" step="0.01" value="<?php echo htmlspecialchars($row['preco']); ?>" required><br><br>
    
    <input type="submit" value="Atualizar Produto">
</form>




