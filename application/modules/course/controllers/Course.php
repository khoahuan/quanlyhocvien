<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {
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
		$this->load->model('M_course');

	}

	public function index($tam = null,$ma_khoa = null)
	{
		$data['cap_nhat']="them";
        if (!isset($ma_khoa)) {
            $ma_khoa = $this->uri->segment(3,null);
        }
		$ten_khoa = '';
		$data['ma_khoa']=array('type'  => 'text',
                                'name'  => 'ma_khoa',
                                'id'    => 'ma_khoa',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập mã khóa học'
                            );
		$data['sm'] = array(
                                'name'  => 'sm',
                                'value' => 'Thêm',
                                'class' => 'btn btn-default btn-success tbl_up'
                        );
		if ($ma_khoa != null && $tam!="del") {
			if ($this->M_course->check_course($ma_khoa)==0) {
				return $this->load->view('home/V_error');
			}
			$info = $this->M_course->get_info($ma_khoa);
			$ma_khoa = $info->ma_khoa;
			$ten_khoa = $info->ten_khoa;
			$data['cap_nhat']="sua";
			$data['ma_khoa']=array('type'  => 'text',
                                'name'  => 'ma_khoa',
                                'id'    => 'ma_khoa',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập mã khóa học',
                                'value' => $ma_khoa,
                                'readonly' => 'readonly'
                            );
			$data['sm'] = array(
                                'name'  => 'sm',
                                'value' => 'Cập nhật',
                                'class' => 'btn btn-default btn-success tbl_up'
                        );
		}
		
		$data['ten_khoa']=array('type'  => 'text',
                                'name'  => 'ten_khoa',
                                'id'    => 'ten_khoa',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập khóa học',
                                'value' => $ten_khoa
                            );
		
		$arr= array('active','success','info','warning','danger');
		$list_course=$this->M_course->list_course();
		$stt=1;
		$i=0;
		$str='';
		foreach ($list_course as $k) {
			$url_up=base_url('course/index/'.$k->ma_khoa);
			$url_del=base_url('course/delete/'.$k->ma_khoa);
			$str .='<tr class="'.$arr[$i++].'">
                  <td>'.$stt++.'</td>
                  <td>'.$k->ma_khoa.'</td>
                  <td>'.$k->ten_khoa.'</td>
                  <td class="text-center"><a href="'.$url_up.'">Edit</a>
                        || <a href="javascript:confirmDelete(\' '.$url_del.'\')">Del</a>
                  </td>
                </tr>';
            $i = ($i==4)? 0:$i;
		}
		$data['str']=$str;
		$this->load->view('V_updata', $data, FALSE);
	}
	public function them(){
		$this->form_validation->set_rules('ma_khoa', 'Ma khoa hoc', 'trim|required|min_length[2]|max_length[10]');
		$this->form_validation->set_rules('ten_khoa', 'Ten khoa hoc', 'trim|required|min_length[3]|max_length[50]');
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
		$fld['ma_khoa'] = str_replace(" ", "", $fld['ma_khoa']);
		 if ($this->M_course->check_course($fld['ma_khoa']) != 0) {
            $data['errors']='Dữ liệu thêm đã tồn tại.';
            $data['url'] = 'course';
            $this->load->view('theo_doi/V_errors',$data);
            return;
        }
        $this->M_course->insert_course($fld);
        $this->index();

	}
	public function sua(){
		$fld=($this->input->post(NULL, FALSE));
        if (empty($fld)) {
               $this->load->view('home/V_error');
                return;
        }
		$this->form_validation->set_rules('ten_khoa', 'Ten khoa hoc', 'trim|required|min_length[3]|max_length[50]');
		if ($this->form_validation->run() == FALSE)
        {
            return $this->index(null,$fld['ma_khoa']);
        }
        
		unset($fld['sm']);
		$this->M_course->updata_course($fld);
		$this->index();
	}

	public function delete(){
        $ma_khoa = $this->uri->segment(3,null);
        if ($ma_khoa == null || $this->M_course->check_course($ma_khoa) == 0){
            return $this->load->view('home/V_error');
        }else{
        	$this->M_course->delete_course($ma_khoa);
        	$this->index('del');
        }
        
	}

}

/* End of file Course.php */
/* Location: ./application/modules/course/controllers/Course.php */