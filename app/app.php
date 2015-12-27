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
// 设置字符集，不用去配置文件中加载
define('CHARSET','UTF-8');