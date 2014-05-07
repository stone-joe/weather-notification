This document describes the application being submitted for the EC327 final project at Boston University. <br/>
Project Contributors: Joseph Stone, Rabee Ramshed<br/>
Project Title       : Weather Notifier<br/>
Copyright           : May 4, 2014<br/>

<h2>TABLE OF CONTENTS </h2>
<table>
	<tr>
		<td>I.</td>
		<td>
			<a href='#description'>Description</a>
		</td>
	</tr>	
	<tr>	
		<td>II.</td>
		<td>
			<a href='#client'>Client-Side</a>
		</td>
	</tr>	
	<tr>	
		<td>III.</td>
		<td>
			<a href='#server'>Server-Side</a>
		</td>
	</tr>	
	<tr>	
		<td>IV.</td>
		<td>
			<a href='#download'>Installing Program</a>
		</td>
	</tr>	
</table>

<h2 id="description">Description</h2>

Our project is a program that displays the weather in a GUI with rotating images (depending on the season) and has the ability to send 
automated emails to the user every day with weather updates. 

This project has two main components: the client-side that the user interacts with, and the server-side which gets and parses weather information and
sends automated emails.

<h2 id='#client'>Client-Side</h2>

The user activates the program (via clicking the .exe file) which opens a GUI. The GUI starts with a welcome screen showing an image that depicts
the current season. An image with blooming flowers might show if it's spring time, for example. The user then clicks a button which takes them to
another image along with the current weather information. This information includes:
<ul>
	<li>Current temperature</li>
	<li>The day's high temperature</li>
	<li>The day's low temperature</li>
	<li>Humidity</li>
	<li>Amount of precipitation expected</li>
	<li>Wind speed</li>
	<li>Wind Gusts</li>
</ul>

From there, the user can either click the refresh button to update the weather data or click the "Send daily emails" button. The latter will open
another screen where the user can enter their email, click go, and expect an email every morning at 6 AM.

<h2 id='server'>Server-Side</h2>

The server has three main tasks: get and parse the latest weather from the NOAA, store new user emails, and send daily emails to all users. This
is all accomplished by the client-side program contacting certain URLs. 

The information retrieved by the NOAA is in an XML SOAP format. A PHP parser then finds the most relevant information in the data sheet and sends
the data to the client program AND stores the information in a file on the server. This will prevent the script from continuously contacting the
NOAA server, which could harm their server. Every hour, the NOAA updates it's data, so naturally the program updates the server with the latest
information at that time.

The automated updating and automated emailing is run using a Cron job on a Linux server.

<h2 id='download'>Installing Program</h2>

This program only runs on Windows Vista or later versions ( Windows 7, Windows 8 ). To download the installer, <a href=''>click here</a>
The installer includes a version of MCR (a portable MATLAB compiler), all necessary .mat files, and image files. Once downloaded, just run the
executable.
