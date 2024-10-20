<div class="container-fluid main-nav clearfix">
    <div class="nav-collapse">
        <ul class="nav">
            <?php
            if ($this->user->root == 0) {
                /**
                 * Consultamos los compromisos de pago para hoy
                 */
//                        $credit_hist_num = (new gestcobra\credit_hist_model())
//                                ->where('compromiso_pago_date', date('Y-m-d',time()))
//                                ->where('compromiso_pago_date', date('Y-m-d',time()))
//                                ->count();
                $credit_status = ( new gestcobra\credit_status_model())
                        ->where('status_name', 'COMPROMISO PAGO')
                        ->where('company_id', $this->user->company_id)
                        ->find_one();

                $credit_compromisos_num = 0;
//                        $credit_compromiso = (new gestcobra\credit_detail_model())
//                                            ->where('credit_status_id', $credit_status->id)
//                                            ->count();
                if ($credit_status->id > 0) {
                    $this->db->where('c_h.compromiso_max', 1);
                    $this->db->where('c_h.compromiso_pago_date <', date('Y-m-d', time()));
                    $this->db->where('c_h.credit_status_id', 23);
                   
                    if ($this->user->role_id == 1) {
                        $this->db->where('c_d.oficial_credito_id', $this->user->id);
                    }
					if ($this->user->role_id == 2) {
                        $this -> db -> where ('c_d.oficina_company_id', $this->user->oficina_company_id);
                    }
					
                    $this->db->from('credit_detail c_d');
                    $this->db->join('credit_hist c_h', 'c_h.credit_detail_id = c_d.id AND c_d.credit_status_id = c_h.credit_status_id');
                    $this->db->group_by('c_h.credit_detail_id');
                    $query = $this->db->get();
                    $credit_compromisos_num = $query->num_rows();
//$credit_compromisos_num = $this->db->count_all_results();                                
                }
//                      echo $this->user->id;
                ?>
				  <li>
                    <a class="current" href="<?= base_url('credit_details_legal.jsp') ?>"><span aria-hidden="true" class="glyphicon glyphicon-folder-open"></span>Historial Judicial</a>
                </li>
				<li>
                    <a class="current" href="<?= base_url('volver_llamar.jsp') ?>"><span aria-hidden="true" class="glyphicon glyphicon-folder-open"></span>Volver a llamar</a>
                </li>
                <li>
                    <!--<ul class="nav navbar-nav">-->
                    <!--<li class="dropdown hidden-xs">-->
                    <a data-toggle="dropdown" class="dropdown-toggle text-danger" href="#" >
                        <?= $credit_compromisos_num ?>&nbsp;Alertas&nbsp;<i class="glyphicon glyphicon-bell" ></i>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="<?= base_url('credit_details.jsp/' . date('Y-m-d')) ?>">
                                <i class="glyphicon glyphicon-calendar"></i>&nbsp;<?= $credit_compromisos_num ?>&nbsp;Compromisos de Pago para Hoy</a>
                        </li>
                    </ul>
                    <!--</li>-->
                    <!--</ul>-->
                </li>
                <li>
                    <a class="current" href="<?= base_url() ?>"><span aria-hidden="true" class="glyphicon glyphicon-upload"></span>Inicio</a>
                </li>
				<li>
                    <a class="current"  href="<?= base_url('/uploads/18/Manual/MANUAL-TCOBRO.pdf')?>" target="blank"><span aria-hidden="true" class="glyphicon glyphicon-book"></span>MANUAL</a>
                </li>
                <li>
                    <a class="current" href="<?= base_url('credit_details.jsp') ?>"><span aria-hidden="true" class="glyphicon glyphicon-usd"></span>Cr&eacute;ditos</a>
                </li>
				<?php
            if ($this->user->role_id == 2 OR $this->user->role_id == 4) {
                ?>
				<li class="dropdown"><a data-toggle="dropdown" href="#">
                        <span aria-hidden="true" class="glyphicon glyphicon-stats"></span>Reportes</a>
                    <ul class="dropdown-menu">                 
                        <li>
                            <a href="<?= base_url('reports/report_agencia.jsp') ?>">Gesti&oacute;n Por Agencia</a>
                        </li>                                                 
                    </ul>
                </li>

				   <?php
			}
            
            /**
             * Si es gerente o si es superusuario
             */
            if ($this->user->role_id == 3) {
                ?>
                <li class="dropdown"><a data-toggle="dropdown" href="#">
                        <span aria-hidden="true" class="glyphicon glyphicon-stats"></span>Reportes</a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= base_url('reports/report_date.jsp') ?>">
                                <span class="notifications label label-warning">*</span>
                                <p>
                                    Gesti&oacute;n Por Fechas
                                </p></a>
                        </li>                    
                        <li>
                            <a href="<?= base_url('reports/report_oficial.jsp') ?>">Gesti&oacute;n Por Oficial</a>
                        </li>
                        <li>
                            <a href="<?= base_url('reports/report_agencia.jsp') ?>">Gesti&oacute;n Por Agencia</a>
                        </li>                                                 
                        <li>
                            <a href="<?= base_url('reports/report_general.jsp') ?>">Reporte General</a>
                        </li> 
					<!--	 <li>
                            <a href="<?= base_url('reports/report_producto.jsp') ?>">Reporte Tipo Producto</a>
                        </li>-->
						<li>
                            <a href="<?= base_url('reports/report_gestiones.jsp') ?>">Reporte General de Gestiones</a>
                        </li> 
                    </ul>
                </li>
				   <?php
            }
			
           
            }
            /**
             * Si es gerente o si es superusuario
             */
            if ($this->user->role_id == 3 OR $this->user->role_id == 100) {
                ?>
                        <li class="dropdown"><a data-toggle="dropdown" href="#">
                              <span aria-hidden="true" class="icon-gears"></span>Administraci&oacute;n</a>
                             <ul class="dropdown-menu">
                               <li>
                                  <a href="<?= base_url('companyadmin.jsp') ?>"><span aria-hidden="true" class="icon-gears"></span>Administraci&oacute;n</a>
                                </li>
                               <!--<li>
                                  <a href="<?= base_url('infor_mjs.jsp') ?>"><span aria-hidden="true" class="glyphicon glyphicon-envelope"></span>Infomaci&oacute;n Mensajes</a>
                                </li>
                                 <li>
                                  <a href="<?= base_url('subir_msjs.jsp') ?>"><span aria-hidden="true" class="glyphicon glyphicon-upload"></span>Subir Mensajes</a>
                                </li>
								<li>
                                  <a href="<?= base_url('envio_report.jsp') ?>"><span aria-hidden="true" class="glyphicon glyphicon-upload"></span>Historial Envios SMS</a>
                                </li>-->
                             </ul>
                        </li>

                <?php
            }
                ?>                                    
        </ul>
    </div>
</div>
<div id="porq"></div>
<script>
alerta();
function alerta() {
        var a=<?=$this->user->id?>;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("porq").innerHTML = this.responseText;
                if(this.responseText!=''){
                 alert("REVISAR ALERTA VOLVER A LLAMAR EN 5 MINUTOS O MENOS");
                }
            }
        };
        //xmlhttp.open("GET","../uploads/alerta.php?q="+a,true);
		xmlhttp.open("GET","http://localhost:8080/tcobro/uploads/alerta.php?q="+a,true);
        xmlhttp.send();
}
setInterval('alerta()', 300000);
</script>