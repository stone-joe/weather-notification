angular.module("weather-notifier").directive("home",["$interval",function($interval){
    return {
	restrict: "E",
	templateUrl: "views/home.html"
    };
}]);
