<?php

// Validates that a trimmed string is within the given character length range 
function validate_text($text, $min, $max) {
    $trimmed = trim($text);
    $length = strlen($trimmed);

    return $length >= $min && $length <= $max;
}

// Validates that a value is numeric and within the given range 
function validate_number($number, $min, $max) {
    if ($number === '' || $number === null) {
        return false;
    }

    if (!is_numeric($number)) {
        return false;
    }

    $number = (int)$number;
    return $number >= $min && $number <= $max;
}

// Validates that a value exists within an allowed options array 
function validate_option($value, $allowed_options) {
    return in_array($value, $allowed_options, true);
}

// Validates that a string is a properly formatted email address 
function validate_email_address($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

?>