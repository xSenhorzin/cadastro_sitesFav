<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // RECEBENDO OS DADOS
    $nomeUsuario = filter_input(
        INPUT_POST,
        "nomeUsuario",
        FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );

    $emailUsuario = filter_input(
        INPUT_POST,
        "emailUsuario",
        FILTER_SANITIZE_EMAIL
    );

    // SENHAS
    $senhaUsuario = $_POST["senhaUsuario"] ?? "";
    $confirmarSenha = $_POST["confirmarSenha"] ?? "";

    // VALIDANDO OS DADOS
    if (empty($nomeUsuario) || !filter_var($emailUsuario, FILTER_VALIDATE_EMAIL)) {
        exit("Preencha os dados corretamente.");
    }

    if (strlen($senhaUsuario) < 8) {
        exit("A senha deve possuir pelo menos 8 caracteres.");
    }

    if ($senhaUsuario !== $confirmarSenha) {
        exit("As senhas não coincidem.");
    }

    try {

        require_once("../_conexao.php");

        // VERIFICANDO SE O EMAIL JÁ EXISTE
        $consulta = $conexao->prepare(
            "SELECT idUsuario FROM usuarios
             WHERE emailUsuario = :emailUsuario"
        );

        $consulta->execute(array(
            ":emailUsuario" => $emailUsuario
        ));

        if ($consulta->rowCount() > 0) {
            exit("Este e-mail já está cadastrado.");
        }

        // CRIPTOGRAFANDO A SENHA
        $senhaCriptografada = password_hash(
            $senhaUsuario,
            PASSWORD_DEFAULT
        );

        // CADASTRANDO O USUARIO
        $comandoSQL = $conexao->prepare(
            "INSERT INTO usuarios (
                nomeUsuario,
                emailUsuario,
                senhaUsuario
            ) VALUES (
                :nomeUsuario,
                :emailUsuario,
                :senhaUsuario
            )"
        );

        $comandoSQL->execute(array(
            ":nomeUsuario" => $nomeUsuario,
            ":emailUsuario" => $emailUsuario,
            ":senhaUsuario" => $senhaCriptografada
        ));

        if ($comandoSQL->rowCount() > 0) {
            header("location: login.php");
            exit();
        }

        echo("Não foi possível realizar o cadastro.");

    } catch (PDOException $erro) {

        echo("Erro ao cadastrar usuário.");

    }

} else {

    echo("Acesso inválido.");

}

?>