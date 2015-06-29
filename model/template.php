<?php


class Template
{
	private $_metadata    = array();
	private $_stylesheets = array();
	private $_jshead      = array();
	private $_jsbody      = array();
	private $_vars        = array();

	public function metadata($index, $value = Null)
	{
		if ($value)

			$this->_metadata[$index] = $value;

		else

			return $this->_metadata[$index];
	}

	public function stylesheet($index, $value = Null)
	{
		if ($value)

			$this->_stylesheets[$index] = $value;

		else

			return $this->_stylesheets[$index];
	}

	public function javascriptHead($value = Null)
	{
		if ($value)

			$this->_jshead[] = $value;

		else

			return $this->_jshead[array_search($value, $this->_jshead)];
	}

	public function javascriptBody($index, $value = Null)
	{
		if ($value)

			$this->_jsbody[$index] = $value;

		else

			return $this->_jsbody[$index];
	}

	public function render($template)
	{
		$page = $this->load('', $template . '.php');

		$this->output($page);
	}

	public function load($path, $file)
	{
		ob_start();

		include VIEW_PATH . '/' . $path . $file;

		$page = ob_get_contents();

		ob_end_clean();

		return $this->format($path, $page);
	}

	public function format($path, $page)
	{
		$metaHtml = "";

		foreach (array_keys($this->_metadata) as $name)

			$metaHtml .= "<meta name=\"$name\" content=\"" . $this->_metadata[$name] . "\">\n";

		$page = str_replace('{__METADATA__}', $metaHtml, $page);


		$cssHtml = "";

		foreach ($this->_stylesheets as $value)

			$cssHtml .= "<link type=\"text/css\" rel=\"stylesheet\" href=\"$value\">\n";

		$page = str_replace('{__STYLESHEETS__}', $cssHtml, $page);


		$jsHeadHtml = "";

		foreach ($this->_jshead as $value)

			$jsHeadHtml .= "<script src=\"$value\"></script>\n";

		$page = str_replace('{__JSHEAD__}', $jsHeadHtml, $page);


		$jsBodyHtml = "";

		foreach (array_keys($this->_jsbody) as $value)

			$jsBodyHtml .= "<script src=\"$value\"></script>\n";

		$page = str_replace('{__JSBODY__}', $jsBodyHtml, $page);


		foreach (array_keys($this->_vars) as $key)

			$page = str_replace('{' . $key . '}', $this->_vars[$key], $page);

		$includes = array();

		$regex = "/\{\s*__INCLUDE__\s*\:\s*.+\}/";

		preg_match_all($regex, $page, $includes);

		foreach ($includes[0] as $include)
		{
			$filePath = $path . trim(preg_split("/\s*\:\s*/", $include)[1], '}');
			$page     = preg_replace($regex, $this->load(dirname($filePath) . '/', basename($filePath)), $page, 1);
		}

		$keys = array();

		$regex = "/\{\s*__GET__\s*\:\s*.+\}/";

		preg_match_all($regex, $page, $keys);

		foreach ($keys[0] as $key)
		{
			$parts = preg_split("/(\s*\:\s*)|(\s*\~\s*)/", $key);

			$getKey = trim($parts[1], '}');

			$value = trim((isset($_GET[$getKey])) ? $_GET[$getKey] : ((isset($parts[2])) ? $parts[2] : ''), '}');

			$page   = preg_replace($regex, trim($value), $page, 1);
		}

		$keys = array();

		$regex = "/\{\s*__POST__\s*\:\s*.+\}/";

		preg_match_all($regex, $page, $keys);

		foreach ($keys[0] as $key)
		{
			$parts = preg_split("/(\s*\:\s*)|(\s*\~\s*)/", $key);

			$postKey = trim($parts[1], '}');

			$value = trim((isset($_POST[$postKey])) ? $_POST[$postKey] : ((isset($parts[2])) ? $parts[2] : ''), '}');

			$page   = preg_replace($regex, trim($value), $page, 1);
		}

		$page = preg_replace('/\{.*\}/', '', $page);

		return $page;
	}

	public function output($page)
	{
		echo $page;
	}

	public function __call($index, $value)
	{
		$index = strtoupper($index);

		if (count($value) > 0)

			$this->_vars[$index] = $value[0];

		else

			return $this->_vars[$index];
	}
}

$__model = new Template();
