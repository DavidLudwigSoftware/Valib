<?php


class Matches extends FormRule
{
    private $_field1;
    private $_field2;
    private $_message;

    public function __construct($field1, $field2, $message = Null)
    {
        $this->_field1 = $field1;
        $this->_field2 = $field2;
        $this->_message = ($message) ? $message : '{FIELD1} doesn\'t match {FIELD2}';
    }

    public function validate()
    {
        if ($this->_field1->value() !== $this->_field2->value())
        {
            $this->_field1->addError($this->formatMessage());
        }
    }

    public function formatMessage()
    {
        return str_replace('{FIELD1}', $this->_field1->id(),
                    str_replace('{FIELD2}', $this->_field2->id(),
                                $this->_mesage));
    }

}
