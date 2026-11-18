<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADASTRO - SITES FAVORITOS</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>

<body>

    <h1 id="titulo_login">CRIAR CONTA</h1>

    <div class="conteudo_login">

        <form action="cadastrobd.php" method="post">

            <div class="row">
                <div class="col">

                    <label for="nomeUsuario">NOME COMPLETO</label>

                    <input
                        type="text"
                        name="nomeUsuario"
                        id="nomeUsuario"
                        placeholder="Digite seu nome"
                        maxlength="100"
                        required>

                </div>
            </div>

            <div class="row">
                <div class="col">

                    <label for="emailUsuario">E-MAIL</label>

                    <input
                        type="email"
                        name="emailUsuario"
                        id="emailUsuario"
                        placeholder="seuemail@exemplo.com"
                        maxlength="150"
                        required>

                </div>
            </div>

            <div class="row">
                <div class="col">

                    <label for="senhaUsuario">SENHA</label>

                    <input
                        type="password"
                        name="senhaUsuario"
                        id="senhaUsuario"
                        placeholder="Digite sua senha"
                        minlength="8"
                        required>

                </div>
            </div>

            <div class="row">
                <div class="col">

                    <label for="confirmarSenha">CONFIRMAR SENHA</label>

                    <input
                        type="password"
                        name="confirmarSenha"
                        id="confirmarSenha"
                        placeholder="Digite novamente sua senha"
                        minlength="8"
                        required>

                </div>
            </div>

            <div class="row">
                <div class="col botoes">

                    <input
                        type="submit"
                        value="CADASTRAR">

                    <input
                        type="reset"
                        value="VOLTAR"
                        onclick="history.go(-1);">

                </div>
            </div>

        </form>

        <p class="link_login">
            Já possui uma conta?
            <a href="login.php">Faça login</a>
        </p>

    </div>

</body>
</html>