<?php

class Inventory extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

    }


    function index(){
    	header('Content-Type: text/html; charset=UTF-8');

		// Read the spreadsheet via a relative path to the document
		$file = APPPATH.'../docs/file.xls';
 		$sheetnames = array('Inventory Form 2016');
 		$ext = pathinfo($file, PATHINFO_EXTENSION);
 		//load the excel library
		$this->load->library('excel');
		if ($ext == 'xls') {
				$objReader = PHPExcel_IOFactory::createReader('Excel5');
			} else if ($ext == 'xlsx') {
				$objReader = PHPExcel_IOFactory::createReader('Excel2007');
			} else {
				die('Invalid file format given: ' . $ext);
			} 
		//read file from path
		$objReader->setReadDataOnly(true);
		$objReader->setLoadSheetsOnly($sheetnames);
		$objPHPExcel = $objReader->load($file);

		//get only the Cell Collection
		$active_sheet = $objPHPExcel->getActiveSheet();
		$cell_collection = $active_sheet->getCellCollection();
		$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
    	$highestRow = $objWorksheet->getHighestRow();
    	$highestColumn = $objWorksheet ->getHighestColumn();


		//extract to a PHP readable array format
		foreach ($cell_collection as $cell) {
			
			    $column = $objWorksheet->getCell($cell)->getColumn();
			    $row = $objWorksheet->getCell($cell)->getRow();
			    $data_value = $objWorksheet->getCell($cell)->getValue();

			    //header will/should be in row 1 only. of course this can be modified to suit your need.
			    if (in_array($column,range('A',$highestColumn))) {
			    	if (in_array($row,range(10,$highestRow))) {
			    		if ($row == 18) {
			    			$header[$row][$column] = $data_value;
			    		}else if($row > 18) {
			    			if (in_array($column,range('B',$highestColumn))!= '') {
				        		$arr_data[$row][$column] = $data_value;
				        	}	
				    	}
					}
			    } 
			
		}

		
		$array_name = array();
		$array_pop = array();

		if(is_array($arr_data) && !empty($arr_data)) {
			$column_size = sizeof($arr_data) + 19;
			for ($row = 19; $row < $column_size; $row++) {
				//  Push a row of data into an array
	
				$data_array[] = array(
										$arr_data[$row]['B'], 
										$arr_data[$row]['C'], 
										$arr_data[$row]['D'], 
										$arr_data[$row]['E'],
										$arr_data[$row]['F'],
										$arr_data[$row]['G'],
										$arr_data[$row]['H'],
										$arr_data[$row]['I'],
										$arr_data[$row]['J'],
										$arr_data[$row]['K'],
										$arr_data[$row]['L'],
										$arr_data[$row]['M'],
										$arr_data[$row]['N'],
									);

			}		
			echo json_encode($data_array);
		}
		 
		//send the data in an array format
		$data['header'] = $header;
		$data['values'] = $arr_data;

		//echo json_encode($data);
    }
}