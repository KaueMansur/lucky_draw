let checkBox = document.querySelectorAll(".criar_venda_checkbox");




function abrirRifa(idRifa){
   document.getElementById("id" + idRifa).style.display = "block";
}

function fecharRifa(idRifa){
    document.getElementById("id" + idRifa).style.display = "none";
}

function criarVenda(){
    document.getElementById("btn_cancelar_venda").style.display = "block";
    document.getElementById("btn_continuar_venda").style.display = "block";
    document.getElementById("btn_criar_venda").style.display = "none";

    checkBox.forEach(element => {
        element.style.display = "block";
    });
}

function cancelarVenda(){
    document.getElementById("btn_cancelar_venda").style.display = "none";
    document.getElementById("btn_continuar_venda").style.display = "none";
    document.getElementById("btn_criar_venda").style.display = "block";

    
    checkBox.forEach(element => {
        element.style.display = "none";
    });
}

function continuarVenda(){
    document.getElementById("card_comprador").style.display = "block"
}