<?php


class FormResult
{
	private $_errors = array();

	public function isValid()
	{
		return empty($this->_errors);
	}

	public function hasError($fieldId)
	{
		if (isset($this->_errors[$fieldId]))

			return True;

		return False;
	}

	public function addError($id, $error)
	{
		$this->_errors[$id] = $error;
	}

	public function errors()
	{
		return $this->_errors;
	}
}