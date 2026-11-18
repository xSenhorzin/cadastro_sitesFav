<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="menu">
        <ul>
            <li><a href="../cadastrar/cadastrar.php">CADASTRAR</a></li>
            <li><a href="../visualizar/visualizar.php">VISUALIZAR</a></li>
            <li><a href="../index.php">Olá, <?= htmlspecialchars($_SESSION["nomeUsuario"], ENT_QUOTES, "UTF-8"); ?></a></li>
            <li id="sair"><a href="../login/logout.php">SAIR</a></li>
        </ul>
</div>