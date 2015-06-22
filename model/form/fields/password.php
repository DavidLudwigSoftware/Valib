<?php


class PasswordField extends FormField
{
	private $_minLen = 8;
	private $_options;

	public function __construct($id, $value, $minLen = 8, $options = Form::Standard, $required = True)
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
		$errors = array();

		if (empty($this->value()) && strlen($this->value()) == 0 && $this->isRequired())

			$errors[] = Form::VOID;

		if ($this->minimumLength() !== Null && strlen($this->value()) < $this->minimumLength())

			$errors[] = Form::SHORT;

		if ($this->options() & Form::MixedCase && !preg_match('/([A-Z][a-z])|([a-z][A-Z])/', $this->value()))

			$errors[] = Form::INVALID;

		if ($this->options() & Form::Numbers && !preg_match('/[0-9]/', $this->value()))

			$errors[] = Form::INVALID;

		if ($this->options() & Form::Symbols && !preg_match('/[^a-zA-Z\d\s:]/', $this->value()))

			$errors[] = Form::INVALID;

		$errors->removeDuplicates();

		return $errors;
	}

}

Form::RegisterField('PasswordField');

?>