// Quando declaramos o módulo principal de uma
// aplicação Web, o primeiro parâmetro string deve
// ser correspondente ao valor que iremos
// utilizar na diretiva ng-app em seu código HTML
var helloWorldApp = angular.module("helloworld", []);
// Quando declaramos controllers, o primeiro parâmetro
// string deve ser correspondente ao valor que iremos
// utilizar na diretiva ng-controller em seu
// código HTML
// Os demais parâmetros são injeção de dependência,
// neste caso, estamos injetando $scope
helloWorldApp.controller("helloworldcontroller", ["$scope",
    function($scope){
    $scope.msg = "Hello World!";
}]);