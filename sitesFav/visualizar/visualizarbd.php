<?php

// VERIFICANDO O LOGIN
require_once("../verificarLogin.php");

// CONEXÃO COM O BANCO
require_once("../_conexao.php");

try {

    // ID DO USUÁRIO LOGADO
    $idUsuario = (int) $_SESSION["idUsuario"];

    // BUSCANDO SOMENTE OS SITES DO USUÁRIO
    $comandoSQL = $conexao->prepare(
        "SELECT * FROM sites
         WHERE idUsuario = :idUsuario"
    );

    $comandoSQL->execute(array(
        ":idUsuario" => $idUsuario
    ));

    // ORGANIZANDO OS DADOS
    $dados = $comandoSQL->fetchAll(PDO::FETCH_ASSOC);

    // TOTAL DE REGISTROS
    $totalRegistros = count($dados);

} catch (PDOException $erro) {

    echo("Entre em contato com o suporte.");

}

?>



