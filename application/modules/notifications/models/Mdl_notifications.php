<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mdl_notifications extends CI_Model {

	function get_notification_count() {
            $this->db->select('*');
            $this->db->distinct();
            $this->db->from('m_order');
            $this->db->where('status',1);
            $query = $this->db->get();
            return $query->num_rows();
        }

     function get_task() {
            $this->db->select('*');
            $this->db->distinct();
            $this->db->from('m_order');
            $this->db->where('status',1);
            $query = $this->db->get();
            return $query->result();
        }
   
    }