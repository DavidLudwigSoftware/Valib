<?php


class FormResult
{
	private $_fields = array();

	public function isValid()
	{
		return empty($this->errorFields());
	}

	public function hasError($fieldId)
	{
		if (isset($this->_fields[$fieldId]))

			if ($this->_fields[$fieldId]->hasErrors())

				return True;

		return False;
	}

	public function addField($field)
	{
		$this->_fields[$field->id()] = $field;
	}

	public function errorFields()
	{
		$errorFields = array();

		foreach ($this->_fields as $field)

			if ($field->hasErrors())

				$errorFields[] = $field;

		return $errorFields;
	}
}
