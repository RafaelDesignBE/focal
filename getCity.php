<?php 

if(!empty($_POST['latitude']) && !empty($_POST['longitude'])){ 

    //Send request and receive json data by latitude and longitude 

    $url = 'http://maps.googleapis.com/maps/api/geocode/json?KEY=AIzaSyCTiq2TgM0Kh0S-CULZsO5ecsGJxW4qQ2I&latlng='.trim($_POST['latitude']).','.trim($_POST['longitude']).'&sensor=false'; 

    $json = @file_get_contents($url); 

    $data = json_decode($json); 

    $status = $data->status; 

    if($status=="OK"){ 

        //Get location from JSON
        $city = $data->results[0]->address_components[2]->long_name; 

        // build location
        $location = $city;
    }else{ 

        $location =  ''; 

    } 

    //Print location 

    echo $location;

} 

?>