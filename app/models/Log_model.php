<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends MY_Model 
{
     public $table;
     public function __construct(){
          $this->table = 'log';
          parent::__construct();
     }
}