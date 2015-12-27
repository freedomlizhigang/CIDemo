<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		echo $this->router->fetch_class();
		echo "<br />";
		echo $this->router->fetch_method();
		echo "<br />";
		echo $this->uri->rsegment(1);
		$data['title'] = "Is News!";
		$this->load->view('pages_index',$data);
	}
	public function view($slug = NULL)
	{
		$data['news_item'] = $this->news_model->get_news($slug);
		if (empty($data['news_item'])) 
		{
			show_404();
		}
		$data['title'] = $data['news_item']['text'];
		$this->load->view('pages_view',$data);
	}
	public function create()
	{
		$data['title'] = 'Create a News item';
		$this->form_validation->set_rules('title','Title','required');
		$this->form_validation->set_rules('text','Text','required');
		if ($this->form_validation->run() === FALSE) 
		{
			$this->load->view('pages_create',$data);
		}
		else
		{
			$this->news_model->set_news();
			$this->load->view('pages_success');
		}
	}
}
