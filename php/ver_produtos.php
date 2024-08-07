<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Ver Produtos</title>
    <style>
        /* Estilos fornecidos */
        body {
            background-color: #E4E9F7;
        }
        .table-container {
            display: flex;
            justify-content: center; /* Centraliza a tabela horizontalmente */
            margin: 20px; /* Adiciona uma margem ao redor da tabela */
        }

        .table {
            width: 60rem;
            border: 1px solid #333; /* Cor da borda da tabela */
            border-collapse: collapse; /* Para colapsar as bordas da tabela */
            background: white; /* Cor de fundo da tabela para contraste */
        }

        .table-header {
            display: flex;
            width: 100%;
            background: #11101d;
            color: white; /* Ajusta a cor do texto para branco */
            padding: 12px 0; /* Espaçamento vertical */
        }

        .table-row {
            display: flex;
            width: 100%;
            padding: 8px 0; /* Espaçamento vertical */
        }

        .table-row:nth-of-type(odd) {
            background: #f2f2f2; /* Cor de fundo alternada para linhas ímpares */
        }

        .table-data, .header__item {
            flex: 1 1 20%;
            text-align: center;
            padding: 8px; /* Adiciona algum padding para as células */
        }

        .header__item {
            text-transform: uppercase;
        }

        
    </style>
</head>
<body>
    <?php
    include 'conexao.php';

    // Consulta para buscar produtos com o nome da categoria
    $sql = "SELECT p.id, p.nome, c.nome AS categoria, p.preco
            FROM produtos p 
            JOIN categorias c ON p.categoria_id = c.id ORDER BY p.id ASC";
    $result = $conn->query($sql);

    echo '<form>';
    echo '<h2>Lista de Produtos</h2>';
    echo '</form>';

    echo '<div class="table-container">
            <div class="table">
                <div class="table-header">
                    <div class="header__item">ID</div>
                    <div class="header__item">Nome</div>
                    <div class="header__item">Categoria</div>
                    <div class="header__item">Preço</div>
                    <div class="header__item">Ações</div>
                </div>';

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="table-row">';
            echo '<div class="table-data">' . $row["id"] . '</div>';
            echo '<div class="table-data">' . $row["nome"] . '</div>';
            echo '<div class="table-data">' . $row["categoria"] . '</div>';
            echo '<div class="table-data">' . $row["preco"] . '</div>';
            echo '<div class="table-data">
                    <button type="button" class="btn-edit" onclick="loadEditForm(' . $row["id"] . ')">Editar</button>
                    <button type="button" class="btn-del" onclick="deleteProduct(' . $row["id"] . ')">Deletar</button>
                  </div>';
            echo '</div>';
        }
    } else {
        echo '<div class="table-row"><div class="table-data" colspan="5">Nenhum produto encontrado</div></div>';
    }
    echo '</div>
          </div>';

    $conn->close();
    ?>
</body>
</html>
