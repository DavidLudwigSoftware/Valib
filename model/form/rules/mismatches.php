<?php


class MismatchesRule extends FormRule
{
    private $_field1;
    private $_field2;
    private $_message;

    public function __construct($field1, $field2, $message = Null)
    {
        $this->_field1 = $field1;
        $this->_field2 = $field2;
        $this->_message = ($message) ? $message : '{FIELD1} and {FIELD2} can\'t be the same';
    }

    public function validate()
    {
        if ($this->_field1->value() === $this->_field2->value())
        {
            $this->_field1->addError('mismatches', $this->formatMessage());
        }
    }

    public function formatMessage()
    {
        return str_replace('{FIELD1}', $this->_field1->id(),
                    str_replace('{FIELD2}', $this->_field2->id(),
                                $this->_message));
    }

}

Form::RegisterRule('MismatchesRule');
