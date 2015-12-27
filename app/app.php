<?php
if (!function_exists('my_load_class'))
{
	/**
	 * Class load
	*/
	function my_load_class($class, $directory = 'libraries')
	{
		require_once(APPPATH.'/'.$directory.'/'.$class.'.php');
	}
}
