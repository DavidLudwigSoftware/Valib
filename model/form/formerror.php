<?php


class FormError
{
    private $_field;
    private $name;
    private $_message;

    public function __construct($field, $name, $message)
    {
        $this->_field   = $field;
        $this->_name    = $name;
        $this->_message = $this->formatMessage($message);
    }

    public function field()
    {
        return $this->_field;
    }

    public function name()
    {
        return $this->_name;
    }

    public function message()
    {
        return $this->_message;
    }

    private function formatMessage($message)
    {
        return str_replace('{FIELD}', $this->_field->id(), $message);
    }
}
