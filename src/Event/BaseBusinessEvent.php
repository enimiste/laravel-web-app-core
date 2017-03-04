<?php

namespace Enimiste\LaravelWebApp\Core\Event;


class BaseBusinessEvent
{
    /** @var array */
    protected $errors = [];

    /**
     *  Empty strings are ignored
     *
     * @param $error
     *
     * @return bool
     */
    public function addError($error)
    {
        $error = trim($error);
        if (mb_strlen($error) != 0) {
            $this->errors[] = $error;

            return true;
        }

        return false;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Empty strings are ignored
     *
     * @param array $errors
     */
    public function setErrors($errors)
    {
        $this->errors = [];
        foreach ($errors as $error) {
            $this->addError($error);
        }
    }
}