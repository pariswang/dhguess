<?php

function columnIterater($set=NULL){
	static $columnArr = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	static $iter = 0;
	if(!is_null($set)){
		$iter = $set;
	}
	if( $iter >= strlen($columnArr) ){
		$first = floor($iter / strlen($columnArr));
		$second = $iter % strlen($columnArr);
		$iter++;
		return $columnArr[$first].$columnArr[$second];
	}
	return $columnArr[$iter++];
}

function exportExcel($users) {
    Vendor('Excel.PHPExcel');
		$objPHPExcel=new \PHPExcel();
		$objPHPExcel->getProperties()->setCreator('DHGate')
			->setLastModifiedBy('DHGate')
			->setTitle('DHGate Facebook Activity');
		$objPHPExcel->getSheet(0)
			->setCellValue(columnIterater(0).'1','Facebook ID')
			->setCellValue(columnIterater().'1','Name')
			->setCellValue(columnIterater().'1','创建时间')
			->setCellValue(columnIterater().'1','剩余次数')
			->setCellValue(columnIterater().'1','邀请次数');
		$objPHPExcel->getSheet(0)->getColumnDimension('A')->setWidth(30);
		$objPHPExcel->getSheet(0)->getColumnDimension('B')->setWidth(20);
		$objPHPExcel->getSheet(0)->getColumnDimension('C')->setWidth(20);
		
		$rowIndex = 2;
		foreach($users as $row){
			$objPHPExcel->getSheet(0)
				->setCellValue(columnIterater(0).$rowIndex,'`'.$row['fb_id'])
				->setCellValue(columnIterater().$rowIndex,$row['name'])
				->setCellValue(columnIterater().$rowIndex,$row['ctime'])
				->setCellValue(columnIterater().$rowIndex,$row['guess_count'])
				->setCellValue(columnIterater().$rowIndex,$row['invite_accept_count'].'/'.$row['invite_count']);
			++$rowIndex;
		}
		//生成xls文件
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="user-数据统计.xls"');
		header('Cache-Control: max-age=0');
		$objPHPExcel->setActiveSheetIndex(0);
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		
		$objWriter->save('php://output');
}

?>
