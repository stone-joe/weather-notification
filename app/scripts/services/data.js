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
	    units: "metric",
	    tabs: {
		labels: ["General","Time","Weather"],
		selected: "General",
		selectTab: function(index){
		    data.settings.tabs.selected = data.settings.tabs.labels[index];
		}
	    }
	},
	forms: {
	    time: false,
	    show: false,
	    set: function(prop,val){
		data.forms[prop] = val;
	    },
	    get: function(prop){
		return data.forms[prop];
	    }
	},
	weather : {}
    };
    return data;
}]);
