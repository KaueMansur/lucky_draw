let checkBox = document.querySelectorAll(".criar_venda_checkbox");




function abrirRifa(idRifa){
   document.getElementById("id" + idRifa).style.display = "block";
}

function fecharRifa(idRifa){
    document.getElementById("id" + idRifa).style.display = "none";
}

function criarVenda(idRifa){
    document.getElementById("btn_cancelar_venda" + idRifa).style.display = "block";
    document.getElementById("card_comprador" + idRifa).style.display = "block";
    document.getElementById("btn_criar_venda" + idRifa).style.display = "none";
}

function cancelarVenda(idRifa){
    document.getElementById("btn_cancelar_venda" + idRifa).style.display = "none";
    document.getElementById("btn_criar_venda" + idRifa).style.display = "block";
    document.getElementById("card_comprador" + idRifa).style.display = "none";
    
    checkBox.forEach(element => {
        element.style.display = "none";
    });
}

function adicionarNumeros(idUsuario){
    checkBox.forEach(element => {
        element.style.display = "block";
    });

    document.getElementById("btn_adicionar_numeros" + idUsuario).style.display = "none";
    document.getElementById("btn_cancelar_numeros" + idUsuario).style.display = "block";
    document.getElementById("btn_comprar_numeros" + idUsuario).style.display = "block";

    console.log(idUsuario);
}

function cancelarNumeros(idUsuario){
    checkBox.forEach(element => {
        element.style.display = "none";
    });

    document.getElementById("btn_adicionar_numeros" + idUsuario).style.display = "block";
    document.getElementById("btn_cancelar_numeros" + idUsuario).style.display = "none";
    document.getElementById("btn_comprar_numeros" + idUsuario).style.display = "none";
}

function ativarHiddens(idUsuario){
    let item = document.getElementById("id_hidden" + idUsuario)
    item.setAttribute("name", "id_usuarios_temp")
}

function mostrarOpcoesDeSorteio(idRifa){
    document.getElementById("opcoes_de_sorteio" + idRifa).style.display = "block";
}

function cancelarOpcoesSorteio(idRifa){
    document.getElementById("opcoes_de_sorteio" + idRifa).style.display = "none";
}

function abrirSorteio(idRifa){
    document.getElementById("popup_sorteio" + idRifa).style.display = "block";
}

function cancelarSorteio(idRifa){
    document.getElementById("popup_sorteio" + idRifa).style.display = "none";
}