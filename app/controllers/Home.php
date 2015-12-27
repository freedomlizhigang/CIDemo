<?php
defined('BASEPATH') OR exit('No direct script access allowed');
my_load_class('Pages','controllers');
class Home extends Pages {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// $this->load->model('menu_model');
		// $this->load->database();
		// $sql = "SELECT * FROM mzsj_menu WHERE parentid = 0 and display = 1 ORDER BY menuid ASC LIMIT 1000";
		// $query =  $this->db->query($sql)->result_array();
		// $query = $this->menu_model->getAll();
		// var_dump($query);
		$this->output->enable_profiler(TRUE);
		$this->load->view('home_index');
	}
}
