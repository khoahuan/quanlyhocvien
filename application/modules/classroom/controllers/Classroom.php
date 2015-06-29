<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classroom extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
        $this->load->model('user/M_user');
        //check quyen dang nhap
        if(!$this->M_user->check_login()){
            redirect('user/login','refresh');
        }
        $info = $this->session->userdata('user');
        if($info['cap_bac']==1){
            redirect('home','refresh');
        }
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$this->load->model('M_classroom');

	}

	public function index($tam = null,$ma_phong=null)
	{
		$data['cap_nhat']="them";
		if (!isset($ma_phong)) {
			$ma_phong = $this->uri->segment(3,null);
		}
		
		$ten_phong = '';
		$data['ma_phong']=array('type'  => 'text',
                                'name'  => 'ma_phong',
                                'id'    => 'ma_phong',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập mã phòng'
                            );
		$data['sm'] = array(
                                'name'  => 'sm',
                                'value' => 'Thêm',
                                'class' => 'btn btn-default btn-success tbl_up'
                        );
		if ($ma_phong != null && $tam!="del") {
			if ($this->M_classroom->check_classroom($ma_phong)==0) {
				return $this->load->view('home/V_error');
			}
			$info = $this->M_classroom->get_info($ma_phong);
			$ma_phong = $info->ma_phong;
			$ten_phong = $info->ten_phong;
			$data['cap_nhat']="sua";
			$data['ma_phong']=array('type'  => 'text',
                                'name'  => 'ma_phong',
                                'id'    => 'ma_phong',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập mã phòng',
                                'value' => $ma_phong,
                                'readonly' => 'readonly'
                            );
			$data['sm'] = array(
                                'name'  => 'sm',
                                'value' => 'Cập nhật',
                                'class' => 'btn btn-default btn-success tbl_up'
                        );
		}
		
		$data['ten_phong']=array('type'  => 'text',
                                'name'  => 'ten_phong',
                                'id'    => 'ten_phong',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập tên phòng',
                                'value' => $ten_phong
                            );
		
		$arr= array('active','success','info','warning','danger');
		$list_classroom=$this->M_classroom->list_classroom();
		$stt=1;
		$i=0;
		$str='';
		foreach ($list_classroom as $k) {
			$url_up=base_url('classroom/index/'.$k->ma_phong);
			$url_del=base_url('classroom/delete/'.$k->ma_phong);
			$str .='<tr class="'.$arr[$i++].'">
                  <td>'.$stt++.'</td>
                  <td>'.$k->ma_phong.'</td>
                  <td>'.$k->ten_phong.'</td>
                  <td class="text-center"><a href="'.$url_up.'">Edit</a>
                        || <a href="javascript:confirmDelete(\''.$url_del.' \')">Del</a>
                  </td>
                </tr>';
            $i = ($i==4)? 0:$i;
		}
		$data['str']=$str;
		$this->load->view('V_updata', $data, FALSE);
	}
	public function them(){
		$this->form_validation->set_rules('ma_phong', 'Ma phong', 'trim|required|min_length[2]|max_length[10]');
		$this->form_validation->set_rules('ten_phong', 'Ten phong', 'trim|required|min_length[1]|max_length[50]');
        if ($this->form_validation->run() == FALSE)
        {
            return $this->index();
        }
        $fld=($this->input->post(NULL, FALSE));
        if (empty($fld)) {
            $this->load->view('home/V_error');
            return;
        }
		unset($fld['sm']);
		$fld['ma_phong'] = str_replace(" ", "", $fld['ma_phong']);
		 if ($this->M_classroom->check_classroom($fld['ma_phong']) != 0) {
            $data['errors']='Dữ liệu thêm đã tồn tại.';
            $data['url'] = 'classroom';
            $this->load->view('theo_doi/V_errors',$data);
            return;
        }
        $this->M_classroom->insert_classroom($fld);
        $this->index();

	}
	public function sua(){
		$fld=($this->input->post(NULL, FALSE));
        if (empty($fld)) {
               $this->load->view('home/V_error');
                return;
        }
		$this->form_validation->set_rules('ten_phong', 'Ten phong', 'trim|required|min_length[1]|max_length[50]');
		if ($this->form_validation->run() == FALSE)
        {
            return $this->index(null,$fld['ma_phong']);
        }
        
		unset($fld['sm']);
		$this->M_classroom->updata_classroom($fld);
		$this->index();
	}

	public function delete(){
        $ma_phong = $this->uri->segment(3,null);
        if ($ma_phong == null || $this->M_classroom->check_classroom($ma_phong) == 0){
            return $this->load->view('home/V_error');
        }else{
        	$this->M_classroom->delete_classroom($ma_phong);
        	$this->index('del');
        }
        
	}

}

/* End of file Classroom.php */
/* Location: ./application/modules/classroom/controllers/Classroom.php */