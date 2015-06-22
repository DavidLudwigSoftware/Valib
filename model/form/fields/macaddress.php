<?php


class MacAddressField extends FormField
{
	public function validate()
	{
		$errors = array();

		if (empty($this->value()) && strlen($this->value()) == 0 && $this->isRequired())

			$errors[] = Field::Void;

		if (!empty($this->value()) && !filter_var($this->value(), FILTER_VALIDATE_MAC))

			$errors[] = Field::Invalid;

		return $errors;
	}
}

?>