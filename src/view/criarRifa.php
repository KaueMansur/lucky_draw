<?php

require "../model/usuario.php";

require "../controller/session_off.php";

$usuario = $_SESSION["usuario"];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Rifa</title>
</head>
<body>
    <h1>Criar Rifa</h1>

    <form action="../controller/criar_rifa_controller.php" method="post" style="display: flex; flex-direction: column; width: 200px;">

        <label for="">Objetivo:</label>
        <input type="text" name="objetivo" id="">        

        <label for="">Quantidade de números:</label>
        <input type="number" name="quantidade_numeros" id="">

        <label for="">Valor de cada número:</label>
        <input type="number" name="valor_numeros" id="">

        <label for="">Valor total:</label>
        <input type="number" name="valor_total" id="">

        <label for="">Prêmio:</label>
        <input type="text" name="premio" id="">

        <label for="">Imagem ilustrativa:</label>
        <input type="text" name="img_ilustrativa" id="">

        <label for="">Data do sorteio:</label>
        <input type="date" name="data_sorteio" id="">

        <label for="">Local do sorteio:</label>
        <input type="text" name="local_sorteio" id="">
        
        <label for="">Privacidade:</label>
        <div>
            
            <div>
                <input type="radio" name="privacidade" id="" value="0" checked>
                <label for="">Público</label>
            </div>
            
            <div>
                <input type="radio" name="privacidade" id="" value="1">
                <label for="">Privado</label>
            </div>

            <div>
                <input type="radio" name="privacidade" id="" value="2">
                <label for="">Somente com link</label>
            </div>

        </div>
        <input type="hidden" name="id_usuario" value="<?= $usuario->getIdUsuario() ?>">
        
        <input type="submit" value="Criar Rifa">
        
        <!-- <input type="number" name="id_usuario" id=""> -->

    </form>
</body>
</html>