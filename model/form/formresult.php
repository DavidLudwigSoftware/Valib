<?php


class FormResult
{

	private $_fields = array();
	private $_reason = Form::ERROR_NONE;

	public function isValid()
	{
		if (!empty($this->errorFields()))

			$this->_reason = Form::ERROR_FIELD;

		return $this->_reason === Form::ERROR_NONE;
	}

	public function errorReason()
	{
		return $this->_reason;
	}

	public function setErrorReason($reason)
	{
		$this->_reason = $reason;
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
