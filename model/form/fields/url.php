<?php


class UrlField extends FormField
{
	public function validate()
	{
		$this->_errors = array();

		if (empty($this->value()) && strlen($this->value()) == 0 && $this->isRequired())

			$this->addError('void', 'Enter a URL');

		if (!empty($this->value()) && !filter_var($this->value(), FILTER_VALIDATE_URL))

			$this->addError('invalid', 'URL is invalid');

		return $this->_errors;
	}
}

Form::RegisterField('UrlField');

?>
