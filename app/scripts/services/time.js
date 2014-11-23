angular.module("weather-notifier").factory("time",["$interval","$timeout",function($interval,$timeout){
    var timer = null;
    var curTime = new Date().getTime();
    var time = {
	current: {
	    hours: "00",
	    minutes: "00"
	},
	monitor : function(){
	    function getTime(){
		var d = new Date();
		var min = d.getMinutes();
		var hour = d.getHours();
		// Check that the hour and minute have two digits
		if ( hour < 10 )
		    hour = "0"+hour;
		if ( min < 10 )
		    min = "0"+min;
		
		time.current.hours = hour;
		time.current.minutes = min;

		var dt = d.getTime()-curTime;
		curTime = d.getTime();
		$timeout(getTime,dt);
	    }
	    getTime();
	    timer = $timeout(getTime,new Date().getSeconds()*1000);
	}
    };
    return time;
}]);
