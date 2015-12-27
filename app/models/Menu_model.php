<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends MY_Model 
{
     public $table;
     public function __construct(){
          $this->table = 'menu';
          parent::__construct();
     }
}