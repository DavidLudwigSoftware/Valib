<?php


class Template
{
	private $_metadata    = array();
	private $_stylesheets = array();
	private $_css         = "";
	private $_jsheadFiles = array();
	private $_jsbodyFiles = array();
	private $_jsheadCode  = "";
	private $_jsbodyCode  = "";
	private $_vars        = array();

	public function addMetadata($name, $value)
	{
		$this->_metadata[$name] = $value;
	}

	public function addStylesheet($value)
	{
		$this->_stylesheets[] = $value;
	}

	public function addCss($value)
	{
		$this->_css .= "\n\n$value";
	}

	public function addHeadJavascriptFile($value)
	{
		$this->_jsheadFiles[] = $value;
	}

	public function addBodyJavascriptFile($value)
	{
		$this->_jsbodyFiles[] = $value;
	}

	public function addHeadJavascript($value)
	{
		$this->_jsheadCode .= "\n\n$value";
	}

	public function addBodyJavascript($value)
	{
		$this->_jsbodyCode .= "\n\n$value";
	}

	public function render($template)
	{
		$page = $this->load('', $template);

		$this->output($page);
	}

	public function load($path, $file)
	{
		ob_start();

		if (!empty($path))

			$path = ($path[strlen($path) - 1] == '/') ? $path : $path . '/';

		include VIEW_PATH . '/' . $path . $file;

		$page = ob_get_contents();

		ob_end_clean();

		return $this->format($path, $page);
	}

	public function format($path, $page)
	{
		$this->formatVariables($page);

		$this->formatMetadata($page);

		$this->formatStylesheets($page);

		$this->formatJavascript($page);

		$this->formatIncludes($path, $page);

		$this->formatFromArray('__GET__',  $_GET,  $page);
		$this->formatFromArray('__POST__', $_POST, $page);

		return $page;
	}

	protected function formatVariables(&$page)
	{
		foreach (array_keys($this->_vars) as $key)

			$page = str_replace('{' . $key . '}', $this->_vars[$key], $page);
	}

	protected function formatMetadata(&$page)
	{
		$html = "";

		foreach (array_keys($this->_metadata) as $name)

			$html .= "<meta name=\"$name\" content=\"" . $this->_metadata[$name] . "\">\n";

		$page = str_replace('{__METADATA__}', $html, $page);
	}

	protected function formatStylesheets(&$page)
	{
		$html = "";

		foreach ($this->_stylesheets as $value)

			$html .= "<link type=\"text/css\" rel=\"stylesheet\" href=\"$value\">\n";

		if (!empty($this->_css))

			$html .= "\n<style>" . $this->_css . "\n\n</style>\n";

		$page = str_replace('{__STYLESHEETS__}', $html, $page);
	}

	protected function formatJavascript(&$page)
	{
		$html = "";

		foreach ($this->_jsheadFiles as $value)

			$html .= "<script src=\"$value\"></script>\n";

		if (!empty($this->_jsheadCode))

			$html .= "\n\n<script>" . $this->_jsheadCode . "\n\n</script>\n\n";

		$page = str_replace('{__JSHEAD__}', $html, $page);

		$html = "";

		foreach ($this->_jsbodyFiles as $value)

			$html .= "<script src=\"$value\"></script>\n";

		if (!empty($this->_jsbodyCode))

			$html .= "\n\n<script>" . $this->_jsbodyCode . "\n\n</script>\n\n";

		$page = str_replace('{__JSBODY__}', $html, $page);
	}

	protected function formatIncludes($path, &$page)
	{
		$includes = array();

		$regex = "/\{\s*__INCLUDE__\s*\:\s*.+\}/";

		preg_match_all($regex, $page, $includes);

		foreach ($includes[0] as $include)
		{
			$filePath = $path . trim(preg_split("/\s*\:\s*/", $include)[1], '}');
			$page     = preg_replace($regex, $this->load(dirname($filePath) . '/', basename($filePath)), $page, 1);
		}
	}

	protected function formatFromArray($varName, $array, &$page)
	{
		$keys = array();

		$regex = "/\{\s*" . $varName . "\s*\:\s*.+\}/";

		preg_match_all($regex, $page, $keys);

		foreach ($keys[0] as $key)
		{
			$parts = preg_split("/(\s*\:\s*)|(\s*\~\s*)/", $key);

			$getKey = trim($parts[1], '}');

			$value = trim((isset($array[$getKey])) ? $array[$getKey] : ((isset($parts[2])) ? $parts[2] : ''), '}');

			$page = preg_replace($regex, trim($value), $page, 1);
		}
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
