let checkBox = document.querySelectorAll(".criar_venda_checkbox");




function abrirRifa(idRifa) {
    document.getElementById("id" + idRifa).style.display = "flex";
}

function fecharRifa(idRifa) {
    document.getElementById("id" + idRifa).style.display = "none";
    limparSelecao()
}

function criarVenda(idRifa) {
    document.getElementById("btn_cancelar_venda" + idRifa).style.display = "block";
    document.getElementById("card_comprador" + idRifa).style.display = "flex";
    document.getElementById("btn_criar_venda" + idRifa).style.display = "none";
}

function cancelarVenda(idRifa) {
    document.getElementById("btn_cancelar_venda" + idRifa).style.display = "none";
    document.getElementById("btn_criar_venda" + idRifa).style.display = "block";
    document.getElementById("card_comprador" + idRifa).style.display = "none";

    checkBox.forEach(element => {
        element.style.display = "none";
    });
}

function adicionarNumeros(idUsuario) {
    checkBox.forEach(element => {
        element.style.display = "block";
    });

    document.getElementById("btn_adicionar_numeros" + idUsuario).style.display = "none";
    document.getElementById("btn_cancelar_numeros" + idUsuario).style.display = "block";
    document.getElementById("btn_comprar_numeros" + idUsuario).style.display = "block";

    console.log(idUsuario);
}

function cancelarNumeros(idUsuario) {
    checkBox.forEach(element => {
        element.style.display = "none";
    });

    document.getElementById("btn_adicionar_numeros" + idUsuario).style.display = "block";
    document.getElementById("btn_cancelar_numeros" + idUsuario).style.display = "none";
    document.getElementById("btn_comprar_numeros" + idUsuario).style.display = "none";
}

function ativarHiddens(idUsuario) {
    let item = document.getElementById("id_hidden" + idUsuario)
    item.setAttribute("name", "id_usuarios_temp")
}

function mostrarOpcoesDeSorteio(idRifa) {
    document.getElementById("opcoes_de_sorteio" + idRifa).style.display = "block";
}

function cancelarOpcoesSorteio(idRifa) {
    document.getElementById("opcoes_de_sorteio" + idRifa).style.display = "none";
}

function abrirSorteio(idRifa) {
    document.getElementById("popup_sorteio" + idRifa).style.display = "block";
}

function cancelarSorteio(idRifa) {
    document.getElementById("popup_sorteio" + idRifa).style.display = "none";
}

function limparSelecao() {
    numerosDisponiveis.forEach(element => {
        element.checked = false;
    })

    btnComprar.forEach(btn => {
        btn.setAttribute("disabled", true);
    })

    btnLimpar.forEach(btn => {
        btn.setAttribute("disabled", true);
    })

    document.querySelectorAll(".numero_disponivel").forEach(element => {
        element.classList.remove("numero_selecionado");
        // element.style.backgroundColor = "#FFF";
        // element.style.transform = "scale(1.0)"
        // element.style.borderRadius = "5px"
    })
}

let numerosDisponiveis = document.querySelectorAll(".numeros_rifa_disponiveis");
let btnComprar = document.querySelectorAll(".btn_comprar_numeros");
let btnLimpar = document.querySelectorAll(".btn_limpar_selecao");
let numero = document.querySelectorAll(".numero");


let key = 0;
numerosDisponiveis.forEach(element => {
    element.addEventListener("change", () => {
        if (element.checked) {
            btnComprar.forEach(btn => {
                btn.removeAttribute("disabled");
            })
            btnLimpar.forEach(btn => {
                btn.removeAttribute("disabled");
            })

            let id = "n" + element.getAttribute("id").substring(1);
            let item = document.getElementById(id);
            item.classList.add("numero_selecionado");
            // item.style.backgroundColor = "#F30";
            // item.style.transform = "scale(1.1)"
            // item.style.borderRadius = "1px"
            // console.log(item);


            key++;
        } else {
            key--;

            let id = "n" + element.getAttribute("id").substring(1);
            let item = document.getElementById(id);
            item.classList.remove("numero_selecionado");
            // item.style.backgroundColor = "#FFF";
            // item.style.transform = "scale(1.0)"
            // item.style.borderRadius = "5px"
            // // console.log(item);

            if (key == 0) {

                btnComprar.forEach(btn => {
                    btn.setAttribute("disabled", true);
                })
                btnLimpar.forEach(btn => {
                    btn.setAttribute("disabled", true);
                })

            }
        }
    })
})

btnLimpar.forEach(btn => {
    btn.addEventListener("click", () => {
        limparSelecao()
    })
})

let radios = document.querySelectorAll(".tipo_de_valor");
let valorTotal = document.getElementById("valor_total");
let valorNumeros = document.getElementById("valor_numeros");


radios.forEach(element => {
    element.addEventListener("change", () => {

        let idRadio = element.getAttribute("id");
        if(idRadio == "radio_valor_numeros"){
            valorNumeros.removeAttribute("disabled");
            valorTotal.setAttribute("disabled", true);
            valorNumeros.focus()
        } else{
            valorTotal.removeAttribute("disabled");
            valorNumeros.setAttribute("disabled", true);
            valorTotal.focus()
        }
    })
})