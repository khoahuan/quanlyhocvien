<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homeroom extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('user/M_user');
        $this->load->model('user/M_user');
        //check quyen dang nhap
        if(!$this->M_user->check_login()){
            redirect('user/login','refresh');
        }
        $info = $this->session->userdata('user');
        if($info['cap_bac']==1){
            redirect('home','refresh');
        } 
		$this->load->model('lop/M_lop');
		$this->load->model('course/M_course');
		$this->load->model('M_homeroom');
		$this->load->helper(array('url','form'));
		$this->load->library('form_validation');
	}
	public function index()
	{
		
		$data['sm'] = array(
                                'value' => 'Thêm',
                                'class' => 'btn btn-default btn-success tbl_up'
                        );
		$arr =  array();
        //print_r($this->M_lop->list_lop());
        foreach ($this->M_lop->list_lop() as $k) {
                array_push($arr, array($k->ma_lop => $k->ten_lop));
                
        }
		$data['lop_hoc']= $arr;
		$arr =  array();
        foreach ($this->M_course->list_course() as $k) {
                array_push($arr, array($k->ma_khoa => $k->ten_khoa));
                
        }
		$data['khoa_hoc']= $arr;
		$arr =  array();
        foreach ($this->M_user->list_user() as $k) {
                array_push($arr, array($k->sdt => $k->ho.' '.$k->ten));
                
        }
		$data['sdt']= $arr;

		
		$arr= array('active','success','info','warning','danger');
		$list_homeroom=$this->M_homeroom->list_homeroom();
		$stt=1;
		$i=0;
		$str='';
		foreach ($list_homeroom as $k) {
			$url_del=base_url('homeroom/delete/'.$k->ma_pc_cn);
			$str .='<tr class="'.$arr[$i++].'">
                  <td>'.$k->ma_pc_cn.'</td>
                  <td>'.$k->ma_khoa.'</td>
                  <td>'.$k->ma_lop.'</td>
                  <td>'.$k->sdt.'</td>
                  <td class="text-center">
                  	<a href="javascript:confirmDelete(\''.$url_del.' \')">Del</a>
                  </td>
                </tr>';
            $i = ($i==4)? 0:$i;
		}
		$data['str']=$str;
		$this->load->view('V_updata', $data, FALSE);
	}

	public function them(){
		$fld=($this->input->post(NULL, FALSE));
        if (empty($fld)) {
            $this->load->view('home/V_error');
            return;
        }
        if ($this->M_homeroom->check_homeroom($fld) != 0) {
            $data['errors']='Lớp này đã có chủ nhiệm.';
            $data['url'] = 'homeroom';
            $this->load->view('theo_doi/V_errors',$data);
            return;
        }
        $this->M_homeroom->insert_homeroom($fld);
        $this->index();
	}
	public function delete(){
        $ma_pc_cn = $this->uri->segment(3,null);
        if ($ma_pc_cn == null || $this->M_homeroom->check_del($ma_pc_cn) == 0){
            return $this->load->view('home/V_error');
        }else{
        	$this->M_homeroom->delete_homeroom($ma_pc_cn);
        	$this->index();
        }
        
	}
}

/* End of file Homeroom.php */
/* Location: ./application/modules/homeroom/controllers/Homeroom.php */