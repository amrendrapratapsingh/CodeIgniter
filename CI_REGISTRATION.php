 register_view.php
<style>
.err
{
color:red;
}
</style>

<p style="color:green">
<?php
echo $msg;
?>
</p>
<?php //echo validation_errors();?>
<form method="post" action="<?php echo base_url();?>index.php/user_controller/register_now">
Name : <input type="text" name="name" value="<?php echo set_value('name');?>">
<?php echo form_error('name');?>
<br/><br/>
Email : <input type="text" name="email">
<?php echo form_error('email');?>

<br/><br/>
Mobile : <input type="text" name="mobile"><br/><br/>
Password : <input type="password" name="password"><br/><br/>
<input type="submit" name="register" value="Register"><br/><br/>
</form>

User_controller.php
<?php
class User_controller extends CI_controller
{
public function register_load_view()
{
$data=array();
$data['msg']="";
$this->load->view('register_view',$data);
}
public function register_now()
{
$this->load->library('form_validation');
$this->form_validation->set_rules('name','Username','required|alpha',array('required'=>'Name is required','alpha'=>'Invalid name'));
$this->form_validation->set_rules('email','Useremail','required|valid_email');
$this->form_validation->set_error_delimiters('<span class="err">','</span>');
if($this->form_validation->run())
{
extract($_POST);
if(isset($register))
{
$data=array(
'name'=>$name,
'email'=>$email,
'mobile'=>$mobile,
'password'=>$password
);
$this->load->model('user_model');
$resp=$this->user_model->user_register($data);
$view_data=array();
if($resp==1)
$view_data['msg']="Registration success";
if($resp==2)
$view_data['msg']="Registration failed";
if($resp==3)
$view_data['msg']="Email already exists";
$this->load->view('register_view',$view_data);
}
else
echo "Invalid request";
}
else
{
$data=array();
$data['msg']="";
$this->load->view('register_view',$data);
}
}

public function backup()
{
extract($_POST);
if(isset($register))
{
$data=array(
'name'=>$name,
'email'=>$email,
'mobile'=>$mobile,
'password'=>$password
);
$this->load->model('user_model');
$resp=$this->user_model->user_register($data);
$view_data=array();
if($resp==1)
$view_data['msg']="Registration success";
if($resp==2)
$view_data['msg']="Registration failed";
$this->load->view('register_view',$view_data);
}
else
echo "Invalid request";
}

}
?>
User_model.php
<?php
class User_model extends CI_model
{
public function user_register($pdata)
{
$this->db->select('email');
$this->db->from('users_tbl');
$this->db->where('email',$pdata['email']);
$res=$this->db->get();
$count=$res->num_rows();
if($count>0)
{
return 3;
}
else
{
$resp=$this->db->insert('users_tbl',$pdata);
if($resp)
return 1;
else
return 2;
}
}
}

?>