<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$bancodedados = "listadehabito";
// Abre a conexão com o banco
// de dados listadehabito
$conexao = new mysqli( $servidor
, $usuario
, $senha
, $bancodedados);
// Verifica se houve erro ao abrir a conexão
if ($conexao->connect_error) {
    die('Connect Error: ' . $conexao->connect_error);
}
// Busca nome que foi recebido
// via get através do formulário
// de cadastro
$nome = $_GET["nome"];
// Insere o hábito na tabela
// habito do banco de dados
$sql = "INSERT INTO habito (nome, status)
VALUES ('".$nome."', 'A')";
// Verifica se ocorreu tudo bem
// Caso houve erro, fecha a conexão
// e aborta o programa
if (!($conexao->query($sql) === TRUE)) {
$conexao->close();
die("Erro: " . $sql . "<br>" . $conexao->error);
}
// Fecha a conexão com o
// Banco de dados
$conexao->close();
// Envia para a página index
// onde aparece a lista de hábitoss
// já com o novo hábito cadastrado
header("Location: index.php");
?>