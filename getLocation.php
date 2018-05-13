<?php 

if(!empty($_POST['latitude']) && !empty($_POST['longitude'])){ 

    //Send request and receive json data by latitude and longitude 

    $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($_POST['latitude']).','.trim($_POST['longitude']).'&KEY=AIzaSyCTiq2TgM0Kh0S-CULZsO5ecsGJxW4qQ2I'; 

    $json = @file_get_contents($url); 

    $data = json_decode($json); 

    $status = $data->status; 

    if($status=="OK"){ 

        //Get location from JSON
        $city = $data->results[0]->address_components[2]->long_name; 
        $region = $data->results[0]->address_components[3]->long_name;
        $country = $data->results[0]->address_components[5]->long_name;

        // build location
        $location = $city.",".$region.",".$country;
    }else{ 

        $location =  ''; 

    } 

    //Print location 

    echo $location;

} 

?>