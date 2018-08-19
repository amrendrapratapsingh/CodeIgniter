<?php

class My_first_controller extends CI_controller
{
	public function f1()
	{
		$this->load->view('my_first_view');
	}
	public function f2()
	{
		$this->load->view('my_second_view');
	}
}
?>