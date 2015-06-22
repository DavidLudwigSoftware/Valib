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
		$errors = array();

		if (empty($this->value()) && strlen($this->value()) == 0 && $this->isRequired())

			$errors[] = Form::VOID;

		if (!empty($this->value()) && !filter_var($this->value(), FILTER_VALIDATE_EMAIL))

			$errors[] = Form::INVALID;

		if ($this->maximumLength() !== Null && strlen($this->value()) > $this->maximumLength())

			$errors[] = Form::LONG;

		return $errors;
	}
}

Form::RegisterField('EmailField');

?>