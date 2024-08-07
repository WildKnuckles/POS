<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="js/script.js" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">Empresa</span>
    </div>
    <ul class="nav-links">
      <li>
        <a>
          <i class='bx bx-grid-alt'></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Dashboard</a></li>
        </ul>
      </li>
      <li>
        <a href="#1" onclick="loadPage('php/ver_produtos.php', 'content')">
          <i class='bx bx-box'></i>
          <span class="link_name">Ver Produtos</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#1" onclick="loadPage('php/ver_produtos.php', 'content')">Ver Produtos</a></li>
        </ul>
      </li>
      <li>
        <a href="#2" onclick="loadPage('php/adicionar_produto.php', 'content')">
          <i class='bx bx-plus'></i>
          <span class="link_name">Adicionar Produto</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#2" onclick="loadPage('php/adicionar_produto.php', 'content')">Adicionar Produto</a></li>
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
      
      
      
        <div class="profile-details">
          <div class="profile-content">
            <!--<img src="image/profile.jpg" alt="profileImg">-->
          </div>
          <div class="name-job">
            <div class="profile_name">Johnny Cardoso</div>
            <div class="job">Desenvolvedor</div>
          </div>
          <i class='bx bx-log-out'></i>
        </div>
      </li>
    </ul>
  </div>
  <section class="home-section">
    <div class="home-content">
    </div>
    
    <div id="content" class="main">
      <h1>Bem-vindo à Dashboard</h1>
      <h4>Escolha uma opção no menu à esquerda.</h4>
    </div>
  </section>

  <script>
    function loadPage(url, containerId) {
      fetch(url)
        .then(response => response.text())
        .then(data => {
          document.getElementById(containerId).innerHTML = data;
        })
        .catch(error => console.error('Error loading page:', error));
    }
  </script>
</body>
</html>
