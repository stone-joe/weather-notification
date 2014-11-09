<?php
	include("./nusoap/nusoap.php");
	// Variables used for storing data
	$layout_keys = array();

	// Default parameters
	if ( !isset($_GET['params']) || ( isset($_GET["combine"]) && $_GET["combine"] == 1 ) ){
		$param = array(
		       'maxt'	 => 1, // High
		       'mint' 	 => 1, // Low
		       'wgust'	 => 1, // Wind Gust
	       	       'dew'	 => 1, // Dew Temperature
	       	       'appt'	 => 1, // Apparent Temp
	       	       'qpf'	 => 1, // Precipitation Amt
	       	       'rh'	 => 1, // Relative Humidity
	       	       'sky'	 => 1, // Cloud Cover
	       	       'snow'	 => 1, // Amt of Snow (winter only?)
	       	       'iceaccum'=> 1, // Ice Accumulation
	       	       'wspd'	 => 1, // Wind speed
	       	       'wdir'	 => 1, // Wind direction
	       	       'wwa'	 => 1  // Watches, warnings, and advisories
		);
	}
	else
		$param = explode(",",$_GET['params']);

	if ( isset($_GET["combine"]) && $_GET["combine"] == 1 )
	   $param = array_merge($param,$_GET["params"]);

	// Extras - Forecast
	$forecast = array(
		  'temp'    => 1, // 3 hourly forecast
		  'pop12'   => 1, // 12 hour precipitation forecast
		  
	);
	if ( !isset($_GET['lat']) || !isset($_GET['lon']) ){
	   echo "Latitude and longitude are both needed!";
	   exit;
	}

	// Find the city that the device is in. If the data has already been stored, then we don't need to contact the NOAA!
	/*$lines = explode("\n",file_get_contents("./data/NationalFedCodes_20140401.txt"));
      print_r($lines);exit;*/

	if ( !isset($_GET['days']) )
	   $days = 1;
	else
	   $days = $_GET['days'];
	$parameters = array( 'product'   => 'time-series',
    'numDays'   => 7,
    'format'    => '24 hourly',
    'latitude'  => $_GET['lat'],
    'longitude' => $_GET['lon'],
//    'weatherParameters' => implode(",",$param)
    );
        // Comment to tab to
	try {
	    $client = new nusoap_client('http://www.weather.gov/forecasts/xml/DWMLgen/wsdl/ndfdXML.wsdl', 'wsdl');
	    $result = $client->call('NDFDgen',$parameters);
        if ( is_array($result) ){
            echo json_encode($result);
            exit;
        }
	}
	catch (Exception $ex){
	    echo "failed";
	}

	$xml  = simplexml_load_string($result);
	$json = json_encode($xml);

	$weather = json_decode($json,TRUE);

	//	array_print($weather["data"]["parameters"]);exit;

	// Get all of the layout keys from the data
	$data = $weather["data"]["time-layout"];
	$key = "";

	foreach ($data as $index => $value ){
		foreach ($value as $name => $val){
			if ( $name == "layout-key" ){
			   $key = $val;
			   $layout_keys[$key] = array(	"start"=>array(),
							"end"=>array(),
						);
			}
			else if ( $name == "start-valid-time" )
			     $layout_keys[$key]["start"] = $val;
			else if ( $name == "end-valid-time" )
			     $layout_keys[$key]["end"] = $val;
		}
	}

	// Get the daily max and min temperatures
	$param = $weather["data"]["parameters"];	
	foreach ( $param as $i => $val ){
		if ( $val[0] ){
		   foreach ( $val as $j => $value  ){
		   	if ( count($value) > 1 ){
			   $key = $value["@attributes"]["time-layout"];
			   $layout_keys[$key][fix_name($value["name"])] = $value["value"];
			}
		   }
		}
		else {		   
		     $key = $val["@attributes"]["time-layout"];
		     $layout_keys[$key][fix_name($value["name"])] = $val["value"];
		}
	}

	// Now, break the information down into daily and hourly parts
	/****************************************
	 *	$data = array(                  * 
         *	      day => array(		*
         *	      	  hour => array(	*
         *		       [data]		*
	 *		  )    			*
	 *	      )	  			*
	 *	)     				*
	 ****************************************/
	$data    = array();
	$indices = array(); // Relates data to indices
$added = 0;

	foreach ( $layout_keys as $key => $value ){
		// Find the dates and times
        if ( $value["start"] == null || array_key_exists("start",$value) === FALSE)
            continue;
		$dates   = $value["start"];
		$indices = $value["start"]; 
        if ( is_array($dates) === FALSE )
            continue;
		foreach ( $dates as $index => $date ){
			set_arr_element($date,&$data);
		}
		unset($value["start"]);
		unset($value["end"]);
		foreach ( $value as $item_name => $item ){
            if ( $item == null || $item == "" )
                continue;
			foreach ( $item as $index => $val ){
				$map = get_arr_map($indices[$index]);
				$data[$map[0]][$map[1]][$item_name] = $val;
			}
		}
	}
$out = array();
foreach ($data as $index => $value){
    $out[$index] = $value;
    $added++;
}

$dataTags = array(
    "Apparent_Temperature",
    "Daily_Maximum_Temperature",
    "Daily_Minimum_Temperature",
    "Daily_Maximum_Relative_Humidity",
    "Liquid_Precipitation_Amount",
    "Wind_Speed",
    "Wind_Speed_Gust"
);
// Output the specific information
foreach ($data as $index => $value){
    foreach ($value as $time => $weath){
        for ($i = 0, $n = count($dataTags); $i < $n; $i++ ){
            if ( $weath[$dataTags[$i]] && $weath[$dataTags[$i]] != "" ){
                $dataTags[$i] = $weath[$dataTags[$i]];
            }
        }
    }
}
file_put_contents("weather.json",json_encode($dataTags));
echo "N ".implode(" ",$dataTags);
//	echo json_encode($out);

	function get_arr_map($date_string){
		 $d = explode("T",$date_string);
		 $time = explode("-",$d[1]);
		 $time = "T".str_replace(":","_",$time[0]); // We don't need the offset
		 return array($d[0],$time);
	}	
	function set_arr_element($date_string,$date_array){
		 if ( preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}:[0-9]{2}/",$date_string) ){
		   $d = explode("T",$date_string);
		   $time = explode("-",$d[1]);
		   $time = "T".str_replace(":","_",$time[0]); // We don't need the offset
		   if ( !$date_array[$d[0]] )
		      $date_array[$d[0]] = array();
		   if ( !$date_array[$d[0]][$time] )
		      $date_array[$d[0]][$time] = array();
		}
	}
	function array_print($arr){
		 echo "<pre>";
		 print_r($arr);
		 echo "</pre>";
	}
function fix_name($str){
    $str = preg_replace("/\(\s*[a-zA-Z]{1,}\s*\)/","",$str);
    $str = preg_replace("/\s/","_",$str);
    $str = str_replace("12_","Twelve_",$str);
    return $str;
}
?>