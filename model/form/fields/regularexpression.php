<?php


class RegularExpressionField extends FormField
{
	public function validate()
	{
		$this->_errors = array();

		if (empty($this->value()) && strlen($this->value()) == 0 && $this->isRequired())

			$this->addError('void', 'Enter a regular expression');

		if (!empty($this->value()) && !filter_var($this->value(), FILTER_VALIDATE_REGEXP))

			$this->addError('invalid', 'Regular expression is invalid');

		return $this->_errors;
	}
}

Form::RegisterField('RegularExpresionField');

?>
