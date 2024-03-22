<?php 

    $url = "https://restcountries.com/v3.1/all";

    $data = file_get_contents($url);

    $countries = json_decode($data, true);
    $defaultCountry = "France";
?>