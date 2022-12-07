<?php

declare (strict_types=1);

function formatDollarAmount(float $amount): string {
    $isNegative = $amount < 0;

    return($isNegative ? '-' : '') . '$' . number_format(abs($amount), 2); //If amount is negative, return a - sign in front of a $ sign whilst formatting the amount to 2 decimal places
}

function formatDate(string $date): string {
    return date('M j, Y', strtotime($date)); // Reformatting date
}