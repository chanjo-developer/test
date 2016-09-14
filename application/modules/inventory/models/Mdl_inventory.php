<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mdl_inventory extends CI_Model {

	function __construct() {
        parent::__construct();
    }

    function get_similar_facility($facility, $subcounty) {
        $this->db->select('mf.id,facility_name');
        $this->db->where('facility_name LIKE', '%'.$facility.'%');
        $this->db->where('subcounty_name LIKE', '%'.$subcounty.'%');
        $this->db->from('tbl_facilities mf');
        $this->db->join('tbl_subcounties', 'tbl_subcounties.id = mf.subcounty_id');
        $this->db->join('tbl_counties', 'tbl_counties.id = mf.county_id');
        $this->db->join('tbl_regions', 'tbl_counties.region_id = tbl_regions.id');
        $query = $this->db->get();
        return $query->result();
    }

     function get_facility($subcounty) {
        $this->db->select('mf.id,facility_name');
        $this->db->where('subcounty_name LIKE', '%'.$subcounty.'%');
        $this->db->from('tbl_facilities mf');
        $this->db->join('tbl_subcounties', 'tbl_subcounties.id = mf.subcounty_id');
        $this->db->join('tbl_counties', 'tbl_counties.id = mf.county_id');
        $this->db->join('tbl_regions', 'tbl_counties.region_id = tbl_regions.id');
        $query = $this->db->get();
        return $query->result();
    }

    function get_similar_model($model) {
        $this->db->select('id,Model');
        $this->db->where('Model LIKE', '%'.$model.'%');
        $this->db->from('tbl_fridges');
        $query = $this->db->get();
        return $query->result();
    }

    function get_inventory() {
        $this->db->select('*');
        $this->db->from('tbl_inventory ti');
        $this->db->join('tbl_facilities', 'tbl_facilities.id = ti.facility_id');
        $this->db->join('tbl_fridges', ' tbl_fridges.id= ti.fridge_id');
        // $this->db->join('tbl_subcounties', 'tbl_subcounties.id = mf.subcounty_id');
        // $this->db->join('tbl_counties', 'tbl_counties.id = mf.county_id');
        // $this->db->join('tbl_regions', 'tbl_counties.region_id = tbl_regions.id');
        $query = $this->db->get();
        return $query->result();
    }

}    


