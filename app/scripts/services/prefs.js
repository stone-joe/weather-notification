angular.module("weather-notifier").factory("prefs",function(){
    return {
	useCurrentLocation: true,
	units: "metric" // Options: metric or imperial
    };
});
