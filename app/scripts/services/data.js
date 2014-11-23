angular.module("weather-notifier").factory("data",[function(){
    var data = {
	alarms : {},
	user: {
	    location: {
		lon: 0,
		lat: 0
	    }
	},
	settings: {
	    units: "metric"
	},
	app: {
	    forms: {
		time: false,
		show: false,
		set: function(prop,val){
		    data.app.forms[prop] = val;
		},
		get: function(prop){
		    return data.app.forms[prop];
		}
	    }
	},
	weather : {}
    };
    return data;
}]);
