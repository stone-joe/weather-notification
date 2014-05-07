function num = Contact_Server

% Contacts the SERVER and retrieves the day's weather information
str = urlread('http://notetech.host22.com/weather/get_weather.php?lat=42.3581&lon=-71.0636&days=');

% Checks for errors and display correct data when it is recieved!
occ = strfind(str,'faultcode');

if ( isempty(occ) == 0 )
    disp('An error has occurred when retrieving information from the server.');
    num = -1;
else
    if ( isempty(strfind(str,'N')) == 1 )
        disp('An error has occurred!');
        disp(str);
    else
        occ = strfind(str,'<');
        str(occ(1):end) = [];
       num = strtrim(str);
    end
end