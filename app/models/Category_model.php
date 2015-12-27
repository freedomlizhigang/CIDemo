<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends MY_Model 
{
     public $table;
     public function __construct(){
          $this->table = 'category';
          parent::__construct();
     }
}