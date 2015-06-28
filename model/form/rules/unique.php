<?php


class UniqueRule extends FormRule
{
    private $_db;
    private $_table;
    private $_fields;
    private $_field;
    private $_message;

    public function __construct($database, $table, $fields, $field, $message = Null)
    {
        $this->_db      = $database;
        $this->_table   = $table;
        $this->_fields  = $fields;
        $this->_field   = $field;
        $this->_message = ($message) ? $message : '{FIELD} is not unique';
    }

    public function validate()
    {
        if ($this->_db->exists($this->_table, $this->_fields, $this->_field->valueFormatted()))
        {
            $this->_field->addError('unique', $this->formatMessage());
        }
    }

    public function formatMessage()
    {
        return str_replace('{FIELD}', $this->_field->id(), $this->_message);
    }
}

Form::RegisterRule('UniqueRule');
