<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$bancodedados = "listadehabito";
// Cria a conexão
$conn = new mysqli( $servidor
, $usuario
, $senha
, $bancodedados);
// Verifica se conectou
// Com sucesso
if ($conn->connect_error) {
die("A conexão falhou: "
. $conn->connect_error);
}
// Obtém o id do registro
// que foi recebido via get
$id = $_GET["id"];
$sql = "DELETE FROM habito WHERE id="
.$id;
// Executa o comando delete
// da variável $sql
if (!($conn->query($sql) === TRUE)) {
die("Erro ao excluir: "
. $conn->error);
}
// Fecha a conexão
$conn->close();
// Redireciona para a página inicial
header("Location: index.php")
?>