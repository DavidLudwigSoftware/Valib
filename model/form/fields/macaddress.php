<?php


class MacAddressField extends FormField
{
	public function validate()
	{
		$errors = array();

		if (empty($this->value()) && strlen($this->value()) == 0 && $this->isRequired())

			$errors[] = Form::VOID;

		if (!empty($this->value()) && !filter_var($this->value(), FILTER_VALIDATE_MAC))

			$errors[] = Form::INVALID;

		return $errors;
	}
}

Form::RegisterField('MacAddressField');

?>