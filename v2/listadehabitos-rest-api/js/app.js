// Declaramos o módulo, que é ligado à
// página Web através da diretiva ng-app
// ngRoute na linha abaixo é uma injeção de
// dependência, é um módulo que está contido
// do arquivo angular-route.js
var app = angular.module("app", [ "ngRoute" ]);
// Declaramos o controller para a página
// api-test-get.html
app.controller("apitestgetcontroller", [ "$scope", "$http",
function($scope, $http) {
$scope.result = "";
$scope.id = "";
$scope.listaDeHabitosApiGet = function() {
if ($scope.id == ""){
$http.get("http://localhost:80/uniasselvi/v1/listadehabitos-rest-api/habito.php").then(function(data) {
var output = JSON.stringify(data);
$scope.result = output;
});
} else {
$http.get("http://localhost:80/uniasselvi/v1/listadehabitos-rest-api/habito.php", {params: {
id: $scope.id
}}).then(function(data) {
var output = JSON.stringify(data);
$scope.result = output;
});
}
}
}]);
// Declaramos o controller para a página
// api-test-post.html
app.controller("apitestpostcontroller", [ "$scope", "$http",
function($scope, $http) {
$scope.result = "";
$scope.nome = "";
// Criar
$scope.listaDeHabitosApiPost = function() {
    $http.post("http://localhost:80/uniasselvi/v1/listadehabitos-rest-api/habito.php", {
    nome: $scope.nome
    }).then(function(data) {
    var output = JSON.stringify(data);
    $scope.result = output;
    });
    };
    }]);
    // Declaramos o controller para a página
    // api-test-put.html
    app.controller("apitestputcontroller", [ "$scope", "$http",
    function($scope, $http) {
    $scope.result = "";
    $scope.id = "";
    $scope.nome = "";
    $scope.status = "";
    // Atualizar
    $scope.listaDeHabitosApiPut = (function() {
    $http.put("http://localhost:80/uniasselvi/v1/listadehabitos-rest-api/habito.php", {
    id: $scope.id,
    nome: $scope.nome,
    status:$scope.status
    }).then(function(data){
    var output = JSON.stringify(data);
    $scope.result = output;
    });
    });
    }]);
    // Declaramos o controller para a página
    // api-test-get.html
    app.controller("apitestdeletecontroller", [ "$scope", "$http",
    function($scope, $http) {
        $scope.result = "";
$scope.id = "";
// Deletar
$scope.listaDeHabitosApiDel = (function() {
$http.delete("http://localhost:80/uniasselvi/v1/listadehabitos-rest-api/habito.php", {params: {
id: $scope.id
}}).then(function(data){
var output = JSON.stringify(data);
$scope.result = output;
});
});
} ]);
// Declaramos o controller para a página
// welcome.html
app.controller("welcomecontroller", [ "$scope",
function($scope) {
}]);
// Aqui definimos a dinâmica de navegação da
// página. Para cada URL que a página possui
// define-se qual controller será usado
// e qual arquivo .html será exibido
app.config(function($routeProvider) {
$routeProvider.when("/api-test-get", {
controller : "apitestgetcontroller",
templateUrl : "partials/api-test-get.html"
}).when("/api-test-post", {
controller : "apitestpostcontroller",
templateUrl : "partials/api-test-post.html"
}).when("/api-test-put", {
controller : "apitestputcontroller",
templateUrl : "partials/api-test-put.html"
}).when("/api-test-delete", {
controller : "apitestdeletecontroller",
templateUrl : "partials/api-test-delete.html"
}).otherwise({
    controller : "welcomecontroller",
templateUrl : "partials/welcome.html"
});
});