<?php


class EmailField extends FormField
{
	private $_maxLen = 255;

	public function maximumLength()
	{
		return $this->_maxLen;
	}

	public function setMaximumLength($len)
	{
		return $this->_maxLen = ($len === Null) ? Null : intval($len);
	}

	public function validate()
	{
		$this->_errors = array();

		if (empty($this->value()) && strlen($this->value()) == 0 && $this->isRequired())

			$this->addError('void', 'Enter an email address');

		if (!empty($this->value()) && !filter_var($this->value(), FILTER_VALIDATE_EMAIL))

			$this->addError('invalid', 'Email address is invalid');

		if ($this->maximumLength() !== Null && strlen($this->value()) > $this->maximumLength())

			$this->addError('long', 'Email address is too long');

		return $this->_errors;
	}
}

Form::RegisterField('EmailField');

?>
