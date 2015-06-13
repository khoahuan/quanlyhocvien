<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Theo_doi extends CI_Controller {
        private $user_info = null;
        public function __construct()
        {
                parent::__construct();
                //Do your magic here
                $this->load->library('form_validation');
                $this->load->helper(array('form', 'url'));
                $this->load->model('M_theo_doi');
                $this->load->model('student/M_student');
                $this->load->model('homeroom/M_homeroom');
                $this->load->model('user/M_user');
                $this->user_info = $this->M_user->get_info();
                if(!$this->M_user->check_login()){
                    redirect('user/login','refresh');
                }

                
        }
	public function index()
	{
		
	}
	public function cap_nhat($ma_theodoi=null)
	{
        if (!isset($ma_theodoi)) {
            $ma_theodoi = $this->uri->segment(3,null); 
        }            
        $sdt=$this->user_info->sdt;
        $sotheodoi = '';
        $quan_so = '';
        $hien_dien = '';
        //$vang = '';
        $danh_sach_vang = '';
        $ghi_chu = '';
        $de_cuong=-1;
        $giao_an = -1;
        $so_tay=-1;
        $data['v_phong']='';
        $data['v_mon']='';
        $data['v_khoa']='';
        $data['v_lop']='';
        $data['v_buoi']='';
        $data['sm'] = array(
                        'value' => 'Thêm',
                        'class' => 'btn btn-default btn-success'
                );

        $data['cap_nhat']='them';
        $ma_khoa='12';
        $ma_lop="";
        if ($ma_theodoi != null) {
                if ($this->M_theo_doi->check_so_theo_doi($ma_theodoi)== 0) {
                        $this->load->view('home/V_error1');
                        return;
                }
                $sotheodoi = $this->M_theo_doi->get_so_theo_doi_2($ma_theodoi);
                $hien_dien = $sotheodoi->hien_dien;
                $danh_sach_vang = $sotheodoi->danh_sach_vang;
                $ghi_chu = $sotheodoi->ghi_chu;
                $de_cuong=$sotheodoi->de_cuong;
                $giao_an = $sotheodoi->giao_an;
                $so_tay=$sotheodoi->so_tay;
                $data['v_phong']=$sotheodoi->ma_phong;
                $ma_khoa=$sotheodoi->ma_khoa;
                $ma_lop=$sotheodoi->ma_lop;
                $data['sm'] = array(
                        'value' => 'Cập nhật',
                        'class' => 'btn btn-default btn-success'
                );
                $data['cap_nhat']='sua';
                $data['ngay']=$sotheodoi->ngay;
                $data['ma_mon'] = array(
                        'type'  => 'text',
                        'name'  => 'ma_mon',
                        'id'    => 'ma_mon',
                        'value' => $sotheodoi->ma_mon,
                        'class' => 'form-control',
                        'readonly'=>'readonly'
                );
                $data['ma_lop'] = array(
                        'type'  => 'text',
                        'name'  => 'ma_lop',
                        'id'    => 'ma_lop',
                        'value' => $sotheodoi->ma_lop,
                        'class' => 'form-control',
                        'readonly'=>'readonly'
                );
                $data['ma_khoa'] = array(
                        'type'  => 'text',
                        'name'  => 'ma_khoa',
                        'id'    => 'ma_khoa',
                        'value' => $sotheodoi->ma_khoa,
                        'class' => 'form-control',
                        'readonly'=>'readonly'
                );
                $data['ma_buoi'] = array(
                        'type'  => 'text',
                        'name'  => 'ma_buoi',
                        'id'    => 'ma_buoi',
                        'value' => $sotheodoi->ma_buoi,
                        'class' => 'form-control',
                        'readonly'=>'readonly'
                );
        }
        
        $data['hien_dien'] = array(
                        'type'  => 'text',
                        'name'  => 'hien_dien',
                        'id'    => 'hien_dien',
                        'value' => $hien_dien,
                        'class' => 'form-control'
                );
        /*$data['vang'] = array(
                        'type'  => 'text',
                        'name'  => 'vang',
                        'id'    => 'vang',
                        'value' =>  $vang,
                        'class' => 'form-control'
                );*/
        $data['danh_sach_vang'] = array(
                        'name'  => 'danh_sach_vang',
                        'id'    => 'danh_sach_vang',
                        'value' =>  $danh_sach_vang,
                        'class' => 'form-control',
                        'rows' => 5,
                        'cols' => 30
                );
        $data['ghi_chu'] = array(
                        'name'  => 'ghi_chu',
                        'id'    => 'ghi_chu',
                        'value' =>  $ghi_chu,
                        'class' => 'form-control',
                        'rows' => 5,
                        'cols' => 30
                );
        $checked = (($de_cuong!=0)? "checked":"");
        $data['de_cuong'] = array(
                        'name'  => 'de_cuong',
                        'id'    => 'de_cuong',
                        'value' =>  1,
                        'checked'=>$checked
                );
        $checked = (($giao_an!=0)? "checked":"");
        $data['giao_an'] = array(
                        'name'  => 'giao_an',
                        'id'    => 'giao_an',
                        'value' =>  1,
                        'checked'=>$checked
                );
        $checked = (($so_tay!=0)? "checked":"");
        $data['so_tay'] = array(
                        'name'  => 'so_tay',
                        'id'    => 'so_tay',
                        'value' =>  1,
                        'checked'=>$checked
                );
        //-----------phòng học
        $arr =  array();
        foreach ($this->M_theo_doi->get_phong() as $k) {
                array_push($arr, array($k->ma_phong => $k->ten_phong));
                
        }
        $data['phong']=$arr;
        //-----------môn
        $arr =  array();
        foreach ($this->M_theo_doi->get_mon_phan_cong($this->user_info->sdt) as $k) {
                array_push($arr, array($k->ma_mon => $k->ten_mon));
                
        }
        $data['mon']=$arr;
        //-----------khóa học
        $arr =  array();
        foreach ($this->M_theo_doi->get_khoa() as $k) {
                array_push($arr, array($k->ma_khoa => $k->ten_khoa));
                
        }
        $data['khoa']=$arr;
        //-----------lớp
        $arr =  array();
        foreach ($this->M_theo_doi->get_lop_co_hv($sdt,'12') as $k) {
                array_push($arr, array($k->ma_lop => $k->ten_lop));
        }
        $data['lop']=$arr;
        if (!empty($arr)) {
            $tam=array_keys($arr[0]);
            if ($ma_theodoi == null) {
                $ma_lop=$tam[0];
            }
        }
        
        //-----------
        $ma_pc_cn = $this->M_homeroom->get_ma_pc_cn($ma_khoa,$ma_lop);
        $quan_so= $this->M_student->get_quan_so($ma_pc_cn);
        $data['quan_so'] = array(
                        'type'  => 'text',
                        'name'  => 'quan_so',
                        'id'    => 'quan_so',
                        'value' => $quan_so,
                        'class' => 'form-control',
                        'readonly'=>'readonly'
                );
        $data['buoi']=array('SANG'=>'Sáng','CHIEU'=>'Chiều');
        $this->load->view('V_cap_nhat',$data);
        
	}
    public function sua(){
        $fld=($this->input->post(NULL, FALSE));
        
        if (empty($fld)) {
               $this->load->view('home/V_error');
                return;
        }
        $quan_so=$fld['quan_so'];
        $fld['sdt']=$this->user_info->sdt;
        $this->form_validation->set_rules('quan_so', 'Quan so', 'integer|trim|required|min_length[1]|max_length[3]');
        $this->form_validation->set_rules('hien_dien', 'Hien dien', 'less_than_equal_to['.$quan_so.']|integer|trim|required|min_length[1]|max_length[3]');
        $ma_theodoi = $this->M_theo_doi->get_so_theo_doi($fld['ngay'],$fld['sdt'],$fld['ma_khoa'],$fld['ma_mon'],$fld['ma_lop'],$fld['ma_buoi'])->ma_theodoi;    
        //print_r($fld);
        if ($this->form_validation->run() == FALSE)
        {
               return $this->cap_nhat($ma_theodoi);
        }
        
        $fld['vang']=$fld['quan_so']-$fld['hien_dien'];
        $this->M_theo_doi->update_sotheodoi($fld);
        $this->danh_sach($fld);
    }
     
    public function them(){
            $quan_so = $this->input->post('quan_so');
            $this->form_validation->set_rules('ma_lop', 'Ma lop', 'required');
            $this->form_validation->set_rules('quan_so', 'Quan so', 'integer|trim|required|min_length[1]|max_length[3]');
            $this->form_validation->set_rules('hien_dien', 'Hien dien', 'less_than_equal_to['.$quan_so.']|integer|trim|required|min_length[1]|max_length[3]');
            
            if ($this->form_validation->run() == FALSE)
            {
                return $this->cap_nhat();
            }
            $fld=($this->input->post(NULL, FALSE));
            if (empty($fld)) {
                $this->load->view('home/V_error');
                return;
            }
            $fld['sdt']=$this->user_info->sdt;
            $fld['ngay'] = date('Y-m-d');
            $fld['vang']=$fld['quan_so']-$fld['hien_dien'];
            //print_r($fld);
            if ($this->M_theo_doi->check_so_theo_doi_2($fld['ngay'],$fld['sdt'],$fld['ma_khoa'],$fld['ma_mon'],$fld['ma_lop'],$fld['ma_buoi'])!= 0 ) {
                $data['errors']='Dữ liệu thêm đã tồn tại.';
                $data['url'] = 'theo_doi/them';
                $this->load->view('theo_doi/V_errors',$data);
                return;
            }
            $temp =$this->M_theo_doi->insert_sotheodoi($fld);
            if ($fld['vang']==0) {
                $this->danh_sach($fld);
                return;
            }
            $this->hocvienvang($fld);
    }
    public function xoa(){
        $ma_theodoi = $this->uri->segment(3,null);
        if ($ma_theodoi != null) {
            
            if ($this->M_theo_doi->check_so_theo_doi($ma_theodoi)== 0) {
                $this->load->view('home/V_error');
                return;
            }
        }else{
            $this->load->view('home/V_error');
            return;
        }
        
        $fld=$this->M_theo_doi->get_so_theo_doi_2($ma_theodoi);

        //print_r($fld);
        $fld=array('ngay' => $fld->ngay,'ma_lop' => $fld->ma_lop,'ma_khoa' => $fld->ma_khoa,'sdt' => $fld->sdt,'ma_mon' => $fld->ma_mon,'ma_buoi' => $fld->ma_buoi );
        $this->M_theo_doi->delete_sotheodoi($ma_theodoi);
        $this->danh_sach($fld);
    }
    public function danh_sach($fld = null)
    {       //print_r($fld);
        $ngay = date('Y-m');
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
        $data['ngay']=$ngay;
        $ma_khoa=$fld['ma_khoa'];
        $ma_mon=$fld['ma_mon'];
        $ma_lop=$fld['ma_lop'];
        $list=$this->M_theo_doi->list_so_theo_doi($ngay,$fld['sdt'],$ma_khoa,$ma_mon,$ma_lop);
        
        $arr= array('active','success','info','warning','danger');
        foreach ($list as $k) {
            //$url_del=base_url('theo_doi/xoa/'.$k->ngay.'/'.$k->sdt.'/'.$k->ma_khoa.'/'.$k->ma_mon.'/'.$k->ma_lop.'/'.$k->ma_buoi);
            $url_del=base_url('theo_doi/xoa/'.$k->ma_theodoi);
            $url_hvv=base_url('theo_doi/hocvienvang/'.$k->ma_khoa.'/'.$k->ma_mon.'/'.$k->ma_lop.'/'.$k->ngay.'/'.$k->ma_buoi);
            $ten_mon=$this->M_theo_doi->get_ten_mon($k->ma_mon);
            $ten_phong=$this->M_theo_doi->get_ten_phong($k->ma_phong);
            $danh_sach_vang='';
            $fld['ma_buoi']=$k->ma_buoi;
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
                      <td class="text-center"><a href="cap_nhat/'.$k->ma_theodoi.'">Edit</a>
                            || <a href="'.$url_del.'">Del</a>|| <a target="new" href="'.$url_hvv.'">Edit HVV</a>
                      </td>
                    </tr>';
               $i = ($i==4)? 0:$i;
        }
        //echo $str;
        $data['str']=$str;
        $this->load->view('V_danh_sach',$data);
            
    }

    public function hocvienvang(){
        $data['cap_nhat']='them_hv_vang';
        $ma_khoa=$this->uri->segment(3,null);
        $ma_mon=$this->uri->segment(4,null);
        $ma_lop=$this->uri->segment(5,null);
        $ngay = $this->uri->segment(6,null);
        $ma_buoi = $this->uri->segment(7,null);
        $fld=$this->input->post(NULL,FALSE);
        //print_r($fld);
       
        
        if ($ma_khoa !=null) {
            $fld['sdt']= $this->user_info->sdt;
            $fld['ma_khoa']= $ma_khoa;
            $fld['ma_mon']= $ma_mon;
            $fld['ma_lop']= $ma_lop;
            $fld['ngay']= $ngay;
            $fld['ma_buoi']= $ma_buoi;
            $temp=$this->M_student->check_ds_hvvang($fld);
            if ($temp == 0) {
                $this->load->view('home/V_error');
                return;
            }
        }else{
            if (empty($fld)) {
                $this->load->view('home/V_error');
                return;
            }
             $fld['ngay']= date('Y-m-d');
             $fld['sdt']= $this->user_info->sdt;
           
        }
        
        //print_r($fld);
        $arr =  array();
        $ma_pc_cn=$this->M_homeroom->get_ma_pc_cn($fld['ma_khoa'],$fld['ma_lop']);
        $list_student=$this->M_student->get_student($ma_pc_cn);
        //print_r($list_student);
        if (!empty($list_student)) {
            foreach ($list_student as $k) {
                array_push($arr, array($k->ma_hocvien => $k->ho_hocvien.' '.$k->ten_hocvien));
            }
        }
        $data['hocvien']=$arr;
        $data['hidden'] = array(
                            'sdt'  => $fld['sdt'],
                            'ma_khoa' => $fld['ma_khoa'],
                            'ma_mon' => $fld['ma_mon'],
                            'ma_lop' => $fld['ma_lop'],
                            'ngay' => $fld['ngay'],
                            'ma_buoi' => $fld['ma_buoi'],
                    );

        
        $arr= array('active','success','info','warning','danger');
        $list_student=$this->M_student->list_hocvienvang($fld);
        $stt=1;
        $i=0;
        $str='';

        foreach ($list_student as $k) {
            $url_del=base_url('theo_doi/delete_hvvang/'.$fld['ma_khoa'].'/'.$fld['ma_mon'].'/'.$fld['ma_lop'].'/'.$fld['ngay'].'/'.$fld['ma_buoi'].'/'.$k->ma_hocvien);
            $str .='<tr class="'.$arr[$i++].'">
                  <td>'.$stt++.'</td>
                  <td>'.$k->ma_hocvien.'</td>
                  <td>'.$k->ho_hocvien.'</td>
                  <td>'.$k->ten_hocvien.'</td>
                  <td class="text-center"><a href="'.$url_del.'">Del</a>
                  </td>
                </tr>';
            $i = ($i==4)? 0:$i;
        }
        $data['str']=$str;
        $data['sm'] = array(
                        'value' => 'Thêm',
                        'class' => 'btn btn-default btn-success'
                        );
        $this->load->view('V_hocvienvang', $data, FALSE);
    }
    public function them_hv_vang(){
        $fld = $this->input->post(NULL,FALSE);
        if (empty($fld)) {
            $this->load->view('home/V_error');
            return;
        }
        
        $fld['ma_theodoi']=$this->M_theo_doi->get_so_theo_doi($fld['ngay'],$fld['sdt'],$fld['ma_khoa'],$fld['ma_mon'],$fld['ma_lop'],$fld['ma_buoi'])->ma_theodoi;
        
        if ($this->M_student->check_hvvang($fld)) {
            $data['errors']='Dữ liệu thêm đã tồn tại.';
            $data['url'] = 'theo_doi/hocvienvang/'.$fld['ma_khoa'].'/'.$fld['ma_mon'].'/'.$fld['ma_lop'].'/'.$fld['ngay'].'/'.$fld['ma_buoi'];
            $this->load->view('theo_doi/V_errors',$data);
            return;
        }
        unset($fld['ngay'],$fld['sdt'],$fld['ma_khoa'],$fld['ma_mon'],$fld['ma_lop'],$fld['ma_buoi']);
        print_r($fld);
        $this->M_student->insert_hvvang($fld);
        $this->hocvienvang();
    }

    public function delete_hvvang(){
        $ma_khoa=$this->uri->segment(3,null);
        $ma_mon=$this->uri->segment(4,null);
        $ma_lop=$this->uri->segment(5,null);
        $ngay = $this->uri->segment(6,null);
        $ma_buoi= $this->uri->segment(7,null);
        $ma_hocvien = $this->uri->segment(8,null);
        $sdt= $this->user_info->sdt;
        $fld['ma_theodoi'] = $this->M_theo_doi->get_so_theo_doi($ngay,$sdt,$ma_khoa,$ma_mon,$ma_lop,$ma_buoi)->ma_theodoi;
        $fld['ma_hocvien']=$ma_hocvien;
        $this->M_student->delete_hvvang($fld);
        $this->hocvienvang($fld);
    }
    public function change_class(){
        $sdt = $this->user_info->sdt;
        $ma_khoa = $this->input->post('ma_khoa');
        $list=$this->M_theo_doi->get_lop_co_hv($sdt,$ma_khoa);
        $i=0;
        $str='';
        foreach ($list as $k) {
            $str.='<optgroup label="'.$i++.'">
                        <option value="'.$k->ma_lop.'">'.$k->ten_lop.'</option>
                    </optgroup>';
        }
        echo $str;
    }
    public function change_quan_so(){
        $ma_khoa = $this->input->post('ma_khoa');
        $ma_lop = $this->input->post('ma_lop');
        $ma_pc_cn = $this->M_homeroom->get_ma_pc_cn($ma_khoa,$ma_lop);
        echo $quan_so= $this->M_student->get_quan_so($ma_pc_cn);
    }

}

/* End of file theo_doi.php */
/* Location: ./application/modules/home/controllers/theo_doi.php */