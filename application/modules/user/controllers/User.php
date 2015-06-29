<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	private $info = null;
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('M_user');
		
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        
		$this->info=$this->M_user->get_info();

	}
	public function index(){
		$this->login();
	}
	public function profile($error = null){
		if(!$this->M_user->check_login()){
			redirect('user/login','refresh');
		}
		$data['info']=$this->info;
		$data['error'] ='';
		if (isset($error)) {
			$data['error'] = $error;
		}
		
		$data['mat_khau_cu'] = array(
                                'type'  => 'password',
                                'name'  => 'mat_khau_cu',
                                'id'    => 'mat_khau_cu',
                                'class' => 'form-control',
                                'placeholder' => 'old password'
                        );
		$data['mat_khau'] = array(
                                'type'  => 'password',
                                'name'  => 'mat_khau',
                                'id'    => 'mat_khau',
                                'class' => 'form-control',
                                'placeholder' => 'new password'
                        );
		$data['mat_khau_2'] = array(
                                'type'  => 'password',
                                'name'  => 'mat_khau_2',
                                'id'    => 'mat_khau_2',
                                'class' => 'form-control',
                                'placeholder' => 'confrim new password'
                        );
		$data['sm'] = array(
                                'name'  => 'sm',
                                'value' => 'Cập nhật',
                                'class' => ' btn btn-default btn-success tbl_up'
                        );

		$this->load->view('V_profile',$data,FALSE);
	}
	public function login($v_error = null)
	{
		//print_r($this->M_user->check_login());
		if ($this->M_user->check_login()==1) {
			redirect('/home','refresh');
		}
		$info = $this->session->userdata('user');
        if($info['cap_bac']==1){
            redirect('home','refresh');
        } 
		$data['sdt']= array(
								'type'  => 'text',
                                'name'  => 'sdt',
                                'id'    => 'sdt',
                                'class' => 'form-control',
                                'placeholder'=>'Số điện thoại'
                        );
		$data['mat_khau']=array(
								'type'  => 'password',
                                'name'  => 'mat_khau',
                                'id'    => 'mat_khau',
                                'class' => 'form-control',
                                'placeholder'=>'Mật khẩu'
                        );
		$data['v_error']=((isset($v_error)?$v_error:""));
		$this->load->view('V_login',$data, FALSE);
	}
	public function active_login()
	{
		
		$this->form_validation->set_rules('sdt', 'số điện thoại', 'numeric|trim|required|min_length[10]|max_length[11]');
		$this->form_validation->set_rules('mat_khau', 'mật khẩu', 'trim|required|min_length[3]|max_length[20]');
		if ($this->form_validation->run() == FALSE)
        {
			return $this->login();

        }
		$data['v_error']='';
		$arr = $this->input->post(NULL, FALSE);
		if (empty($arr)) {
			//$data['v_error']='Truy cập lỗi';
			$this->load->view('home/V_error');
			return;
		}
		$login = $this->M_user->create_login($arr['sdt'],$arr['mat_khau']);
		if ($login == 0) {
			$data['v_error']="Sai thông tin tài khoản";
			$this->login($data['v_error']);
		}else{
			redirect('/home','refresh');
		}
	}

	public function logout(){
		$this->session->unset_userdata('user');
		redirect('/user/login','refresh');
	}

	public function set_pass(){
		$arr = $this->input->post(NULL, FALSE);
		if (empty($arr)) {
			$this->load->view('home/V_error');
			return;
		}
		$error = '';
		//print_r($arr);
		$this->form_validation->set_rules('mat_khau', 'New pass', 'trim|required|min_length[3]|max_length[12]');
		$this->form_validation->set_rules('mat_khau_2', 'Password Confirmation', 'trim|required|matches[mat_khau]');
		$this->form_validation->set_rules('mat_khau_cu', 'Old pass', 'required');
		if ($this->form_validation->run() == FALSE)
	    {
            $this->profile();
	    }else{
	    	/*if ($arr['mat_khau'] != $arr['mat_khau_2']) {
	    		$error='Mật khẩu nhập lại không đúng';
	    		$this->profile($error);
	    		return;
	    	}*/
	    	//print_r($this->M_user->check_user($this->info->sdt,$arr['mat_khau_cu']));
	    	if (!$this->M_user->check_user($this->info->sdt,$arr['mat_khau_cu'])) {
	    		$error='Mật khẩu cũ không đúng';
	    		$this->profile($error);
	    		return;
	    	}
	    	unset($arr['mat_khau_cu']);
	    	unset($arr['mat_khau_2']);
	    	unset($arr['sm']);
	    	$arr['sdt']=$this->info->sdt;
	    	$this->M_user->updata_pass($arr);
	    	$error='Đổi thành công';
	    		$this->profile($error);
	    		return;
	    }
	}

	public function updata($tam = null,$sdt = null){
		//check quyen dang nhap
        if(!$this->M_user->check_login()){
            redirect('user/login','refresh');
        }
        $info = $this->session->userdata('user');
        if($info['cap_bac']==1){
            redirect('home','refresh');
        } 
		$mail='';
		$ho='';
		$ten='';
		$mat_khau='';
		$cap_bac='';
		$data['cap_nhat']="them";
		$v_sm="Thêm";
		if (!isset($sdt)) {
            $sdt = $this->uri->segment(3,null);
        }
		
		$data['sdt']=array(
							'type'  => 'text',
                            'name'  => 'sdt',
                            'id'    => 'sdt',
                            'value' => $sdt,
                            'class' => 'form-control',
                            'placeholder'=>'Nhập số điện thoại'
						);
		$data['cap_bac']= array('1'=>'user','2'=>'admin');
		$data['v_cap_bac']='';
		if ($sdt != null && $tam!="del") {
			if ($this->M_user->check_giaovien($sdt)==0) {
				return $this->load->view('home/V_error');
			}
			$info = $this->M_user->get_info($sdt);
			$mail=$info->mail;
			$ho=$info->ho;
			$ten=$info->ten;
			
			$data['v_cap_bac']=$info->cap_bac;
			$data['cap_nhat']="sua";
			$v_sm="Cập nhật";
			$data['sdt']=array(
							'type'  => 'text',
                            'name'  => 'sdt',
                            'id'    => 'sdt',
                            'value' => $sdt,
                            'class' => 'form-control',
                            'readonly' => 'readonly',
                            'placeholder'=>'Nhập số điện thoại'
						);
		}
		
		$data['mail']=array(
							'type'  => 'email',
                            'name'  => 'mail',
                            'id'    => 'mail',
                            'value' => $mail,
                            'class' => 'form-control',
                            'placeholder' => 'exam@gmail.com'
						);
		$data['ho']=array(
							'type'  => 'text',
                            'name'  => 'ho',
                            'id'    => 'ho',
                            'value' => $ho,
                            'class' => 'form-control',
                            'placeholder' => 'Nhập họ của bạn'
						);
		$data['ten']=array(
							'type'  => 'text',
                            'name'  => 'ten',
                            'id'    => 'ten',
                            'value' => $ten,
                            'class' => 'form-control',
                            'placeholder' => 'Nhập tên của bạn'
						);
		$data['mat_khau']=array(
							'type'  => 'password',
                            'name'  => 'mat_khau',
                            'id'    => 'mat_khau',
                            'value' => $mat_khau,
                            'class' => 'form-control',
                            'placeholder' => 'Nhập mật khẩu'
						);
		$data['sm'] = array(
                                'name'  => 'sm',
                                'value' => $v_sm,
                                'class' => 'btn btn-default btn-success tbl_up'
                        );
		$arr= array('active','success','info','warning','danger');
		$list_user=$this->M_user->list_user();
		$stt=1;
		$i=0;
		$str='';
		foreach ($list_user as $k) {
			$cap_bac = ($k->cap_bac == 1) ? "user":"admin";
			$url_up=base_url('user/updata/'.$k->sdt);
			$url_del=base_url('user/delete/'.$k->sdt);
			$str .='<tr class="'.$arr[$i++].'">
                  <td>'.$stt++.'</td>
                  <td>'.$k->sdt.'</td>
                  <td>'.$k->mail.'</td>
                  <td>'.$k->ho.'</td>
                  <td>'.$k->ten.'</td>
                  <td>'.$cap_bac.'</td>
                  <td class="text-center"><a href="'.$url_up.'">Edit</a>
                        || <a href="javascript:confirmDelete(\''.$url_del.' \')">Del</a>
                  </td>
                </tr>';
            $i = ($i==4)? 0:$i;
		}
		$data['str']=$str;
		$this->load->view('V_updata',$data,FALSE);
	}

	public function them(){
		$this->form_validation->set_rules('sdt', 'So Dien Thoai', 'trim|required|min_length[10]|max_length[11]');
		$this->form_validation->set_rules('mail', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('ho', 'Ho', 'trim|required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('ten', 'Ten', 'trim|required|min_length[2]|max_length[15]');
		$this->form_validation->set_rules('mat_khau', 'Mat Khau', 'trim|required|min_length[2]|max_length[12]');
        if ($this->form_validation->run() == FALSE)
        {
            return $this->updata();
        }
        $fld=($this->input->post(NULL, FALSE));
        if (empty($fld)) {
            $this->load->view('home/V_error');
            return;
        }
        $fld['mat_khau']= md5($fld['mat_khau']);
		unset($fld['sm']);
		 if ($this->M_user->check_giaovien($fld['sdt']) != 0) {
            $data['errors']='Dữ liệu thêm đã tồn tại.';
            $data['url'] = 'user/updata';
            $this->load->view('theo_doi/V_errors',$data);
            return;
        }
        $this->M_user->insert_user($fld);
        $this->updata();

	}

	public function sua(){
		$fld=($this->input->post(NULL, FALSE));
        if (empty($fld)) {
               $this->load->view('home/V_error');
                return;
        }
		$this->form_validation->set_rules('mail', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('ho', 'Ho', 'trim|required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('ten', 'Ten', 'trim|required|min_length[2]|max_length[15]');
        
		if ($this->form_validation->run() == FALSE)
        {
            return $this->updata(null,$fld['sdt']);
        }
        //print_r($fld);
		if ($fld['mat_khau']!=null) {
			$fld['mat_khau']=md5($fld['mat_khau']);
		}else{
			unset($fld['mat_khau']);
		}
		unset($fld['sm']);
		$this->M_user->updata_user($fld);
		$this->updata();
	}

	public function delete(){
        $sdt = $this->uri->segment(3,null);
        if ($sdt == null || $this->M_user->check_giaovien($sdt) == 0){
            return $this->load->view('home/V_error');
        }else{
        	$this->M_user->delete_user($sdt);
        	$this->updata('del');
        }
        
	}

}

/* End of file User.php */
/* Location: ./application/modules/user/controllers/User.php */