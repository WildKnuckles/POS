

// Atualizar os manipuladores de eventos para usar o modal em vez do alert
function loadPage(page) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', page, true);
    xhr.onload = function () {
        if (this.status === 200) {
            document.getElementById('content').innerHTML = this.responseText;
            if (page.includes('criar_fatura.php')) {
                // Inicialize qualquer script específico para criar_fatura.php, se necessário
            }
        }
    };
    xhr.send();
}




function addProduct(event) {
    event.preventDefault(); // Evita o envio do formulário padrão

    const form = event.target;
    const formData = new FormData(form);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/adicionar_produto.php', true);
    xhr.onload = function () {
        if (this.status === 200) {
            showModal(this.responseText);
            loadPage('php/ver_produtos.php'); // Redireciona para a página de produtos
        }
    };
    xhr.send(formData);
}

function loadEditForm(id) {
    loadPage('php/editar_produto.php?id=' + id);
}

function updateProduct(event) {
    event.preventDefault(); // Evita o envio do formulário padrão

    const form = event.target;
    const formData = new FormData(form);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/editar_produto.php', true);
    xhr.onload = function () {
        if (this.status === 200) {
            showModal(this.responseText);
            loadPage('php/ver_produtos.php'); // Redireciona para a página de produtos
        }
    };
    xhr.send(formData);
}



let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
        let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
        arrowParent.classList.toggle("showMenu");
    });
}

let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
console.log(sidebarBtn);
sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
});
