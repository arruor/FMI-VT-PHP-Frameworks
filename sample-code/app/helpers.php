<?php

function showGrade($value) {
    $grade = '';
    switch($value) {
        case ($value < 3.00):
            $grade = sprintf("Слаб (%s)", $value);
            break;

        case (($value >= 3.00) && ($value <= 3.49)):
            $grade = sprintf("Среден (%s)", $value);
            break;

        case (($value >= 3.50) && ($value <= 4.49)):
            $grade = sprintf("Добър (%s)", $value);
            break;

        case (($value >= 4.50) && ($value <= 5.49)):
            $grade = sprintf("Мн. добър (%s)", $value);
            break;

        case (($value >= 5.50) && ($value <= 6.00)):
            $grade = sprintf("Отличен (%s)", $value);
            break;
    }

    return $grade;
}