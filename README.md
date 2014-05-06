This document describes the application being submitted for the EC327 final project at Boston University. <br/>
Project Contributors: Joseph Stone, Rabee Ramshed<br/>
Project Title       : Weather Notifier<br/>
Copyright           : May 4, 2014<br/>
License             : See "License.txt" for details<br/>

<h2>TABLE OF CONTENTS </h2>
I.    Description<br/>
II.   General Use<br/>
III.  Platform<br/>
IV.   Client-Side Application<br/>
IV.a. Weather App - ME<br/>
IV.b. Weather Notifier - Rabee<br/>
IV.c. Alarm Clock - Rabee<br/>
IV.d. Options - ME<br/>
V.    Server-Side Application - ME<br/>
VI.   GUI<br/>
VI.a  Screen Size<br/>
VI.b  Home Screen <br/>
VI.c  Alarm Clock<br/>
VI.d  Weather<br/>
VI.e  Notifications<br/> 
VI.f  Options<br/>
VI.g  Images<br/>
VII.  License<br/>
<h2>I. Description </h2>

An android application that sends notifications to the user when an extreme change in weather is going to occur. 
"Extreme changes" include:<br/>
   1) Drastic change in temperature (+/- 10 degrees)<br/>
   2) Sudden and intense rain, wind, snow, hail, sleet<br/>
   3) Intense conditions: blizzards, tornados, floods, earthquakes, extreme cold/heat (defined as +/- 20 degrees of
      the average temperature)

<h2>II. General Use</h2>

When the app is not notifying the user of drastic weather changes, it can be used as a normal weather application 
(where users can look up the current and future weather forecasts) as well as a basic alarm clock that will wake the
user at a specified time and display: the time, weather, and any notifications to the user.

<h2>III. Platform</h2>

This application is designed to be used by any Android device running the newest Android OS, 4.4 KitKat. This 
application will not be backwards compatible, but there are future plans to have the app run on other mobile 
operating systems such as iOS and Windows.

<h2>IV. Client-Side Application</h2>

<h3> ## IV.a. Weather Application ## </h3>

This is a typical weather application that will contact the web server, download the current and future weather 
information, and display this information using graphics. These graphics will be high-definition background images
that take up the entire display (for devices under 800 x 600 pixel dimensions) and be perfectly centered for larger
displays. 

The mobile device will request current and future weather data from the server by accessing the following link:

	     		      http://notetech.host22.com/weather/get_weather.php

This will call the web crawler (get_weather.php) that will get the latest weather information, parse it, and send a
JSON formatted response to the mobile device. A type of "checksum" will be used to ensure the integrity of the 
information. The JSON will be formatted like this: (subject to change)
<pre>
	     	      	      {
				date        : mm-dd-yyyy,
				time        : hh:mm:ss,
				temperature : [degrees_fahrenheight, degrees_celsius],
				wind_speed  : [mph, m/s],
				precip	    : [in, cm],
				precip_type : rain/snow/hail/sleet
				warnings    : blizzard/flood/heat/cold/tornado/excessive_wind
				hourly      : {
					    hh : {
					    	 temperature : [degrees_fahrenheight, degrees_celsius], 
						 wind_speed  : [mph, m/s],
						 precip	     : [in, cm],
						 precip_type : rain/snow/hail/sleet
						 warnings    : blizzard/flood/heat/cold/tornado/excessive_wind
					       
					    }
				}				
			      }
</pre>
To request weekly weather data, the mobile device will add a query to the end of the link:

   	   	  	      http://notetech.host22.com/weather/get_weather.php?weekly=1

This will tell the web crawler to get the weekly forecast along with the daily weather forecast. The user will still
be notified of any drastic or extreme weather conditions. The response format will be as follows:
<pre>
   	       	   	      {
				0 : {
				  date : mm:dd:yyyy,
				  temperature : [degrees_fahrenheight, degrees_celsius],
				  wind_speed  : [mph, m/s],
				  precip      : [in, cm],
				  precip_type : rain/snow/hail/sleet
				  warnings    : blizzard/flood/heat/cold/tornado/excessive_wind
				},
				1 : {
				  date : mm:dd+1:yyyy,
				  temperature : [degrees_fahrenheight, degrees_celsius],
				  wind_speed  : [mph, m/s],
				  precip      : [in, cm],
				  precip_type : rain/snow/hail/sleet
				  warnings    : blizzard/flood/heat/cold/tornado/excessive_wind
				},
				.
				.
				.
				6 : {
				  date : mm:dd+6:yyyy,
				  temperature : [degrees_fahrenheight, degrees_celsius],
				  wind_speed  : [mph, m/s],
				  precip      : [in, cm],
				  precip_type : rain/snow/hail/sleet
				  warnings    : blizzard/flood/heat/cold/tornado/excessive_wind
				}
			      }	
</pre>			
where the "0" property is today and the "6" property is six days from today. No hourly data will be available when
requesting the weekly forecast.

<h3> ## IV.b. Weather Notifier ## </h3>

NOTE: UPDATE README

