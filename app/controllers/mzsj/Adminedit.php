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
class Adminedit extends Mzsj {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
	}
	/*
	* editadmin
	*/
	public function editadmin()
	{
		$this->data['title'] = 'EditAdmin';
		$this->load->view('mzsj/com_header',$this->data);
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
				$this->msg('UpdateAdmin Success!','mzsj/adminedit/editadmin');
			}
			else
			{
				$this->msg('UpdateAdmin Error!','',1);
			}
		}else{
			$sql = 'adminid = '.$this->session->mzsj_aid;
			$data['info'] = $this->admin_model->getOne('*',$sql);
			if (empty($data['info'])) {
				$this->msg('Parameter Error!','',1);
			}else{
				$this->load->view('mzsj/adminedit_editadmin',$data);
			}
		}
		$this->load->view('mzsj/com_footer');
	}
	/*
	* edit password
	*/
	public function editpassword()
	{
		$this->data['title'] = 'EditPassword';
		$this->load->view('mzsj/com_header',$this->data);
		if (isset($_POST['dosubmit']) && $this->form_validation->run('admin_editpwd')) {
			$savesql = 'adminid = '.$this->input->post('adminid');
			$getinfo = $this->admin_model->getOne('*',$savesql);
			if ($getinfo['password'] != md5(md5($this->input->post('oldpassword').$getinfo['encrypt'])))
			{
				$this->msg('旧密码填写错误!','mzsj/adminedit/editpassword');
				return;
			}
			$save['password'] = md5(md5($this->input->post('info[password]').$getinfo['encrypt']));
			$res = $this->admin_model->updateOne($savesql,$save);
			if ($res)
			{
				// addlog
				$this->addlog($savesql);
				// update rolecache
				$this->load->library('updatecache');
				$this->updatecache->admincache();
				$this->msg('UpdateAdmin Success!','mzsj/adminedit/editpassword');
			}
			else
			{
				$this->msg('UpdateAdmin Error!','',1);
			}
		}else{
			$sql = 'adminid = '.$this->session->mzsj_aid;
			$data['info'] = $this->admin_model->getOne('*',$sql);
			if (empty($data['info'])) {
				$this->msg('Parameter Error!','',1);
			}else{
				$data['rolelist'] = $this->cache->get('rolecache');
				$this->load->view('mzsj/adminedit_editpwd',$data);
			}
		}
		$this->load->view('mzsj/com_footer');
	}
}