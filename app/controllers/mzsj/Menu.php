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

my_load_class('Mzsj','controllers/mzsj');
class Menu extends Mzsj {
	public function __construct()
	{
		parent::__construct();
	}
	// Index listtotree
	public function index(){
		$this->data['title'] = "MenuList";
		$this->load->view('mzsj/com_header',$this->data);
		// load menulist
		$data['tree'] = $this->list_to_tree($model = 'menu_model',$pkname = 'menuid',$parentidname = 'parentid',$pid = 0);
		$data['tree'] = $this->statusname($data['tree'],'displayname','display');
		$this->load->view('mzsj/menu_index',$data);
		$this->load->view('mzsj/com_footer');
	}
	// addMenu
	public function addmenu($pid = NULL){
		$this->data['title'] = "AddMenu";
		$this->load->view('mzsj/com_header',$this->data);
		$this->load->model('menu_model');
		if (isset($_POST['dosubmit']) && $this->form_validation->run('menu_rules')) {
			$menuid = $this->menu_model->insertOne($this->input->post('info[]'));
			if ($menuid) {
				// addlog
				$this->addlog('menuid = '.$menuid);
				$this->msg('success addmenu','mzsj/menu/index');
			}else{
				$this->msg($res,uri_string());
			}
		}else{
			$data['pid'] = (int)$this->uri->segment(4) ? (int)$this->uri->segment(4) : 0;
			if ($data['pid'] < 0) $this->msg('Parameter Error!','mzsj/menu/index');
			if ($data['pid'] === 0) {
				$this->load->view('mzsj/menu_addmenu',$data);
			}else{
				$sql = 'menuid = '.$data['pid'];
				$mid = $this->menu_model->getOne($field = 'menuid',$sql);
				if (!empty($mid)) {
					$this->load->view('mzsj/menu_addmenu',$data);
				}else{
					$this->msg('Parameter Error!','mzsj/menu/index');
				}
			}
		}
		$this->load->view('mzsj/com_footer');
	}
	// editMenu
	public function editmenu($menuid = NULL)
	{
		$this->data['title'] = "EditMenu";
		$this->load->view('mzsj/com_header',$this->data);
		if ($menuid === NULL || (int)$menuid <= 0) {
			$this->msg('Parameter Error!','mzsj/menu/index');
		}else{
			$this->load->model('menu_model');
			$data['mid'] = (int)$this->uri->segment(4) ? (int)$this->uri->segment(4) : 0;
			if (isset($_POST['dosubmit']) && $this->form_validation->run('menu_rules')) {
				$sql = 'menuid = '.$this->input->post('menuid');
				$res = $this->menu_model->updateOne($sql,$this->input->post('info[]'));
				if ($res) {
					// addlog
					$this->addlog($sql);
					$this->msg('success editmenu','mzsj/menu/index');
				}else{
					$this->msg($res,uri_string());
				}
			}else{
				$sql = 'menuid = '.$data['mid'];
				$data['info'] = $this->menu_model->getOne($field = '*',$sql);
				if (empty($data['info'])) 
				{
					$this->msg('Parameter Error!','mzsj/menu/index');
				}else
				{
					$this->load->view('mzsj/menu_editmenu',$data);
				}
			}
		}
		$this->load->view('mzsj/com_footer');
	}
	// delMenu
	public function delmenu($menuid = NULL){
		$this->data['title'] = "DelMenu";
		$this->load->view('mzsj/com_header',$this->data);
		if (isset($_POST['dosubmit']))
		{
			$menuids = $this->input->post('mids[]');
			foreach ($menuids as $m) {
				$this->delchild('menu_model','menuid','parentid',$m);
				$this->menu_model->deleteOne('menuid = '.$m);
				// addlog
				$this->addlog('menuid = '.$m);
			}
		}else{
			if ($menuid == NULL || (int)$menuid <= 0) {
				$this->msg('Parameter Error!','mzsj/menu/index');
			}else{
				$menuid = (int)$this->uri->segment(4);
				$this->delchild('menu_model','menuid','parentid',$menuid);
				$this->menu_model->deleteOne('menuid = '.$menuid);
				// addlog
				$this->addlog('menuid = '.$menuid);
			}
		}
		$this->msg('Del Success!','mzsj/menu/index');
		$this->load->view('mzsj/com_footer');
	}
}