<?php


class IntegerField extends FormField 
{
	private $_min = Null;
	private $_max = Null;

	public function __construct($id, $value, $min = Null, $max = Null, $required = True)
	{
		$this->_max = ($max === Null) ? Null : intval($max);
		$this->_min = ($min === Null) ? Null : intval($min);

		$this->setTrimEnabled(False);

		parent::__construct($id, ($value === Null || $value === '') ? Null : intval($value), $required);
	}

	public function maximum()
	{
		return $this->_max;
	}

	public function minimum()
	{
		return $this->_min;
	}

	public function setValue($value)
	{
		return parent::setValue(($value === Null) ? Null : intval($value));
	}

	public function setMaximum($value)
	{
		return $this->_max = ($value === Null) ? Null : intval($value);
	}

	public function setMinimum($value)
	{
		return $this->_min = ($value === Null) ? Null : intval($value);
	}

	public function setTrimEnabled($enabled)
	{
		return parent::setTrimEnabled(False);
	}

	public function validate()
	{
		$errors = array();

		if ($this->value() === Null && $this->isRequired())

			$errors[] = Form::VOID;

		if ($this->value() !== Null && $this->value() < $this->minimum() && $this->minimum() !== Null)

			$errors[] = Form::SMALL;

		if ($this->value() !== Null && $this->value() > $this->maximum() && $this->maximum() !== Null)

			$errors[] = Form::LARGE;

		return $errors;
	}
}

Form::RegisterField('IntegerField');

?>