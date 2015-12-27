<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends MY_Model 
{
     public $table;
     public function __construct(){
          $this->table = 'role';
          parent::__construct();
     }
}