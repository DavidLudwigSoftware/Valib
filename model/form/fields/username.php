<?php

class UsernameField extends FormField
{
	private $_minLen;
	private $_maxLen;
	private $_regex;

	public function __construct($id, $value, $minLen = 3, $maxLen = 25, $regex = Null, $required = True)
	{
		$this->_minLen = ($minLen === Null) ? 3  : $minLen;
		$this->_maxLen = ($maxLen === Null) ? 25 : $maxLen;
		$this->_regex  = ($regex  === Null) ? '\b[A-Za-z][A-Za-z\-\_0-9]*' : $regex;

		parent::__construct($id, $value, $required);
	}

	public function minimumLength()
	{
		return $this->_minLen;
	}

	public function maximumLength()
	{
		return $this->_maxLen;
	}

	public function setMinimumLength($len)
	{
		return $this->_minLen = ($len === Null) ? 3 : $len;
	}

	public function setMaximumLength($len)
	{
		return $this->_maxLen = ($len === Null) ? 25 : $len;
	}

	public function validate()
	{
		$errors = array();

		if (empty($this->value()) && strlen($this->value()) == 0 && $this->isRequired())

			$errors[] = Field::Void;

		if (strlen($this->value()) < $this->minimumLength())

			$errors[] = Field::Short;

		if (strlen($this->value()) > $this->maximumLength())

			$errors[] = Field::Long;

		if (implode(preg_split('/' . $this->_regex . '/', $this->value())) !== '')

			$errors[] = Field::Invalid;

		return $errors;
	}
}

?>