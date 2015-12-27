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

class MY_Model extends CI_Model
{
	protected $table = '';
	// __construct
	public function __construct()
	{
		parent::__construct();
		// 手动连接database
		$this->load->database();
		$this->table = $this->table;
	}
	/*
	* get all
	*/
     public function getAll($field = '*',$sql = NULL,$limit = NULL,$order = NULL)
     {
     		if ($order !== NULL) $this->db->order_by($order);
     		if ($sql !== NULL) $this->db->where($sql);
     		if ($limit !== NULL) $this->db->limit($limit);
     		$query = $this->db->select($field)->get($this->table);
		return $query->result_array();
     }
     /*
	* getPage
	* $limit number or get
	* $pages 当前分页
	*/
     public function getPage($field = '*',$sql = NULL,$limit = NULL,$pages = NULL,$order = NULL)
     {
     		if ($order !== NULL) $this->db->order_by($order);
     		if ($sql !== NULL) $this->db->where($sql);
     		$query = $this->db->limit($limit,$pages)->select($field)->get($this->table);
		return $query->result_array();
     }
     /*
     * get Tree
     * output Tree
     */
     public function getTree($field = '*',$sql = '',$limit = 100,$order = '')
     {
          $query = $this->db->select($field)->where($sql)->order_by($order)->get($this->table,$limit);
          return $query->result_array();
     }
     // getNumRows
	public function getNumRows($field = '*',$sql = NULL){
		if ($sql != NULL) $this->db->where($sql);
		return $this->db->select($field)->get($this->table)->num_rows();
	}
	// getOne
	public function getOne($field = '*',$sql = NULL,$order = NULL){
		if ($sql !== NULL) $this->db->where($sql);
		if ($order !== NULL) $this->db->order_by($order);
		$query = $this->db->select($field)->get($this->table,1);
		return $query->row_array();
	}
	/*
	*updateSite
	*sql 更新条件
	*/
	public function updateOne($sql = '',$data = '')
	{
		return $this->db->where($sql)->update($this->table,$data);
	}
	/*
	* InsertOne
	*/
	public function insertOne($data)
	{	
		$this->db->insert($this->table,$data);
		return $this->db->insert_id();
	}
	/*
	* InsertAll
	*/
	public function insertALL($data)
	{	
		return $this->db->insert_batch($this->table,$data);
	}
	/*
	* deleteOne
	*/
	public function deleteone($sql)
	{
		return $this->db->where($sql)->delete($this->table);
	}
}