<?php
$config = array(
	'site_rules' => array(
		array(
			'field' => 'info[name]',
			'label' => 'Sitename',
			'rules' => 'trim|is_unique[site.name.siteid]|min_length[2]|max_length[15]',
		),
		array(
			'field' => 'info[siteurl]',
			'label' => 'SiteUrl',
			'rules' => 'trim|min_length[5]|valid_url',
		),
		array(
			'field' => 'info[sitename]',
			'label' => 'Sitename',
			'rules' => 'trim|min_length[2]|max_length[30]',
		),
		array(
			'field' => 'info[keyword]',
			'label' => 'Keyword',
			'rules' => 'trim|min_length[2]|max_length[50]',
		),
		array(
			'field' => 'info[description]',
			'label' => 'Description',
			'rules' => 'trim|min_length[2]|max_length[200]',
		),
		array(
			'field' => 'info[linkman]',
			'label' => 'LinkMan',
			'rules' => 'trim|min_length[2]|max_length[10]',
		),
		array(
			'field' => 'info[tel]',
			'label' => 'Tel',
			'rules' => 'trim|is_natural|exact_length[11]',
		),
		array(
			'field' => 'info[qq]',
			'label' => 'Q Q',
			'rules' => 'trim|is_natural|max_length[15]',
		),
		array(
			'field' => 'info[address]',
			'label' => 'Address',
			'rules' => 'trim|min_length[2]|max_length[50]',
		),
		array(
			'field' => 'info[contact]',
			'label' => 'Contact',
			'rules' => 'trim|min_length[2]|max_length[15]',
		),
		array(
			'field' => 'info[template]',
			'label' => 'Template',
			'rules' => 'trim|min_length[2]|max_length[50]',
		),
	),
	'menu_rules' => array(
		array(
			'field' => 'info[name]',
			'label' => 'Name',
			'rules' => 'trim|required|is_unique[menu.name.menuid]|max_length[10]'
		),
		array(
			'field' => 'info[url]',
			'label' => 'Url',
			'rules' => 'trim|required|max_length[50]'
		),
		array(
			'field' => 'info[listorder]',
			'label' => 'Listorder',
			'rules' => 'trim|required'
		)
	),
	'role_rules' => array(
		array(
			'field' => 'info[rolename]',
			'label' => 'Name',
			'rules' => 'trim|required|is_unique[role.rolename.roleid]|max_length[10]'
		)
	),
	'admin_rules' => array(
		array(
			'field' => 'info[adminname]',
			'label' => 'Name',
			'rules' => 'trim|is_unique[admin.adminname.adminid]|max_length[10]'
		),
		array(
			'field' => 'info[realname]',
			'label' => 'Realname',
			'rules' => 'trim|required|max_length[10]',
		),
		array(
			'field' => 'info[roleid]',
			'label' => 'Role',
			'rules' => 'trim|required',
		),
		array(
			'field' => 'info[password]',
			'label' => 'Password',
			'rules' => 'min_length[6]|max_length[15]',
		),
		array(
			'field' => 'repassword',
			'label' => 'repassword',
			'rules' => 'matches[info[password]]',
		),
		array(
			'field' => 'info[email]',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email',
		),
		array(
			'field' => 'info[tel]',
			'label' => 'Tel',
			'rules' => 'trim|required|is_natural|min_length[7]|max_length[11]',
		),
	),
	'admin_editpwd' => array(
		array(
			'field' => 'oldpassword',
			'label' => 'oldpassword',
			'rules' => 'required|min_length[6]|max_length[15]',
		),
		array(
			'field' => 'info[password]',
			'label' => 'Password',
			'rules' => 'required|min_length[6]|max_length[15]',
		),
		array(
			'field' => 'repassword',
			'label' => 'repassword',
			'rules' => 'matches[info[password]]',
		),
	),
	'login_rules' => array(
		array(
			'field' => 'username',
			'label' => 'Name',
			'rules' => 'trim|required|max_length[10]'
		),
		array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'required|min_length[6]|max_length[15]',
		),
	),
	'category_rules' => array(
		array(
			'field' => 'info[catname]',
			'label' => 'Catename',
			'rules' => 'trim|required|is_unique[category.catname.catid]|max_length[15]'
		),
		array(
			'field' => 'info[catdir]',
			'label' => 'Catdir',
			'rules' => 'trim|required|is_unique[category.catdir.catid]|max_length[15]',
		),
		array(
			'field' => 'info[content]',
			'label' => 'Content',
			'rules' => 'trim|required',
		),
	),
);