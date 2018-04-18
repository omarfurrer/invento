<?php

namespace App\Services;

class BaseService {

    /**
     * @var array 
     */
    protected $errorMessages;

    /**
     * Add an error message to array.
     * 
     * @param string $message
     * @return boolean
     */
    public function addError($message)
    {
        if (empty($message)) {
            return false;
        }
        array_push($this->errorMessages, $message);
    }

    /**
     * Retrieve array of error messages.
     * 
     * @return array
     */
    public function getErrorMessages()
    {
        return $this->errorMessages;
    }

    /**
     * Get first error message in array.
     * 
     * @return boolean|string
     */
    public function getErrorMessage()
    {
        $errorMessages = $this->getErrorMessages();
        if (empty($errorMessages)) {
            return false;
        }
        return $errorMessages[0];
    }

    /**
     * Clears error messages array.
     */
    public function clearErrors()
    {
        $this->errorMessages = [];
    }

}
