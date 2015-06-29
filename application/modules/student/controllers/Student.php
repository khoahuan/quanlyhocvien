<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {
	private $sdt=null;
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->library('form_validation');
		$this->load->helper(array('url','form' ));
		$this->load->model('M_student');
		$this->load->model('course/M_course');
		$this->load->model('lop/M_lop');
		$this->load->model('homeroom/M_homeroom');
		$this->load->model('user/M_user');
		//check quyen dang nhap
		if(!$this->M_user->check_login()){
			redirect('user/login','refresh');
		}
		$this->sdt=$this->M_user->get_info()->sdt;

	}
	public function index($tam = null,$ma_hocvien = null)
	{
		$fld=($this->input->post(NULL, FALSE));
		//print_r($fld);
		$ho_hocvien='';
		$ten_hocvien='';
		$data['cap_nhat']="them";
		$v_sm="Thêm";
		if (!isset($ma_hocvien)) {
             $ma_hocvien = $this->uri->segment(3,null);
        }
		
		$arr =  array();
		$temp_ma_khoa='';
		$temp_ma_lop='';
		$list_khoa =$this->M_course->list_course($this->sdt);
		if (!empty($list_khoa)) {
			foreach ($list_khoa as $k) {
                array_push($arr, array($k->ma_khoa => $k->ten_khoa));
        	}
        	$a=array_keys($arr[0]);
        	
        	$temp_ma_khoa=$a[0];
        	if(isset($fld['ma_khoa'])){
        		$temp_ma_khoa= $fld['ma_khoa'];
			}
        	$list_lop = $this->M_lop->list_lop($this->sdt,$temp_ma_khoa);
		}
        
        
		$data['khoa_hoc']= $arr;
		$data['v_khoa_hoc']=$temp_ma_khoa;
		
		$arr =  array();
		
		if (!empty($list_lop)) {
			foreach ($list_lop as $k){
                array_push($arr, array($k->ma_lop => $k->ten_lop));
        	}
        	$a=array_keys($arr[0]);

        	$temp_ma_lop=$a[0];
        	if(isset($fld['ma_lop'])){
        		$temp_ma_lop= $fld['ma_lop'];
			}
        	
		}
        $data['v_lop_hoc']=$temp_ma_lop;
		$data['lop_hoc']= $arr;
		$data['tinh_trang']=array('HOC'=>'Học',
									'NGHI'=>'Nghỉ',
									'BAOLUU'=>'Bảo Lưu');
		$data['v_tinh_trang'] = '';
		
		$data['ma_hocvien']=array(
							'type'  => 'text',
                            'name'  => 'ma_hocvien',
                            'id'    => 'ma_hocvien',
                            'value' => $ma_hocvien,
                            'class' => 'form-control',
                            'placeholder'=>'Nhập mã học viên'
						);
		$list_student=$this->M_student->list_student($this->sdt,$temp_ma_khoa,$temp_ma_lop);
		//phần cập nhật
		if ($ma_hocvien != null && $tam!="del") {
			if ($this->M_student->check_student($ma_hocvien)==0) {
				return $this->load->view('home/V_error');
			}
			$info = $this->M_student->get_info($ma_hocvien);
			$ma_hocvien=$info->ma_hocvien;
			$ho_hocvien=$info->ho_hocvien;
			$ten_hocvien=$info->ten_hocvien;
			$temp=$this->M_homeroom->get_homeroom($info->ma_pc_cn);
			$data['v_khoa_hoc']=$temp->ma_khoa;
			$data['v_lop_hoc']=$temp->ma_lop;
			$data['v_tinh_trang'] = $info->tinh_trang;
			$data['cap_nhat']="sua";
			$v_sm="Cập nhật";
			$data['ma_hocvien']=array(
							'type'  => 'text',
                            'name'  => 'ma_hocvien',
                            'id'    => 'ma_hocvien',
                            'value' => $ma_hocvien,
                            'class' => 'form-control',
                            'readonly' => 'readonly',
                            'placeholder'=>'Nhập mã học viên'
						);
			$list_lop = $this->M_lop->list_lop($this->sdt,$temp->ma_khoa);
			$arr =  array();
			if (!empty($list_lop)) {
				foreach ($list_lop as $k){
	                array_push($arr, array($k->ma_lop => $k->ten_lop));
	        	}
	        	$data['lop_hoc']= $arr;
			}

			$list_student=$this->M_student->list_student($this->sdt,$temp->ma_khoa,$temp->ma_lop);
			
		}
		
		
		$data['ho_hocvien']=array(
							'type'  => 'text',
                            'name'  => 'ho_hocvien',
                            'id'    => 'ho_hocvien',
                            'value' => $ho_hocvien,
                            'class' => 'form-control',
                            'placeholder' => 'Nhập họ học viên'
						);
		$data['ten_hocvien']=array(
							'type'  => 'text',
                            'name'  => 'ten_hocvien',
                            'id'    => 'ten_hocvien',
                            'value' => $ten_hocvien,
                            'class' => 'form-control',
                            'placeholder' => 'Nhập tên học viên'
						);
		
		$data['sm'] = array(
                                'value' => $v_sm,
                                'class' => 'btn btn-default btn-success tbl_up'
                        );
		$arr= array('active','success','info','warning','danger');
		
		
		$stt=1;
		$i=0;
		$str='';

		foreach ($list_student as $k) {
			$url_up=base_url('student/index/'.$k->ma_hocvien);
			$url_del=base_url('student/delete/'.$k->ma_hocvien);
			$str .='<tr class="'.$arr[$i++].'">
                  <td>'.$stt++.'</td>
                  <td>'.$k->ma_hocvien.'</td>
                  <td>'.$k->ho_hocvien.'</td>
                  <td>'.$k->ten_hocvien.'</td>
                  <td>'.$k->tinh_trang.'</td>
                  <td class="text-center"><a href="'.$url_up.'">Edit</a>
                        || <a href="javascript:confirmDelete(\''.$url_del.' \')">Del</a>
                  </td>
                </tr>';
            $i = ($i==4)? 0:$i;
		}
		$data['str']=$str;
		$this->load->view('V_updata',$data,FALSE);
	}
	public function list_student(){
		$arr= array('active','success','info','warning','danger');
		$ma_khoa = $this->input->post('ma_khoa');
		$ma_lop = $this->input->post('ma_lop');
		$list_student=$this->M_student->list_student($this->sdt,$ma_khoa,$ma_lop);
		$stt=1;
		$i=0;
		$str='';

		foreach ($list_student as $k) {
			$url_up=base_url('student/index/'.$k->ma_hocvien);
			$url_del=base_url('student/delete/'.$k->ma_hocvien);
			$str .='<tr class="'.$arr[$i++].'">
                  <td>'.$stt++.'</td>
                  <td>'.$k->ma_hocvien.'</td>
                  <td>'.$k->ho_hocvien.'</td>
                  <td>'.$k->ten_hocvien.'</td>
                  <td>'.$k->tinh_trang.'</td>
                  <td class="text-center"><a href="'.$url_up.'">Edit</a>
                        || <a href="'.$url_del.'">Del</a>
                  </td>
                </tr>';
            $i = ($i==4)? 0:$i;
		}
		echo $str;
	}
	public function them(){
		$this->form_validation->set_rules('ma_hocvien', 'Ma hoc vien', 'trim|required|min_length[1]|max_length[10]');
		$this->form_validation->set_rules('ten_hocvien', 'Ten hoc vien', 'trim|required|min_length[1]|max_length[15]');
		$this->form_validation->set_rules('ho_hocvien', 'Ho hoc vien', 'trim|required|min_length[2]|max_length[50]');
		$this->form_validation->set_rules('ma_khoa', 'Ma khoa', 'required');
		$this->form_validation->set_rules('ma_lop', 'Ma lop', 'required');
		if ($this->form_validation->run() == FALSE)
        {
            return $this->index();
        }
        $fld=($this->input->post(NULL, FALSE));
        if (empty($fld)) {
            $this->load->view('home/V_error');
            ;
            return;
        }
		$fld['ma_hocvien'] = str_replace(" ", "", $fld['ma_hocvien']);
		 if ($this->M_student->check_student($fld['ma_hocvien']) != 0) {
            $data['errors']='Dữ liệu thêm đã tồn tại.';
            $data['url'] = 'student';
            $this->load->view('theo_doi/V_errors',$data);
            return;
        }
        
        $fld['ma_pc_cn']=$this->M_homeroom->get_ma_pc_cn($fld['ma_khoa'],$fld['ma_lop']);
        unset($fld['ma_khoa']);
        unset($fld['ma_lop']);
        $this->M_student->insert_student($fld);
        $this->index();
	}
	public function sua(){
		$fld=($this->input->post(NULL, FALSE));
        if (empty($fld)) {
               $this->load->view('home/V_error');
                return;
        }
		$this->form_validation->set_rules('ten_hocvien', 'Ten hoc vien', 'trim|required|min_length[1]|max_length[15]');
		$this->form_validation->set_rules('ho_hocvien', 'Ho hoc vien', 'trim|required|min_length[2]|max_length[50]');
		
		if ($this->form_validation->run() == FALSE)
        {
            return $this->index(null,$fld['ma_hocvien']);
        }
        //print_r($fld);
        $fld['ma_pc_cn'] = $this->M_homeroom->get_ma_pc_cn($fld['ma_khoa'],$fld['ma_lop']);
        unset($fld['ma_khoa']);
        unset($fld['ma_lop']);
		$this->M_student->updata_student($fld);
		$this->index();
	}

	public function delete(){
        $ma_hocvien = $this->uri->segment(3,null);
        if ($ma_hocvien == null || $this->M_student->check_student($ma_hocvien) == 0){
            return $this->load->view('home/V_error');
        }else{
        	$this->M_student->delete_student($ma_hocvien);
        	$this->index('del');
        }
        
	}

	public function change_class(){
		$ma_khoa=$this->input->post('ma_khoa');
		$list=$this->M_lop->list_lop($this->sdt,$ma_khoa);
		$str='';
		$stt=0;
		foreach ($list as $k) {
			$str.='<optgroup label="'.$stt++.'">
					<option value="'.$k->ma_lop.'">'.$k->ten_lop.'</option>
					</optgroup>';
		}
		echo $str;
	}

}

/* End of file Student.php */
/* Location: ./application/modules/student/controllers/Student.php */