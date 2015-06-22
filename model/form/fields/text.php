<?php

class TextField extends FormField
{
	private $_minLen = Null;
	private $_maxLen = Null;

	public function __construct($id, $value, $trim = True, $required = True)
	{
		parent::__construct($id, $value, $required);
		parent::setTrimEnabled($trim);
	}

	public function maximumLength()
	{
		return $this->_maxLen;
	}

	public function minimumLength()
	{
		return $this->_minLen;
	}

	public function setMaximumLength($len)
	{
		return $this->_maxLen = ($len === Null) ? Null : intval($len);
	}

	public function setMinimumLength($len)
	{
		return $this->_minLen = ($len === Null) ? Null : intval($len);
	}

	public function validate()
	{
		$errors = array();

		if (empty($this->value()) && strlen($this->value()) == 0 && $this->isRequired())

			$errors[] = Form::VOID;

		if ($this->minimumLength() !== Null && strlen($this->value()) < $this->minimumLength())

			$errors[] = Form::SHORT;

		if ($this->maximumLength() !== Null && strlen($this->value()) > $this->maximumLength())

			$errors[] = Form::LONG;

		return $errors;
	}
}

Form::RegisterField('TextField');

?>