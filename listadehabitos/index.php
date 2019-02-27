<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./styles.css">
        <title>Lista de hábitos</title>
    </head>
    <body>
        <div class="center">
            <h1>Lista de hábitos</h1>
            <p>Cadastre aqui os hábitos que você tem que vencer para melhorar sua vida!</p>
            <?
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $bancodedados = "listadehabito";

                $conexao = new mysqli( $servidor
                , $usuario
                , $senha
                , $bancodedados);
                
                if ($conexao->connect_error) {
                    die('Connect Error: ' . $conexao->connect_error);
                }
                
                $sql = " SELECT id ".
                " , nome ".
                " FROM habito ".
                " WHERE status = 'A'";
                $resultado = $conexao->query($sql);

                die($resultado);
                
                if ($resultado->num_rows > 0) {
                    ?>
                        <br />
                        <table class="center">
                            <tbody>
                                <?
                                    while($registro = $resultado->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><? echo $registro["nome"]; ?></td>
                                        <td><a href="vencerhabito.php?id=<? echo $registro["id"]; ?>">Vencer</a></td>
                                        <td><a href="desistirhabito.php?id=<? echo $registro["id"]; ?>">Desistir</a></td>
                                    </tr>
                                <?
                                    } 
                                ?>
                            </tbody>
                        </table>
                        <p>Continue mudando sua vida!</p>
                        <p>Cadastre mais hábitos!</p>
                    <?
                } else {
                    ?>
                        <p>Você não possui hábitos cadastrados!</p>
                        <p>Começe já a mudar sua vida!</p>
                    <?
                } 
                        $conexao->close();
                    ?>  
            <a href="novohabito.php">Cadastrar Hábito</a>
        </div>
    </body>
</html>