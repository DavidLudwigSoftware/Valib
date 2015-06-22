<?php


class FormField
{

	private $_id;
	private $_value;
	private $_required;
	private $_errors;
	private $_trim = True;
	
	public function __construct($id, $value, $required = True)
	{
		$this->_id       = (string) $id;
		$this->_value    =          $value;
		$this->_required = (bool)   $required;
	}

	public function hasErrors()
	{
		return !$this->isValid();
	}

	public function isTrimEnabled()
	{
		return $this->_trim;
	}

	public function isRequired()
	{
		return $this->_required;
	}

	public function isValid()
	{
		return empty($this->validate());
	}

	public function validate()
	{
		$errors = array();

		if (empty($this->_value) && $this->isRequired())

			$errors[] = Field::Void;

		return $errors;
	}

	public function id()
	{
		return $this->_id;
	}

	public function value()
	{
		return ($this->_trim) ? trim($this->_value) : $this->_value;
	}

	public function setId($id)
	{
		return $this->_id = (string) $id;
	}

	public function setRequired($required)
	{
		return $this->_required = (bool) $required;
	}

	public function setTrimEnabled($enabled)
	{
		return $this->_trim = (bool) $enabled;
	}

	public function setValue($value)
	{
		return $this->_value = $value;
	}
}

?>