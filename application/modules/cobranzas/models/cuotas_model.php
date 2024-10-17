<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cuotas_model extends \CI_Model {
  

        function get_cuotas_data( $limit, $offset, $order_by = null, $client_id) {

            $this -> db -> from('cuotas cm');

            $this -> db -> select('cm.id, cm.Column1, cm.Column2, cm.Column3, cm.Column4, cm.Column5, cm.Column6, cm.Column7, cm.Column8', FALSE
  );
				
			
				$this -> db -> where('cm.Column1',$client_id);  
                //$this -> db -> limit($limit, $offset);

                $query = $this -> db -> get();         

            $result = $query->result();

        

            return $result;           

        } 
				public function get_count( $limit, $offset, $order_by = null, $client_id) {  
            $this->get_cuotas_data($limit, $offset, $order_by = null, $client_id);
            return $this->db->count_all_results();    
        }  

	

       
}