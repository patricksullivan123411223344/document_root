<?php

function validate_text($text, $min, $max) {
    $trimmed = trim($text);
    $length = strlen($trimmed);

    return $length >= $min && $length <= $max;
}

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

function validate_option($value, $allowed_options) {
    return in_array($value, $allowed_options, true);
}

function validate_email_address($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

?>