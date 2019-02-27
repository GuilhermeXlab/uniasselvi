<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="styles.css">
<title>Lista de hábitos</title>
</head>
<body>
<div class="center">
<h1>Novo Hábito</h1>
<!-- Formulário para cadastro de pessoas
Note a utilização do atributo name, que faz
o link entre os elementos do DOM e o JavaScript-->
<form id="formulario" action="inserthabito.php">
<p><label>Nome: <input type="text" id="nome"
name="nome" autofocus /></label></p>
<p><input type="submit" value="Criar"></p>
</form>
</div>
<script type="text/javascript">
// Declara uma função para
// validar o formulário
var validaForm = function(){
var nomeHabito = document.
getElementById("nome").value;
if ("" == nomeHabito){
alert("É necessário informar o nome do Hábito");
return false;
}
}
// Aqui declaramos que esta
// função ocorre sempre no
// submit do formulário
document.getElementById("formulario").onsubmit = validaForm;
</script>
</body>
</html>