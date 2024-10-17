<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Alertas_model extends \CI_Model {
  

        function get_alertas_data( $limit, $offset, $order_by = null) {

            $this -> db -> from('alertas a');

            $this -> db -> select('a.id, a.usuario, a.numero_operacion, a.fechahora', FALSE
  );
				 $d = new DateTime();
			$d=$d->format('Y-m-d 00:00:00');
			
			if( $this->user->role_id == 1 ){
				$this -> db -> where('a.usuario',$this->user->id);	
			}
			
				$this -> db -> where('a.fechahora >',$d);
                //$this -> db -> limit($limit, $offset);

                $query = $this -> db -> get();         

            $result = $query->result();

        

            return $result;           

        } 
				public function get_alertas_count( $limit, $offset, $order_by = null) {  
            $this->get_alertas_data($limit, $offset, $order_by = null);
            return $this->db->count_all_results();    
        }  

	

       
}