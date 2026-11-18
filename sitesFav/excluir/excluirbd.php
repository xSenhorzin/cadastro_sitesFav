<?php

// VERIFICANDO O LOGIN
require_once("../verificarLogin.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ID DO USUÁRIO LOGADO
    $idUsuario = (int) $_SESSION["idUsuario"];

    // RECEBENDO E VALIDANDO O CÓDIGO
    $idSite = filter_input(INPUT_POST, "codigo", FILTER_VALIDATE_INT);

    if (!$idSite || $idSite <= 0) {
        exit("Código do site inválido.");
    }

    try {

        require_once("../_conexao.php");

        // BUSCANDO A FOTO DO SITE DO USUÁRIO
        $consulta = $conexao->prepare(
            "SELECT fotoSite
             FROM sites
             WHERE idSite = :idSite
             AND idUsuario = :idUsuario"
        );

        $consulta->execute(array(
            ":idSite" => $idSite,
            ":idUsuario" => $idUsuario
        ));

        $site = $consulta->fetch(PDO::FETCH_ASSOC);

        if (!$site) {
            exit("Site não encontrado ou você não tem permissão para excluí-lo.");
        }

        // EXCLUINDO SOMENTE O REGISTRO DO USUÁRIO
        $comandoSQL = $conexao->prepare(
            "DELETE FROM sites
             WHERE idSite = :idSite
             AND idUsuario = :idUsuario"
        );

        $comandoSQL->execute(array(
            ":idSite" => $idSite,
            ":idUsuario" => $idUsuario
        ));

        if ($comandoSQL->rowCount() > 0) {

            // REMOVENDO A FOTO DO SITE
            $fotoAntiga = $site["fotoSite"];

            if (!empty($fotoAntiga) && $fotoAntiga != "semFoto.png") {

                $caminhoFoto = __DIR__ . "/../foto/" . basename($fotoAntiga);

                if (is_file($caminhoFoto)) {
                    unlink($caminhoFoto);
                }
            }

            header("Location: ../visualizar/visualizar.php");
            exit();

        } else {

            echo "Não foi possível excluir o site.";

        }

    } catch (PDOException $erro) {

        echo "Erro ao excluir o site.";

    }

} else {

    echo "Acesso inválido.";

}

?>