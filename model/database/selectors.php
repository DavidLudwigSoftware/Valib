<?php


class SelectorLogic
{
	private $_id;
	private $_data;

	public function __construct($id, $data)
	{
		$this->_id   = $id;
		$this->_data = $data;
	}

	public function id()
	{
		return $this->_id;
	}

	public function data()
	{
		return $this->_data;
	}

	public function build(&$values = array())
	{
		$spacer = ($this->id() == Database::AndSelector) ? 'AND' : 'OR';

		$query  = '(';

		foreach ($this->data() as $field)
		{	
			if (is_array($field))
			{
				foreach (array_keys($field) as $key)
				{
					$query   .= (($query == '(') ? '' : ' ') . "`$key` = ? $spacer";
					$values[] = $field[$key];
				}
			}
			elseif (is_object($field))

				$query .= (($query == '(') ? '' : ' ') . $field->build($values) . " $spacer";

		}

		$query = rtrim($query, " $spacer") . ')';

		return $query;
	}
}

class Limit
{
	private $_start;
	private $_count;

	public function __construct($start, $count)
	{
		$this->_start = intval($start);
		$this->_count = intval($count);
	}

	public function start()
	{
		return $this->_start;
	}

	public function count()
	{
		return $this->_count;
	}

	public function build()
	{
		return ' LIMIT ' . $this->start() . ', ' . $this->count();
	}
}

class Order
{
	private $_column;
	private $_order;

	public function __construct($column, $order = Null)
	{
		$this->_column = $column;
		$this->_order  = $order;
	}

	public function column()
	{
		return $this->_column;
	}

	public function order()
	{
		return $this->_order;
	}

	public function build()
	{
		return ' ORDER BY `' . $this->column() . '`' . (($this->order() !== Null) ? (($this->order() == Database::OrderAscend) ? ' ASC' : ' DESC') : '');
	}
}

class Where
{
	private $_data;

	public function __construct($data)
	{
		$this->_data = $data;
	}

	public function data()
	{
		return $this->_data;
	}

	public function build(&$values = array())
	{	
		$query  = "WHERE";


		foreach ($this->data() as $field)
		{	

			if (is_array($field))
			{
				foreach (array_keys($field) as $key)
				{
					$query   .= " `$key` = ? AND";
					$values[] = $field[$key];
				}
			}
			elseif (is_object($field))
			{
				$query .= ' ' . $field->build($values) . ' AND';
			}
		}

		$query = rtrim(rtrim($query, ' AND'), ' OR');

		return $query;
	}
}


?>