<?php

class Inventory extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

    }

    function index () {
          
           $data['section'] = "NVIP Chanjo";
           $data['subtitle'] = "Library";
           $data['page_title'] = "Files";
           $data['module'] = "inventory";
           $data['view_file'] = "match_view";
           $data['user_object'] = $this->get_user_object();
           $data['main_title'] = $this->get_title();
            //breadcrumbs
            $this->load->library('make_bread');
            $this->make_bread->add('inventory', '/', 1);
            $data['breadcrumb'] = $this->make_bread->output();
            //
           echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
       }

    function load_excel($file=Null){
    	//header('Content-Type: text/html; charset=UTF-8');
    	
    	if(!is_null($file)){

    		$file_path = $file['upload_data']['file_path'];
    		$file_name = $file['upload_data']['file_name'];
    		$file_ext = $file['upload_data']['file_ext'];
	    	
			// Read the spreadsheet via a relative path to the document
			$file = $file['upload_data']['full_path'];
	 		$allowed_sheet = 'Inventory Form 2016';
	 		$sheetnames = array($allowed_sheet);
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
			$sheet_loader = $objReader->setLoadSheetsOnly($sheetnames);
			$objPHPExcel = $objReader->load($file);
			$sheets = $objPHPExcel->getSheetNames();
			if (in_array($allowed_sheet, $sheets)==TRUE){
				
				//get only the Cell Collection
				$active_sheet = $objPHPExcel->getActiveSheet();
				$cell_collection = $active_sheet->getCellCollection();
				$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
		    	$highestRow = $objWorksheet->getHighestRow();
		    	$highestColumn = $objWorksheet ->getHighestColumn();
		    	$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

		    	 for ($row = 1; $row <= $highestRow; ++$row) {
					for ($col = 0; $col <= $highestColumnIndex; ++$col) {
						if ($row == 18) {
					    		$header[$row][$col] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue() ;
			    		}else if($row > 18) {
			    			$first_column = $objWorksheet->getCellByColumnAndRow(1, $row)->getValue() ;
			    			if (!is_null($first_column))  {
				    			//if (!empty(in_array($row,range(3,$highestRow)))) {
					    			$arr_data[$row][$col] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue() ;
					        	// }

					        }
				    	}


					}
				}
			
				
				if(is_array($arr_data) && !empty($arr_data)) {
					$column_size = sizeof($arr_data) + 19;
					for ($row = 19; $row < $column_size; $row++) {
						//  Push a row of data into an array
								
						$data_array[] = array(
												$arr_data[$row]['1'], 
												$arr_data[$row]['2'], 
												$arr_data[$row]['3'], 
												$arr_data[$row]['4'],
												$arr_data[$row]['5'],
												$arr_data[$row]['6'],
												$arr_data[$row]['7'],
												$arr_data[$row]['8'],
												$arr_data[$row]['9'],
												$arr_data[$row]['10'],
												$arr_data[$row]['11'],
												$arr_data[$row]['12'],
												$arr_data[$row]['13'],
											);

					}		
					
					//echo json_encode($data_array);
				}
				 
				//send the data in an array format
				$data['header'] = $header;
				$data['values'] = $arr_data;

				echo json_encode($data);
			}else{
				show_error('Error. Please make sure the Excel document follows the proper format given!');
			}
			
		}else{
			show_error('Please try again. Unsuccessful file upload!');
		}
    }


    function excel_upload() {
            $config['upload_path']='./docs/excel';
            $config['allowed_types']='xls|xlsx';
            $config['max_size']='2048';
            $config['remove_spaces']= TRUE;

            $this->load->library('upload', $config);
                //$this->upload->initialize($config);
                    if ( ! $this->upload->do_upload()) {
                      
                        $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-danger text-center">'.$this->upload->display_errors().'</div>');
                        redirect('inventory/index');
                    }
                    else
                    {
                            $data = $this->upload->data();
                            $data = array('upload_data' => $this->upload->data());
                            //$this->session->set_flashdata('msg','<div id="alert-message" class="alert alert-success text-center">File uploaded successfully!</div> ');
                           // redirect('inventory/index');
                            $this->load_excel($data);
                            
                }
        }

}