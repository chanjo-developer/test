<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use
    DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Join,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate;

class Mdl_Stock extends CI_Model
{
	
	private $editorDb = null;

	function __construct()
	{
	parent::__construct();	
	}


     
    public function init($editorDb)
    {
        $this->editorDb = $editorDb;
    }
     
    public function getData($post, $station, $vaccine_id)
    {
        // Build our Editor instance and process the data coming from _POST
        // Use the Editor database class
               Editor::inst($this->editorDb, 'tbl_transaction' )
	        ->field(
	        Field::inst( 'tbl_transaction.id as order' ),
	        Field::inst( 'tbl_transaction.timestamp as timestamp' ),
	        Field::inst( 'tbl_transaction.transaction_date as date' ),
	        Field::inst( 'tbl_transaction.to_from as to_from' ),
	        Field::inst( 'tbl_transaction.station as station' ),
	        Field::inst( 'tbl_transaction_type.type as type' ),
	        Field::inst( 'tbl_transaction_items.vaccine_id as vaccine_id' ),
	        Field::inst( 'tbl_transaction_items.batch as batch' ),
	        Field::inst( 'tbl_transaction_items.expiry_date as expiry' ),
	        Field::inst( 'tbl_transaction_items.transaction_quantity as quantity' ),
	        Field::inst( 'tbl_balances.balance as balance' )
	    )
	    ->leftJoin( 'tbl_transaction_items', 'tbl_transaction_items.transaction_id', '=', 'tbl_transaction.id' )
	    ->leftJoin( 'tbl_vaccines', 'tbl_vaccines.id', '=', 'tbl_transaction_items.vaccine_id' )
	    ->leftJoin( 'tbl_transaction_type', 'tbl_transaction_type.id', '=', 'tbl_transaction.type' )
	    ->leftJoin( 'tbl_balances', 'tbl_balances.transaction_id', '=', 'tbl_transaction.id AND tbl_balances.station = tbl_transaction.station AND tbl_balances.vaccine_id = tbl_transaction_items.vaccine_id')
	    
        ->where( 'tbl_transaction.station', $station )
        ->where( 'tbl_transaction_items.vaccine_id', $vaccine_id )	   
        ->process( $post )
        ->json();    
    }


	function get_all_physical_counts($selected_vaccine, $station){
		if (isset($selected_vaccine) && !is_null($selected_vaccine)) {
			$call_procedure="call get_physical_count('$station',$selected_vaccine)";
	        $query=$this->db->query($call_procedure);
	        $query->next_result();
	        return $query->result_array();
		}else{
			return false;
		}

	}

	function count_records($selected_vaccine){
		$this->db->distinct();
		$this->db->select('vaccine_id, Vaccine_name, batch_number, expiry_date ,stock_balance');
		$this->db->join('m_vaccines ', ' m_vaccines.ID = m_stock_balance.vaccine_id');
		$s = array('vaccine_id' => $selected_vaccine);
		$this->db->where($s);
		$query = $this->db->get('m_stock_balance');
	    return $query->num_rows();

	}
	function get_transaction_type(){
		$this->db->select('id,transaction_type');
        $query = $this->db->get('m_transaction_type');
        return $query->result_array();
	}
	function get_batches($selected_vaccine, $station){
		if (isset($selected_vaccine) && is_numeric($selected_vaccine)) {
			$call_procedure="call get_vaccine_batch('$station',$selected_vaccine)";
	        $query=$this->db->query($call_procedure);
	        $query->next_result();
	        return $query->result_array();
		}else{
			return false;
		}
        
	}


	function get_expiry($selected_vaccine, $batch){
		if (isset($selected_vaccine) && is_numeric($selected_vaccine)) {
			$call_procedure="call get_expiry_date($selected_vaccine,'$batch')";
	        $query=$this->db->query($call_procedure);
	        $query->next_result();
	        return $query->result_array();
		}else{
			return false;
		}
        
	}

	function get_batch_details($selected_batch, $station){
		if (isset($selected_batch) && !is_null($selected_batch)) {
			$call_procedure="call get_vaccine_batch_details('$station','$selected_batch')";
	        $query=$this->db->query($call_procedure);
	        $query->next_result();
	        return $query->result_array();
		}else{
			return false;
		}
	}


	
	function get_region_base(){
		$this->db->select('id, region_name as location');
		$query=$this->db->get('tbl_regions');
		return $query->result();
	}

	function get_county_base($user_id){
		$this->db->select('tbl_counties.id, tbl_counties.county_name as location');
		$this->db->from('tbl_regions');
		$this->db->join('v_regions_userbase', 'tbl_regions.id = v_regions_userbase.region');
		$this->db->join('tbl_counties', 'tbl_regions.id =  tbl_counties.region_id ');
		$this->db->where('user_id',$user_id);
		$this->db->order_by('tbl_counties.county_name', 'asc');
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_subcounty_base($user_id){
		$this->db->select('tbl_subcounties.id, tbl_subcounties.subcounty_name as location');
		$this->db->from('tbl_counties');
		$this->db->join('v_counties_userbase', 'tbl_counties.id = v_counties_userbase.county');
		$this->db->join('tbl_subcounties', 'tbl_counties.id =  tbl_subcounties.county_id ');
		$this->db->where('user_id',$user_id);
		$this->db->order_by('tbl_subcounties.subcounty_name', 'asc');
		$query = $this->db->get();
		return $query->result();
	}
	// function get_subcounty($user_id){
	// 	$this->db->select('tbl_subcounties.id, tbl_subcounties.subcounty_name as location');
	// 	$this->db->from('tbl_user_base');
	// 	$this->db->join('tbl_regions', 'tbl_regions.id = region');
	// 	$this->db->join('tbl_counties', 'tbl_counties.region_id = tbl_regions.id');
	// 	$this->db->join('tbl_subcounties', 'tbl_subcounties.county_id = tbl_counties.id');
	// 	$this->db->where('user_id',$user_id);
	// 	$this->db->order_by('tbl_subcounties.subcounty_name', 'asc');
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }
	function get_subcounty($user_id){
		$this->db->select('id,location');
		$this->db->from('v_regions_locations');
		$this->db->where('user_id',$user_id);
		$this->db->order_by('location', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	function get_facility_base($user_id){
		$this->db->select('tbl_facilities.id, tbl_facilities.facility_name as location');
		$this->db->from('tbl_subcounties');
		$this->db->join('v_subcounties_userbase', 'tbl_subcounties.id = v_subcounties_userbase.subcounty');
		$this->db->join('tbl_facilities', 'tbl_subcounties.id =  tbl_facilities.subcounty_id ');
		$this->db->order_by('tbl_facilities.facility_name', 'asc');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		return $query->result();
	}

	function get_orders($station){
		$this->db->select('id');
		$this->db->from('tbl_request');
		$this->db->where('station',$station);
		$query = $this->db->get();
		return $query->result();
	}



	public function show_data_by_date_range($option, $date, $id, $station_id) {
		$condition = "date_created BETWEEN " . "'" . $date[0] . "'" . " AND " . "'" . $date[1] . "'";
		$array = array('vaccine_id' => $id, 'station' => $station_id);
		if ($option=='in') {
			$this->db->select($this->column);
			$this->db->where($array);
			$this->db->where($condition);
			$query = $this->db->get('v_received_transactions');
		} elseif ($option=='out') {
			$this->db->select($this->column2);
			$this->db->where($array);
			$this->db->where($condition);
			$query = $this->db->get('v_issued_transactions');
		}
		
		
		return $query->result();

	}

	function get_vaccine_ledger_out($id, $station_id){
			$this->_get_ledger_out_query($id, $station_id);
			if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
			return $query->result();
		}

	private function _get_ledger_out_query($id, $station_id){
		$this->db->select($this->column2);
		$this->db->from('v_issued_transactions');
		$array = array('vaccine_id' => $id, 'station' => $station_id);
		$this->db->where($array);
		$i = 0;

		foreach ($this->column2 as $item) 
		{
			if($_POST['search']['value'])
				($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
			$column2[$i] = $item;
			$i++;
		}

		if(isset($_POST['order']))
		{
			$this->db->order_by($column2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->issue_order_value))
		{
			$order = $this->issue_order_value;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

    function get_order_batch($order_id ,$vaccine_id, $station_id){
        $callprocedure="CALL get_request_batch('$station_id', $order_id, $vaccine_id)";
		$query=$this->db->query($callprocedure);
		$query->next_result();
		return $query->result_array();
    }

    function get_quantity_data($station, $vaccine_id, $type){
		
		$this->db->distinct();
        $this->db->select('transaction_date,vaccine_id,quantity');
		$this->db->from('v_issued_received');
		$array = array('station' => $station ,'vaccine_id' => $vaccine_id,'type' => $type);
        $this->db->where($array);
		$query = $this->db->get();
		// return $query->result_array();
		return $query->result();
	}

	function get_vaccines(){
		$this->db->select('id,vaccine_name');
		$this->db->order_by('vaccine_name','asc');
		$query = $this->db->get('tbl_vaccines');
		return $query->result();
	}


	function get_stock_balance($selected_vaccine ,$station)
	{
		$this->db->distinct();
		$this->db->select('balance as stock_balance');
		$this->db->from('tbl_balances');
		$array = array('vaccine_id' => $selected_vaccine, 'station' => $station );
        $this->db->where($array);
        $this->db->having('stock_balance > 0');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
		$query = $this->db->get();
        return $query->result_array();
	}

    
    function get_batch_stock_summary($selected_vaccine ,$station_id){

		$this->db->distinct();
		$this->db->select('ms.batch,ms.expiry_date, ms.balance');
		$this->db->from('tbl_balances ms');
		$array = array('ms.vaccine_id' => $selected_vaccine, 'ms.station' => $station_id );
        $this->db->where($array);
        $this->db->group_by('ms.vaccine_id, ms.batch');
        $this->db->having('min(ms.balance) > 0');
        $this->db->order_by('expiry_date', 'asc');
		$query = $this->db->get();
		return $query;
	}
	
	function count_issued_filtered($id, $station_id){
		$this->_get_ledger_out_query($id, $station_id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_received_filtered($id, $station_id){
		$this->_get_ledger_in_query($id, $station_id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function get_store_balance($selected_vaccine, $user_id){
		$this->db->select('Vaccine as vaccine, Stock_Balance as balance');
		$this->db->from('vaccine_stockbalance');
		$this->db->where('id',$selected_vaccine);
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		return $query->result();
	}   

	function count_all() {
		$query=$this->db->get('vaccine_movement');
		$num_rows = $query->num_rows();
		return $num_rows;
	}

	function get_order_to_issue($order_id){
		$callprocedure="CALL get_issue_request($order_id)";
		$query=$this->db->query($callprocedure);
		$query->next_result();
		return $query->result_array();
	}
	function get_order_infor($order_id){
		$callprocedure="CALL get_request_info($order_id)";
		$query=$this->db->query($callprocedure);
		$query->next_result();
		return $query->result_array();

	}
	function get_order_to_receive($order_id){
		$callprocedure="CALL get_issue_details($order_id)";
		$query=$this->db->query($callprocedure);
		$query->next_result();
		return $query->result_array();
	}

	function _remove_duplicate($id, $data) {
		$table = "view_orders_received";
		$this->db->where('id', $id);
		$this->db->update($table, $data);
		return true;

	}

}