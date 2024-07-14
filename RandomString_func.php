<?php
function generateRandomString($length = 10) {
    // Define the characters you want to include in the random string
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    // Loop to generate the random string
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

// Example usage
// $randomString = generateRandomString(16); // Change the length as needed
// echo "Random String: " . $randomString;
?>
