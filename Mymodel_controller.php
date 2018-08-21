<?php

 class Mymodel_controller extends CI_controller
 {
	 public function test()
	 {
		 $this->load->model('Myfirst_model');
		 $this->Myfirst_model->f1();
	 }
 }
?>