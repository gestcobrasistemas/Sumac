
    <div class="handsontable" id="example">       
        <table id="table_cuotas" 
               data-side-pagination="server"
               data-toggle="table_cuotas"
               data-height="<?php echo $data_height ?>"
               data-url="<?= base_url('cobranzas/credit/get_cuotas/'.$client_id) ?>"
               data-sort-name="dias_mora"
               data-sort-order="desc"
               <?php
               if ($show_export == 1) {
               ?>
                   data-detail-view="true"
				   data-select-item-name="c_d_id[]"
                   data-id-field="id"
                   data-detail-formatter="moreActions_geo"            
                   data-pagination="true"               
                   data-show-refresh="true"
                   data-show-toggle="true"
                   data-show-columns="true"                 
                   data-show-export="true"
                   data-filter-control="true"                                                        
                   data-maintain-selected="true"
                   data-mobile-responsive="true"  
                   data-resizable="true"
                   <?php
               }
               ?>
                   >  
            <thead>
                <!--c.fecha, p.nombres, p.apellidos, p.direccion, p.email, p.telefonos, p.celular-->
                <tr>
                    <?php
                    if ($show_export == 1) {
                        ?>
                        <th data-field="id" data-checkbox="true" data-formatter="disabledNoElectronic">ID</th>
                        <th data-field="status_name" data-sortable="true" data-cell-style="cellStyle" data-filter-control="input">Estado</th>
                        <?php
                    } else {
                        ?>
                        <th data-field="id" data-visible="false" data-sortable="true">ID</th>
                        <?php
                    }
                    ?>                     
                    <?php
                    if ($show_export == 1) {
                        ?>
                        <th data-field="client_name" data-sortable="true" data-filter-control="input">Cliente</th>                        
                        <th data-field="personal_address" data-filter-control="input">Direccion</th>
                        <th data-field="deuda_inicial" data-visible="true" data-sortable="true" data-filter-control="input">Deuda Inicial</th>  
                        <th data-field="plazo_original" data-visible="false" data-sortable="true" data-filter-control="input">Plazo original</th>
                        <th data-field="saldo_actual" data-visible="true" data-sortable="true" data-filter-control="input">Saldo Deuda</th>
                        <th data-field="dias_mora" data-visible="true" data-sortable="true" data-filter-control="input" >Dias mora</th> 
                        <th data-field="cuotas_mora" data-visible="true" data-sortable="true" data-filter-control="input">Nro. Cuotas</th> 
                        <th data-field="total_cuotas_vencidas" data-visible="true" data-sortable="true" data-filter-control="input">Tot. Cuotas</th>
                        <th data-field="cuotas_pagadas" data-visible="false" data-sortable="true" data-filter-control="input">Cuotas pagadas</th>                  
                        <th data-field="adjudicacion_date" data-visible="false" data-sortable="true" data-filter-control="datepicker">F. Adjudicacion</th>
                        <th data-field="curr_date" data-visible="false" data-sortable="true" data-filter-control="input">F. Actualizacion</th>                  
                        <th data-field="last_pay_date" data-visible="false" data-sortable="true" data-filter-control="input">F. ultimo pago</th>
						<th data-field="firstname" data-visible="false" data-sortable="true" data-filter-control="input">Oficial</th>
						<th data-field="name" data-visible="false" data-sortable="true" data-filter-control="input">Agencia</th>
						
                        <!--<th data-field="total_comision" data-visible="false" data-sortable="true" data-filter-control="input">Tot.Comision</th>
                        <th data-field="total_pagar" data-visible="false" data-sortable="true" data-filter-control="input">Cuotas + Comision</th>  -->                             
                        <?php
                    } else {
                        ?>
                <th data-field="id" data-visible="false" data-sortable="true">ID</th>
                <th data-field="Column1" data-filter-control="input">Prestamo</th>
				<th data-field="Column2" data-filter-control="input">Dividendo</th>
				<th data-field="Column3" data-filter-control="input">Valor cuota</th>
				<th data-field="Column4" data-filter-control="input">Mora</th>
				<th data-field="Column5" data-filter-control="input">Otros cuota</th>
				<th data-field="Column6" data-filter-control="input">Valor pendiente</th>
				<th data-field="Column7" data-filter-control="input">Dias Mora Cuota</th>
				<th data-field="Column8" data-filter-control="input">Fecha vencimiento</th>
						
                       <!-- <th data-field="total_comision" data-visible="true" data-filter-control="input">Tot.Comision</th>
                        <th data-field="total_pagar" data-visible="true" data-filter-control="input">Cuotas + Comision</th>-->
                        <?php
                    }
                    ?>     
                                      
                </tr>
            </thead>
        </table>    
    </div>
    <?php
    if ($show_export == 1) {
        ?>
    </form>
    <?php
}
?>




<script>  
    $(function () {
        $('input[rel="txtTooltip"]').tooltip();
    });
     
    $('[data-toggle="table_cuotas"]').bootstrapTable();
    var $table = $('#table_cuotas');
   

    $table.on('load-success.bs.table', function (es) {
        setTotalSelecteds();
        $('input[rel="txtTooltip"]').tooltip();
    });
<?php
if ($show_export == 1) {
    ?>
        function moreActions_geo(index, row) {
            var html = [];
            var id = row['credit_detail_id'];
            var openDoc = '<a id="call-php" class="btn btn-success btn-xs" href="#" data-target="messagesout" php-function="<?= base_url() ?>modal/cobranzas__credit__open_credit_detail__' + id + '/0/0">Realizar Gesti&oacute;n</a>';
            var openDoc1 = '<a id="call-php" class="btn btn-success btn-xs" href="<?= base_url() ?>geo/mapa/index/' + id + '" target="_blank">VER Direcci&oacute;n</a>';
            //var openDoc1 = '<a id="call-php" class="btn btn-success btn-xs" href="#" data-target="messagesout" php-function="<?= base_url() ?>modal/geo__mapa__index__' + id + '/0/0">VER Direcci&oacute;n</a>';
            var openDoc2 = '<a id="call-php" class="btn btn-success btn-xs" href="#" data-target="messagesout" php-function="<?= base_url() ?>modal/geo__mapa__open_map__' + id + '/0/0">Agregar localizaci&oacute;n</a>';
            html.push(openDoc);
            html.push(openDoc1);
            html.push(openDoc2);
            return html.join('');
        }
    <?php
}
?>
    /**
     * Desactiva seleccion de comprobantes que no son ni seran documentos electronicos
     * @param {type} value
     * @param {type} row
     * @param {type} index
     * @returns {disabledAnulados.ml_sricomprob_reportAnonym$0}
     */
    function disabledNoElectronic(value, row, index) {
        if (row['status_name'] == 'CANCELADO') {
            return {
//                checked: true
                disabled: true
            };
        }
//        else{
//            return {
//                checked: false
//            };            
//        }
        return value;
    }

   


    function inputFormatterClientDir_oficial(index, row) {
        var credit_type = row['credit_type'];
        var client_id_oficial = row['client_id_oficial'];
        var inputClientIdOficial = "<input type='hidden'  rel='txtTooltip' data-toggle='tooltip' data-placement='bottom' title='" + client_id_oficial + "' name='client_id_oficial[]' value='" + client_id_oficial + "'/> ";
        return inputClientIdOficial + credit_type;
    }


    function inputPersonId(index, row) {
        var person_id = row['person_id'];
        var credit_detail_id = row['credit_detail_id'];
        var client_name = row['client_name'];
        var deuda_inicial = row['deuda_inicial'];

        var inputPerson = "<input type='hidden' rel='txtTooltip' data-toggle='tooltip' data-placement='bottom' title='" + person_id + "' name='person_id[]' value='" + person_id + "'/> ";
        var credit_detail_id = "<input type='hidden' rel='txtTooltip' data-toggle='tooltip' data-placement='bottom' title='" + credit_detail_id + "' name='credit_detail_id[]' value='" + credit_detail_id + "'/> ";
        var inputClientName = "<input type='hidden' rel='txtTooltip' data-toggle='tooltip' data-placement='bottom' title='" + client_name + "' name='client_name_ofic[]' value='" + client_name + "'/> ";
        var inputDetail = "<input type='text' disabled style='background-color:ffffff' rel='txtTooltip' data-toggle='tooltip' data-placement='bottom' title='" + deuda_inicial + "' name='deuda_inicial' value='" + deuda_inicial + "'/> ";

        return inputPerson + credit_detail_id + inputClientName + inputDetail;
    }

    function inputFormatterStatusName(index, row) {
        var color = row['color'];
        var background = row['background'];
        var status_name = row['status_name'];
        var inputDetail = "<input style='background:" + background + "; color:" + color + "; width:100px ' name='status_name' value='" + status_name + "'/> ";
        return inputDetail;
    }
    function cellStyle(value, row, index) {
        var color = row['color'];
        var background = row['background'];
        return {
            //classes: classes[index / 2]
            css: {
                "background": background,
                "color": color,
            }
        };
    }
    

</script>
