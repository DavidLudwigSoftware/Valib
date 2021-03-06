<?php


class PasswordField extends FormField
{
	private $_minLen = 8;
	private $_options;

	public function __construct($id, $value, $minLen = 8, $options = Form::PASSWORD_STANDARD, $required = True)
	{
		$this->_minLen = ($minLen === Null) ? 8 : intval($minLen);
		$this->_options = $options;

		parent::__construct($id, $value, $required);
	}

	public function minimumLength()
	{
		return $this->_minLen;
	}

	public function options()
	{
		return $this->_options;
	}

	public function setMinimumLength($value)
	{
		return $this->_minLen = ($minLen === Null) ? Null : intval($minLen);
	}

	public function setOptions($options)
	{
		return $this->_options = $options;
	}

	public function validate()
	{
		$this->_errors = array();

		if (empty($this->value()) && strlen($this->value()) == 0 && $this->isRequired())

			$this->addError('void', 'Enter a password');

		if ($this->minimumLength() !== Null && strlen($this->value()) < $this->minimumLength())

			$this->addError('short', 'Password is too short');

		if ($this->options() & Form::PASSWORD_MIXED_CASE && !preg_match('/([A-Z][a-z])|([a-z][A-Z])/', $this->value()))

			$this->addError('invalid', 'Password is invalid');

		if ($this->options() & Form::PASSWORD_NUMBERS && !preg_match('/[0-9]/', $this->value()))

			$this->addError('invalid', 'Password is invalid');

		if ($this->options() & Form::PASSWORD_SYMBOLS && !preg_match('/[^a-zA-Z\d\s:]/', $this->value()))

			$this->addError('invalid', 'Password is invalid');

		return $this->_errors;
	}

}

Form::RegisterField('PasswordField');

?>
