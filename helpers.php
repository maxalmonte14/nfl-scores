<?php

/**
 * Returns the ordinal suffix for
 * a number from 1 to 5, if the
 * param is greater than, or in
 * fact is not a number just returns
 * the param.
 *
 * @return string
 */
function getOrdinalSuffix($number) :string
{
    switch ($number) {
        case 1:
            return 'st';
        case 2:
            return 'nd';
        case 3:
            return 'rd';
        case 4:
        case 5:
            return 'th';
        default:
            return $number;
    }
}
