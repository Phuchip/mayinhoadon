<?
include('../home/config.php');
echo '<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />';
$form = '<form action="" method="POST" enctype="multipart/form-data">';
$form .= '<input type="file" name="excel">';
$form .= '<br>';
$form .= '<input type="submit" name="push" value="push">';
$form .= '</form>';
echo $form;

if(isset($_FILES['excel'])){
	include '../classes/PHPExcel/IOFactory.php';

	$file_tmp = $_FILES['excel']['tmp_name'];
	$inputFileName = $file_tmp;
	try {
		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($inputFileName);
	} catch(Exception $e) {
		die('Lỗi không thể đọc file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
	}
	// lấy tổng số sheet trên site
	$sheetCount = $objPHPExcel->getSheetCount();
	// Khai báo mảng $rowData chứa dữ liệu
	$rowData = array();
	$row_cl = array();

	for ($i=0; $i < $sheetCount; $i++) { 
		// Lấy sheet hiện tại
		$sheet = $objPHPExcel->getSheet($i); 
		// Lấy tổng số dòng của file
		$highestRow = $sheet->getHighestRow(); 
		// Lấy tổng số cột của file
		$highestColumn = $sheet->getHighestColumn();
		//  Thực hiện việc lặp qua từng dòng của file, để lấy thông tin
		for ($row = 1; $row <= $highestRow; $row++){ 
		    // Lấy dữ liệu từng dòng và đưa vào mảng $rowData
			$row_cl = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE,FALSE);
			$rowData[] = $row_cl[0];
			unset($row_cl);
		}
	}
	$u = 0;
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=Thong_ke_SL_key.xls");
	header("Pragma: no-cache");
	header("Expires: 0");

	echo '<table border="1px solid black">';
	echo '<tr>';
	echo '<td><strong> Key </strong></td>';
	echo '<td><strong> Số tin tuyển dụng</strong></td>';
	foreach ($rowData as $key => $value) {
		$key_sql =  $value[0];
		if($key_sql!=''){
			$condition = "(new_title LIKE '%".str_replace(' ', "%' AND new_title LIKE '%", trim($key_sql))."%')";
			$sql = "SELECT count(*) FROM new JOIN user_company ON user_company.usc_id = new.new_user_id WHERE $condition";
			$db_qr = new db_query($sql);
			$row = mysql_fetch_assoc($db_qr->result);
			$count = $row['count(*)'];
			echo'<table border="1px solid black">';
			echo'<tr>';
			echo'<td>'.$key_sql.'</td>';
			echo'<td>'.$count.'</td>';
		}
	}
	$a = 1;
	echo '</tr>';
	echo '</table>';


	unset($rowData);
}
?>