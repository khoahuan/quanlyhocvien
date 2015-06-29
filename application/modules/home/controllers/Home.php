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
    $this->load->model('subject/M_subject');
    
		
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
        $data['mail']=$this->user_info->ho." ".$this->user_info->ten;
		$this->load->view('V_home',$data);	
	}
  
	public function search(){
		$data=$this->input->post(NULL, FALSE);
    if (empty($data)) {
      $this->load->view('V_error');  
      return;
    }
    //print_r($data);
    if ($data['thang']!="all") {
      $data['ngay']=$data['nam'].'-'.$data['thang'];
    }
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
  {       
      $str = '';
      $i = 0;
      if (!isset($fld)) {
          $this->load->view('home/V_error');
          return;
      }
      $data['ten_lop']=$this->M_theo_doi->get_ten_lop($fld['ma_lop']);
      $data['ten_khoa']=$this->M_theo_doi->get_ten_khoa($fld['ma_khoa']);
      $data['ngay']= isset($fld['ngay'])?$fld['ngay']:'Tất cả';
      $ma_khoa=$fld['ma_khoa'];
      $ma_mon=$fld['ma_mon'];
      $ma_lop=$fld['ma_lop'];
      $vang_phep = 0;
      $vang_k_phep = 0;
      //$list=$this->M_theo_doi->list_so_theo_doi($fld['ngay'],$fld['sdt'],$ma_khoa,$ma_mon,$ma_lop);
      $list = $this->M_theo_doi->list_so_theo_doi_v3($fld);
      //print_r($fld);
      $arr= array('active','success','info','warning','danger');
      $list_ma_td= array();
      foreach ($list as $k) {
        array_push($list_ma_td,$k->ma_theodoi);
        $ten_mon=$this->M_theo_doi->get_ten_mon($k->ma_mon);
        $ten_phong=$this->M_theo_doi->get_ten_phong($k->ma_phong);
        $danh_sach_vang='';
        $fld['ma_buoi']=$k->ma_buoi;
        $fld['ngay']=$k->ngay;
        $list_hvv = $this->M_student->list_hocvienvang($fld);
        $j=0;
        foreach ($list_hvv as $x) {
          ($j!=0? $danh_sach_vang.=', ':$danh_sach_vang);
          $danh_sach_vang .=$x->ho_hocvien.' '.$x->ten_hocvien;
          (($x->phep == 1) ? $vang_phep++ : $vang_k_phep++);
          $j=1;
        }
        $str .='<tr class="'.$arr[$i++].'">
                        <td>'.$k->ngay.'</td>
                        <td>'.(($k->ma_buoi=="SANG")?"S":"C").'</td>
                        <td>'.$k->quan_so.'</td>
                        <td>'.$k->hien_dien.'</td>
                        <td>'.$k->vang.'</td>
                        <td style="max-width: 250px;">'.$danh_sach_vang.'</td>
                        <td>'.$ten_mon.'</td>
                        <td style="max-width: 50px;">'.$ten_phong.'</td>
                        <td>'.(($k->de_cuong ==1) ? "có":"không").'</td>
                        <td>'.(($k->giao_an ==1) ? "có":"không").'</td>
                        <td>'.(($k->so_tay==1) ? "có":"không").'</td>
                        
                        <td>'.$k->ghi_chu.'</td>
                        <td></td>
                      </tr>';
       $i = ($i==4)? 0:$i;
      }

      /*----------------canh bao hoc vu--------*/
      $cbhv='';
      $tiet_canh_bao = $this->M_subject->get_tiet_canh_bao($ma_mon);
      if (!empty($list_ma_td)) {
        $list_ma_td = implode(',',$list_ma_td);
        $list_hsvang = $this->M_student->get_luot_vang($list_ma_td);
        foreach ($list_hsvang as $k) {
          $nghiLTphep=(floor($k->ltpsang/2)*4) + (floor($k->ltpchieu/2)*3);
          $nghiTHphep=(floor($k->thpsang/2)*4) + (floor($k->thpchieu/2)*3);
          $nghiLTkphep=($k->ltkpsang*4) + ($k->ltkpchieu*3);
          $nghiTHkphep=($k->thkpsang*4) + ($k->thkpchieu*3);
          $nghiLT=$nghiLTphep+$nghiLTkphep;
          $nghiTH=$nghiTHphep+$nghiTHkphep;
          $ngaynghiLT = $tiet_canh_bao['LT'] - $nghiLT;
          $ngaynghiTH = $tiet_canh_bao['TH'] - $nghiTH;
          $info_hv = $this->M_student->get_info($k->ma_hocvien);
          $ho_ten = $info_hv->ho_hocvien.' '.$info_hv->ten_hocvien;
          if($ngaynghiLT < 8   ){
            $cbhv .= "</br>- ".$ho_ten."(".$k->ma_hocvien.") Nghỉ LT: ".$nghiLT." tiết, Quỹ nghỉ LT: ".$ngaynghiLT." tiết";
          }
          if( $ngaynghiTH < 8 ){
            $cbhv .= "</br>- ".$ho_ten."(".$k->ma_hocvien.") Nghỉ TH: ".$nghiTH." tiết, Quỹ nghỉ TH: ".$ngaynghiTH." tiết";
          }
        }
        $temp = 'LT: '.$tiet_canh_bao['LT'].' tiết, TH: '.$tiet_canh_bao['TH'].' tiết';
        $str .='<tr class="'.$arr[$i].'">
                  <td colspan="11">Cảnh báo học vụ '.$temp.$cbhv.'</td>
                  <td colspan="2">Vắng: '.($vang_phep + $vang_k_phep).', Phép: '.$vang_phep.', Không: '.$vang_k_phep.'</td>
              </tr>';
      }
      /*-----------------end-----------------*/
      
      $data['str']=$str;
      $this->load->view('theo_doi/V_in',$data);
          
  }
  public function danh_sach($fld = null)
  {       
      $str = '';
      $i = 0;
      if (!isset($fld)) {
          $this->load->view('home/V_error');
          return;
      }
      $data['ten_lop']=$this->M_theo_doi->get_ten_lop($fld['ma_lop']);
      $data['ten_khoa']=$this->M_theo_doi->get_ten_khoa($fld['ma_khoa']);
      $data['ngay']= isset($fld['ngay'])?$fld['ngay']:'Tất cả';
      $ma_khoa=$fld['ma_khoa'];
      $ma_mon=$fld['ma_mon'];
      $ma_lop=$fld['ma_lop'];
      $vang_phep = 0;
      $vang_k_phep = 0;
      //$list=$this->M_theo_doi->list_so_theo_doi($fld['ngay'],$fld['sdt'],$ma_khoa,$ma_mon,$ma_lop);
      $list = $this->M_theo_doi->list_so_theo_doi_v3($fld);
      //print_r($fld);
      $arr= array('active','success','info','warning','danger');
      $list_ma_td= array();
      foreach ($list as $k) {
        array_push($list_ma_td,$k->ma_theodoi);
        $url_fix=base_url('theo_doi/cap_nhat/'.$k->ma_theodoi);
        $url_del=base_url('theo_doi/xoa/'.$k->ma_theodoi);
        $url_hvv=base_url('theo_doi/hocvienvang/'.$k->ma_khoa.'/'.$k->ma_mon.'/'.$k->ma_lop.'/'.$k->ngay.'/'.$k->ma_buoi);
        $ten_mon=$this->M_theo_doi->get_ten_mon($k->ma_mon);
        $ten_phong=$this->M_theo_doi->get_ten_phong($k->ma_phong);
        $danh_sach_vang='';
        $fld['ma_buoi']=$k->ma_buoi;
        $fld['ngay']=$k->ngay;
        $list_hvv = $this->M_student->list_hocvienvang($fld);
        $j=0;
        foreach ($list_hvv as $x) {
          ($j!=0? $danh_sach_vang.=', ':$danh_sach_vang);
          $danh_sach_vang .=$x->ho_hocvien.' '.$x->ten_hocvien;
          (($x->phep == 1) ? $vang_phep++ : $vang_k_phep++);
          $j=1;
        }
        $str .='<tr class="'.$arr[$i++].'">
                  <td>'.$k->ngay.'</td>
                  <td>'.(($k->ma_buoi=="SANG")?"S":"C").'</td>
                  <td>'.$k->quan_so.'</td>
                  <td>'.$k->hien_dien.'</td>
                  <td>'.$k->vang.'</td>
                  <td style="max-width: 250px;">'.$danh_sach_vang.'</td>
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

      /*----------------canh bao hoc vu--------*/
      $cbhv='';
      $tiet_canh_bao = $this->M_subject->get_tiet_canh_bao($ma_mon);
      if (!empty($list_ma_td)) {
        $list_ma_td = implode(',',$list_ma_td);
        $list_hsvang = $this->M_student->get_luot_vang($list_ma_td);
        foreach ($list_hsvang as $k) {
          $nghiLTphep=(floor($k->ltpsang/2)*4) + (floor($k->ltpchieu/2)*3);
          $nghiTHphep=(floor($k->thpsang/2)*4) + (floor($k->thpchieu/2)*3);
          $nghiLTkphep=($k->ltkpsang*4) + ($k->ltkpchieu*3);
          $nghiTHkphep=($k->thkpsang*4) + ($k->thkpchieu*3);
          $nghiLT=$nghiLTphep+$nghiLTkphep;
          $nghiTH=$nghiTHphep+$nghiTHkphep;
          $ngaynghiLT = $tiet_canh_bao['LT'] - $nghiLT;
          $ngaynghiTH = $tiet_canh_bao['TH'] - $nghiTH;
          $info_hv = $this->M_student->get_info($k->ma_hocvien);
          $ho_ten = $info_hv->ho_hocvien.' '.$info_hv->ten_hocvien;
          if($ngaynghiLT < 8   ){
            $cbhv .= "</br>- ".$ho_ten."(".$k->ma_hocvien.") Nghỉ LT: ".$nghiLT." tiết, Quỹ nghỉ LT: ".$ngaynghiLT." tiết";
          }
          if( $ngaynghiTH < 8 ){
            $cbhv .= "</br>- ".$ho_ten."(".$k->ma_hocvien.") Nghỉ TH: ".$nghiTH." tiết, Quỹ nghỉ TH: ".$ngaynghiTH." tiết";
          }
        }
        $temp = 'LT: '.$tiet_canh_bao['LT'].' tiết, TH: '.$tiet_canh_bao['TH'].' tiết';
        $str .='<tr class="'.$arr[$i].'">
                  <td colspan="11">Cảnh báo học vụ '.$temp.$cbhv.'</td>
                  <td colspan="2">Vắng: '.($vang_phep + $vang_k_phep).', Phép: '.$vang_phep.', Không: '.$vang_k_phep.'</td>
              </tr>';
      }
      /*-----------------end-----------------*/
      
      $data['str']=$str;
      $this->load->view('theo_doi/V_danh_sach',$data);
          
  }
  






}

/* End of file Home.php */
/* Location: ./application/modules/home/controllers/Home.php */