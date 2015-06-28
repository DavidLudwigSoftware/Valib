<?php


class IpAddressField extends FormField
{
	public function validate()
	{
		$this->_errors = array();

		if (empty($this->value()) && strlen($this->value()) == 0 && $this->isRequired())

			$this->addError('void', 'Enter an IP address');

		if (!empty($this->value()) && !filter_var($this->value(), FILTER_VALIDATE_IP))

			$this->addError('invalid', 'IP address is invalid');

		return $this->_errors;
	}
}

Form::RegisterField('IpAddressField');

?>
