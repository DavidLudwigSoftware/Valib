<?php


class NameField extends FormField
{
	private $_maxLen;

	public function __construct($id, $value, $maxLen = 50, $required = True)
	{
		$this->_maxLen = ($maxLen === Null) ? 50 : $maxLen;

		parent::__construct($id, $value, $required);
	}

	public function maximumLength()
	{
		return $this->_maxLen;
	}

	public function setMaximumLength($len)
	{
		return $this->_maxLen = ($len === Null) ? 50 : $len;
	}

	public function value()
	{
		return strtoupper(substr(parent::value(), 0, 1)) . strtolower(substr(parent::value(), 1));
	}

	public function validate()
	{
		$this->_errors = array();

		if (empty($this->value()) && strlen($this->value()) == 0 && $this->isRequired())

			$this->addError('void', 'Enter a name');

		if (strlen($this->value()) > $this->maximumLength())

			$this->addError('long', 'Name is too long');

		if (preg_match('/[^A-Za-z\s]/', $this->value()))

			$this->addError('invalid', 'Name is invalid');

		return $this->_errors;
	}
}

Form::RegisterField('NameField');

?>
