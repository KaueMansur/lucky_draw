<?php


require "../model/rifa.php";

require "../controller/session_off.php";

$rifa = new Rifa();

$usuario = $_SESSION["usuario"];

$numeroComprado = new NumeroComprado();

$listaDeRifas = $rifa->listarTodasAsRifas($usuario->getIdUsuario());

$listaDasRifas = [];

foreach($listaDeRifas as $r){
    array_push($listaDasRifas, $rifa = new Rifa($r->id_rifa, $r->objetivo, $r->quantidade_de_numeros, $r->premio, $r->imagem_ilustrativa, $r->data_do_sorteio, $r->local_do_sorteio, $r->valor_cada_numero, $r->valor_total, $r->id_usuario, $r->privacidade));
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .rifas {
            width: 400px;
            height: 150px;
            background-color: #fff;
        }

        .rifa_aberta {
            display: none;
            position: fixed;
            top: 10px;
            left: 200px;
            width: 900px;
            height: 600px;
            background-color: #fff;
            border: 1px solid #000;
            padding: 5px;
        }

        .espaco_numeros {
            background-color: #413636ff;
            width: 95%;
            height: 80%;
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
            padding: 10px;
            overflow: scroll;
        }

        .numero {
            background-color: #fff;
            width: 40px;
            height: 40px;
            list-style-type: none;
        }

        .numero_vendido {
            background-color: #e91111ff;
        }

        .desativado{
            display: none;
        }

        #card_comprador{
            background-color: #fff;
            width: 80%;
            height: 100px;
            border: 2px solid #000;
        }
        </style>
    <title>Galeria de Rifas</title>
</head>
<body>
    <h1>Galeria de rifas</h1>
    <a href="../../index.php">Voltar à página inicial</a>
    <section style="background-color: #695353ff; width: 100wh; height: 550px; padding: 50px;">

        <ul>
            <?php foreach($listaDasRifas as $rifa){ ?>
                <li class="rifas">
                    <p><?= $rifa->getObjetivo() ?></p>
                    <p><?= $rifa->getPremio() ?></p>
                    <p><?= number_format($rifa->getValorCadaNumero(), 2, '.') ?></p>
                    <button onclick="abrirRifa(<?= $rifa->getIdRifa() ?>)">Abrir Rifa</button>
                </li>
                <div class="rifa_aberta" id="id<?= $rifa->getIdRifa() ?>">
                    <button onclick="fecharRifa(<?= $rifa->getIdRifa() ?>)">Fechar Rifa</button>
                    <ul class="espaco_numeros">
                        <?php 
                        
                            $numerosDaRifa = $numeroComprado->listarNumerosCompradosDaRifa($rifa->getIdRifa());

                            $numerosConvertidos = [];


                            for($i = 0; $i < count($numerosDaRifa); $i++ ){
                                array_push($numerosConvertidos, $numerosDaRifa[$i]->numero);
                            }

                           for($i = 1; $i < $rifa->getQuantidadeDeNumeros() + 1; $i++){
                                if(in_array($i, $numerosConvertidos)){
                                    //Número vendido
                                    ?>
                                    <label>
                                        <li class="numero numero_vendido">
                                            <?= $i ?>
                                            <input type="checkbox" name="numeros[]" value="<?= $i  ?>" class="criar_venda_checkbox" checked disabled>
                                            </li>
                                    </label>
                                
                        <?php } else{ ?>
                            <label>
                                <li class="numero">
                                    <?= $i ?>
                                    <input type="checkbox" name="numeros[]" value="<?= $i  ?>" class="criar_venda_checkbox">
                                </li>
                            </label>
                            <?php }} ?>
                    </ul>
                    <button onclick="criarVenda()" id="btn_criar_venda">Criar Venda</button>
                    <button onclick="cancelarVenda()" id="btn_cancelar_venda" class="desativado">Cancelar Venda</button>
                    <button onclick="continuarVenda()" id="btn_continuar_venda" class="desativado">Próximo</button>

                    <div id="card_comprador" class="desativado">
                        
                        <div>
                            <label>Nome:</label>
                            <input type="text" name="" id="">
                        </div>
                        
                        <div>
                            <label>Telefone:</label>
                            <input type="tel" name="" id="">
                        </div>
                      
                        <input type="submit" value="Salvar">
                    </div>
                </div>
            <?php } ?>
        </ul>

    </section>
    <script src="../../assets/js/script.js"></script>
</body>
</html>