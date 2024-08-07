<?php
include 'conexao.php';

// Obter o termo de pesquisa, se existir
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Prepare a consulta SQL com filtragem de pesquisa
$sql = "SELECT p.id, p.nome, p.preco, c.nome AS categoria 
        FROM produtos p 
        JOIN categorias c ON p.categoria_id = c.id 
        WHERE p.nome LIKE ? OR c.nome LIKE ?";
$searchTerm = '%' . $searchTerm . '%';
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/cr_style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Fatura</title>
    <style>

.container {
    display: flex;
    justify-content: center;
    flex: 1;
    margin-top: 10rem; /* Espaço para a barra de pesquisa */
}
body {
    background-color: #E4E9F7;
}

.products {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* Cria 3 colunas de igual largura */
    gap: 20px; /* Espaçamento entre os cartões */
    max-width: 100%;
    margin-left: -5rem; /* Ajuste conforme necessário */
}

.product-card {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 30px;
    width: 300px;
    position: relative;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1); /* Adiciona uma leve sombra para destacar */
}

.product-card h3 {
    margin: 0;
}

.product-card .details {
    margin-top: 10px;
}

.product-card .buttons {
    position: absolute;
    bottom: 10px;
    right: 10px;
    display: flex;
    gap: 7px;
}

.product-card button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 5px;
    cursor: pointer;
    font-size: 18px;
}

.product-card button.sub {
    background-color: #f44336;
}

.invoice {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px;
    width: 300px; /* Ajuste conforme necessário */
    position: fixed; /* Posiciona a fatura no lado direito */
    right: 20px; /* Ajuste a distância do lado direito */
    top: 50px; /* Ajuste a distância do topo */
    max-height: calc(100vh - 40px); /* Evita que a fatura ultrapasse a altura da janela de visualização */
    overflow-y: auto; /* Adiciona rolagem se necessário */
    background-color: #E4E9F7; /* Adiciona um fundo branco para impressão */
}

.invoice h2, h4, p {
    color: transparent;
}

.invoice ul {
    list-style-type: none;
    padding: 0;
}

.invoice ul li h2, h4, p {
    color: black;
}

.invoice ul li {
    border-bottom: 1px solid #ddd;
    padding: 5px 0;
    margin-top: 1rem;
}

.invoice ul li:last-child {
    border-bottom: none;
}

.invoice-header img {
    width: 100%;
    max-width: 200px;
    display: block;
    margin: 0 auto;
}

.invoice-header p {
    text-align: center;
}

/* Estilos específicos para impressão */
@media print {
    body * {
        visibility: hidden;
    }
    .invoice, .invoice * {
        visibility: visible;
    }
    .invoice {
        position: absolute;
        left: 0;
        top: 0;
        width: 27rem;
        height: 100%;
        overflow: hidden;
        background-color: white;
    }
    .invoice h2, h4, p {
        color: black;
    }
    .invoice p {
        margin-bottom: 100%;
    }

    .invoice h2, h4, p {
        display: flex;
        justify-content: center;
    }

    .print {
        color: transparent;
    }
    input[type="number"] {
        border: none;
        font-size: 16px;
    }
}

.invoice button {
    background-color: #11101d;
    color: #fff;
    border: none;
    padding: 10px;
    cursor: pointer;
    margin-bottom: 5px;
}

/* Barra de pesquisa */
.search-bar {
    position: fixed;
    top: 20px; /* Ajuste conforme necessário */
    left: 50%;
    margin-top: 1.5rem;
    transform: translateX(-50%); /* Centraliza a barra de pesquisa horizontalmente */
    padding: 10px;
    z-index: 1000; /* Garante que a barra de pesquisa fique sobre outros elementos */
    width: 400px; /* Ajuste a largura conforme necessário */
}

input[type="number"] {
    width: 5rem;
}

.search-bar input[type="text"] {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #11101d;
}

.invoice button[disabled] {
    background-color: #ccc;
    cursor: not-allowed;
}

/* Responsividade */
@media (max-width: 1366px) {
    .products {
        grid-template-columns: repeat(2, 1fr); /* Ajusta para 2 colunas em telas médias */
        margin: 0;
    }
}

@media (max-width: 1229.4px) {
    .products {
        grid-template-columns: repeat(2, 1fr); /* Ajusta para 2 colunas em telas médias */
        margin: 0;
    }
}



@media (max-width: 480px) {
    .product-card {
        width: 100%; /* Ajusta a largura do card para 100% em telas muito pequenas */
        padding: 20px; /* Reduz o padding para telas pequenas */
    }
}



    </style>
</head>
<body>
<div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">Empresa</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="http://localhost/project/index.php">
          <i class='bx bx-box'></i>
          <span class="link_name">Voltar na Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="http://localhost/project/index.php">Voltar na Dashboard</a></li>
        </ul>
      </li>
      
      <li>
        <a href="http://localhost/project/php/criar_fatura.php">
          <i class='bx bx-file'></i>
          <span class="link_name">Criar Fatura</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="http://localhost/project/php/criar_fatura.php">Criar Fatura</a></li>
        </ul>
      </li>
      
      
      <li>
        <a href="#">
          <i class='bx bx-cog'></i>
          <span class="link_name">Definições</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Setting</a></li>
        </ul>
      </li>
     
    </ul>
  </div>
    <!-- Barra de pesquisa -->
    
    <div class="search-bar">
        <input type="text" id="search" placeholder="Pesquisar produtos..." onkeyup="filterProducts()">
    </div>

    <div class="container">
        <div class="products" id="products-list">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="product-card">';
echo '<h3>' . htmlspecialchars($row['nome']) . '</h3>';
echo '<div class="details">';
echo '<p>Categoria: ' . htmlspecialchars($row['categoria']) . '</p>';
echo '<p>Preço: ' . number_format($row['preco'], 2, ',', '.') . ' Kz</p>';
echo '</div>';
echo '<div class="buttons">';
echo '<button onclick="addToInvoice(' . $row['id'] . ', \'' . htmlspecialchars($row['nome']) . '\', ' . $row['preco'] . ')">+</button>';
echo '<button class="sub" onclick="removeFromInvoice(' . $row['id'] . ')">-</button>';
echo '</div>';
echo '</div>';
                }
            } else {
                echo '<p>Nenhum produto encontrado</p>';
            }

            $conn->close();
            ?>
        </div>
    </div>
    

    <div class="invoice" id="invoice">
    <h2>Fatura</h2><br><br>
    <ul id="invoice-list">
        <!-- Items serão adicionados dinamicamente aqui -->
    </ul>
    <span>Pagou: </span><input type="number" id="paidAmount" oninput="calculateChange()"><br>
    <span>Troco: </span><span id="changeAmount">0</span> Kz<br>
    <span>Data: <label id="currentDateTime"></label></span><br>
    <button class="save" onclick="saveInvoice()">Salvar</button>
    <button class="print" onclick="printInvoice()" disabled>Imprimir</button>
</div>


<script>
    let invoiceItems = {};

    window.onload = function() {
        invoiceItems = {};
        sessionStorage.removeItem('invoiceItems');
        updateInvoice();
        updateDateTime();
    };

    function updateInvoice() {
        const invoiceList = document.getElementById('invoice-list');
        invoiceList.innerHTML = '';

        let total = 0;

        for (const [id, item] of Object.entries(invoiceItems)) {
            const li = document.createElement('li');
            li.textContent = `${item.nome} - ${item.preco.toFixed(2)}Kz - ${item.quantity}x`;
            invoiceList.appendChild(li);
            total += item.preco * item.quantity;
        }

        if (Object.keys(invoiceItems).length > 0) {
            const totalLi = document.createElement('li');
            totalLi.textContent = `Total: ${total.toFixed(2)} Kz`;
            totalLi.style.fontWeight = 'bold';
            invoiceList.appendChild(totalLi);
        }

        // Salvar no sessionStorage
        sessionStorage.setItem('invoiceItems', JSON.stringify(invoiceItems));
    }

    function addToInvoice(id, nome, preco) {
        if (invoiceItems[id]) {
            invoiceItems[id].quantity += 1;
        } else {
            invoiceItems[id] = { nome, preco, quantity: 1 };
        }
        updateInvoice();
    }

    function removeFromInvoice(id) {
        if (invoiceItems[id]) {
            invoiceItems[id].quantity -= 1;
            if (invoiceItems[id].quantity <= 0) {
                delete invoiceItems[id];
            }
            updateInvoice();
        }
    }

    function saveInvoice() {
        const invoiceItemsArray = Object.entries(invoiceItems).map(([id, item]) => ({
            id: parseInt(id),
            nome: item.nome,
            preco: item.preco,
            quantity: item.quantity
        }));
        const paidAmount = parseFloat(document.getElementById('paidAmount').value) || 0;
        const changeAmount = parseFloat(document.getElementById('changeAmount').textContent) || 0;

        fetch('salvar_fatura.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                items: invoiceItemsArray,
                paidAmount: paidAmount,
                changeAmount: changeAmount
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Fatura salva com sucesso!');
                document.querySelector('.print').disabled = false;
            } else {
                alert('Erro ao salvar a fatura.');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao salvar a fatura.');
        });
    }

    function printInvoice() {
        window.print();
    }

    function filterProducts() {
        let input = document.getElementById('search');
        let filter = input.value.toLowerCase();
        let productCards = document.querySelectorAll('.product-card');

        productCards.forEach(card => {
            let name = card.querySelector('h3').textContent.toLowerCase();
            let category = card.querySelector('.details p').textContent.toLowerCase();

            if (name.includes(filter) || category.includes(filter)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function calculateChange() {
        const paidAmount = parseFloat(document.getElementById('paidAmount').value) || 0;
        const total = Object.values(invoiceItems).reduce((sum, item) => sum + item.preco * item.quantity, 0);
        const change = paidAmount - total;

        document.getElementById('changeAmount').textContent = change >= 0 ? change.toFixed(2) : "Sem troco";
    }

    function updateDateTime() {
        const now = new Date();
        const date = now.toLocaleDateString('pt-BR');
        const time = now.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
        document.getElementById('currentDateTime').textContent = `${date} - ${time}`;

        // Atualizar data e hora a cada minuto
        setTimeout(updateDateTime, 60000);
    }
</script>


    
</body>
</html>
