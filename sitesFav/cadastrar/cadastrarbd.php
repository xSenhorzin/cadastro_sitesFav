<?php

require_once("../verificarLogin.php");

// ID DO USUÁRIO LOGADO
$idUsuario = (int) $_SESSION["idUsuario"];

// VERIFICANDO SE O FORMULÁRIO FOI ENVIADO
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // RECEBENDO OS DADOS
    $nomeSite = trim($_POST["nomeSite"] ?? "");
    $urlSite = trim($_POST["urlSite"] ?? "");
    $descricaoSite = trim($_POST["descricaoSite"] ?? "");
    $categoriaSite = trim($_POST["categoriaSite"] ?? "");
    $dataSite = trim($_POST["dataSite"] ?? "");

    // VALIDANDO OS CAMPOS
    if (
        $nomeSite === "" ||
        $urlSite === "" ||
        $descricaoSite === "" ||
        $categoriaSite === "" ||
        $dataSite === ""
    ) {
        exit("Preencha todos os campos.");
    }

    // VALIDANDO A URL
    if (!filter_var($urlSite, FILTER_VALIDATE_URL)) {
        exit("Informe uma URL válida.");
    }

    $esquema = parse_url($urlSite, PHP_URL_SCHEME);

    if (!in_array(strtolower($esquema ?? ""), ["http", "https"])) {
        exit("A URL deve começar com HTTP ou HTTPS.");
    }

    // FOTO PADRÃO
    $fotoSite = "semFoto.png";
    $caminhoFoto = null;

    try {

        // VERIFICANDO SE UMA FOTO FOI ENVIADA
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

            // VERIFICANDO O TIPO REAL DO ARQUIVO
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

            // GERANDO NOME ALEATÓRIO
            $extensao = $tiposPermitidos[$tipo];
            $fotoSite = bin2hex(random_bytes(16)) . "." . $extensao;

            // CAMINHO DA PASTA
            $pastaUpload = __DIR__ . "/../foto/";

            if (!is_dir($pastaUpload) || !is_writable($pastaUpload)) {
                throw new Exception("A pasta de imagens não está disponível.");
            }

            $caminhoFoto = $pastaUpload . $fotoSite;

            // SALVANDO A IMAGEM
            if (!move_uploaded_file($arquivo["tmp_name"], $caminhoFoto)) {
                throw new Exception("Não foi possível salvar a imagem.");
            }
        }

        // CONEXÃO COM O BANCO
        require_once("../_conexao.php");

        // INSERINDO O SITE E O DONO DO REGISTRO
        $comandoSQL = $conexao->prepare(
            "INSERT INTO sites (
                idUsuario,
                nomeSite,
                urlSite,
                descricaoSite,
                categoriaSite,
                fotoSite,
                dataSite
            ) VALUES (
                :idUsuario,
                :nomeSite,
                :urlSite,
                :descricaoSite,
                :categoriaSite,
                :fotoSite,
                :dataSite
            )"
        );

        $comandoSQL->execute(array(
            ":idUsuario" => $idUsuario,
            ":nomeSite" => $nomeSite,
            ":urlSite" => $urlSite,
            ":descricaoSite" => $descricaoSite,
            ":categoriaSite" => $categoriaSite,
            ":fotoSite" => $fotoSite,
            ":dataSite" => $dataSite
        ));

        // CADASTRO REALIZADO
        header("Location: ../visualizar/visualizar.php");
        exit();

    } catch (PDOException $erro) {

        // REMOVE A FOTO SE O CADASTRO FALHAR
        if ($caminhoFoto !== null && file_exists($caminhoFoto)) {
            unlink($caminhoFoto);
        }

        echo "Erro ao cadastrar o site.";

    } catch (Exception $erro) {

        if ($caminhoFoto !== null && file_exists($caminhoFoto)) {
            unlink($caminhoFoto);
        }

        echo htmlspecialchars($erro->getMessage(), ENT_QUOTES, "UTF-8");
    }

} else {

    echo "Acesso inválido.";

}

?>

    