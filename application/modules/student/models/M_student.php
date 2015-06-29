<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_student extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('theo_doi/M_theo_doi');
	}
	public function list_student($sdt=null,$ma_khoa=null,$ma_lop=null){
		if (isset($sdt)&&isset($ma_khoa)&&isset($ma_lop)) {
			$this->db->select('hv.*');
			$this->db->where('pc.sdt', $sdt);
			$this->db->where('pc.ma_khoa', $ma_khoa);
			$this->db->where('pc.ma_lop', $ma_lop);
			$this->db->distinct();
			$this->db->join('phan_cong_cn pc', 'pc.ma_pc_cn = hv.ma_pc_cn', 'left');
			return $this->db->get('hoc_vien hv')->result();
			return $this->db->last_query();
		}
		return  $this->db->get('hoc_vien')->result();
	}

	public function insert_student($data){
		return  $this->db->insert('hoc_vien', $data);
	}
	public function check_student($data){
		$this->db->where('ma_hocvien', $data);
		return $this->db->get('hoc_vien')->num_rows();
	}
	public function updata_student($data){
		$this->db->where('ma_hocvien', $data['ma_hocvien']);
		unset($data['ma_hocvien']);
		return $this->db->update('hoc_vien', $data);
	}
	public function delete_student($data){
		$this->db->where('ma_hocvien', $data);
		return $this->db->delete('hoc_vien');;
	}
	public function get_info($data){
		$this->db->where('ma_hocvien', $data);
		$arr = $this->db->get('hoc_vien')->result();
		return $arr[0];
	}
	public function get_student($data){
		$this->db->where('ma_pc_cn', $data);
		return $this->db->get('hoc_vien')->result();
	}
	public function list_hocvienvang($data){
		$this->db->select('hv.*,dsv.phep');
		$this->db->where('sdt', $data['sdt']);
		$this->db->where('ma_khoa', $data['ma_khoa']);
		$this->db->where('ma_lop', $data['ma_lop']);
		$this->db->where('ngay', $data['ngay']);
		$this->db->where('ma_buoi', $data['ma_buoi']);
		$this->db->where('ma_mon', $data['ma_mon']);
		$this->db->join('so_theo_doi std', 'std.ma_theodoi = dsv.ma_theodoi', 'left');
		$this->db->join('hoc_vien hv', 'hv.ma_hocvien = dsv.ma_hocvien', 'left');
		return $this->db->get('ds_hv_vang dsv')->result();
		//return  $this->db->last_query();
	}
	public function list_hocvienvang_v2($data){
		$this->db->where_in('ma_theodoi', $data);		
		return $this->db->get('ds_hv_vang dsv')->result();
		//return  $this->db->last_query();
	}
	public function insert_hvvang($data){
		return $this->db->insert('ds_hv_vang', $data);
	}
	public function check_hvvang($data){
		$this->db->where('ma_hocvien', $data['ma_hocvien']);
		$this->db->where('ma_theodoi', $data['ma_theodoi']);
		return $this->db->get('ds_hv_vang')->num_rows();
	}
	public function delete_hvvang($data){
		$this->db->where('ma_theodoi', $data['ma_theodoi']);
		$this->db->where('ma_hocvien', $data['ma_hocvien']);
		return $this->db->delete('ds_hv_vang');
	}
	public function check_luotvang($data){
		$this->db->where('ma_theodoi', $data);
		$arr = $this->db->get('ds_hv_vang');
		return $arr->num_rows();
	}
	public function check_ds_hvvang($data){
		$this->db->where('sdt', $data['sdt']);
		$this->db->where('ma_khoa', $data['ma_khoa']);
		$this->db->where('ma_lop', $data['ma_lop']);
		$this->db->where('ma_mon', $data['ma_mon']);
		$this->db->where('ma_buoi', $data['ma_buoi']);
		if($this->db->get('so_theo_doi')->num_rows()==0){
			return 0;
		}
		$ma_theodoi=$this->M_theo_doi->get_so_theo_doi($data['ngay'],$data['sdt'],$data['ma_khoa'],$data['ma_mon'],$data['ma_lop'],$data['ma_buoi'])->ma_theodoi;
		$this->db->where('ma_theodoi', $ma_theodoi);
		if($this->db->get('ds_hv_vang')->num_rows()==0){
			return 1;
		}
		return 2;
	}

	public function get_quan_so($data){
		$this->db->where('tinh_trang', 'HOC');
		$this->db->where('ma_pc_cn', $data);
		return $this->db->get('hoc_vien')->num_rows();

	}
	public function get_luot_vang($data){
		
		$query = 'SELECT ma_hocvien, 
					COUNT(CASE WHEN dsv.phep = 1 and td.ma_buoi="SANG" and td.loai="LT" THEN dsv.ma_hocvien END) as ltpsang,
					COUNT(CASE WHEN dsv.phep = 1 and td.ma_buoi="CHIEU" and td.loai="LT" THEN dsv.ma_hocvien END) as ltpchieu,
					COUNT(CASE WHEN dsv.phep = 1 and td.ma_buoi="SANG" and td.loai="TH" THEN dsv.ma_hocvien END) as thpsang,
					COUNT(CASE WHEN dsv.phep = 1 and td.ma_buoi="CHIEU" and td.loai="TH" THEN dsv.ma_hocvien END) as thpchieu,
					COUNT(CASE WHEN dsv.phep = 0 and td.ma_buoi="SANG" and td.loai="LT" THEN dsv.ma_hocvien END) as ltkpsang,
					COUNT(CASE WHEN dsv.phep = 0 and td.ma_buoi="CHIEU" and td.loai="LT" THEN dsv.ma_hocvien END) as ltkpchieu,
					COUNT(CASE WHEN dsv.phep = 0 and td.ma_buoi="SANG" and td.loai="TH" THEN dsv.ma_hocvien END) as thkpsang,
					COUNT(CASE WHEN dsv.phep = 0 and td.ma_buoi="CHIEU" and td.loai="TH" THEN dsv.ma_hocvien END) as thkpchieu

					FROM ds_hv_vang dsv,so_theo_doi td
					where dsv.ma_theodoi in('.$data.') and dsv.ma_theodoi=td.ma_theodoi
					group by dsv.ma_hocvien';
		return $this->db->query($query)->result();
	}

}

/* End of file M_student.php */
/* Location: ./application/modules/student/models/M_student.php */