<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * @package	Mzsj
 * @author	李潇喃
 * @copyright	Copyright (c) 2015 - 2017,
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://www.muzisheji.com
 * @since	Version 1.0.0
*/

class MY_Form_validation extends CI_Form_validation {
	/**
	 * Is Unique
	 *
	 * Check if the input value doesn't already exist
	 * in the specified database field.
	 *
	 * @param	string	$str
	 * @param	string	$field
	 * @return	bool
	 */
	public function is_unique($str, $field)
	{
		sscanf($field, '%[^.].%[^.].%[^.]', $table, $field ,$primary);
		$thisid = $this->CI->input->post($primary);
		$query = $this->CI->db->limit(2)->get_where($table, array($field => $str));
		return isset($this->CI->db) ? (($query->num_rows() === 1 and $query->first_row()->$primary === $thisid) || $query->num_rows() === 0) : FALSE;
	}
}