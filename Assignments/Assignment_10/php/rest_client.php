<?php



function getWeather(){

    $apiUrl = "https://russet-v8.wccnet.edu/~sshaper/assignments/assignment10_rest/get_weather_json.php?zip_code={$_POST['zip_code']}";  
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "$apiUrl");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    
    //Converting the JASON data into a accotiative array for php
    $result = json_decode($response, true);
    //Checking to see if the API returned with a error
    if(isset($result['error'])){
        $output = "<p>" . $result['error'] . "</p>";
        curl_close($ch);
        return [$output, ""];
    }
    //If it was not a error grabs the information form the API
    else{
        //Setting output to the results of the API information
        $output = "<h2>" . $result['searched_city']['name'] . "</h2>";
        $output .= "<p><b>Temperature: </b>" . $result['searched_city']['temperature'] . "</p>";
        $output .= "<p><b>Humidity: </b>" . $result['searched_city']['humidity'] . "</p>";
        $output .= "<p><b>3-day forecast</b></p>";
        $output .= "<ul>";
        //Loops through the array to get each of the forecast day and condition
        foreach($result['searched_city']['forecast'] as $row){
            $output .= "<li>" . $row['day'] . ": " . $row['condition'] . "</li>";
        }
        $output .= "</ul>";
        //The if statement for higher_temperatures for the table
        if(empty($result['higher_temperatures'])){
            $output .= "<p><b>There are no cities with temperatures higher than " . $result['searched_city']['name'] . "\n</b><p>";
        }
        //If there are cities that are higher temperatures then the current city this will print out them in a table
        else{
            $output .= "<p><b>Up to three cities where temperatures are higher than " . $result['searched_city']['name'] . "\n</b><p>";
            $output .= "<table class='table table-striped'><thead><tr>";
            $output .= "<th>City Name</th><th>Temperature</th><tbody>";
            //Loops through the higher_tempperatures and prints out the name and temperature
            foreach($result['higher_temperatures'] as $row){
                $output .= "<tr><td>" . $row["name"] . "</td><td>" . $row["temperature"] . "</td>";
            }
            $output .= "</tbody></table>"; 
        }
        //The if statement for lower_temperatures for the table
        if(empty($result['lower_temperatures'])){
            $output .= "<p><b>There are no cities with temperatures lower than " . $result['searched_city']['name'] . "\n</b><p>";
        }
        //If there are cities that are lower temperatures then the current city this will print out them in a table
        else{
            $output .= "<p><b>Up to three cities where temperatures are lower than " . $result['searched_city']['name'] . "\n</b><p>";
            $output .= "<table class='table table-striped'><thead><tr>";
            $output .= "<th>City Name</th><th>Temperature</th><tbody>";
            //Loops through the lower_tempperatures and prints out the name and temperature
            foreach($result['lower_temperatures'] as $row){
                $output .= "<tr><td>" . $row["name"] . "</td><td>" . $row["temperature"] . "</td>";
            }
            $output .= "</tbody></table>"; 
        }
        curl_close($ch);
        return ["", $output];
    }

}









?>