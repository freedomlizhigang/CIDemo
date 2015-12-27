<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_model extends MY_Model 
{
     public $table;
     public function __construct(){
          $this->table = 'article';
          parent::__construct();
     }
}