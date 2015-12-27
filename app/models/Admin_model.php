<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends MY_Model 
{
     public $table;
     public function __construct(){
          $this->table = 'admin';
          parent::__construct();
     }
}