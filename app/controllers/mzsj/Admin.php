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
class Admin extends Mzsj {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->model('role_model');
	}
	/*
	* admin list
	*/
	public function index($pages = 0)
	{
		$this->data['title'] = "AdminList";
		$this->load->view('mzsj/com_header',$this->data);
		// site list
		if ( (int)$pages > 1) $pages = ((int)$pages - 1) * 10;
		$data['adminlist'] = $this->admin_model->getPage('*',NULL,10,$pages,'adminid DESC');
		$data['adminlist'] = $this->statusname($data['adminlist'],'statusname','status','正常','禁用');
		// totalRows + pages
		$totalRows = $this->admin_model->getNumRows('adminid');
		$data['pages'] = $this->viewPages('mzsj/admin/index',$totalRows,10,4);
		// rolecache
		$data['rolename'] = $this->cache->get('rolecache');
		$this->load->view('mzsj/admin_index',$data);
		$this->load->view('mzsj/com_footer');
	}
	/*
	* add Admin
	*/
	public function addadmin()
	{
		$this->data['title'] = "AddAdmin";
		$this->load->view('mzsj/com_header',$this->data);
		if (isset($_POST['dosubmit']) && $this->form_validation->run('admin_rules')) {
			// 取得所有数据，并给密码加密
			$insertData = $this->input->post('info[]');
			$insertData['password'] = md5(md5($insertData['password'].$insertData['encrypt']));
			$res = $this->admin_model->insertOne($insertData);
			if ($res)
			{
				// addlog
				$this->addlog('adminid = '.$res);
				// update admincache
				$this->load->library('updatecache');
				$this->updatecache->admincache();
				$this->msg('AddAdmin Success!','mzsj/admin/index');
			}
			else
			{
				$this->msg('AddAdmin Error!',uri_string());
			}
		}else{
			$data['encrypt'] = create_randomstr();
			$data['rolelist'] = $this->cache->get('rolecache');
			$this->load->view('mzsj/admin_addadmin',$data);
		}
		$this->load->view('mzsj/com_footer');
	}
	/*
	* edit Admin
	*/
	public function editadmin($adminid = NULL)
	{
		$this->data['title'] = "EditAdmin";
		$this->load->view('mzsj/com_header',$this->data);
		if ($adminid == NULL || (int)$adminid <= 0) 
		{
			$this->msg('Parameter Error!','mzsj/admin/index');
		}
		else
		{
			if (isset($_POST['dosubmit']) && $this->form_validation->run('admin_rules')) {
				$savesql = 'adminid = '.$this->input->post('adminid');
				$res = $this->admin_model->updateOne($savesql,$this->input->post('info[]'));
				if ($res)
				{
					// addlog
					$this->addlog($savesql);
					// update rolecache
					$this->load->library('updatecache');
					$this->updatecache->admincache();
					$this->msg('UpdateAdmin Success!','mzsj/admin/index');
				}
				else
				{
					$this->msg('UpdateAdmin Error!',uri_string());
				}
			}else{
				$sql = 'adminid = '.(int)$adminid;
				$data['info'] = $this->admin_model->getOne('*',$sql);
				if (empty($data['info'])) {
					$this->msg('Parameter Error!','mzsj/admin/index');
				}else{
					$data['rolelist'] = $this->cache->get('rolecache');
					$this->load->view('mzsj/admin_editadmin',$data);
				}
			}
		}
		$this->load->view('mzsj/com_footer');
	}
	/*
	* delAdmin
	*/
	public function deladmin($adminid = NULL)
	{
		$this->data['title'] = "DelAdmin";
		$this->load->view('mzsj/com_header',$this->data);
		if ($adminid != NULL && (int)$adminid > 0) {
				$this->admin_model->deleteOne('adminid = '.(int)$adminid);
				// addlog
				$this->addlog('adminid = .'.(int)$adminid);
				// update admincache
				$this->load->library('updatecache');
				$this->updatecache->admincache();
				$this->msg('Delete Success!','mzsj/admin/index');
		}else{
			$this->msg('Parameter Error!','mzsj/admin/index');
		}
		$this->load->view('mzsj/com_footer');
	}
	/*
	* rolelist
	*/
	public function rolelist($pages = 0){
		$this->data['title'] = "RoleList";
		$this->load->view('mzsj/com_header',$this->data);
		// site list
		if ( (int)$pages > 1) $pages = ((int)$pages - 1) * 10;
		$data['rolelist'] = $this->role_model->getPage('*',NULL,10,$pages);
		$data['rolelist'] = $this->statusname($data['rolelist'],'statusname','status','正常','禁用');
		// totalRows + pages
		$totalRows = $this->role_model->getNumRows('roleid');
		$data['pages'] = $this->viewPages('mzsj/admin/rolelist',$totalRows,10,4);
		$this->load->view('mzsj/admin_rolelist',$data);
		$this->load->view('mzsj/com_footer');
	}
	/*
	* add Role
	*/
	public function addrole()
	{
		$this->data['title'] = "AddRole";
		$this->load->view('mzsj/com_header',$this->data);
		if (isset($_POST['dosubmit']) && $this->form_validation->run('role_rules')) {
			$res = $this->role_model->insertOne($this->input->post('info[]'));
			if ($res)
			{
				// addlog
				$this->addlog('roleid = '.$res);
				// update rolecache
				$this->load->library('updatecache');
				$this->updatecache->rolecache();
				$this->msg('AddRole Success!','mzsj/admin/rolelist');
			}
			else
			{
				$this->msg('AddRole Error!',uri_string());
			}
		}else{
			$this->load->view('mzsj/admin_addrole');
		}
		$this->load->view('mzsj/com_footer');
	}
	/*
	* edit Role
	*/
	public function editrole($roleid = NULL)
	{
		$this->data['title'] = "EditRole";
		$this->load->view('mzsj/com_header',$this->data);
		if ($roleid == NULL || (int)$roleid <= 0) 
		{
			$this->msg('Parameter Error!','mzsj/admin/rolelist');
		}
		else
		{
			if (isset($_POST['dosubmit']) && $this->form_validation->run('role_rules')) {
				$savesql = 'roleid = '.$this->input->post('roleid');
				$res = $this->role_model->updateOne($savesql,$this->input->post('info[]'));
				if ($res)
				{
					// addlog
					$this->addlog($savesql);
					// update rolecache
					$this->load->library('updatecache');
					$this->updatecache->rolecache();
					$this->msg('UpdateRole Success!','mzsj/admin/rolelist');
				}
				else
				{
					$this->msg('UpdateRole Error!',uri_string());
				}
			}else{
				$sql = 'roleid = '.(int)$roleid;
				$data['info'] = $this->role_model->getOne('*',$sql);
				if (empty($data['info'])) {
					$this->msg('Parameter Error!','mzsj/admin/rolelist');
				}else{
					$this->load->view('mzsj/admin_editrole',$data);
				}
			}
		}
		$this->load->view('mzsj/com_footer');
	}
	/*
	* delRole
	*/
	public function delrole($roleid = NULL)
	{
		$this->data['title'] = "DelRole";
		$this->load->view('mzsj/com_header',$this->data);
		if ($roleid == NULL || (int)$roleid <= 0) 
		{
			$this->msg('Parameter Error!','mzsj/admin/rolelist');
		}
		else
		{
			// if not user del
			if ($this->roleisnull((int)$roleid)) {
				$this->role_model->deleteOne('roleid = '.(int)$roleid);
				// addlog
				$this->addlog('roleid = .'.(int)$roleid);
				// update rolecache
				$this->load->library('updatecache');
				$this->updatecache->rolecache();
				$this->msg('Delete Success!','mzsj/admin/rolelist');
			}else{
				$this->msg('Have User!','mzsj/admin/rolelist');
			}
		}
		$this->load->view('mzsj/com_footer');
	}
	/*
	* adminpriv
	*/
	public function adminpriv($roleid = NULL)
	{
		$this->data['title'] = "AdminPriv";
		$this->load->view('mzsj/com_header',$this->data);
		$this->load->model('admin_priv_model');
		if (isset($_POST['dosubmit'])) {
			$delsql = 'roleid = '.$this->input->post('roleid');
			$this->admin_priv_model->deleteOne($delsql);
			$insertData = $this->input->post('urls[]');
			$tempArr = array();
			foreach (array_unique($insertData) as $k => $v) {
				$tempArr[$k] = array(
						'roleid' => $this->input->post('roleid'),
						'url' => $v
					);
			}
			$res = $this->admin_priv_model->insertAll($tempArr);
			if ($res) {
				// addlog
				$this->addlog('roleid = '.$this->input->post('roleid'));
				$this->session->ADMIN_MENU_LIST = null;
				$this->msg('UpdatePriv Success!','mzsj/admin/rolelist');
			}else{
				$this->msg('UpdatePriv Error!','mzsj/admin/rolelist');
			}
		}else{
			if ($roleid != NULL && (int)$roleid > 0) {
				$data['roleurl'] = $this->admin_priv_model->getAll('*','roleid = '.(int)$roleid);
				$data['tree'] = $this->list_to_tree('menu_model','menuid','parentid',0);
				$tempstr = '';
				foreach ($data['roleurl'] as $v) {
					$tempstr .= "'".$v['url']."',";
				}
				$tempstr = trim($tempstr,',');
				$data['roleurl'] = $tempstr;
				$data['roleid'] = (int)$roleid;
				$this->load->view('mzsj/admin_adminpriv',$data);
			}else{
				$this->msg('Parameter Error!','mzsj/admin/rolelist');
			}
		}
		$this->load->view('mzsj/com_footer');
	}
	// roleisnull 
	private function roleisnull($roleid)
	{
		$sql = 'roleid = '.$roleid;
		$data = $this->admin_model->getAll('*',$sql);
		if (empty($data)) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
}