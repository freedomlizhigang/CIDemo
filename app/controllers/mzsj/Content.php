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
class Content extends Mzsj
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('category_model');
		$this->load->model('article_model');
	}
	/*
	* 栏目列表
	*/
	public function cate()
	{
		$this->data['title'] = "栏目列表";
		$this->load->view('mzsj/com_header',$this->data);
		// load catetree
		$data['tree'] = $this->list_to_tree($model = 'category_model',$pkname = 'catid',$parentidname = 'parentid',$pid = 0);
		// 是否菜单显示
		$data['tree'] = $this->statusname($data['tree'],'displayname','ismenu');
		// 单网页
		$data['tree'] = $this->statusname($data['tree'],'ispage','ispage');
		// 外链接
		$data['tree'] = $this->statusname($data['tree'],'islink','islink');
		$this->load->view('mzsj/content_cate',$data);
		$this->load->view('mzsj/com_footer');
	}
	/*
	* 添加栏目
	* 不指定父栏目时为一级栏目pid = 0
	*/
	public function addcate($pid = 0)
	{
		$this->data['title'] = "添加栏目";
		$this->load->view('mzsj/com_header',$this->data);
		if (isset($_POST['dosubmit']) && $this->form_validation->run('category_rules'))
		{
			$insertData = $this->input->post('info[]');
			$res = $this->category_model->insertOne($insertData);
			if ($res)
			{
				// addlog
				$this->addlog('catid = '.$res);
				// update admincache
				$this->updatecache->catecache();
				$this->msg('AddCategory Success!','mzsj/content/cate');
			}
			else
			{
				$this->msg('AddCategory Error!');
			}
		}
		else
		{
			$data['pid'] = (int)$pid ? (int)$pid : 0;
			$this->load->view('mzsj/content_addcate',$data);
		}
		$this->load->view('mzsj/com_footer');
	}
	/*
	* 修改栏目
	* 
	*/
	public function editcate($cid = 0)
	{
		$this->data['title'] = "修改栏目";
		$this->load->view('mzsj/com_header',$this->data);
		$cid = (int)$cid ? (int)$cid : 0;
		if ($cid !== 0)
		{
			if (isset($_POST['dosubmit']) && $this->form_validation->run('category_rules'))
			{
				$data = $this->input->post('info[]');
				if ($cid == $data['parentid']) {
					$this->msg('上级栏目不能是自身!');
					return;
				}
				// 更新
				$res = $this->category_model->updateOne(array('catid'=>$cid),$data);
				if ($res)
				{
					// addlog
					$this->addlog('catid = '.$res);
					// update admincache
					$this->updatecache->catecache();
					$this->msg('EditCategory Success!','mzsj/content/cate');
				}
				else
				{
					$this->msg('EditCategory Error!');
				}
			}
			else
			{
				$data['info'] = $this->category_model->getOne('*',array('catid'=>$cid));
				$data['catetree'] = $this->list_to_tree($model = 'category_model',$pkname = 'catid',$parentidname = 'parentid',$pid = 0,$jg = '&nbsp;',$field = 'catid,catname');
				$this->load->view('mzsj/content_editcate',$data);
			}
		}
		else
		{
			$this->msg('参数错误');
		}
		$this->load->view('mzsj/com_footer');
	}
	/*
	* 删除栏目
	*/
	public function delcate($cid = null)
	{
		$this->data['title'] = "删除栏目";
		$this->load->view('mzsj/com_header',$this->data);
		if (isset($_POST['dosubmit']))
		{
			$cids = $this->input->post('cids[]');
			foreach ($cids as $c) {
				$res = $this->delchildcat($c);
				if ($res !== true)
				{
					$this->msg('栏目'.$res.'下有文章，请先删除文章!','mzsj/content/cate');
					return;
				}
				else
				{
					continue;
				}
			}
			// 记录用户行为
			$cids = arr2str($cids);
			$this->addlog("catid=$cids");
		}
		else
		{
			if ($cid == NULL || (int)$cid <= 0) 
			{
				$this->msg('Parameter Error!','mzsj/content/cate');
			}
			else
			{
				$res = $this->delchildcat((int)$cid);
				if ($res === true) {
					// 记录用户行为
					$this->addlog("catid=$cid");
				}else{
					$this->msg('栏目'.$res.'下有文章，请先删除文章!','mzsj/content/cate');
					return;
				}
			}
		}
		$this->updatecache->catecache();
		$this->msg('Delete Success!','mzsj/content/cate');
		$this->load->view('mzsj/com_footer');
	}
	// 真正的删除操作
	private function delchildcat($cid)
	{
		// 找出所有子栏目及自身
		$strchild = $this->category_model->getOne('catid,arrchildid',array('catid'=>$cid));
		$arrchild = str2arr($strchild['arrchildid']);
		// 判断子栏目或者自身下是否有文章
		foreach ($arrchild as $c) {
			if ($this->article_model->getOne('artid,catid',array('catid'=>$c))) {
				return $c;
			}
			else
			{
				continue;
			}
		}
		$this->category_model->deleteOne("catid in(".$strchild['arrchildid'].")");
		return true;
	}
}