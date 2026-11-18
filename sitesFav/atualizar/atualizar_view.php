<?php

// VERIFICANDO O LOGIN
require_once("../verificarLogin.php");

// CONEXÃO COM O BANCO
require_once("../_conexao.php");

try {

    // RECEBENDO O CÓDIGO
    $codigo = filter_input(INPUT_GET, "codigo", FILTER_VALIDATE_INT);

    if (!$codigo || $codigo <= 0) {
        exit("Código do site inválido.");
    }

    // ID DO USUÁRIO LOGADO
    $idUsuario = (int) $_SESSION["idUsuario"];

    // BUSCANDO SOMENTE O SITE DO USUÁRIO
    $comandoSQL = $conexao->prepare(
        "SELECT *
         FROM sites
         WHERE idSite = :codigo
         AND idUsuario = :idUsuario"
    );

    $comandoSQL->execute(array(
        ":codigo" => $codigo,
        ":idUsuario" => $idUsuario
    ));

    $dados = $comandoSQL->fetch(PDO::FETCH_ASSOC);

    // VERIFICANDO SE O SITE EXISTE E PERTENCE AO USUÁRIO
    if (!$dados) {
        exit("Site não encontrado ou você não tem permissão para acessá-lo.");
    }

} catch (PDOException $erro) {

    echo "Erro ao buscar o site.";

}

?>