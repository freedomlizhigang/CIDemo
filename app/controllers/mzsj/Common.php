<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
 * @package	Common
 * @author	李潇喃
 * @copyright	Copyright (c) 2015 - 2017,
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://www.muzisheji.com
 * @since	Version 1.0.0
*/

class Common extends CI_Controller {
	private $data;
	public function __construct()
	{
		parent::__construct();
		// load CheckClass and CheckPriv
		$this->load->model('admin_model');
		$this->config->load('publicpath');
		$this->data['css_path'] = $this->config->item('css_path');
		$this->data['js_path'] = $this->config->item('js_path');
		$this->data['img_path'] = $this->config->item('img_path');
	}
	// 登陆
	public function index()
	{
		redirect('/mzsj/Common/login');
	}
	public function login()
	{
		if ($this->session->mzsj_aid != null) 
		{
			$this->msg('已经登陆过，即将跳转到用户中心！','mzsj/home/index');
			return;
		}
		else
		{
			$data = $this->data;
			$data['title'] = "木子设计管理中心登陆";
			if (isset($_POST['dosubmit']) && $this->form_validation->run('login_rules')) 
			{
				// 判断验证码
				$verify = $this->input->post('verify');
				if ($verify != $this->session->verifytext)
				{
					$this->msg('验证码错误！','mzsj/common/login');
					return;
				}
				if (time() - 600 > $this->session->verifytime)
				{
					$this->msg('验证码超时！','mzsj/common/login');
					return;
				}
				// 查询数据并验证用户
				$select_sql = "adminname = '".$this->input->post('username')."'";
				$user = $this->admin_model->getOne('*',$select_sql);
				// 不存在用户
				if (empty($user)) {$this->msg('用户不存在！','mzsj/common/login');return;}
				// 用户存在，判断密码
				$inputpwd = md5(md5($this->input->post('password').$user['encrypt']));
				if ($user['password'] === $inputpwd) 
				{
					$this->session->mzsj_aid = $user['adminid'];
					$this->session->mzsj_rid = $user['roleid'];
					$this->msg('登陆成功，即将跳转到管理中心！','mzsj/home/index');
					return;
				}
				else
				{
					$this->msg('密码输入错误','mzsj/common/login');
					return;
				}
			}
			else
			{	
				$this->load->view('mzsj/common_login',$data);
			}
		}
	}
	// 退出登陆
	public function logout(){
		$this->session->sess_destroy();
		$this->msg('退出登陆成功！','mzsj/common/login');
		return;
	}
	// 验证码
	public function verify($w = 100,$h = 28)
	{
		// 删除10分钟前的图片
		$this->load->helper('file');
		$files = get_dir_file_info('./uploads/captcha/');
		foreach ($files as $fname => $v) {
			if ($v['date'] + 600 < time()) {
				unlink($v['server_path']);
			}
		}
		// 生成新验证码
		$this->load->helper('captcha');
		$vals = array(
		    'img_path'  => './uploads/captcha/',
		    'img_url'   => 'http://www.ci.com/uploads/captcha/',
		    'img_width' => $w,
		    'img_height'    => $h,
		    'expiration'    => 600,
		    'word_length'   => 5,
		    'font_path' => './public/font/georgia.ttf',
		    'font_size' => 16,
		    'pool'      => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
		    // White background and border, black text and red grid
		    'colors'    => array(
		        'background' => array(205, 200, 205),
		        'border' => array(255, 255, 255),
		        'text' => array(0, 0, 0),
		        'grid' => array(255, 255, 255)
		    )
		);
		$cap = create_captcha($vals);
		$this->session->verifytext = $cap['word'];
		$this->session->verifytime = $cap['time'];
		echo $cap['image'];
	}
	// 跳转
	public function msg($msg = '',$url = '')
	{	
		$data = $this->data;
		$data['title'] = '跳转页面';
		$data['msg'] = $msg;
		$data['url'] = base_url($url);
		$this->load->view('mzsj/common_msg',$data);
	}
	/*
	* 上传图片
	* 先生成当天的上传子目录mkdir()，以此来分类图片
	*/
	public function kindupload()
	{
		$this->mkdir();
		$config['upload_path'] = './uploads/'.date('Ymd').'/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '2048'; //kb
		// $config['file_name'] = '';  //重命名方法
		$config['file_ext_tolower'] = true; //文件后缀名将转换为小写
		$config['encrypt_name'] = true; //文件名将会转换为一个随机的字符串
		$config['max_filename_increment'] = 10000; //同名文件最大自增数
		$this->load->library('upload', $config);
		/* 返回标准数据 */
        $return  = array('error' => 0, 'info' => '上传成功', 'data' => '');
        /* 记录附件信息 */
        // 字段是imgFile，由KindEditor生成的上传字段
		if(!$this->upload->do_upload('imgFile'))
        {
        	$return['error'] = 1;
            $return['message'] = $this->upload->display_errors();
        }
        else
        {
        	$return['url'] = '/uploads/'.date('Ymd').'/'.$this->upload->data()['file_name'];
        }
        exit(json_encode($return));
	}

	 /**
     * 创建保存文件的子目录
     */
    private function mkdir(){
        $dir = './uploads/'.date('Ymd').'/';
        if(is_dir($dir)){
            return true;
        }
        if(mkdir($dir, 0777, true)){
            return true;
        } else {
            exit(json_encode("子目录创建失败！"));
        }
    }
}