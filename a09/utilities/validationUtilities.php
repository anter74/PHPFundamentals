<?php
// All validation functions return either true or false.
//
// Validate string length.
function fIsValidLength($input, $minLength, $maxLength)
{
    //returns true of false
    //trim empty spaces from beginning and end
    $input = trim($input);
    $IsValid = (strlen($input) >= $minLength && strlen($input) <= $maxLength);
    return $IsValid;
}

function fIsValidAddr($input, $minLength, $maxLength)
{
    //returns true of false
    //trim empty spaces from beginning and end
    $input = trim($input);
    $IsValid = (strlen($input) >= $minLength && strlen($input) <= $maxLength) && is_numeric(substr($input ,0 ,1));
    return $IsValid;
}


//email address
function fIsValidEmail($email)
{
    //validate using php filter function. Returns true or false.
    $email = trim($email);
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
        return false;
    else
        return true;
}

//state abbreviation
function fIsValidStateAbbr($state)
{
    $ValidAbbr = array("AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "FL",
        "GA", "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD", "MA",
        "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC",
        "ND", "OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT",
        "VA", "WA", "WV", "WI", "WY");

    //trim & change to upper case (to match strings in array)
    $state = trim(strtoupper($state));

    //check if a value exists in an array.
    return in_array($state, $ValidAbbr);
}

//telephone numbers
function fIsValidPhone($phone)
{
    //remove delimiters and spaces
    $pattern = "/[-,.()\s]/";
    $phone = preg_replace($pattern, '', $phone);

    //must be 10 digits
    return ((strlen($phone) == 10) && is_numeric($phone));
}

//date
function fIsValidDate($date)
{
//date must be in format yyyy-mm-dd or yyyy/mm/dd (RFC 3339 format)
    $date = str_replace('-', '/', $date);
    $test_arr = explode('/', $date);
    if (count($test_arr) == 3 &&
        is_numeric($test_arr[0]) &&
        is_numeric($test_arr[1]) &&
        is_numeric($test_arr[2])
    ) {
        //checkdate($month, $day, $year)
        if (checkdate($test_arr[1], $test_arr[2], $test_arr[0])) {
            return true;
        } else {
            return false; //invalid date
        }
    } else {
        return false; //invalid format
    }
}

function fIsValidRange($value, $min, $max)
{
    if (is_numeric($max) && is_numeric($value) && is_numeric($min)) {
        if ($value <= $max && $value >= $min) {
            return true; // valid
        } else {
            return false; // is not inbetween min/max
        }
    } else {
        return false; // is not numeric
    }
}

function fIsValidZipcode($zip)
{
    if (is_numeric($zip) && (strlen($zip) == 5)) {
        return true;
    } else {
        return false;
    }
}

//makes numbers into dollars
//http://stackoverflow.com/questions/21507977/
function asDollars($value){
    return '$'.number_format($value, 2);
}

?>

