<?php
require_once("../verificarLogin.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATUALIZAR SITE FAVORITO</title>
    <link rel="stylesheet" href="../css/Estilo.css">
</head> 
<body>
    <?php require_once("../_menu.php"); ?>
    <h1>ATUALIZAR SITE FAVORITO</h1>

    <div class="conteudo">
        
        <?php require_once("./atualizar_view.php");?>

        <div class="row">
    <div class="col">
        <label>FOTO ATUAL</label>
        <br>

        <img
            src="../foto/<?= htmlspecialchars($dados["fotoSite"] ?: "semFoto.png", ENT_QUOTES, "UTF-8"); ?>"
            alt="Foto atual"
            width="120">
    </div>
</div>

        <form action="atualizarbd.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="codigo" value="<?=$codigo; ?>">
            <div class="row">
                <div class="col">
                    <label for="nomeSite">NOME DO SITE</label>
                    <input 
                        type="text" 
                        name="nomeSite" 
                        id="nomeSite"
                        placeholder="Nome"
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
                        value="<?=$dados["dataSite"];?>">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="fotoSite">FOTO PARA PERFIL</label>
                    <input type="file" name="fotoSite" id="fotoSite">
                </div>
            </div>
            
            <div class="row">
                <div class="col botoes">
                    <input type="submit" value="SALVAR">
                    <input 
                        type="reset" 
                        onclick="javascript:history.go(-1);"
                        value="VOLTAR">    
                </div>
            </div>
        </form>
    </div>
    
</body>
</html>