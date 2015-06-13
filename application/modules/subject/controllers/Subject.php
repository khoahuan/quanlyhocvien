<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$this->load->model('M_subject');
	}

	public function index($tam = null,$ma_mon = null)
	{	
		$data['cap_nhat']="them";
        if (!isset($ma_mon)) {
            $ma_mon = $this->uri->segment(3,null);
        }
		
		$ten_mon = '';
		$data['ma_mon']=array('type'  => 'text',
                                'name'  => 'ma_mon',
                                'id'    => 'ma_mon',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập mã môn'
                            );
		$data['sm'] = array(
                                'name'  => 'sm',
                                'value' => 'Add',
                                'class' => ' btn-default btn-success'
                        );
		if ($ma_mon != null && $tam!="del") {
			if ($this->M_subject->check_subject($ma_mon)==0) {
				return $this->load->view('home/V_error');
			}
			$info = $this->M_subject->get_info($ma_mon);
			$ma_mon = $info->ma_mon;
			$ten_mon = $info->ten_mon;
			$data['cap_nhat']="sua";
			$data['ma_mon']=array('type'  => 'text',
                                'name'  => 'ma_mon',
                                'id'    => 'ma_mon',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập mã môn',
                                'value' => $ma_mon,
                                'readonly' => 'readonly'
                            );
			$data['sm'] = array(
                                'name'  => 'sm',
                                'value' => 'Edit',
                                'class' => ' btn-default btn-success'
                        );
		}
		
		$data['ten_mon']=array('type'  => 'text',
                                'name'  => 'ten_mon',
                                'id'    => 'ten_mon',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập tên môn',
                                'value' => $ten_mon
                            );
		
		$arr= array('active','success','info','warning','danger');
		$list_subject=$this->M_subject->list_subject();
		$stt=1;
		$i=0;
		$str='';
		foreach ($list_subject as $k) {
			$url_up=base_url('subject/index/'.$k->ma_mon);
			$url_del=base_url('subject/delete/'.$k->ma_mon);
			$str .='<tr class="'.$arr[$i++].'">
                  <td>'.$stt++.'</td>
                  <td>'.$k->ma_mon.'</td>
                  <td>'.$k->ten_mon.'</td>
                  <td class="text-center"><a href="'.$url_up.'">Edit</a>
                        || <a href="'.$url_del.'">Del</a>
                  </td>
                </tr>';
            $i = ($i==4)? 0:$i;
		}
		$data['str']=$str;
		$this->load->view('V_updata', $data, FALSE);

	}
	public function them(){
		$this->form_validation->set_rules('ma_mon', 'ma mon', 'trim|required|min_length[2]|max_length[10]');
        $this->form_validation->set_rules('ten_mon', 'ten mon', 'trim|required|min_length[3]|max_length[150]');
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
        $fld['ma_mon'] = str_replace(" ", "", $fld['ma_mon']);
		 if ($this->M_subject->check_subject($fld['ma_mon']) != 0) {
            $data['errors']='Dữ liệu thêm đã tồn tại.';
            $data['url'] = 'subject';
            $this->load->view('theo_doi/V_errors',$data);
            return;
        }
        $this->M_subject->insert_subject($fld);
        $this->index();

	}
	public function sua(){
		$fld=($this->input->post(NULL, FALSE));
        if (empty($fld)) {
               $this->load->view('home/V_error');
                return;
        }
		$this->form_validation->set_rules('ten_mon', 'ten mon', 'trim|required|min_length[3]|max_length[150]');
		if ($this->form_validation->run() == FALSE)
        {
            return $this->index(null,$fld['ma_mon']);
        }
        
		unset($fld['sm']);
		$this->M_subject->updata_subject($fld);
		$this->index();
	}

	public function delete(){
        $ma_mon = $this->uri->segment(3,null);
        if ($ma_mon == null || $this->M_subject->check_subject($ma_mon) == 0){
            return $this->load->view('home/V_error');
        }else{
        	$this->M_subject->delete_subject($ma_mon);
        	$this->index('del');
        }
        
	}

}

/* End of file Subject.php */
/* Location: ./application/modules/subject/controllers/Subject.php */