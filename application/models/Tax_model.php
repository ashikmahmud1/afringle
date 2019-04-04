<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Tax_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();

    }



    		private $Table = 'taxes';
    		private $Table_id = 'tax_id';


        /*
         * Insert taxes data
         */
     		public function Insert($data){

			    $data['hotel_id'] = $hotelid = $this->session->userdata['is_logged_admin']['hotel_id'];
    			$result = $this->db->insert($this->Table, $this->security->xss_clean($data) );
    			if($result == 1)
    				return true;
    			else
    				return false;
    		}

        /*
         * List of taxes data
         */
    		public function ListData()
    		{
				$hotel_id = $hotelid = $this->session->userdata['is_logged_admin']['hotel_id'];
     			$this->db->select('*');
    			$this->db->from($this->Table);
    			$this->db->where('hotel_id',"$hotel_id");
    			$this->db->order_by($this->Table_id,'DESC');
      			$query = $this->db->get();
    			return $query->result_array();
    		}

        /*
         * List of taxes data
         */
    		public function RowData($id)
    		{
     			$this->db->select('*');
    			$this->db->from($this->Table);
    			$this->db->where($this->Table_id,$id);
     			$query = $this->db->get();
    			return $query->row_array();
    		}


        /*
         * Update taxes data
         */
    		public function Update($data,$id){

    			$result = $this->db->update($this->Table, $this->security->xss_clean($data), [ $this->Table_id => $id] );
    			if($result == 1)
    				return true;
    			else
    				return false;
    		}

        /*
         * Delete taxes data
         */
    		public function Delete($id){
    			$this->db->where($this->Table_id, $id);
    			$res = $this->db->delete($this->Table);
    			if($res == 1)
    				return true;
    			else
    				return false;

    		}

        /*
         * Type of taxes
         */
    		public function TaxType(){
    			$this->db->select('tax_id,tax_name,tax_percentage');
    			$this->db->from($this->Table);
      			$query = $this->db->get();
    			return $query->result_array();
    		}


        /*
         * Get tax name
         */
    		public function GetTaxName($id)
    		{
     			$this->db->select('tax_id,tax_name,tax_percentage');
    			$this->db->from($this->Table);
    			$this->db->where($this->Table_id,$id);
     			$query = $this->db->get();
    			return $query->row_array();
    		}



}
