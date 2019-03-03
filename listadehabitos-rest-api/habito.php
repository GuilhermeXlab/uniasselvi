<?php
/*
* Função que converte os parâmetros
* de requisições HTTP
* POST e PUT em um Hábito
*
*/
function f_parametro_to_habito(){
    // Obtém o conteúdo da requisição
    $dados = file_get_contents("php://input");
    // Converte para Json e retornar
    $habito = json_decode($dados, true);
    return $habito;
    }
    /*
    * Função que retorna uma conexão
    * com o banco de dados.
    *
    */
    function f_obtem_conexao(){
    // Parâmetros
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bancodedados = "listadehabito";
    // Cria uma conexão com o banco de dados
    $conexao = new mysqli( $servidor
    , $usuario
    , $senha
    , $bancodedados);
    // Verifica a conexão
    if ($conexao->connect_error) {
    die("Falha na conexão: " .
    $conexao->conexaoect_error);
    }
    return $conexao;
    }
    /*
    * Função que retorna os hábitos
    *
*/
function f_select_habito(){
    // cria uma cláusula WHERE com os
    // parâmetros que foram
    // recebidos através da requisição
    // HTTP get
    $queryWhere = " WHERE ";
    $primeiroParametro = true;
    $parametrosGet = array_keys($_GET);
    foreach ($parametrosGet as $param){
    if (!$primeiroParametro){
    $queryWhere .= " AND ";
    }
    $primeiroParametro = false;
    $queryWhere .= $param." = '".$_GET[$param]."'";
    }
    // Executa a query da variável $sql
    $sql = " SELECT id ".
    " , nome ".
    " , status ".
    " FROM habito ";
    // utiliza o where criado com base
    // nos parâmetros do GET
    if ($queryWhere != " WHERE "){
    $sql .= $queryWhere;
    }
    // Obtém a conexão com o DB
    $conexao = f_obtem_conexao();
    // Executa a query
    $resultado = $conexao->query($sql);
    // Verifica se a query retornou registros
    if ($resultado->num_rows > 0) {
    // Inicializa o array para
    // a formação dos objetos JSON
    $jsonHabitoArray = Array();
$contador = 0;
while($registro = $resultado->fetch_assoc()) {
// Monta um objeto Json
// através de um array associativo
// ou seja, indexado através de strings
$jsonHabito = Array();
$jsonHabito["id"] = $registro["id"];
$jsonHabito["nome"] = $registro["nome"];
$jsonHabito["status"] = $registro["status"];
$jsonHabitoArray[$contador++] = $jsonHabito;
}
// Transforma o array com
// os resultados da query
// em um array Json e imprime-o
// na página
echo json_encode($jsonHabitoArray);
} else {
// Se a query não retornou
// registros, devolve um
// array Json vazio
echo json_encode(Array());
}
// Fecha a conexão com o MySQL
$conexao->close();
}
/*
* Insere um novo hábito na tabela habito
*
*/
function f_insert_habito(){
$habito = f_parametro_to_habito();
// Busca nome que foi recebido
// via post através do formulário
// de cadastro
$nome = $habito["nome"];
// Insere o hábito na tabela
// habito do banco de dados
$sql = "INSERT INTO habito (nome)
VALUES ('".$nome."')";
// Obtem a conexão
$conexao = f_obtem_conexao();
// Verifica se ocorreu tudo bem
// Caso houve erro, fecha a conexão
// e aborta o programa
if (!($conexao->query($sql) === TRUE)) {
$conexao->close();
die("Erro: " . $sql . "<br>" . $conexao->error);
}
// Insere as demais informações
// no Json
$habito["id"] = mysqli_insert_id($conexao);
$habito["status"] = "A";
echo json_encode($habito);
// Fecha a conexão com o
// Banco de dados
$conexao->close();
}
/*
* Atualiza um hábito existente
*
*/
function f_update_habito(){
$habito = f_parametro_to_habito();
$id = $habito["id"];
$nome = $habito["nome"];
$status = $habito["status"];
// Atualiza o status de A - ativo
// para V - vencido
$sql = " UPDATE habito "
." SET status = '".$status."' "
." , nome = '".$nome."'"
." WHERE id = ".$id;
// Obtém a cnexão com o banco
// de dados
$conn = f_obtem_conexao();
// Verifica se o comando foi
// executado com sucesso
if (!($conn->query($sql) === TRUE)) {
$conn->close();
die("Erro ao atualizar: " . $conn->error);
}
// retorna o Registro
// atualizado
echo json_encode($habito);
// Fecha a conexão
$conn->close();
}
/*
* Exclui um hábito existente
*
*/
function f_delete_habito(){
// Obtém o id do registro
// que foi recebido via get
$id = $_GET["id"];
$sql = "DELETE FROM habito WHERE id="
.$id;
// Obtém a Conexão
$conn = f_obtem_conexao();
// Executa o comando delete
// da variável $sql
if (!($conn->query($sql) === TRUE)) {
    die("Erro ao deletar: "
    . $conn->error);
    }
    $conn->close();
    }
    // A variável de servidor REQUEST_METHOD
    // contém o nome do método HTTP através
    // qual o arquivo solicitado foi
    // acessado
    $metodo = $_SERVER['REQUEST_METHOD'];
    // Verifica qual ação a ser tomada
    // de acordo com o método HTTP
    // que foi utilizado para acessar
    // este recurso
    switch ($metodo) {
    // Se foi GET
    // deve consultar
    case "GET":
    f_select_habito();
    break;
    // Se foi POST
    // deve inserir
    case "POST":
    f_insert_habito();
    break;
    // Se foi put
    // deve alterar
    case "PUT":
    f_update_habito();
    break;
    // Se foi delete
    // deve excluir
    case "DELETE":
f_delete_habito();
break;
}
?>