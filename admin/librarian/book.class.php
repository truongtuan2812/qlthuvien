<?php
include "dbcon.class.php";

class book extends connection_db
{
	public $ma_sach;
	public $ten_sach;
	public $tac_gia;
	public $nha_xuat_ban;
	public $nam_xuat_ban;
    public $so_trang;
	public $the_loai;
    public $mo_ta;
    public $tinh_trang;
    public $anh;
    public $tai_lieu;
		
	function stripUnicode($str){
		if(!$str) return false;
		$unicode = array(
		  'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
		  'd'=>'đ|Đ',
		  'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
		  'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
		  'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
		  'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
		  'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
		);
		foreach($unicode as $nonUnicode=>$uni) 
			$str = preg_replace("/($uni)/i",$nonUnicode,$str);
		return $str;
	}
	function getall(){
		$sql = "select * from sach INNER JOIN the_loai
		ON sach.ma_sach = the_loai.ma_sach";
		return $this->query($sql);
	
	}
	function find_advance($truy_van){
		$sql = "select * from sach where " .$truy_van;
		return $this->query($sql);
	}
	function getall_old(){
		$sql = "select * from sach INNER JOIN the_loai
		ON sach.ma_sach = the_loai.ma_sach where tinh_trang ='cu' ";
		return $this->query($sql);
	}
	function getall_new(){
		$sql = "select * from sach INNER JOIN the_loai
		ON sach.ma_sach = the_loai.ma_sach where tinh_trang ='moi' ";
		return $this->query($sql);
	}
	// function get_ma_sach($ma_sach){
	// 	$sql = "SELECT * FROM `sach` WHERE ma_sach = '$ma_sach' ";
	// 	return $this->query1($sql);
	// }
	function get_ma_sach($ma_sach){
		
		$sql = "select * from sach INNER JOIN the_loai
		ON sach.ma_sach = the_loai.ma_sach where the_loai.ma_sach = '$ma_sach' ";
		return $this->query1($sql);
	}
	/*
	function del($tendangnhap){
		$sql="DELETE FROM `taikhoan` WHERE tendangnhap='$tendangnhap' ";
		return $this->non_query($sql);
	}
	*/
	
	function del(){
		$sql="DELETE FROM `sach` WHERE ma_sach='$this->ma_sach' ";
		$this->no_query($sql);
		$sql_1="DELETE FROM `the_loai` WHERE ma_sach='$this->ma_sach' ";
		return $this->no_query($sql_1);


	}
	
	function insert(){
		//$sql="INSERT INTO sach(ma_sach,ten_sach,nha_xuat_ban,nam_xuat_ban) VALUES('$this->ma_sach','$this->ten_sach','$this->nha_xuat_ban','$this->nam_xuat_ban')";
		
		$sql = "INSERT INTO `sach`(`ma_sach`, `ten_sach`,`tac_gia`,`nha_xuat_ban`, `nam_xuat_ban`, `so_trang`,`tinh_trang`, `mo_ta`, `anh`, `tai_lieu`)
		 VALUES ('$this->ma_sach', '$this->ten_sach','$this->tac_gia', '$this->nha_xuat_ban', $this->nam_xuat_ban, $this->so_trang, '$this->mo_ta', '$this->tinh_trang', '$this->anh', '$this->tai_lieu')";
		$this->no_query($sql);
		$sql_1 ="INSERT INTO `the_loai`(`ma_sach`, `the_loai`) VALUES ('$this->ma_sach','$this->the_loai')";
		$this->no_query($sql_1);

	}
	
	function update()
	{

	$sql="UPDATE `sach` SET
	 `ten_sach`='$this->ten_sach',
	 `tac_gia`='$this->tac_gia', 
	 `nha_xuat_ban`='$this->nha_xuat_ban',
	 `nam_xuat_ban`=$this->nam_xuat_ban, 
	 `so_trang`= $this->so_trang, 
	 `tinh_trang`='$this->tinh_trang', 
	 `mo_ta`='$this->mo_ta', `anh`='$this->anh', `tai_lieu`= '$this->tai_lieu'  WHERE ma_sach = '$this->ma_sach'";  
	
	$this->no_query($sql);

	$sql_1 ="UPDATE `the_loai` SET `the_loai`='$this->the_loai' WHERE ma_sach = '$this->ma_sach' ";
	$this->no_query($sql_1);
	}
}

?>

	
	
	