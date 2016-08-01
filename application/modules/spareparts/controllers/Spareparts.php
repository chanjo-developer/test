<?php
class Spareparts extends MY_Controller {

      function __construct() {
        parent::__construct();
        // $this->output->enable_profiler(true);
        Modules::run('secure_tings/ni_met');
      }


      public function index()
      {
       
       // Modules::run('secure_tings/ni_met');
        $this->load->model('mdl_spareparts');
        $this->load->library('pagination');
        $this->load->library('table');
        $config['base_url'] = base_url().'/spareparts/index';
        $config['total_rows'] = $this->mdl_spareparts->get('id')->num_rows;
        $config['per_page'] = 10;
        $config['num_links'] = 4;
        $config['full_tag_open'] = '<div><ul class="pagination pagination-small pagination-centered">';
        $config['full_tag_close'] = '</ul></div>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";

        $this->pagination->initialize($config);
        $data['records'] = $this->db->get('spareparts_view', $config['per_page'], $this->uri->segment(3));
        $data['section'] = "Maintenance";
        $data['subtitle'] = "Spare Parts";
        $data['page_title'] = "Cold Chain Spare Parts";
        $data['module']="spareparts";
        $data['view_file']="list_spareparts_view";
        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();
        echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data); 
      }

      
      function create(){

// Modules::run('secure_tings/ni_met');
        $update_id= $this->uri->segment(3);
        $data = array();
        $this->load->model('mdl_spareparts');

            if (!isset($update_id )){
              $update_id = $this->input->post('update_id', $id);
              $data['maequipment']  = $this->mdl_spareparts->getequip();
            

            }

            if (is_numeric($update_id)){
              $data = $this->get_data_from_db($update_id);
              $data['update_id'] = $update_id;
              $data['maequipment']  = $this->mdl_spareparts->getequip();
             


            } else {
              $data= $this->get_data_from_post();
              $data['maequipment']  = $this->mdl_spareparts->getequip();
             


            }

        $data['section'] = "Maintenance";
        $data['subtitle'] = "Spare Parts";
        $data['page_title'] = "Add Cold Chain Spare Parts and Accessories";
        $data['module'] = "spareparts";
        $data['view_file'] = "create_spareparts_form";
        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();
        echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
      }

      function update(){

        $update_id= $this->uri->segment(3);
        $data = array();
        $this->load->model('mdl_spareparts');

            if (!isset($update_id )){
              $update_id = $this->input->post('update_id', $id);
            }

            if (is_numeric($update_id)){
              $data = $this->get_data_from_db($update_id);
              $data['update_id'] = $update_id;
            }

        $data['section'] = "Maintenance";
        $data['subtitle'] = "Spare Parts";
        $data['page_title'] = "Update Cold Chain Spare Parts and Accessories";
        $data['module'] = "spareparts";
        $data['view_file'] = "update_spareparts_form";
        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();
        echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
      }



      function get_data_from_post(){
       
        $data['equipment']=$this->input->post('equipment', TRUE);
        $data['etype']=$this->input->post('etype', TRUE);
        $data['e_name']=$this->input->post('e_name', TRUE);
        $data['brand']=$this->input->post('brand', TRUE);
        // $data['model']=$this->input->post('model', TRUE);
        // $data['serial']=$this->input->post('serial', TRUE);
        $data['catalogue']=$this->input->post('catalogue', TRUE);
        $data['unit_price']=$this->input->post('unit_price', TRUE);
        $data['date_purchased']=$this->input->post('date_purchased', TRUE);
        $data['quantity']=$this->input->post('quantity', TRUE);

        return $data;
      }

      function get_data_from_post_u(){
       
       
       
        $data['quantity']=$this->input->post('quantity', TRUE);

        return $data;
      }

      function get_data_from_db($update_id){
        
       $query = $this->get_where($update_id);
         foreach ($query->result() as $row){
           
           $data['quantity'] = $row->quantity;
           
         }
       return $data;
     }

     function submit (){
      // Modules::run('secure_tings/ni_met');
      $this->load->library('form_validation');
      $this->form_validation->set_rules('equipment', 'Equipment Model', 'required');
      $this->form_validation->set_rules('etype', 'Type of Equipment', 'required');
      $this->form_validation->set_rules('e_name', 'Type of Part', 'required');
      $this->form_validation->set_rules('brand', 'Equipment Brand', 'required');
      $this->form_validation->set_rules('catalogue', 'Equipment Catalogue No.', 'required');
      $this->form_validation->set_rules('unit_price', 'Equipment Unit Price', 'required');
      $this->form_validation->set_rules('date_purchased', 'Date of Purchase', 'required');
      $this->form_validation->set_rules('quantity', 'Quantity', 'required| is_natural_no_zero');


      $update_id = $this->input->post('update_id', TRUE);
          if ($this->form_validation->run() == FALSE)
          {   
            $this->create();         
          }
          else
          {  

  

           $data =  $this->get_data_from_post();
           $data['decomission'] = FALSE;
           $data['date_added'] = date('Y-m-d');
           $data['location'] = 'KENYA';
           $data['added_by'] = $this->session->userdata['logged_in']['user_id'];
          // echo "<pre>";
          //  var_dump($data);
          //  die();
          



           if(is_numeric($update_id)){
             $this->_update($update_id, $data);
             $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Spare Parts details updated successfully!</div>');

           } else {
             $this->_insert($data);
             $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">New Spare Part added successfully!</div>');
           }

                       //$this->session->set_flashdata('success', 'depot added successfully.');
       redirect('spareparts');
     }
    }


      function update_save (){
      // Modules::run('secure_tings/ni_met');
      $this->load->library('form_validation');
      $this->form_validation->set_rules('quantity', 'Quantity', 'required|is_natural_no_zero');


      $update_id = $this->input->post('update_id', TRUE);
          if ($this->form_validation->run() == FALSE)
          {   
            $this->update();         
          }
          else
          {  
        $data =  $this->get_data_from_post_u();
         if(is_numeric($update_id)){
             $this->_update($update_id, $data);
             $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Spare Parts details updated successfully!</div>');
           }

                       //$this->session->set_flashdata('success', 'depot added successfully.');
       redirect('spareparts');
     }
    }


    function delete($id){
      // Modules::run('secure_tings/ni_met');
      $this->_delete($id);
      $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Spare Parts details deleted successfully!</div>');
      redirect('spareparts');
    }


    function get($order_by){
      $this->load->model('mdl_spareparts');
      $query = $this->mdl_spareparts->get($order_by);
      return $query;
    }

    function get_with_limit($limit, $offset, $order_by) {
      $this->load->model('mdl_spareparts');
      $query = $this->mdl_spareparts->get_with_limit($limit, $offset, $order_by);
      return $query;
    }

    function get_where($id){
      $this->load->model('mdl_spareparts');
      $query = $this->mdl_spareparts->get_where($id);
      return $query;
    }

    function get_where_custom($col, $value) {
      $this->load->model('mdl_spareparts');
      $query = $this->mdl_spareparts->get_where_custom($col, $value);
      return $query;
    }

    function _insert($data){
      $this->load->model('mdl_spareparts');
      $this->mdl_spareparts->_insert($data);
    }

    function _update($id, $data){
      $this->load->model('mdl_spareparts');
      $this->mdl_spareparts->_update($id, $data);
    }

    function _delete($id){
      $this->load->model('mdl_spareparts');
      $this->mdl_spareparts->_delete($id);
    }

    function count_where($column, $value) {
      $this->load->model('mdl_spareparts');
      $count = $this->mdl_spareparts->count_where($column, $value);
      return $count;
    }

    function get_max() {
      $this->load->model('mdl_spareparts');
      $max_id = $this->mdl_spareparts->get_max();
      return $max_id;
    }

    function _custom_query($mysql_query) {
      $this->load->model('mdl_spareparts');
      $query = $this->mdl_spareparts->_custom_query($mysql_query);
      return $query;
    }

}     