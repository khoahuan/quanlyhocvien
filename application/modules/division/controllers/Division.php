<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Division extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('M_division');
		$this->load->model('subject/M_subject');
		$this->load->model('user/M_user');
		$this->load->helper(array('url','form'));
	}

	public function index()
	{
		$data['cap_nhat']="them";
		$v_sm="Add";
		
		$arr =  array();
        foreach ($this->M_user->list_user() as $k) {
                array_push($arr, array($k->sdt => $k->ho.' '.$k->ten));
                
        }
		$data['giao_vien']= $arr;
		$arr =  array();
        foreach ($this->M_subject->list_subject() as $k) {
                array_push($arr, array($k->ma_mon => $k->ten_mon));
                
        }
		$data['mon_hoc']= $arr;
		$data['sm'] = array(
                                'name'  => 'sm',
                                'value' => $v_sm,
                                'class' => 'btn btn-default btn-success'
                        );
		$arr= array('active','success','info','warning','danger');
		$list_division=$this->M_division->list_division();
		$stt=1;
		$i=0;
		$str='';

		foreach ($list_division as $k) {
			
			$url_del=base_url('division/delete/'.$k->sdt.'/'.$k->ma_mon);
			$ten_giaovien=$this->M_user->get_info($k->sdt)->ho.' '.$this->M_user->get_info($k->sdt)->ten;
			$ten_mon=$this->M_subject->get_info($k->ma_mon)->ten_mon;
			$str .='<tr class="'.$arr[$i++].'">
                  <td>'.$stt++.'</td>
                  <td>'.$ten_giaovien.'</td>
                  <td>'.$ten_mon.'</td>
                  <td class="text-center"><a  href="'.$url_del.'">Del</a>
                  </td>
                </tr>';
            $i = ($i==4)? 0:$i;
		}
		$data['str']=$str;
		$this->load->view('V_updata',$data,FALSE);
	}
	public function them(){
        $fld=($this->input->post(NULL, FALSE));
        if (empty($fld)) {
            $this->load->view('home/V_error');
            return;
        }
		unset($fld['sm']);
		if ($this->M_division->check_division($fld['sdt'],$fld['ma_mon']) != 0) {
            $data['errors']='Dữ liệu thêm đã tồn tại.';
            $data['url'] = 'division';
            $this->load->view('theo_doi/V_errors',$data);
            return;
        }
        $this->M_division->insert_division($fld);
        $this->index();
	}

	public function delete(){
        $sdt = $this->uri->segment(3,null);
        $ma_mon = $this->uri->segment(4,null);
        if ($sdt == null || $ma_mon == null || $this->M_division->check_division($sdt,$ma_mon) == 0){
            return $this->load->view('home/V_error');
        }else{
        	$this->M_division->delete_division($sdt,$ma_mon);
        	$this->index('del');
        }
        
	}
}

/* End of file Division.php */
/* Location: ./application/modules/division/controllers/Division.php */