<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Index extends MX_Controller {
	function __construct()
	{
 		parent::__construct();
                $this->user->check_session(); 
	}	
        
        public function index() {
            $res['menu'] = array(
                    array( 'Subir Creditos', 'icon-apple')
                );
            $res['content_menu'] = array(
                    array( 'credit_detail_load', 'Subir de creditos vencidos' )
                );
            $res['view_name'] = 'common/templates/left_menu';
            echo $this->load->view('common/templates/dashboard',$res,TRUE);   
        }        

        public function credit_details($compromiso_pago_date = '0') {
            $notification_format = (new gestcobra\notification_format_model())
                    ->where('company_id',  $this->user->company_id)
                    ->find();
            
            $res['menu'] = array(
                    array('Creditos', 'icon-apple'),    
                    array('Gestion', 'icon-apple'),    
                    array('Comunicaciones', 'icon-apple'),  
                    array('Notificaciones', 'icon-apple'),  
                    array('Historial', 'icon-apple'),
					//array('Historial Legal', 'icon-apple'),
                );
            $res['content_menu'] = array(
                    array('credit_detail_report', 'Gestion de Creditos', array('client_id'=>'0', 'data_height'=>'510', 'show_export'=>1, 'notification_format'=>$notification_format, 'compromiso_pago_date'=>$compromiso_pago_date) ),
                    array('credit_hist_report', 'Detalle de Gestion de Creditos', array('client_id'=>'0', 'data_height'=>'510', 'show_export'=>1, 'compromiso_pago_date'=>$compromiso_pago_date )),
                    array('credit_hist_contact', 'Detalle de Clientes contactados', array('client_id'=>'0', 'data_height'=>'510', 'show_export'=>1, 'compromiso_pago_date'=>$compromiso_pago_date )),
                    array('credit_hist_notification', 'Detalle de Clientes contactados', array('client_id'=>'0', 'data_height'=>'510', 'show_export'=>1, 'compromiso_pago_date'=>$compromiso_pago_date )),
					array('credit_hist_report_a', 'Detalle de Gestiones', array('client_id'=>'0', 'data_height'=>'510', 'show_export'=>1, 'compromiso_pago_date'=>$compromiso_pago_date, 'var'=>"todoHi")),
					//array('credit_hist_report_legal', 'Gestion Legal', array('client_id'=>'0', 'data_height'=>'510', 'show_export'=>1, 'compromiso_pago_date'=>$compromiso_pago_date, 'var'=>"todoHi")),
                );
            
            $res['view_name'] = 'common/templates/left_menu';
            echo $this->load->view('common/templates/dashboard',$res,TRUE);   
        }
		 public function credit_details_legal($nro_pagare='0') {
$nro_pagare= set_post_value("pagare");
if (empty($nro_pagare)){
    $nro_pagare=0;
}
        $DB = $this->load->database('gestcobral', TRUE);
        $id = $DB->query("select id from credit_detail where nro_pagare=$nro_pagare");
        $lol = $id->result();
        if ($id->num_rows() == 0) {
            $id_cre = 0;
        } else {

            foreach ($lol as $row) {
                $id_cre = $row->id;
            }
        }
       
        $res['menu'] = array(
            array('Historial Legal', 'icon-apple'),
            array('Busqueda Legal', 'icon-apple'),
            
        );
        $res['content_menu'] = array(
            array('credit_detail_report_legal', 'Gestion Legal', array('data_height'=>'510', 'show_export'=>1)),
            array('credit_detail_legal', 'BUSQUEDA DE GESTIONES LEGALES', array('client_id' => $id_cre, 'data_height' => '510', 'show_export' => 1, 'compromiso_pago_date'=>$compromiso_pago_date)),
        );

        $res['view_name'] = 'common/templates/left_menu';
        echo $this->load->view('common/templates/dashboard', $res, TRUE);
    }

        public function credit_details_filtro($max, $min) {
			$max=  set_post_value('max');
            $min=  set_post_value('min');
            $notification_format = (new gestcobra\notification_format_model())
                    ->where('company_id',  $this->user->company_id)
                    ->find();
            
            $res['menu'] = array(
                    array('Creditos', 'icon-apple'),    
                    array('Gestion', 'icon-apple'),    
                    array('Comunicaciones', 'icon-apple'),  
                    array('Notificaciones', 'icon-apple'),  
                    array('Historial', 'icon-apple'),
                );
            $res['content_menu'] = array(
                    array('credit_detail_report_f', 'Gestion de Creditos', array('client_id'=>'0', 'data_height'=>'510', 'show_export'=>1, 'notification_format'=>$notification_format,  'max'=>$max , 'min'=>$min) ),
                    array('credit_hist_report', 'Detalle de Gestion de Creditos', array('client_id'=>'0', 'data_height'=>'510', 'show_export'=>1, 'compromiso_pago_date'=>$compromiso_pago_date )),
                    array('credit_hist_contact', 'Detalle de Clientes contactados', array('client_id'=>'0', 'data_height'=>'510', 'show_export'=>1, 'compromiso_pago_date'=>$compromiso_pago_date )),
                    array('credit_hist_notification', 'Detalle de Clientes contactados', array('client_id'=>'0', 'data_height'=>'510', 'show_export'=>1, 'compromiso_pago_date'=>$compromiso_pago_date )),
                    array('credit_hist_report_a', 'Detalle de Gestiones', array('client_id'=>'0', 'data_height'=>'510', 'show_export'=>1, 'compromiso_pago_date'=>$compromiso_pago_date, 'var'=>"todoHi")),
                );
            
            $res['view_name'] = 'common/templates/left_menu';
            echo $this->load->view('common/templates/dashboard',$res,TRUE);   
        }        


//-------------------------FILTRO PARA OFICIALES Y AGENCIAS-----------------------
public function credit_details_of() {
			$oficial = set_post_value('oficial_credito_model');
            $notification_format = (new gestcobra\notification_format_model())
                    ->where('company_id',  $this->user->company_id)
                    ->find();
            
            $res['menu'] = array(
                    array('Creditos', 'icon-apple'),    
                    array('Gestion', 'icon-apple'),    
                    array('Comunicaciones', 'icon-apple'),  
                    array('Notificaciones', 'icon-apple'),  
                    array('Historial', 'icon-apple'),
                );
            $res['content_menu'] = array(
                    array('credit_detail_report_of', 'Gestion de Creditos', array('client_id'=>'0', 'data_height'=>'510', 'show_export'=>1, 'notification_format'=>$notification_format, 'oficial'=>$oficial) ),
                    array('credit_hist_report', 'Detalle de Gestion de Creditos', array('client_id'=>'0', 'data_height'=>'510', 'show_export'=>1, 'compromiso_pago_date'=>$compromiso_pago_date )),
                    array('credit_hist_contact', 'Detalle de Clientes contactados', array('client_id'=>'0', 'data_height'=>'510', 'show_export'=>1, 'compromiso_pago_date'=>$compromiso_pago_date )),
                    array('credit_hist_notification', 'Detalle de Clientes contactados', array('client_id'=>'0', 'data_height'=>'510', 'show_export'=>1, 'compromiso_pago_date'=>$compromiso_pago_date )),
                    array('credit_hist_report_a', 'Detalle de Gestiones', array('client_id'=>'0', 'data_height'=>'510', 'show_export'=>1, 'compromiso_pago_date'=>$compromiso_pago_date, 'var'=>"todoHi")),
                );
            
            $res['view_name'] = 'common/templates/left_menu';
            echo $this->load->view('common/templates/dashboard',$res,TRUE);   
        }


public function credit_details_ag() {
			$ag = set_post_value('oficina_company_model');
            $notification_format = (new gestcobra\notification_format_model())
                    ->where('company_id',  $this->user->company_id)
                    ->find();
            
            $res['menu'] = array(
                    array('Creditos', 'icon-apple'),    
                    array('Gestion', 'icon-apple'),    
                    array('Comunicaciones', 'icon-apple'),  
                    array('Notificaciones', 'icon-apple'),  
                    array('Historial', 'icon-apple'),
                );
            $res['content_menu'] = array(
                    array('credit_detail_report_ag', 'Gestion de Creditos', array('client_id'=>'0', 'data_height'=>'510', 'show_export'=>1, 'notification_format'=>$notification_format, 'ag'=>$ag) ),
                    array('credit_hist_report', 'Detalle de Gestion de Creditos', array('client_id'=>'0', 'data_height'=>'510', 'show_export'=>1, 'compromiso_pago_date'=>$compromiso_pago_date )),
                    array('credit_hist_contact', 'Detalle de Clientes contactados', array('client_id'=>'0', 'data_height'=>'510', 'show_export'=>1, 'compromiso_pago_date'=>$compromiso_pago_date )),
                    array('credit_hist_notification', 'Detalle de Clientes contactados', array('client_id'=>'0', 'data_height'=>'510', 'show_export'=>1, 'compromiso_pago_date'=>$compromiso_pago_date )),
                    array('credit_hist_report_a', 'Detalle de Gestiones', array('client_id'=>'0', 'data_height'=>'510', 'show_export'=>1, 'compromiso_pago_date'=>$compromiso_pago_date, 'var'=>"todoHi")),
                );
            
            $res['view_name'] = 'common/templates/left_menu';
            echo $this->load->view('common/templates/dashboard',$res,TRUE);   
        }     

 		
}
