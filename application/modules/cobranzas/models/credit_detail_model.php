<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Credit_detail_model extends \CI_Model {
    
    private function _get_credit_detail_filter( $filter = null, $client_id, $compromiso_pago_date ) {
           
            $this -> db -> where ('c_d.company_id', $this->user->company_id);
			//$this -> db -> where ('c_d.credit_status_id !=', 22);
            
            if($compromiso_pago_date != 0){
				
                $credit_status = (new gestcobra\credit_status_model())
                        ->where('status_name','COMPROMISO PAGO')
                        ->where('company_id',  $this->user->company_id)
                        ->find_one();
                $this -> db -> where ( 'c_d.credit_status_id', $credit_status->id );
                $this -> db -> where ('c_h.compromiso_max', 1);
                $this -> db -> where ( 'c_h.compromiso_pago_date <', $compromiso_pago_date );
                $this -> db -> join ('credit_hist c_h','c_h.credit_detail_id = c_d.id' );
                $this -> db -> group_by('c_h.credit_detail_id' );
				  }
            
            if($client_id>0){
                $this -> db -> where ( 'c_r.credit_detail_id', $client_id );
            }
            /**
             * Si el usuario identificado tiene rol de oficial de credito, entonces se
             * muestra solamente los creditos asignados a su persona
            */
            if( $this->user->role_id == 1 ){
                //$this -> db -> where ('c_d.oficial_credito_id', $this->user->id);
				$this -> db -> where ('c_d.oficina_company_id', $this->user->oficina_company_id);
            }
			if( $this->user->role_id == 2 ){
                $this -> db -> where ('c_d.oficina_company_id', $this->user->oficina_company_id);
            }
            
            
            if($filter){
                
                foreach ($filter as $key => $value) {
                    if( $key == 'client_name' ){
                        $this -> db -> like ('UPPER(cr_p.firstname)', strtoupper($value));
                    }elseif( $key == 'status_name' ){
                        $this -> db -> like ('UPPER(c_s.status_name)', strtoupper($value));
                    }elseif( $key == 'credit_type' ){
                        $this -> db -> like ('UPPER(c_t.name)', strtoupper($value));
                    }elseif( $key == 'client_code' ){
                        $this -> db -> like ('UPPER(c_r.client_code)', strtoupper($value));
                    }elseif( $key == 'cliente' ){
                        $this -> db -> like ('UPPER(c_d.cliente)', strtoupper($value));
                    }elseif( $key == 'nro_pagare' ){
                        $this -> db -> like ('UPPER(c_d.nro_pagare)', strtoupper($value));
                    }elseif( $key == 'personal_address' ){
                        $this -> db -> like ('UPPER(cr_p.personal_address)', strtoupper($value));
                    }elseif( $key == 'firstname' ){
                        $this -> db -> like ('UPPER(o_c.firstname)', strtoupper($value));
                    }elseif( $key == 'deuda_inicial' ){
                        $this -> db -> like ('UPPER(c_d.deuda_inicial)', strtoupper($value));
                    }elseif( $key == 'saldo_actual' ){
                        $this -> db -> like ('UPPER(c_d.saldo_actual)', strtoupper($value));
                    }elseif( $key == 'cuotas_mora' ){
                        $this -> db -> like ('UPPER(c_d.cuotas_mora)', strtoupper($value));
                    }elseif( $key == 'total_cuotas_vencidas' ){
                        $this -> db -> like ('UPPER(c_d.total_cuotas_vencidas)', strtoupper($value));
                    }elseif( $key == 'adjudicacion_date' ){
                        $this -> db -> like ('UPPER(c_d.adjudicacion_date)', strtoupper($value));
                    }elseif( $key == 'name' ){
                        $this -> db -> like ('UPPER(of_c.name)', strtoupper($value));
                    }
					
					elseif( $key == 'curr_date' ){
                        $this -> db -> like ('UPPER(c_d.curr_date)', strtoupper($value));
                    }else{
                        $this -> db -> where($key,$value);                        
                    }      
                }
            }
            $this -> db -> from('credit_detail c_d');
            $this -> db -> join('month m', 'm.id = c_d.updated_month_id');
            $this -> db -> join('client_referencias c_r', 'c_r.credit_detail_id = c_d.id and c_r.reference_type_id=3');
            $this -> db -> join('person cr_p', 'cr_p.id = c_r.person_id');
            $this -> db -> join('credit_status c_s', 'c_s.id = c_d.credit_status_id', 'left');
            $this -> db -> join('credito_type c_t', 'c_t.id = c_d.credito_type_id');
            $this -> db -> join('oficial_credito o_c', 'o_c.id = c_d.oficial_credito_id');
            $this -> db -> join('motivo_no_pago c_c', 'c_c.id = c_d.comision_id');
			$this -> db -> join('oficina_company of_c', 'of_c.id = c_d.oficina_company_id');
    }
    
    /**
     * @param type $limit
     * @param type $offset
     * @param type $whereData
     * @param type $order_by
     * @return type
     */
        function get_credit_detail_data( $limit, $offset, $filter = null, $order_by = null, $client_id, $compromiso_pago_date ) {
            $this->_get_credit_detail_filter($filter, $client_id, $compromiso_pago_date);
            $this->db->select(
                'c_d.id, c_d.id credit_detail_id, c_d.fecha_ultima_gestion, of_c.name,c_d.nro_cuotas, c_d.total_pagar, c_d.total_comision, o_c.email, c_d.nro_pagare ,c_d.deuda_inicial, c_d.saldo_actual, c_d.curr_date, c_d.adjudicacion_date,c_d.cuotas_pagadas,c_d.cuotas_mora,c_d.dias_mora ,c_d.total_cuotas_vencidas,c_d.plazo_original,c_d.last_pay_date, c_r.client_code, cr_p.id person_id, cr_p.personal_address, c_s.status_name, c_s.color, c_s.background, c_d.credit_status_id, c_d.cliente, cr_p.firstname client_name, c_t.name credit_type, m.month_name', FALSE
            );
            if($order_by){
                foreach ($order_by as $order => $tipo) {
                    $this -> db -> order_by($order, $tipo);        
                }
            }
            if(!empty($limit)){
                $this -> db -> limit($limit, $offset);
            }
            $query = $this -> db -> get();      
            $result = $query->result();
                       
        return $result;
        }
      
        
        public function get_credit_detail_count( $filter, $client_id, $compromiso_pago_date ) {
						if($compromiso_pago_date != 0){
				return 100;
			}
            $this->_get_credit_detail_filter($filter, $client_id, $compromiso_pago_date);
            return $this->db-> count_all_results();
        }   
}
