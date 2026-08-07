const checkBox = document.querySelectorAll(".criar_venda_checkbox");
const menu = document.getElementById("menu_hamburguer");
const btnMenu = document.getElementById("btn_menu_haburguer");
const popupLogin = document.getElementById("popup_login");
const inputObjetivo = document.getElementById("input_objetivo");
const numeroDeLetras = document.getElementById("numero_de_letras");
const stepSorteioAudio = document.getElementById("step_sorteio_audio");
const winnerSorteioAudio = document.getElementById("winner_sorteio_audio");
const btnFecharSorteio = document.getElementById("btn_fechar_sorteio");

const numeroSorteioDiv = document.getElementById("numero_sorteio");
const roletaSorteioContainer = document.getElementById("roleta_sorteio_container");

function abrirMenu() {
    if (menu.style.display == "block") {
        menu.style.display = "none";
        // btnMenu.src = "assets/img/icons/btn_menu_hamburguer.svg"
        document.querySelectorAll(".menu_numeros_comprados").forEach((menu) => {
            menu.classList.add("desativado");
        })
        document.querySelectorAll(".numero_sorteado_container").forEach((numero) => {
            numero.classList.add("desativado");
        })
        document.getElementById("menu_rifas_compradas").classList.add("desativado");
    } else {
        menu.style.display = "block";
        // btnMenu.src = "assets/img/icons/btn_fechar_menu.svg"
    }
}

function abrirRifa(idRifa, logado) {
    if (logado) {
        document.getElementById("id" + idRifa).style.display = "flex";
    } else {
        abrirPopupLogin();
    }
}
function fecharRifa(idRifa) {
    document.getElementById("id" + idRifa).style.display = "none";
    limparSelecao();
}

function fecharPopupLogin() {
    document.getElementById("popup_login").style.display = "none";
}

function abrirPopupLogin() {
    popupLogin.style.display = "flex";
}

function criarVenda(idRifa) {
    document.getElementById("card_comprador" + idRifa).style.display = "flex";
}

function cancelarVenda(idRifa) {
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
    let itens = document.getElementById("id_usuario" + idUsuario)
    item.setAttribute("name", "id_usuarios_temp")
    itens.setAttribute("name", "id_usuarios_temp")
}

function mostrarOpcoesDeSorteio(idRifa) {
    document.getElementById("popup_sorteio" + idRifa).style.display = "flex";
}

function cancelarOpcoesSorteio(idRifa) {
    document.getElementById("opcoes_de_sorteio" + idRifa).style.display = "none";
}

function abrirSorteio(idRifa) {
    document.getElementById("popup_sorteio" + idRifa).style.display = "flex";
}

function cancelarSorteio(idRifa) {
    document.getElementById("popup_sorteio" + idRifa).style.display = "none";
}

function editarUsuarioTemp(idUsuario) {
    let campoNome = document.getElementById("nome_usuario_temp" + idUsuario);
    let campoTel = document.getElementById("telefone_usuario_temp" + idUsuario);

    campoNome.removeAttribute("disabled");
    campoTel.removeAttribute("disabled");

    campoNome.classList.add("campo_usuario_temporario_ativo");
    campoTel.classList.add("campo_usuario_temporario_ativo");

    let comprimento = campoNome.value.length;

    campoNome.focus();

    campoNome.setSelectionRange(comprimento, comprimento);

    document.getElementById("btns_confirmar" + idUsuario).style.display = "flex";
    document.getElementById("btns_padrao" + idUsuario).style.display = "none";
}

function cancelarEdicao(idUsuario) {
    let campoNome = document.getElementById("nome_usuario_temp" + idUsuario);
    let campoTel = document.getElementById("telefone_usuario_temp" + idUsuario);

    campoNome.classList.remove("campo_usuario_temporario_ativo");
    campoTel.classList.remove("campo_usuario_temporario_ativo");

    campoNome.setAttribute("disabled", true);
    campoTel.setAttribute("disabled", true);

    document.getElementById("btns_confirmar" + idUsuario).style.display = "none";
    document.getElementById("btns_padrao" + idUsuario).style.display = "flex";
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
    })
}

let numerosDisponiveis = document.querySelectorAll(".numeros_rifa_disponiveis");
let btnComprar = document.querySelectorAll(".btn_comprar_numeros");
let btnLimpar = document.querySelectorAll(".btn_limpar_selecao");
let numero = document.querySelectorAll(".numero");
let btnAddNumero = document.querySelectorAll(".btn_add_numeros");



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

            btnAddNumero.forEach(btn => {
                btn.removeAttribute("disabled")
            })

            let id = "n" + element.getAttribute("id").substring(1);
            let item = document.getElementById(id);
            item.classList.add("numero_selecionado");

            key++;
        } else {
            key--;

            let id = "n" + element.getAttribute("id").substring(1);
            let item = document.getElementById(id);
            item.classList.remove("numero_selecionado");

            if (key == 0) {

                btnComprar.forEach(btn => {
                    btn.setAttribute("disabled", true);
                })

                btnLimpar.forEach(btn => {
                    btn.setAttribute("disabled", true);
                })

                btnAddNumero.forEach(btn => {
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
        if (idRadio == "radio_valor_numeros") {
            valorNumeros.removeAttribute("disabled");
            valorTotal.setAttribute("disabled", true);
            valorNumeros.focus()
        } else {
            valorTotal.removeAttribute("disabled");
            valorNumeros.setAttribute("disabled", true);
            valorTotal.focus()
        }
    })
})

function expandirNumerosVendidos(idUsuario) {
    let div = document.getElementById("lista_numeros" + idUsuario);
    let btnMostrarNumeros = document.getElementById("btn_mostrar_numeros" + idUsuario);
    let ul = document.getElementById("ul_numeros_usuario_temp" + idUsuario);
    let label = document.getElementById("label_numeros" + idUsuario);

    console.log(div)
    if (!div.classList.contains("lista_expandida")) {
        div.classList.add("lista_expandida");
        btnMostrarNumeros.innerHTML = "-";
        btnMostrarNumeros.title = "Esconder"
        ul.style.height = "fit-content";
        // div.style.alignItems = "baseline";
        // ul.style.padding = "15px 0";
        // ul.style.marginTop = "300px";
        label.style.position = "sticky";
        label.style.top = "43px";

    } else {
        div.classList.remove("lista_expandida");
        btnMostrarNumeros.innerHTML = "+";
        ul.style.height = "40px";
        ul.style.padding = "0px";
        // ul.style.marginTop = "5px";
        label.style.position = "static";
        label.style.top = "0px";
    }
}

function abrirRifasCompradas() {
    let menuRifas = document.getElementById("menu_rifas_compradas");

    if (menuRifas.classList.contains("desativado")) {
        menuRifas.classList.remove("desativado");
    } else {
        menuRifas.classList.add("desativado");
        document.querySelectorAll(".menu_numeros_comprados").forEach((menu) => {
            menu.classList.add("desativado");
        })
        document.querySelectorAll(".numero_sorteado_container").forEach((numero) => {
            numero.classList.add("desativado");
        })
    }
}

function abrirNumerosComprados(idRifa) {
    let menuNumeros = document.getElementById("menu_numeros_comprados" + idRifa);
    let menuNumeroSorteado = document.getElementById("numero_sorteado_container" + idRifa);

    if (menuNumeros.classList.contains("desativado")) {
        menuNumeros.classList.remove("desativado");
        menuNumeroSorteado.classList.remove("desativado");
    } else {
        menuNumeros.classList.add("desativado");
        menuNumeroSorteado.classList.add("desativado");
    }

}

function priorizarLiRifa(idRifa) {
    const mediaQuery = window.matchMedia("(max-width: 650px)");
    const rifaLi = document.getElementById("rifa_comprada" + idRifa);
    const rifasCompradas = document.querySelectorAll(".rifas_compradas");

    if (mediaQuery.matches) {
        rifasCompradas.forEach((rifa) => {
            rifa.style.order = "0";
        })
        rifaLi.style.order = "-1";
    }
    abrirNumerosComprados(idRifa);
}

function fecharSorteio() {
    roletaSorteioContainer.style.display = "none";
}

function sortearNumero(e, idRifa) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    fetch('../../src/controller/sorteio_controller.php', {
        method: 'POST',
        body: formData
    })
        .then(async response => {
            if (!response.ok) {
                const text = await response.text();
                throw new Error(`Erro na requisição (${response.status}): ${text}`);
            }
            return response.json();
        })
        .then(sorteio => {
            const popupSorteio = document.getElementById("popup_sorteio" + idRifa);
            const resultadoDiv = document.getElementById("resultado" + idRifa);
            const labelNumeroSorteado = document.getElementById("label_numero_sorteado" + idRifa);
            const btnOpcoesSorteio = document.getElementById("btn_opcoes_sorteio" + idRifa);

            btnOpcoesSorteio.style.display = "none";
            popupSorteio.style.display = "none";
            roletaSorteioContainer.style.display = "flex";


            if ("numerosComprados" in sorteio) {
                //SOMENTE NÚMEROS COMPRADOS
                const numerosComprados = sorteio.numerosComprados;

                let maxChanges = 6;
                const tempoEntreTrocas = 3000;

                const numChanges = Math.floor(Math.random() * (maxChanges - 4)) + 3;

                const indiceAleatorio = Math.floor(Math.random() * numerosComprados.length);
                numeroSorteioDiv.innerText = numerosComprados[indiceAleatorio].numero;
                numeroSorteioDiv.style.animationName = "trocaNumeroSorteio, trocaNumeroSorteio";
                numeroSorteioDiv.style.animationDuration = "3s";
                numeroSorteioDiv.style.animationDelay = "0s, 3s";
                numeroSorteioDiv.style.animationIterationCount = numChanges;
                stepSorteioAudio.play();
                let i = 0;
                const intervalId = setInterval(() => {
                    i++;

                    const delay = i * tempoEntreTrocas;
                    if (i === numChanges) {
                        //Altera para número sorteado!
                        numeroSorteioDiv.innerText = sorteio.numeroSorteado;
                        // resultadoDiv.innerText = sorteio.numeroSorteado;
                        // console.log(resultadoDiv)
                        winnerSorteioAudio.play();
                        const resultadoDiv = document.createElement("span");
                        resultadoDiv.setAttribute("id", "resultadoSpan" + idRifa)
                        resultadoDiv.innerText = sorteio.numeroSorteado;
                        labelNumeroSorteado.appendChild(resultadoDiv);
                        resultadoDiv.classList.add("numero_sorteado_div");
                        resultadoDiv.classList.add("resultado");
                        btnFecharSorteio.style.display = "flex";

                        clearInterval(intervalId);
                    } else {
                        // Altera para números possíveis!
                        const indiceAleatorio = Math.floor(Math.random() * numerosComprados.length);
                        numeroSorteioDiv.innerText = numerosComprados[indiceAleatorio].numero;
                        numeroSorteioDiv.style.animationName = "trocaNumeroSorteio, trocaNumeroSorteio";
                        numeroSorteioDiv.style.animationDuration = "3s";
                        numeroSorteioDiv.style.animationDelay = "0s, 3s";
                        numeroSorteioDiv.style.animationIterationCount = numChanges;
                        stepSorteioAudio.play();
                    }
                }, 3000);
            } else {
                //TODOS OS NÚMEROS
                const quantidadeNumeros = sorteio.quantidadeNumeros[0].quantidade_numeros;

                // console.log(sorteio.numeroFoiComprado);
                // console.log(resultadoDiv)

                let maxChanges = 6;
                const tempoEntreTrocas = 3000;

                const numChanges = Math.floor(Math.random() * (maxChanges - 4)) + 3;

                numeroSorteioDiv.innerText = Math.ceil(Math.random() * quantidadeNumeros);
                numeroSorteioDiv.style.animationName = "trocaNumeroSorteio, trocaNumeroSorteio";
                numeroSorteioDiv.style.animationDuration = "3s";
                numeroSorteioDiv.style.animationDelay = "0s, 3s";
                numeroSorteioDiv.style.animationIterationCount = numChanges - 1;
                stepSorteioAudio.play();
                let i = 0;

                const intervalId = setInterval(() => {
                    i++;

                    const delay = i * tempoEntreTrocas;
                    if (i === numChanges) {

                        btnFecharSorteio.style.display = "flex";
                        const resultado = document.getElementById("resultadoSpan" + idRifa);

                        if (resultado != null) {
                            resultado.style.display = "none";
                        }

                        numeroSorteioDiv.innerText = sorteio.numeroSorteado;
                        // resultadoDiv.value = sorteio.numeroSorteado;
                        winnerSorteioAudio.play();
                        const resultadoDiv = document.createElement("span");
                        resultadoDiv.setAttribute("id", "resultadoSpan" + idRifa)
                        resultadoDiv.innerText = sorteio.numeroSorteado;
                        labelNumeroSorteado.appendChild(resultadoDiv);

                        if (!sorteio.numeroFoiComprado) {
                            popupSorteio.style.display = "flex";
                            btnOpcoesSorteio.style.display = "flex";
                        } else {
                            resultadoDiv.classList.add("numero_sorteado_div");
                            resultadoDiv.classList.add("resultado");
                        }

                        clearInterval(intervalId);
                    } else {
                        const indiceAleatorio = Math.floor(Math.random() * quantidadeNumeros.length);
                        numeroSorteioDiv.innerText = Math.ceil(Math.random() * quantidadeNumeros);
                        numeroSorteioDiv.style.animationName = "trocaNumeroSorteio, trocaNumeroSorteio";
                        numeroSorteioDiv.style.animationDuration = "3s";
                        numeroSorteioDiv.style.animationDelay = "0s, 3s";
                        numeroSorteioDiv.style.animationIterationCount = numChanges;
                        stepSorteioAudio.play();
                    }
                }, 3000);
            }

            if (sorteio.status === 'sucesso') {
                form.reset();
            }
        })
        .catch(error => console.error('Erro no envio:', error));
};

inputObjetivo.addEventListener("input", () => {
    let qntAtual = inputObjetivo.value.length;
    if (qntAtual < 16) {
        numeroDeLetras.textContent = qntAtual + "/15";
    }
});