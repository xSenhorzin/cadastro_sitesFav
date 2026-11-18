<?php
require_once("../verificarLogin.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VISUALIZAR SITES FAVORITOS</title>
    <link rel="stylesheet" href="../css/Estilo.css">
</head>
<body>

    <?php require_once("../_menu.php"); ?>
    
    <h1>VISUALIZAR SITES FAVORITOS</h1>

    <div class="conteudo">
        <?php require_once("./visualizarbd.php"); ?>
        <table>
            <thead>
                <tr>
                    <th width="3%">ID</th>
                    <th width="8%">FOTO</th>
                    <th width="14%">NOME</th>
                    <th width="20%">URL</th>
                    <th width="20%">DESCRIÇÃO</th>
                    <th width="10%">CATEGORIA</th>
                    <th width="8%">DATA</th>
                    <th width="5%">ATT</th>
                    <th width="5%">EXC</th>
                </tr>
            </thead>
            <tbody>
            <?php
               if($totalRegistros > 0){ 
                foreach($dados as $linha){
            ?>
                <tr>
                    <td><?=$linha["idSite"]; ?></td>
                    <td>
                        <img src="../foto/<?= htmlspecialchars($linha["fotoSite"] ?: "semFoto.png", ENT_QUOTES, "UTF-8"); ?>"
                            alt="Foto do site" width="50" height="50">
                    </td>
                    <td><?=$linha["nomeSite"]; ?></td>
                    <td><?=$linha["urlSite"]; ?></td>
                    <td><?=$linha["descricaoSite"]; ?></td>
                    <td><?=$linha["categoriaSite"]; ?></td>
                    <td><?=$linha["dataSite"]; ?></td>
                    <td align="center">
                        <a href="../atualizar/atualizar.php?codigo=<?=$linha["idSite"];?>">
                            <img src="../img/Update.png" alt="Atualizar" width="24">
                        </a>
                    </td>
                    <td align="center">
                        <a href="../excluir/excluir.php?codigo=<?=$linha["idSite"];?>">
                            <img src="../img/Delete.png" alt="Excluir" width="24">
                        </a>
                    </td>
                </tr>
            <?php
                }
               }
               else{
                echo("<tr>");
                echo("<td colspan=6> Não há registros! </td>");
                echo("</tr>");
               }
            ?>
            </tbody>
        </table>
    </div>

</body>
</html>