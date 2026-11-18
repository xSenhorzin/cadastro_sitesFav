<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // RECEBENDO OS DADOS
    $emailUsuario = filter_input(
        INPUT_POST,
        "emailUsuario",
        FILTER_SANITIZE_EMAIL
    );

    $senhaUsuario = $_POST["senhaUsuario"] ?? "";

    // VALIDANDO O EMAIL
    if (!filter_var($emailUsuario, FILTER_VALIDATE_EMAIL)) {
        exit("E-mail ou senha incorretos.");
    }

    try {

        require_once("../_conexao.php");

        // BUSCANDO O USUARIO PELO EMAIL
        $comandoSQL = $conexao->prepare(
            "SELECT idUsuario, nomeUsuario, emailUsuario, senhaUsuario
             FROM usuarios
             WHERE emailUsuario = :emailUsuario"
        );

        $comandoSQL->execute(array(
            ":emailUsuario" => $emailUsuario
        ));

        $usuario = $comandoSQL->fetch(PDO::FETCH_ASSOC);

        // CONFERINDO A SENHA
        if ($usuario && password_verify($senhaUsuario, $usuario["senhaUsuario"])) {

            // INICIANDO A SESSAO
            session_start();

            // EVITANDO FIXACAO DE SESSAO
            session_regenerate_id(true);

            // GUARDANDO OS DADOS DO USUARIO NA SESSAO
            $_SESSION["idUsuario"] = $usuario["idUsuario"];
            $_SESSION["nomeUsuario"] = $usuario["nomeUsuario"];
            $_SESSION["emailUsuario"] = $usuario["emailUsuario"];

            // REDIRECIONANDO PARA O INDEX
            header("location: ../index.php");
            exit();

        } else {

            echo("E-mail ou senha incorretos.");

        }

    } catch (PDOException $erro) {

        echo("Erro ao realizar login.");

    }

} else {

    echo("Acesso inválido.");

}

?>