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
           $data['view_file'] = "index_view";
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
						if ($row == 6) {
					    		$location['county'] = $objWorksheet->getCellByColumnAndRow(3, 6)->getValue() ;
					    		$location['subcounty'] = $objWorksheet->getCellByColumnAndRow(11, 6)->getValue() ;
			    		}
						else if ($row == 18) {
					    		$header[$row][$col] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue() ;
			    		}else if($row > 18) {
			    			$first_column = $objWorksheet->getCellByColumnAndRow(1, $row)->getValue() ;
			    			if (!is_null($first_column))  {
				    			
					    			$arr_data[$row][$col] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue() ;
					        	
					        }
				    	}


					}
				}
			
				
				if(is_array($arr_data) && !empty($arr_data)) {
					$column_size = sizeof($arr_data) + 19;
					for ($row = 19; $row < $column_size; $row++) {
						//  Push a row of data into an array
								
						$data_array[] = array(
										"subcounty_name"	=>	$location['subcounty'], 
										"facility_id"	=>	$arr_data[$row]['0'], 
										"facility_name"	=>	$arr_data[$row]['1'], 
										"details" 		=> array(
											"catchment_pop"	=>	$arr_data[$row]['2'], 
											"live_birth_pop"	=>	$arr_data[$row]['3'], 
											"immunizing_status"	=>	$arr_data[$row]['4'], 
											"working_coldboxes"	=>	$arr_data[$row]['5'],
											"working_vaccine_carriers"	=>	$arr_data[$row]['6'],
											"ice_packs"	=>	$arr_data[$row]['7'],
											"elec_availability"	=>	$arr_data[$row]['8'],
											"make"	=>	$arr_data[$row]['9'],
											"model"	=>	$arr_data[$row]['10'],
											"age"	=>	$arr_data[$row]['11'],
											"status"	=>	$arr_data[$row]['12'],
											"ft2_availability"	=>	$arr_data[$row]['13'],
											),
										"similarities"	=>	$this->retrieve_facility($location['subcounty']),
											);

					}		
					
					
				}
				
				//send the data in an array format
				$data['location'] = $location;
				$data['header'] = $header;
				$data['values'] = $data_array;
				$json_data = array("data" => $data_array);
				
			
			    $fp = fopen(APPPATH.'../docs/json/facilities.json', 'w+');
			    fwrite($fp, json_encode($json_data));
			    redirect('inventory/list_inventory');
			
			}else{
				show_error('Error. Please make sure the Excel document follows the proper format given!');
			}
			
		}else{
			show_error('Please try again. Unsuccessful file upload!');
		}
    }

   	function list_inventory(){
		$data['section'] = "NVIP Chanjo";
		$data['subtitle'] = "Inventory";
		$data['page_title'] = "Views";
		$data['module'] = "inventory";
		$data['view_file'] = "match_view";
		$data['user_object'] = $this->get_user_object();
		$data['main_title'] = $this->get_title();
		//breadcrumbs
		$this->load->library('make_bread');
		$this->make_bread->add('Inventory', 'inventory', 1);
		$this->make_bread->add('List Inventory', 'inventory/list_inventory', 1);
		$data['breadcrumb'] = $this->make_bread->output();
	
		echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
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
                          
                           return $this->load_excel($data);                        
                            
                }
    }

    function retrieve_similar_facility(){
    	$this->load->model('mdl_inventory');

    	$facility = $this->input->post('facility');
    	$subcounty = $this->input->post('subcounty');
    	
    	$query = $this->mdl_inventory->get_similar_facility($facility, $subcounty);
    	echo json_encode($query);
    }

	function retrieve_facility($subcounty)
    {
    	$this->load->model('mdl_inventory');
    	$query = $this->mdl_inventory->get_facility($subcounty);
    	return ($query);
    	// echo json_encode($query);
    }

    function get_similar_model()
    {
    	$this->load->model('mdl_inventory');
    	$query = $this->mdl_inventory->get_similar_model('RCW 42 EG');
    	// return ($query);
    	echo json_encode($query);
    }


    function save(){
    	$info['user_object'] = $this->get_user_object();

    	$user_id = $info['user_object']['user_id'];
    	$station = $info['user_object']['user_statiton'];
       	$level= $info['user_object']['user_level'];

    	$data = stripcslashes($_POST['data']);
        $data = json_decode($data, TRUE);

        $data_array = array();
        foreach ($data as $item ) {
            
            $data_array['facility_id'] = $item['matching_id'];
            $data_array['coldboxes'] = $item['details']['working_coldboxes'];
            $data_array['catchment_pop'] = $item['details']['catchment_pop'];
            $data_array['live_birth_pop'] = $item['details']['live_birth_pop'];
            $data_array['vaccine_carriers'] = $item['details']['working_vaccine_carriers'];
            $data_array['ice_packs'] = $item['details']['ice_packs'];
            $data_array['electricity'] = $item['details']['elec_availability'];
            $data_array['functional_status'] = $item['details']['status'];
            $data_array['age'] = filter_var($item['details']['age'], FILTER_SANITIZE_NUMBER_INT);
           	// $data_array['make'] = $item['details']['make'];
           	// $data_array['model'] = $item['details']['model'];
           	$data_array['ft2_availability'] = $item['details']['ft2_availability'];
           	$data_array['user_id'] = $user_id;
           	$data_array['station'] = $station;
           	$data_array['level'] = $level;
           	$data_array['date_added'] = $date_recorded = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s')));;
            $this->db->insert('tbl_inventory', $data_array);
           
            }
            
            
        $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Cold Chain Inventory updated successfully!</div>');
        
        
    }

    function retrieve_inventory()
    {
    	$this->load->model('mdl_inventory');
    	$query['data'] = $this->mdl_inventory->get_inventory();
    	echo json_encode($query);
    }
}