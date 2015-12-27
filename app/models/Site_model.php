<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_model extends MY_Model 
{
	public $table;
	public function __construct(){
		$this->table = 'site';
		parent::__construct();
	}
}