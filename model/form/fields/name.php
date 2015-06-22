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
		$errors = array();

		if (empty($this->value()) && strlen($this->value()) == 0 && $this->isRequired())

			$errors[] = Form::VOID;

		if (strlen($this->value()) > $this->maximumLength())

			$errors[] = Form::LONG;

		if (preg_match('/[^A-Za-z\s]/', $this->value()))

			$errors[] = Form::INVALID;

		return $errors;
	}
}

Form::RegisterField('NameField');

?>