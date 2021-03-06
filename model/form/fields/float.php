<?php


class FloatField extends FormField
{
	private $_min = Null;
	private $_max = Null;

	public function __construct($id, $value, $min = Null, $max = Null, $required = True)
	{
		$this->_max = ($max === Null) ? Null : floatval($max);
		$this->_min = ($min === Null) ? Null : floatval($min);

		$this->setTrimEnabled(False);

		parent::__construct($id, ($value === Null || $value === '') ? Null : floatval($value), $required);
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
		return parent::setValue(($value === Null) ? Null : floatval($value));
	}

	public function setMaximum($value)
	{
		return $this->_max = ($value === Null) ? Null : floatval($value);
	}

	public function setMinimum($value)
	{
		return $this->_min = ($value === Null) ? Null : floatval($value);
	}

	public function setTrimEnabled($enabled)
	{
		return parent::setTrimEnabled(False);
	}

	public function validate()
	{
		$this->_errors = array();

		if ($this->value() === Null && $this->isRequired())

			$this->addError('void', 'Enter a number');

		if ($this->value() !== Null && $this->value() < $this->minimum() && $this->minimum() !== Null)

			$this->addError('small', 'Number is too small');

		if ($this->value() !== Null && $this->value() > $this->maximum() && $this->maximum() !== Null)

			$this->addError('large', 'Number is too large');

		return $this->_errors;
	}
}

Form::RegisterField('FloatField');

?>
