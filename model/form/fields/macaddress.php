<?php


class MacAddressField extends FormField
{
	public function validate()
	{
		$this->_errors = array();

		if (empty($this->value()) && strlen($this->value()) == 0 && $this->isRequired())

			$this->addError('void', 'Enter a MAC address');

		if (!empty($this->value()) && !filter_var($this->value(), FILTER_VALIDATE_MAC))

			$this->addError('invalid', 'MAC address is invalid');

		return $this->_errors;
	}
}

Form::RegisterField('MacAddressField');

?>
