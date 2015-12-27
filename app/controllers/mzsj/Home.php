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
class Home extends Mzsj {
	public function __construct()
	{
		parent::__construct();
	}
	// siteList
	public function index()
	{
		$this->data['mainmenu'] = $this->findmenu(0);
		$this->load->view('mzsj/index',$this->data);
	}
	// siteList
	public function sitelist($pages = 0)
	{
		$this->data['title'] = "站点列表";
		$this->load->view('mzsj/com_header',$this->data);
		// site list
		$this->load->model('site_model');
		if ( (int)$pages > 1) $pages = ((int)$pages - 1) * 10;
		$data['sitelist'] = $this->site_model->getPage('*',NULL,10,$pages);
		// totalRows + pages
		$totalRows = $this->site_model->getNumRows('siteid');
		$data['pages'] = $this->viewPages('mzsj/home/index',$totalRows,10,4);
		$this->load->view('mzsj/home_sitelist',$data);
		$this->load->view('mzsj/com_footer');
	}
	/*
	* left_menu()
	* pid 父级id 找到下级子栏目
	*/ 
	public function left_menu($pid = '')
	{
		$pid = (int)$pid;
		$this->data['two_menu'] = $this->findmenu($pid);
		$this->data['mzsj'] = $this;
		$this->load->view('mzsj/left',$this->data);
	}
	/*
	* main
	*/
	public function main()
	{
		$this->data['title'] = '开发人员信息';
		$this->load->view('mzsj/com_header',$this->data);
		$this->load->view('mzsj/main');
		$this->load->view('mzsj/com_footer');
	}
	// editSite
	public function editSite($siteid = NULL)
	{
		$this->data['title'] = "EditSite";
		$this->load->view('mzsj/com_header',$this->data);
		if ($siteid == NULL || (int)$siteid <= 0) 
		{
			$this->msg('Parameter Error!','mzsj/home/index');
		}else
		{
			// site_model
			$this->load->model('site_model');
			$sql = 'siteid = '.(int)$siteid;
			// submit data and validation data
			if (isset($_POST['dosubmit']) && $this->form_validation->run('site_rules')) {
				$savesql = 'siteid = '.$this->input->post('siteid');
				$res = $this->site_model->updateOne($sql,$this->input->post('info[]'));
				if ($res) {
					// addlog
					$this->addlog($savesql);
					$this->msg('success','mzsj/home/sitelist');
				}else{
					$this->msg($res,uri_string());
				}
			}else{
				$data['site'] = $this->site_model->getOne('*',$sql,'siteid ASC');
				if (empty($data['site'])) 
				{
					$this->msg('Parameter Error!','mzsj/home/sitelist');
				}else
				{
					$this->load->view('mzsj/home_editsite',$data);
				}
			}
		}
		$this->load->view('mzsj/com_footer');
	}
	// logList
	public function loglist($pages = 0)
	{
		$this->data['title'] = "LogList";
		$this->load->view('mzsj/com_header',$this->data);
		// Log list
		$this->load->model('log_model');
		if( (int) $pages > 1) $pages = ((int) $pages - 1) * 10;
		$data['loglist'] = $this->log_model->getPage('*',NULL,10,$pages,'logid DESC');
		// totalRows + pages
		$totalRows = $this->log_model->getNumRows('logid');
		$data['pages'] = $this->viewPages('mzsj/home/loglist',$totalRows,10,4);
		$this->load->view('mzsj/home_loglist',$data);
		$this->load->view('mzsj/com_footer');
	}
	// clearLog
	public function clear()
	{
		// ji suan shijian
		$sql = 'time < '.(time() - 3600*24*7);
		$this->load->model('log_model');
		$this->log_model->deleteone($sql);
		// addlog
		$this->addlog('clearLog');
		$this->msg('Clear Success!','mzsj/home/loglist');
	}
	// UpdateCache
	public function allcache()
	{
		$this->data['title'] = "UpdateCache";
		$this->load->view('mzsj/com_header',$this->data);
		// jia zai geng xin hanshu
		$this->updatecache->rolecache();
		$data['caches'][] = '更新用户组缓存成功！';
		$this->updatecache->admincache();
		$data['caches'][] = '更新管理员缓存成功！';
		// addlog
		$this->addlog('UpdateCache');
		$this->load->view('mzsj/home_allcache',$data);
		// $this->msg('UpdateCache Success!','mzsj/home/loglist');
		$this->load->view('mzsj/com_footer');
	}
}
