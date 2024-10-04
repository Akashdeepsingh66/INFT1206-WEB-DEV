<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name"viewport content="width=device-width, initial-scale=1">
    <title>INFT1206 - Functions</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>PHP Functions</h1>
<p>This demonstration show various type of functions in PHP</p>

<?php

/**
 * @param $number
 * @return float|int
 */
function square($number){
    return $number * $number;
}
$squareValue = square(25);



function demonstrateStringFunctions($originalString){

    //Replace the string 'great' with 'awesome' in the original string
    $modifiedString = str_replace("great", "awesome", $originalString);

    //Splits the string into an array  of words
    $wordArray = explode(" ", $modifiedString);
    // ["PHP","is","great","for","web","development"]

    //Count the number of words
    $wordCount = count($wordArray);

    //Join the array of words back into string with hyphens
   $implodeArray = implode( "-", $wordArray);

    ///Associate Array: key/value pairs
    return [
        'modifiedString' => $modifiedString,
        'wordArray' => $wordArray,
        'wordCount' => $wordCount,
        'implodeArray' => $implodeArray
    ];
}

$originalString = "PHP is great for web development";
$stringResult = demonstrateStringFunctions($originalString);

/**
 * Function 1 : That converts a string to a uppercase
 * Example:  dog > Dog
 * @param string $inputString: The string to convert
 * @return string The uppercase version of the input
 */


/**
 * Function 2: Check if an input number is even
 * @param int $number: The number to check
 * @return bool: True if the number is even, false otherwise
 */



/*OUTPUT OF THE PAGE*/
echo "<pre>";

echo "square of 25: $squareValue\n";
echo "Original String: $originalString\n";
echo "Modified String:" . $stringResult['modifiedString'] . "\n";
echo "Word Array:" . print_r($stringResult['wordArray'], true) . "\n";
echo "Word Count:" . $stringResult['wordCount'] . "\n";
echo "Imploded String:" . $stringResult['implodeArray'] . "\n";

//echo a call to your FUNCTION1
//echo a call to your FUNCTION2

echo "</pre>";



?>
</body>
</html>