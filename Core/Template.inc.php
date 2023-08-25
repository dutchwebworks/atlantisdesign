<?php
class Core_Template {
	protected $_template;
	//protected $_placeholder;

	// create template
	function __construct($page)
	{
		$this->_template .= implode('', file($page));
	}
	
	// replace placeholder with dynamic data
	function placeholder($place_holder, $dyn_data)
	{
		$this->_template = str_replace($place_holder, stripslashes($dyn_data), $this->_template);
	}
	
	// replace placeholder array: replace array keys (placeholder) with array value's
	function placeholder_array($array)
	{
		foreach($array as $key => $value) {
			if(is_array($value)) {
				foreach($value as $inner_key => $inner_value) {
					$tmp_value .= $inner_value;
				}
				$this->placeholder('{'.$key.'}', $tmp_value);
				unset($tmp_value);
			} else{
				$this->placeholder('{'.$key.'}', nl2br($value));
			}
		}
	}	
	
	// extract html commented block from template
	function getblok($name)
	{
		eregi('<!-- BEGIN '.$name.' -->(.*)<!-- END '.$name.' -->', $this->_template, $arr);
		$this->placeholder($arr[0], '{'.$name.'}');
		return $arr[1];	
	}
	
	// remove all placeholders
	function cleanup_placeholders($replacement = false)
	{
		$this->_template = eregi_replace('\{[[:alnum:]_.]*\}', $replacement, $this->_template);
	}	
	
	// return the template as string
	function return_as_string()
	{
		return($this->_template); 
	}	
	
	// print the template to output
	function parse()
	{
		print($this->_template);
	}	
}