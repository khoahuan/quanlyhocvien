<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	private $user_info = null;
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('theo_doi/M_theo_doi');
		$this->load->helper( array('form','url' ));
		$this->load->model('user/M_user');
    $this->load->model('student/M_student');
		
		$this->user_info = $this->M_user->get_info();
		//print_r($this->M_user->get_info());
		//echo $this->user_info->sdt;
		if(!$this->M_user->check_login()){
			redirect('user/login','refresh');
		}
		

	}
	public function index()
	{
		$arr =  array();
        foreach ($this->M_theo_doi->get_mon() as $k) {
          array_push($arr, array($k->ma_mon => $k->ten_mon));
                
        }
        $data['mon']=$arr;

        $arr =  array();
        foreach ($this->M_theo_doi->get_khoa() as $k) {
          array_push($arr, array($k->ma_khoa => $k->ten_khoa));
                
        }
        $data['khoa']=$arr;

        $arr =  array();
        foreach ($this->M_theo_doi->get_lop() as $k) {
          array_push($arr, array($k->ma_lop => $k->ten_lop));
                
        }
        $data['lop']=$arr;
        $data['mail']=$this->user_info->mail;
		$this->load->view('V_home',$data);	
	}

	public function search(){
		$data=$this->input->post(NULL, FALSE);
    if (empty($data)) {
      $this->load->view('V_error');  
      return;
    }
    //print_r($data);
		$data['ngay']=$data['nam'].'-'.$data['thang'];
    $data['sdt']=$this->user_info->sdt;
		unset($data['nam']);
		unset($data['thang']);
    if (isset($data['print'])) {
      unset($data['print']);
      $this->danh_sach_in($data);
      return;
    }
		$this->danh_sach($data);
	}
  public function danh_sach_in($fld = null)
  {       //print_r($fld);
       $str = '';
      $i = 0;
      //$list=$this->M_theo_doi->list_so_theo_doi();
      if (!isset($fld)) {
          $this->load->view('home/V_error');
          return;
      }
      //return print_r($list);
      $data['ten_lop']=$this->M_theo_doi->get_ten_lop($fld['ma_lop']);
      $data['ten_khoa']=$this->M_theo_doi->get_ten_khoa($fld['ma_khoa']);
      $data['ngay']=$fld['ngay'];
      $ma_khoa=$fld['ma_khoa'];
      $ma_mon=$fld['ma_mon'];
      $ma_lop=$fld['ma_lop'];
      $list=$this->M_theo_doi->list_so_theo_doi($fld['ngay'],$fld['sdt'],$ma_khoa,$ma_mon,$ma_lop);
      
      $arr= array('active','success','info','warning','danger');
      foreach ($list as $k) {
              $ten_mon=$this->M_theo_doi->get_ten_mon($k->ma_mon);
              $ten_phong=$this->M_theo_doi->get_ten_phong($k->ma_phong);
              $danh_sach_vang='';
              $fld['ma_buoi']=$k->ma_buoi;
              $fld['ngay']=$k->ngay;
              $list_hvv = $this->M_student->list_hocvienvang($fld);
              foreach ($list_hvv as $x) {
                  $danh_sach_vang .=$x->ho_hocvien.' '.$x->ten_hocvien.', ';
              }
              $str .='<tr class="'.$arr[$i++].'">
                        <td>'.$k->ngay.'</td>
                        <td>'.(($k->ma_buoi=="SANG")?"Sáng":"Chiều").'</td>
                        <td>'.$k->quan_so.'</td>
                        <td>'.$k->hien_dien.'</td>
                        <td>'.$k->vang.'</td>
                        <td style="max-width: 300px;">'.$danh_sach_vang.'</td>
                        <td>'.$ten_mon.'</td>
                        <td>'.$ten_phong.'</td>
                        <td>'.(($k->de_cuong ==1) ? "có":"không").'</td>
                        <td>'.(($k->giao_an ==1) ? "có":"không").'</td>
                        <td>'.(($k->so_tay==1) ? "có":"không").'</td>
                        
                        <td>'.$k->ghi_chu.'</td>
                        <td></td>
                      </tr>';
             $i = ($i==4)? 0:$i;
      }
      //echo $str;
      $data['str']=$str;
      $this->load->view('theo_doi/V_in',$data);
          
  }
	public function danh_sach($fld = null)
  {       //print_r($fld);
      
      $str = '';
      $i = 0;
      //$list=$this->M_theo_doi->list_so_theo_doi();
      if (!isset($fld)) {
          $this->load->view('home/V_error');
          return;
      }
      //return print_r($list);
      $data['ten_lop']=$this->M_theo_doi->get_ten_lop($fld['ma_lop']);
      $data['ten_khoa']=$this->M_theo_doi->get_ten_khoa($fld['ma_khoa']);
      $data['ngay']=$fld['ngay'];
      $ma_khoa=$fld['ma_khoa'];
      $ma_mon=$fld['ma_mon'];
      $ma_lop=$fld['ma_lop'];
      $list=$this->M_theo_doi->list_so_theo_doi($fld['ngay'],$fld['sdt'],$ma_khoa,$ma_mon,$ma_lop);
      
      $arr= array('active','success','info','warning','danger');
      foreach ($list as $k) {
              $url_fix=base_url('theo_doi/cap_nhat/'.$k->ma_theodoi);
              $url_del=base_url('theo_doi/xoa/'.$k->ma_theodoi);
              $url_hvv=base_url('theo_doi/hocvienvang/'.$k->ma_khoa.'/'.$k->ma_mon.'/'.$k->ma_lop.'/'.$k->ngay.'/'.$k->ma_buoi);
              $ten_mon=$this->M_theo_doi->get_ten_mon($k->ma_mon);
              $ten_phong=$this->M_theo_doi->get_ten_phong($k->ma_phong);
              $danh_sach_vang='';
              $fld['ma_buoi']=$k->ma_buoi;
              $fld['ngay']=$k->ngay;
              $list_hvv = $this->M_student->list_hocvienvang($fld);
              foreach ($list_hvv as $x) {
                  $danh_sach_vang .=$x->ho_hocvien.' '.$x->ten_hocvien.', ';
              }
              $str .='<tr class="'.$arr[$i++].'">
                        <td>'.$k->ngay.'</td>
                        <td>'.(($k->ma_buoi=="SANG")?"Sáng":"Chiều").'</td>
                        <td>'.$k->quan_so.'</td>
                        <td>'.$k->hien_dien.'</td>
                        <td>'.$k->vang.'</td>
                        <td style="max-width: 300px;">'.$danh_sach_vang.'</td>
                        <td>'.$ten_mon.'</td>
                        <td>'.$ten_phong.'</td>
                        <td>'.(($k->de_cuong ==1) ? "có":"không").'</td>
                        <td>'.(($k->giao_an ==1) ? "có":"không").'</td>
                        <td>'.(($k->so_tay==1) ? "có":"không").'</td>
                        
                        <td>'.$k->ghi_chu.'</td>
                        <td class="text-center"><a href="'.$url_fix.'">Edit</a>
                              || <a href="'.$url_del.'">Del</a>|| <a target="new" href="'.$url_hvv.'">Edit HVV</a>
                        </td>
                      </tr>';
             $i = ($i==4)? 0:$i;
      }
      //echo $str;
      $data['str']=$str;
      $this->load->view('theo_doi/V_danh_sach',$data);
          
  }

}

/* End of file Home.php */
/* Location: ./application/modules/home/controllers/Home.php */