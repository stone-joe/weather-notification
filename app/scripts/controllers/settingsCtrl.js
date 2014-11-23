angular.module("weather-notifier").controller("settingsCtrl",["$scope","$http","data",function($scope,$http,data){
    $scope.forms = data.app.forms;
}]);
