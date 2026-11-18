<?php

require_once("../verificarLogin.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ID DO USUÁRIO LOGADO
    $idUsuario = (int) $_SESSION["idUsuario"];

    // RECEBENDO OS DADOS
    $idSite = filter_input(INPUT_POST, "codigo", FILTER_VALIDATE_INT);

    $nomeSite = trim($_POST["nomeSite"] ?? "");
    $urlSite = trim($_POST["urlSite"] ?? "");
    $descricaoSite = trim($_POST["descricaoSite"] ?? "");
    $categoriaSite = trim($_POST["categoriaSite"] ?? "");
    $dataSite = trim($_POST["dataSite"] ?? "");

    $novoCaminhoFoto = null;

    try {

        // VALIDANDO O ID
        if (!$idSite || $idSite <= 0) {
            throw new Exception("Código do site inválido.");
        }

        // VALIDANDO OS CAMPOS
        if (
            $nomeSite === "" ||
            $urlSite === "" ||
            $descricaoSite === "" ||
            $categoriaSite === "" ||
            $dataSite === ""
        ) {
            throw new Exception("Preencha todos os campos.");
        }

        // VALIDANDO A URL
        if (!filter_var($urlSite, FILTER_VALIDATE_URL)) {
            throw new Exception("Informe uma URL válida.");
        }

        $esquema = parse_url($urlSite, PHP_URL_SCHEME);

        if (!in_array(strtolower($esquema ?? ""), ["http", "https"])) {
            throw new Exception("A URL deve começar com HTTP ou HTTPS.");
        }

        require_once("../_conexao.php");

        // BUSCANDO O SITE SOMENTE SE PERTENCER AO USUÁRIO
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

        $siteAtual = $consulta->fetch(PDO::FETCH_ASSOC);

        if (!$siteAtual) {
            throw new Exception("Site não encontrado ou você não tem permissão para editá-lo.");
        }

        // MANTENDO A FOTO ATUAL
        $fotoSite = $siteAtual["fotoSite"];

        // VERIFICANDO SE UMA NOVA FOTO FOI ENVIADA
        if (
            isset($_FILES["fotoSite"]) &&
            $_FILES["fotoSite"]["error"] != UPLOAD_ERR_NO_FILE
        ) {

            $arquivo = $_FILES["fotoSite"];

            if ($arquivo["error"] != UPLOAD_ERR_OK) {
                throw new Exception("Erro ao enviar a imagem.");
            }

            // LIMITE DE 5 MB
            if ($arquivo["size"] > 5 * 1024 * 1024) {
                throw new Exception("A imagem deve ter no máximo 5 MB.");
            }

            // VERIFICANDO O TIPO REAL
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $tipo = finfo_file($finfo, $arquivo["tmp_name"]);
            finfo_close($finfo);

            $tiposPermitidos = array(
                "image/jpeg" => "jpg",
                "image/png" => "png",
                "image/webp" => "webp",
                "image/gif" => "gif"
            );

            if (!array_key_exists($tipo, $tiposPermitidos)) {
                throw new Exception("Formato de imagem inválido.");
            }

            // GERANDO NOME ÚNICO
            $extensao = $tiposPermitidos[$tipo];
            $fotoSite = bin2hex(random_bytes(16)) . "." . $extensao;

            // CAMINHO DA PASTA
            $pastaFoto = __DIR__ . "/../foto/";

            if (!is_dir($pastaFoto) || !is_writable($pastaFoto)) {
                throw new Exception("A pasta de imagens não está disponível.");
            }

            $novoCaminhoFoto = $pastaFoto . $fotoSite;

            // SALVANDO A NOVA FOTO
            if (!move_uploaded_file($arquivo["tmp_name"], $novoCaminhoFoto)) {
                throw new Exception("Não foi possível salvar a imagem.");
            }
        }

        // ATUALIZANDO SOMENTE O SITE DO USUÁRIO
        $comandoSQL = $conexao->prepare(
            "UPDATE sites SET
                nomeSite = :nomeSite,
                urlSite = :urlSite,
                descricaoSite = :descricaoSite,
                categoriaSite = :categoriaSite,
                dataSite = :dataSite,
                fotoSite = :fotoSite
             WHERE idSite = :idSite
             AND idUsuario = :idUsuario"
        );

        $comandoSQL->execute(array(
            ":idSite" => $idSite,
            ":idUsuario" => $idUsuario,
            ":nomeSite" => $nomeSite,
            ":urlSite" => $urlSite,
            ":descricaoSite" => $descricaoSite,
            ":categoriaSite" => $categoriaSite,
            ":dataSite" => $dataSite,
            ":fotoSite" => $fotoSite
        ));

        // REMOVENDO A FOTO ANTIGA APÓS A ATUALIZAÇÃO
        if ($novoCaminhoFoto !== null) {

            $fotoAntiga = $siteAtual["fotoSite"];

            if (!empty($fotoAntiga) && $fotoAntiga != "semFoto.png") {

                $caminhoAntigo = __DIR__ . "/../foto/" . basename($fotoAntiga);

                if (file_exists($caminhoAntigo)) {
                    unlink($caminhoAntigo);
                }
            }
        }

        header("Location: ../visualizar/visualizar.php");
        exit();

    } catch (PDOException $erro) {

        if ($novoCaminhoFoto !== null && file_exists($novoCaminhoFoto)) {
            unlink($novoCaminhoFoto);
        }

        echo "Erro ao atualizar o site.";

    } catch (Exception $erro) {

        if ($novoCaminhoFoto !== null && file_exists($novoCaminhoFoto)) {
            unlink($novoCaminhoFoto);
        }

        echo htmlspecialchars($erro->getMessage(), ENT_QUOTES, "UTF-8");
    }

} else {

    echo "Acesso inválido.";

}

?>