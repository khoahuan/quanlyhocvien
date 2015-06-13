<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lop extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$this->load->model('M_lop');
	}
	public function index($tam = null,$ma_lop = null)
	{	
		$data['cap_nhat']="them";
        if (!isset($ma_lop)) {
            $ma_lop = $this->uri->segment(3,null);
        }
		
		$ten_lop = '';
		$data['ma_lop']=array('type'  => 'text',
                                'name'  => 'ma_lop',
                                'id'    => 'ma_lop',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập mã lớp'
                            );
		$data['sm'] = array(
                                'name'  => 'sm',
                                'value' => 'Add',
                                'class' => ' btn-default btn-success'
                        );
		if ($ma_lop != null && $tam!="del") {
			if ($this->M_lop->check_lop($ma_lop)==0) {
				return $this->load->view('home/V_error');
			}
			$info = $this->M_lop->get_info($ma_lop);
			$ma_lop = $info->ma_lop;
			$ten_lop = $info->ten_lop;
			$data['cap_nhat']="sua";
			$data['ma_lop']=array('type'  => 'text',
                                'name'  => 'ma_lop',
                                'id'    => 'ma_lop',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập mã môn',
                                'value' => $ma_lop,
                                'readonly' => 'readonly'
                            );
			$data['sm'] = array(
                                'name'  => 'sm',
                                'value' => 'Edit',
                                'class' => ' btn-default btn-success'
                        );
		}
		
		$data['ten_lop']=array('type'  => 'text',
                                'name'  => 'ten_lop',
                                'id'    => 'ten_lop',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập tên lớp',
                                'value' => $ten_lop
                            );
		
		$arr= array('active','success','info','warning','danger');
		$list_lop=$this->M_lop->list_lop();
		$stt=1;
		$i=0;
		$str='';
		foreach ($list_lop as $k) {
			$url_up=base_url('lop/index/'.$k->ma_lop);
			$url_del=base_url('lop/delete/'.$k->ma_lop);
			$str .='<tr class="'.$arr[$i++].'">
                  <td>'.$stt++.'</td>
                  <td>'.$k->ma_lop.'</td>
                  <td>'.$k->ten_lop.'</td>
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
		$this->form_validation->set_rules('ma_lop', 'ma lop', 'trim|required|min_length[2]|max_length[10]');
		$this->form_validation->set_rules('ten_lop', 'ten lop', 'trim|required|min_length[3]|max_length[100]');
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
        $fld['ma_lop'] = str_replace(" ", "", $fld['ma_lop']);
		 if ($this->M_lop->check_lop($fld['ma_lop']) != 0) {
            $data['errors']='Dữ liệu thêm đã tồn tại.';
            $data['url'] = 'lop';
            $this->load->view('theo_doi/V_errors',$data);
            return;
        }
        $this->M_lop->insert_lop($fld);
        $this->index();

	}
	public function sua(){
		$fld=($this->input->post(NULL, FALSE));
        if (empty($fld)) {
               $this->load->view('home/V_error');
                return;
        }
		$this->form_validation->set_rules('ten_lop', 'ten lop', 'trim|required|min_length[3]|max_length[100]');
		if ($this->form_validation->run() == FALSE)
        {
            return $this->index(null,$fld['ma_lop']);
        }
        
		unset($fld['sm']);
		$this->M_lop->updata_lop($fld);
		$this->index();
	}

	public function delete(){
        $ma_lop = $this->uri->segment(3,null);
        if ($ma_lop == null || $this->M_lop->check_lop($ma_lop) == 0){
            return $this->load->view('home/V_error');
        }else{
        	$this->M_lop->delete_lop($ma_lop);
        	$this->index('del');
        }
        
	}

}

/* End of file Lop.php */
/* Location: ./application/modules/lop/controllers/Lop.php */