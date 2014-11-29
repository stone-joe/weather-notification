angular.module("weather-notifier").controller("settingsCtrl",["$scope","$http","data",function($scope,$http,data){
    $scope.forms = data.forms;
    $scope.settings = data.settings;
    $scope.tabs = data.settings.tabs;
}]);
