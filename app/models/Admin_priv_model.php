<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_priv_model extends MY_Model
{
	public $table = '';
	public function __construct()
    {
    		$this->table = 'admin_priv';
		parent::__construct();
    }
}
