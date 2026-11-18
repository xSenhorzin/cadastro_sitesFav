<?php
require_once("../verificarLogin.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXCLUIR SITE FAVORITO</title>
    <link rel="stylesheet" href="../css/Estilo.css">
</head>
<body>
    <?php require_once("../_menu.php"); ?>
    <h1>EXCLUIR SITE FAVORITO</h1>

    <div class="conteudo">
        
        <?php require_once("./excluir_view.php");?>

        <form action="excluirbd.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="codigo" value="<?=$codigo; ?>">
            <div class="row">
                <div class="col">
                    <label for="nomeSite">NOME DO SITE</label>
                    <input 
                        type="text" 
                        name="nomeSite" 
                        id="nomeSite"
                        placeholder="Nome"
                        readonly
                        value="<?=$dados["nomeSite"];?>">
                </div>
            </div>
            
            <div class="row">
                <div class="col">
                    <label for="urlSite">LINK DO SITE</label>
                    <input 
                        type="text" 
                        name="urlSite" 
                        id="urlSite"
                        placeholder="URL"
                        readonly
                        value="<?=$dados["urlSite"];?>">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="descricaoSite">DESCRIÇÃO</label>
                    <input 
                        type="text" 
                        name="descricaoSite" 
                        id="descricaoSite"
                        placeholder="Descrição"
                        readonly
                        value="<?=$dados["descricaoSite"];?>">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="categoriaSite">CATEGORIA DO SITE</label>
                    <input 
                        type="text" 
                        name="categoriaSite" 
                        id="categoriaSite"
                        placeholder="Categoria"
                        readonly
                        value="<?=$dados["categoriaSite"];?>">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="dataSite">DATA DO CADASTRO</label>
                    <input 
                        type="date" 
                        name="dataSite" 
                        id="dataSite"
                        placeholder="Data Cadastro do Site"
                        readonly
                        value="<?=$dados["dataSite"];?>">
                </div>
            </div>

            <div class="row">
    <div class="col">
        <label>FOTO DO SITE</label>
        <br>

        <img
            src="../foto/<?= htmlspecialchars($dados["fotoSite"] ?: "semFoto.png", ENT_QUOTES, "UTF-8"); ?>"
            alt="Foto do site"
            width="120">
    </div>
</div>
            </div>
            
            <div class="row">
                <div class="col botoes">
                    <input 
                        id="excluir"
                        type="submit"   
                        value="E X C L U I R">
                    <input 
                        id="voltar_excluir"
                        type="reset" 
                        value="VOLTAR"
                        onclick="javascript:history.go(-1);">    
                </div>
            </div>
        </form>
    </div>
    
</body>
</html>