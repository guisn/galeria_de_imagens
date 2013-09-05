

<h3>Administração da galeria de imagens</h3>

<form method="post" name="formulario_de_login" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <table>
        <tr>
            <th>Usuário</th>
            <td>
                <input type="text" size="20" name="formulario_de_login[usuario]">
            </td>
        </tr>

        <tr>
            <th>Senha</th>
            <td>
                <input type="password" size="20" name="formulario_de_login[senha]">
            </td>
        </tr>

        <tr>
            <th>&nbsp;</th>
            <td>
                <input type="submit" name="formulario_de_login[login]" value="Entrar">
            </td>
        </tr>

    </table>


</form>
