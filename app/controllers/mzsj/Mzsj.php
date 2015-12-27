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
class Mzsj extends CI_Controller {
	public $data,$Mname,$Cname,$Aname;
	public function __construct(){
		parent::__construct();
		// 启用程序分析
		// $this->output->enable_profiler(TRUE);
		// 加载类库
		$this->load->library('updatecache');
		// 取得当前URL路径
		$this->data['Mname'] = $this->Mname = $this->uri->segment(1);
		$this->data['Cname'] = $this->Cname = $this->uri->segment(2);
		$this->data['Aname'] = $this->Aname = $this->uri->segment(3);
		// 如果输入的不是  模块/控制器/方法名  跳转到首页
		if (empty($this->Mname) || empty($this->Cname) || empty($this->Aname)) {
			redirect('/');
		}
		$this->config->load('publicpath');
		$this->data['css_path'] = $this->config->item('css_path');
		$this->data['js_path'] = $this->config->item('js_path');
		$this->data['img_path'] = $this->config->item('img_path');
		$this->load->model('menu_model');
		$this->data['rightmenu'] = $this->getsubmenu();
		// 判断登陆状态
		$this->islogin();
		// 取得用户信息
		$this->getinfo();
		// 检查权限
		$this->check_priv();
		$this->load->driver('cache',array('adapter'=>'apc','backup'=>'file','key_prefix'=>'mz_'));
	}
	// 判断是否登陆
	private function islogin(){
		if($this->session->mzsj_aid == null || $this->session->mzsj_rid == null)
		{
			$this->data['title'] = '';
			$this->load->view('mzsj/com_header',$this->data);
			$this->msg("请先登陆后台，再进行操作！",'mzsj/common/login');
			$this->load->view('mzsj/com_footer');
			$this->output->_display();
			exit;
		}
		else
		{
			return;
		}
	}
	// 取用户信息
	private function getinfo()
	{
		$adminid = $this->session->mzsj_aid;
		$this->load->model('admin_model');
		$this->data['Ainfo'] = $this->admin_model->getOne('*','adminid = '.$adminid);
		if (empty($this->data['Ainfo']))
		{
			$this->data['title'] = '';
			$this->load->view('mzsj/com_header',$this->data);
			$this->msg("请先登陆后台，再进行操作吧！",'mzsj/common/login');
			$this->load->view('mzsj/com_footer');
			$this->output->_display();
			exit;
		}
		return;
	}
	// 检查权限
	final function check_priv(){
		// 登陆及左侧菜单权限读取不做限制
		if($this->Mname =='mzsj' && $this->Cname =='common' && $this->Aname =='login') return true;
		if($this->Mname =='mzsj' && $this->Cname =='home' && $this->Aname =='left_menu') return true;
		if($this->session->mzsj_rid == 1) return true;
		$this->load->model('admin_priv_model');
		$nowurl = $this->Mname.'/'.$this->Cname.'/'.$this->Aname;
		$where = "url = '".$nowurl."' and roleid = ".$this->session->mzsj_rid;
		$res = $this->admin_priv_model->getOne('*',$where);
		if (!is_array($res))
		{
			$this->data['title'] = '';
			$this->load->view('mzsj/com_header',$this->data);
			$this->msg("您没有这个操作的权限！",$_SERVER['HTTP_REFERER'],1);
			$this->load->view('mzsj/com_footer');
			$this->output->_display();
			exit;
		}
		return;
	}
	// 找出所有有权限的url
	private function privurl(){
		if (empty($this->session->role_url)) {
			$this->load->model('admin_priv_model');
			$list = $this->admin_priv_model->getAll('*','roleid = '.$this->session->mzsj_rid);
			$this->session->role_url = $list;
		}
		return $this->session->role_url;
	}
	/*
	* 按父级查找菜单
	* pid 父级id 找到下级子栏目
	*/
	public function findmenu($pid = 0){
		$pid = intval($pid);
		$sql = 'parentid = '.$pid.' and display = 1';
		$menus = $this->menu_model->getAll('*',$sql,1000,'listorder ASC,menuid ASC');
		// 取出所有可以显示的菜单
		$privmenu = $this->privurl();
		$array = array();
		foreach ($menus as $mv) {
			if (is_array($privmenu)) {
				foreach ($privmenu as $pv) {
					if($mv['url'] == $pv['url']){
						$array[] = $mv;
					}
				}
			}
		}
		// 超级管理员拥有所有权限
		if ($this->session->mzsj_rid == 1) {
			$array = $menus;
		}
		return $array;
	}
	// 输出导航菜单
	private function getsubmenu(){
		$privmenu = $this->privurl();
		$submenus = array();
		$url = $this->Mname."/".$this->Cname."/".$this->Aname;
		$sql_submenu = "url = '".$url."'";
		$menuid = $this->menu_model->getOne('menuid,name,parentid,url',$sql_submenu);
		$tempsub = array();
		if ($menuid) {
			$sql_submenus = 'display = 1 and parentid = '.$menuid['menuid'];
			$submenus = $this->menu_model->getAll('*',$sql_submenus,100);
			if ($this->session->mzsj_rid == 1) {
				$tempsub = $submenus;
			}else{
				foreach ($submenus as $privsub) {
					if (is_array($privmenu)) {
						foreach ($privmenu as $pvsub) {
							if($privsub['url'] == $pvsub['url']){
								$tempsub[] = $privsub;
							}
						}
					}
				}
			}
		}
		return $tempsub;
	}
	// redirect Msg
	public function msg($con,$url = '',$goback = 0){
		$data['content'] = $con;
		$data['url'] = base_url($url);
		$goback = $url == '' ? 1 : 0;
		$this->load->view('mzsj/com_msg',$data);
		return;
	}
	// output Pages
	public function viewPages($baseUrl = '',$totalRows = '',$perPage = '',$uriSegment = ''){
		$this->load->library('pagination');
		$pconf['use_page_numbers'] = TRUE;
		$pconf['base_url'] = base_url($baseUrl);
		$pconf['total_rows'] = $totalRows;
		$pconf['per_page'] = $perPage;
		$pconf['uri_segment'] = $uriSegment;
		$this->pagination->initialize($pconf);
		return $this->pagination->create_links();
	}
	// ListToTree
	// 输出树形菜单
	protected $resarray = array();
	public function list_to_tree($model = '',$pkname = '',$parentidname = '',$pid = 0 ,$level = 0 ,$jg = '',$field = '*')
	{
		$number = 1;
		$this->load->model($model);
		$sql = $parentidname.' = '.$pid;
		$lists = $this->$model->getTree($field,$sql,100,'listorder ASC,'.$pkname.' ASC');
		if (is_array($lists)) {
			// 计算子菜单总数，如果有下级菜单，层数+1
			$level++;
			$total = count($lists);
			foreach($lists as $ml){
				// 判断是不是最后一个，最后一个用“ └ ”分隔
				$j=$k='';
				if($number==$total){
					$j .= '└ ';
				}else{
					$j .= '├ ';
				}
				// 为拼接下一级循环用的分隔符做准备
				$k = $jg ? '│ ' : '';
				// 保存分隔符
				$ml['nbsp'] = $jg ? $jg.$j : '';
				$ml['level'] = $level;
				$this->resarray[] = $ml;
				$this->list_to_tree($model,$pkname,$parentidname,$ml[$pkname],$level,$jg.$k.'&nbsp');
				$number++;
			}
		}
		return $this->resarray;
	}
	// 转换是：否
	public function statusname($list,$newzd='',$oldzd='',$font1 = '是',$font2 = '否')
	{
		foreach ($list as $key => $value) {
			$list[$key][$newzd] = $value[$oldzd] ? "<span class='color_green'>".$font1."</span>" : "<span class='color_red'>".$font2."</span>";
		}
		return $list;
	}
	// delChild
	public function delchild($model = '',$pkname = '',$parentid = '',$pid = '')
	{
		$this->load->model($model);
		$sql = $parentid.' = '.$pid;
		$res = $this->$model->getAll($pkname,$sql);
		if ($res)
		{
			foreach ($res as $v) {
				$delsql = $pkname.' = '.$v[$pkname];
				$r = $this->$model->deleteOne($delsql);
				// addlog
				$this->addlog($delsql);
				$this->delchild($model,$pkname,$parentid,$v[$pkname]);
			}
		}
		return true;
	}
	// AddLog
	public function addlog($q = '')
	{
		$this->load->model('log_model');
		$data['adminid'] = '1';
		$data['adminname'] = '1';
		$data['url'] = '/'.$this->Mname.'/'.$this->Cname.'/'.$this->Aname.'/';
		$data['data'] = $q;
		$data['ip'] = $this->input->ip_address();
		$data['time'] = time();
		$this->log_model->insertOne($data);
	}
}