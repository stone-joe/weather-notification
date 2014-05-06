This document describes the application being submitted for the EC327 final project at Boston University. 
Project Contributors: Joseph Stone, Rabee Ramshed
Project Title       : Weather Notifier
Copyright           : May 4, 2014
License             : See "License.txt" for details

		      TABLE OF CONTENTS 
I.    Description
II.   General Use
III.  Platform
IV.   Client-Side Application
IV.a. Weather App - ME
IV.b. Weather Notifier - Rabee
IV.c. Alarm Clock - Rabee
IV.d. Options - ME
V.    Server-Side Application - ME
VI.   GUI
VI.a  Screen Size
VI.b  Home Screen 
VI.c  Alarm Clock
VI.d  Weather
VI.e  Notifications 
VI.f  Options
VI.g  Images
VII.  License
			I. Description 

An android application that sends notifications to the user when an extreme change in weather is going to occur. 
"Extreme changes" include:
   1) Drastic change in temperature (+/- 10 degrees)
   2) Sudden and intense rain, wind, snow, hail, sleet
   3) Intense conditions: blizzards, tornados, floods, earthquakes, extreme cold/heat (defined as +/- 20 degrees of
      the average temperature)

      	  		 II. General Use

When the app is not notifying the user of drastic weather changes, it can be used as a normal weather application 
(where users can look up the current and future weather forecasts) as well as a basic alarm clock that will wake the
user at a specified time and display: the time, weather, and any notifications to the user.

     	  	    	  III. Platform

This application is designed to be used by any Android device running the newest Android OS, 4.4 KitKat. This 
application will not be backwards compatible, but there are future plans to have the app run on other mobile 
operating systems such as iOS and Windows.

 	  	       	  IV. Client-Side Application

					## IV.a. Weather Application ##

This is a typical weather application that will contact the web server, download the current and future weather 
information, and display this information using graphics. These graphics will be high-definition background images
that take up the entire display (for devices under 800 x 600 pixel dimensions) and be perfectly centered for larger
displays. 

The mobile device will request current and future weather data from the server by accessing the following link:

	     		      http://notetech.host22.com/weather/get_weather.php

This will call the web crawler (get_weather.php) that will get the latest weather information, parse it, and send a
JSON formatted response to the mobile device. A type of "checksum" will be used to ensure the integrity of the 
information. The JSON will be formatted like this: (subject to change)

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

To request weekly weather data, the mobile device will add a query to the end of the link:

   	   	  	      http://notetech.host22.com/weather/get_weather.php?weekly=1

This will tell the web crawler to get the weekly forecast along with the daily weather forecast. The user will still
be notified of any drastic or extreme weather conditions. The response format will be as follows:

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
			
where the "0" property is today and the "6" property is six days from today. No hourly data will be available when
requesting the weekly forecast.

					## IV.b. Weather Notifier ##

