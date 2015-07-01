<?php


class PhoneNumberField extends FormField
{

	public function valueFormatted()
	{
		if (empty($this->_errors))
		{
			$v = implode(preg_split('/\D/', parent::value()));
			$l = strlen($v);

			if (strlen($v == 10))

				return '(' . substr($v, 0, 3) . ') ' . substr($v, 3, 3) . '-' . substr($v, 6);

			else

				return '+' . substr($v, 0, $l - 10) . '(' . substr($v, $l - 10, 3) . ') ' . substr($v, $l - 7, 3) . '-' . substr($v, $l - 4);

		}
	}

	public function validate()
	{
		$this->_errors = array();

		if (empty(parent::value()) && strlen(parent::value()) == 0 && $this->isRequired())

			$this->addError('void', 'Enter a phone number');

		if (implode(preg_split('/^(\+)?(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i', parent::value())) !== '')

			$this->addError('invalid', 'Phone number is invalid');

		return $this->_errors;
	}
}

Form::RegisterField('PhoneNumberField');

?>
