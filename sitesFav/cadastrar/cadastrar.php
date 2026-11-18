<?php
require_once("../verificarLogin.php");
?>

<!DOCTYPE html>

<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADASTRAR SITE</title>
    <link rel="stylesheet" href="../css/Estilo.css">
</head>

<body>

<?php require_once("../_menu.php"); ?>

<h1>CADASTRAR SITE</h1>

<div class="conteudo">

    <form action="cadastrarbd.php" method="post" enctype="multipart/form-data">

        <!-- NOME -->
        <div class="row">
            <div class="col">
                <label for="nomeSite">NOME DO SITE</label>

                <input
                    type="text"
                    name="nomeSite"
                    id="nomeSite"
                    placeholder="Nome">
            </div>
        </div>

        <!-- URL -->
        <div class="row">
            <div class="col">
                <label for="urlSite">LINK DO SITE</label>

                <input
                    type="text"
                    name="urlSite"
                    id="urlSite"
                    placeholder="https://exemplo.com">
            </div>
        </div>

        <!-- DESCRIÇÃO -->
        <div class="row">
            <div class="col">
                <label for="descricaoSite">DESCRIÇÃO</label>

                <input
                    type="text"
                    name="descricaoSite"
                    id="descricaoSite"
                    placeholder="Digite uma breve descrição sobre o site..."
                    maxlength="500">
            </div>
        </div>

        <!-- CATEGORIA -->
        <div class="row">
            <div class="col">
                <label for="categoriaSite">CATEGORIA</label>

                <input
                    type="text"
                    name="categoriaSite"
                    id="categoriaSite"
                    placeholder="Ex: Estudos, Entretenimento, Tecnologia...">
            </div>
        </div>

        <!-- DATA -->
        <div class="row">
            <div class="col">
                <label for="dataSite">DATA DO CADASTRO</label>

                <input
                    type="date"
                    name="dataSite"
                    id="dataSite">
            </div>
        </div>

        <!-- FOTO -->
        <div class="row">
            <div class="col">
                <label for="fotoSite">FOTO PARA O SITE</label>

                <input
                    type="file"
                    name="fotoSite"
                    id="fotoSite">
            </div>
        </div>

        <!-- BOTÕES -->
        <div class="row">
            <div class="col botoes">

                <input
                    type="submit"
                    value="SALVAR">

                <input
                    type="reset"
                    value="VOLTAR"
                    onclick="history.go(-1);">

            </div>
        </div>

    </form>

</div>

</body>
</html>