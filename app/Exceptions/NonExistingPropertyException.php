<?php

namespace NFLScores\Exceptions;

use Exception;

class NonExistingPropertyException extends Exception
{
    /**
     * Returns the string representation
     * of the Exception.
     *
     * @return string
     */
    public function __toString(): string
    {
        return sprintf('%s: [%d]: %s', __CLASS__, $this->code, $this->message);
    }
}
