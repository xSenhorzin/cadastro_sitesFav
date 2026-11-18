<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN - SITES FAVORITOS</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>

<body>

    <h1 id="titulo_login">LOGIN - SITES FAVORITOS</h1>

    <div class="conteudo_login">

        <form action="loginbd.php" method="post">

            <div class="row">
                <div class="col">

                    <label for="emailUsuario">E-MAIL</label>

                    <input
                        type="email"
                        name="emailUsuario"
                        id="emailUsuario"
                        placeholder="seuemail@exemplo.com"
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
                        required>

                </div>
            </div>

            <div class="row">
                <div class="col botoes">

                    <input
                        type="submit"
                        value="ENTRAR">

                    <input
                        type="reset"
                        value="VOLTAR"
                        onclick="history.go(-1);">

                </div>
            </div>

        </form>

        <p class="link_login">
            Ainda não possui uma conta?
            <a href="cadastro.php">Cadastre-se</a>
        </p>

    </div>

</body>
</html>