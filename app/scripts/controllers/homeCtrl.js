angular.module("weather-notifier").controller("homeCtrl",["$scope","time","data","weather",function($scope,time,data,weather){
    $scope.current = time.current;
    $scope.forms = data.forms;

    // Methods
    $scope.getWeather = function(){
	return data.weather;
    };
    weather.getCurrent("fake_data.json");
    time.monitor();
}]);
