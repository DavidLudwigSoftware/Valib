<?php


class FormField
{
	private $_id;
	private $_value;
	private $_required;
	private $_trim = True;

	protected $_errors;


	public function __construct($id, $value, $required = True)
	{
		$this->_id       = (string) $id;
		$this->_value    =          $value;
		$this->_required = (bool)   $required;
	}

	public function addError($name, $message)
	{
		$this->_errors[$name] = new FormError($this, $name, $message);
	}

	public function errors()
	{
		return $this->_errors;
	}

	public function firstError()
	{
		if ($this->hasErrors())

			return $this->_errors[array_keys($this->_errors)[0]];

		return Null;
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
		return empty($this->_errors);
	}

	public function validate()
	{
		$this->_errors = array();

		if (empty($this->_value) && $this->isRequired())

			$this->addError('void', '{FIELD} is void');

		return $this->_errors;
	}

	public function id()
	{
		return $this->_id;
	}

	public function value()
	{
		return ($this->_trim) ? trim($this->_value) : $this->_value;
	}

	public function valueFormatted()
	{
		return $this->value();
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
