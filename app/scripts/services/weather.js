angular.module("weather-notifier").factory("weather",["$http","data","prefs",function($http,data,prefs){
    return {
	getCurrent: function(file){
	    if ( file === null ){ 
		var url = "http://api.openweathermap.org/data/2.5/weather?lat="+data.user.location.latitude;
		url += "&lon="+data.user.location.longitude+"&units="+prefs.units+"&mode=json";
		url += "&APPID=4cdd5e5df0b55f5f8942616d4ce080eb";
		$http.get(url).then(function(response){
		    if ( response.data !== null ){
			if ( response.data.data !== null ){
			    data.weather = response.data.data;
			}
		    }
		});
	    }
	    else {
		$http.get(file).then(function(response){
		    if ( response.data !== null ){
			if ( response.data.data !== null ){
			    data.weather = response.data.data;
			    console.log(data.weather);
			}
		    }
		});
	    }
	}
    };
}]);
