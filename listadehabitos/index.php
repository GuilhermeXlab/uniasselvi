<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="./styles.css" />
        <title>Lista de hábitos</title>
    </head>
    <body>

        <div class="center">
            <h1>Lista de hábitos</h1>
            <p>Cadastre aqui os hábitos que você tem que vencer para melhorar sua vida!</p>
            <?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
                //echo $sql.'<hr>';
                $resultado = $conexao->query($sql);

                //die($resultado);
                
                if ($resultado->num_rows > 0) {
                    ?>
                        <br />
                        <table class="center">
                            <tbody>
                                <?php
                                    while($registro = $resultado->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?php echo $registro["nome"]; ?></td>
                                        <td><a href="vencerhabito.php?id=<?php echo $registro["id"]; ?>">Vencer</a></td>
                                        <td><a href="desistirhabito.php?id=<?php echo $registro["id"]; ?>">Desistir</a></td>
                                    </tr>
                                <?php
                                    } 
                                ?>
                            </tbody>
                        </table>
                        <p>Continue mudando sua vida!</p>
                        <p>Cadastre mais hábitos!</p>
                    <?php
                } else {
                    ?>
                        <p>Você não possui hábitos cadastrados!</p>
                        <p>Começe já a mudar sua vida!</p>
                    <?php
                } 
                        $conexao->close();
                    ?>  
            <a href="novohabito.php">Cadastrar Hábito</a>
        </div>
    </body>
</html>