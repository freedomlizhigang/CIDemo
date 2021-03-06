<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Updatecache {
	protected $CI;
	public function __construct()
	{
		$this->CI = & get_instance();
		$this->CI->load->driver('cache',array('adapter'=>'apc','backup'=>'file','key_prefix'=>'mz_'));
	}
	// rolecache
	public function rolecache()
	{
		$this->CI->load->model('role_model');
		$cache = $this->CI->role_model->getAll();
		$tempArr = array();
		foreach ($cache as $v) {
			$tempArr[$v['roleid']] = $v;
		}
		$this->CI->cache->save('rolecache',$tempArr,0);
	}
	// admincache
	public function admincache()
	{
		$this->CI->load->model('admin_model');
		$cache = $this->CI->admin_model->getAll('adminid,adminname,realname,email,tel');
		$tempArr = array();
		foreach ($cache as $v) {
			$tempArr[$v['adminid']] = $v;
		}
		$this->CI->cache->save('admincache',$tempArr,0);
	}
	// 栏目缓存
	public function catecache(){
		$this->CI->load->model('category_model');
		$categorys = array();
		$categorys = $this->CI->category_model->getAll('*',NULL,'1000','catid ASC');
		// 将数组索引转化为typeid，phpcms v9的select方法支持定义数组索引，这个坑花了两小时
		$categorys = $this->get_categorys($categorys,'catid');
		if(is_array($categorys)) {
			foreach($categorys as $catid => $cat) {
				// 取得所有父栏目
				$arrparentid = $this->get_arrparentid($catid,$categorys);
				$arrchildid = $this->get_arrchildid($catid,$categorys);
				$child = is_numeric($arrchildid) ? 0 : 1;
				// 如果父栏目数组、子栏目数组，及是否含有子栏目不与原来相同，更新
				if($categorys[$catid]['arrparentid']!=$arrparentid || $categorys[$catid]['arrchildid']!=$arrchildid || $categorys[$catid]['child']!=$child){
					$this->CI->category_model->updateOne(array('catid'=>$catid),array('catid'=>$catid,'arrparentid'=>$arrparentid,'arrchildid'=>$arrchildid,'child'=>$child));
				}
			}
		}
		//删除在非正常显示的栏目
		foreach($categorys as $cat) {
			if($cat['parentid'] != 0 && !isset($categorys[$cat['parentid']])) {
				$this->CI->category_model->deleteone(array('catid'=>$cat['catid']));
			}
		}
		$newlist = $this->CI->category_model->getAll('*',NULL,'1000','catid ASC');
		$tmparr = array();
		foreach ($newlist as $v) {
			$tmparr[$v['catid']] = $v;
		}
		$this->CI->cache->save('catecache',$tmparr,0);
	}
	/**
	 * 以索引重排结果数组
	 * @param array $categorys
	 * $zhujian 主键
	 */
	private function get_categorys($categorys = array() ,$zhujian = '') {
		if (is_array($categorys) && !empty($categorys)) {
			$temparr = array();
			foreach ($categorys as $c) {
				// 以主键做为数组索引
				$temparr[$c[$zhujian]] = $c;
			}
		} 
		return $temparr;
	}
	/**
	 * 
	 * 获取父栏目ID列表
	 * @param integer $catid              栏目ID
	 * @param array $arrparentid          父目录ID
	 * @param integer $n                  查找的层次
	 */
	private function get_arrparentid($catid, $categorys, $arrparentid = '', $n = 1) {
		if($n > 10 || !is_array($categorys) || !isset($categorys[$catid])) return false;
		$parentid = $categorys[$catid]['parentid'];
		$arrparentid = $arrparentid ? $parentid.','.$arrparentid : $parentid;
		// 父ID不为0时
		if($parentid) {
			$arrparentid = $this->get_arrparentid($parentid, $categorys, $arrparentid, ++$n);
		} else {
			// 如果父ID为0
			$categorys[$catid]['arrparentid'] = $arrparentid;
		}
		$parentid = $categorys[$catid]['parentid'];
		return $arrparentid;
	}
	/**
	 * 
	 * 获取子栏目ID列表
	 * @param $catid 栏目ID
	 */
	private function get_arrchildid($catid, $categorys) {
		$arrchildid = $catid;
		if(is_array($categorys)) {
			foreach($categorys as $id => $cat) {
				if($cat['parentid'] && $id != $catid && $cat['parentid']==$catid) {
					$arrchildid .= ','.$this->get_arrchildid($id, $categorys);
				}
			}
		}
		return $arrchildid;
	}
}