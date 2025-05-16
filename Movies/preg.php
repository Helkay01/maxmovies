<?php
$string = "WWE Backlash: France (2024) | Wrestling Special";
$pattern = '/\((\d+)\)/'; // Regular expression pattern to match digits inside parentheses

if (preg_match($pattern, $string, $matches)) {
    $figuresInsideParentheses = $matches[1]; // Extract the figures inside parentheses
    echo $figuresInsideParentheses;
} else {
    echo "No figures inside parentheses found.";
}