<?php


class Database extends PDO
{
	const AndSelector    = 0x0;
	const OrSelector     = 0x1;
	const OrderAscend    = 0x0;
	const OrderDescend   = 0x1;

	/*
	* @the database instance
	* @access private
	*/
	private static $_db;


	/*
	*
	* @database constructor
	*
	*/
	public function __construct()
	{
		global $V_SETTINGS;

		$username = 'root';
		$password = 'helloworld';

		$dns = 'mysql' .
		':host=' . 'localhost' .
		((!empty($V_SETTINGS['database']['port'])) ? (';port=' . $V_SETTINGS['database']['port']) : '') .
		';dbname=' . 'sakila';

		parent::__construct($dns, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

		self::$_db = $this;
	}


	/**
	*
	* @delete from table
	*
	* @param string $table
	*
	* @param VWhere selector $where = Null
	*
	* @return mixed query result
	*
	*/
	public function delete($table, $where = Null)
	{
		$sql = "DELETE FROM `$table`";
		$values = array();

		if ($where)

			$sql .= ' ' . $where->build($values);

		$query = $this->prepare($sql);

		return $query->execute($values);
	}

	/**
	*
	* @insert into table
	*
	* @param string $table
	*
	* @param array $fields
	*
	* @param bool $useKeys = False
	*
	* @param bool $skipId = True
	*
	* @return mixed query result
	*
	*/
	public function insert($table, $fields, $useKeys = False, $skipId = True)
	{
		$sql = "INSERT INTO `$table`";
		$values = array();

		if ($useKeys)
		{
			$sql .= ' (';

			foreach (array_keys($fields) as $key)

				$sql .= (strrpos($sql, ' (') == strlen($sql) - strlen(' (') ? '' : ', ' ) . "`$key`";

			$sql .= ')';
		}

		$sql .= ' VALUES(';

		if ($skipId && !$useKeys)

			$sql .= 'NULL';

		foreach ($fields as $field)
		{
			$sql .= (strrpos($sql, 'VALUES(') == strlen($sql) - strlen('VALUES(') ? '' : ', ' ) . '?';
			$values[] = $field;
		}

		$sql .= ')';

		$query = $this->prepare($sql);

		return $query->execute($values);
	}


	/**
	*
	* @select from table
	*
	* @param string $table
	*
	* @param array $fields
	*
	* @param VWhere selector $where = Null
	*
	* @param VOrder selector $order = Null
	*
	* @param VLimit selector $limit = Null
	*
	* @return mixed query result
	*
	*/
	public function select($table, $fields, $where = Null, $order = Null, $limit = Null)
	{
		$sql  = 'SELECT';
		$values = array();

		if ($fields == '*')

			$sql .= ' *';

		elseif (!is_array($fields))

			$sql .= " `$fields`";

		else

			for ($i = 0; $i < count($fields); $i++)

				$sql .= (($i > 0) ? ',' : '') . ' `' . $fields[$i] . '`';

		$sql .= " FROM `$table`";

		if ($where)
		
			$sql .= ' ' . $where->build($values);
		

		if ($order)
		
			$sql .= $order->build();
		

		if ($limit)
		
			$sql .= $limit->build();


		$query = $this->prepare($sql);

		if ($query->execute($values))

			return $query->fetchAll();

		return False;
	}


	/**
	*
	* @update table
	*
	* @param string $table
	*
	* @param array $fields
	*
	* @param VWhere selector $where = Null
	*
	* @return mixed query result
	*
	*/
	public function update($table, $fields, $where = Null)
	{
		$sql = "UPDATE `$table` SET ";
		$values = array_values($fields);

		foreach (array_keys($fields) as $key)

			$sql .= (strrpos($sql, 'SET ') == strlen($sql) - strlen('SET ') ? '' : ', ' ) . "`$key` = ?";

		if ($where)

			$sql .= ' ' . $where->build($values);

		$query = $this->prepare($sql);

		return $query->execute($values);
	}


	/**
	*
	* @count table
	*
	* @param string $table
	*
	* @param string $field
	*
	* @param VWhere selector $where = Null
	*
	* @return int
	*
	*/
	public function count($table, $field, $where = Null)
	{
		$sql = "SELECT COUNT('$field') AS 'result' FROM `$table`";
		$values = array();

		if ($where)

			$sql .= ' ' . $where->build($values);

		$query = $this->prepare($sql);

		$query->execute($values);

		return intval($query->fetch(PDO::FETCH_ASSOC)['result']);
	}


	/**
	*
	* @value is unique in table
	*
	* @param string $table
	*
	* @param array $fields
	*
	* @param string $value
	*
	* @return bool
	*
	*/
	public function isUnique($table, $fields, $value)
	{
		return !$this->exists($table, $fields, $value);
	}


	/**
	*
	* @value exists in table
	*
	* @param string $table
	*
	* @param array $fields
	*
	* @param string $value
	*
	* @return bool
	*
	*/
	public function exists($table, $fields, $value)
	{
		$where = array();

		foreach ($fields as $key)

			$where[$key] = $value;

		return (bool) $this->count($table, '*', vWhere(vOr($where)));
	}


	/**
	*
	* @database instance
	*
	* @param string $table
	*
	* @param array $fields
	*
	* @param string $value
	*
	* @return bool
	*
	*/
	public static function Instance()
	{
		return (self::$_db) ? self::$_db : new self();
	}


	/**
	*
	* @sql AND logic
	*
	* @param variable-length array/selector $array
	*
	* @return SelectorLogic
	*
	*/
	public function dbAnd(...$array)
	{
		return new SelectorLogic(self::AndSelector, $array);
	}


	/**
	*
	* @sql OR logic
	*
	* @param variable-length array/selector $array
	*
	* @return SelectorLogic
	*
	*/
	public function dbOr(...$array)
	{
		return new SelectorLogic(self::OrSelector, $array);
	}


	/**
	*
	* @sql limit selector
	*
	* @param int $start
	*
	* @param int $count
	*
	* @return Limit
	*
	*/
	public function limit($start, $count)
	{
		return new Limit($start, $count);
	}


	/**
	*
	* @sql order selector
	*
	* @param int $column
	*
	* @param int $order
	*
	* @return Order
	*
	*/
	public function order($column, $order = Null)
	{
		return new Order($column, $order);
	}


	/**
	*
	* @sql where selector
	*
	* @param variable-length selector logic $data
	*
	* @return Where
	*
	*/
	public function where(...$data)
	{
		return new Where($data);
	}

}

?>