<?php
require_once("verificarLogin.php");
require_once("./_conexao.php");

try {
    $idUsuario = (int) $_SESSION["idUsuario"];

    $comandoSQL = $conexao->prepare(
        "SELECT * FROM sites WHERE idUsuario = :idUsuario"
    );

    $comandoSQL->execute(array(
        ":idUsuario" => $idUsuario
    ));

} catch (PDOException $erro) {
    echo("Entre em contato com suporte!");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SITES FAVORITOS</title>

    <link rel="stylesheet" href="./css/Index.css">
</head>

<body>

    <div class="menu">
        <h1 id="titulo">SITES FAVORITOS</h1>
        <a href="./visualizar/visualizar.php">GERENCIAR</a>
    </div>

    <div class="conteudo">

        <?php while ($dados = $comandoSQL->fetch()) { ?>

            <div class="site">

                <img src="./foto/<?= htmlspecialchars($dados["fotoSite"] ?: "semFoto.png", ENT_QUOTES, "UTF-8"); ?>"
                alt="Foto do site" width="100">
                <h2><?= htmlspecialchars($dados["nomeSite"], ENT_QUOTES, "UTF-8"); ?></h2>

                <p>
                    <b>LINK:</b>
                    <?= $dados["urlSite"]; ?>
                </p>

                <p>
                    <b>DESCRIÇÃO:</b>
                    <?= $dados["descricaoSite"]; ?>
                </p>

                <p>
                    <b>CATEGORIA:</b>
                    <?= $dados["categoriaSite"]; ?>
                </p>

                <p>
                    <b>DATA DO CADASTRO:</b>
                    <?= $dados["dataSite"]; ?>
                </p>

                <a href="<?= $dados["urlSite"]; ?>" target="_blank">
                    <button type="button">ACESSAR SITE</button>
                </a>

            </div>

        <?php } ?>

    </div>

</body>
</html>