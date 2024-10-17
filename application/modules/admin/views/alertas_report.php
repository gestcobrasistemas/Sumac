
        <table id="table"
               data-side-pagination="server"
               data-pagination="false"                  
               data-toggle="table"
               data-height="460"
               data-detail-view="true"             
               data-url="<?= base_url('cobranzas/credit/get_alertas') ?>"
               data-sort-name="id"
               data-sort-order="desc"
               data-show-refresh="true"
               data-show-toggle="true"
               data-show-columns="true"                 
               data-show-export="true"
               data-filter-control="true"
        >
            <thead>
                <!--c.fecha, p.nombres, p.apellidos, p.direccion, p.email, p.telefonos, p.celular-->
            <tr>
                <th data-field="id" data-visible="false">ID</th>
                <th data-field="numero_operacion" >Cliente</th>
                <th data-field="fechahora" >hora</th>
                
            </tr>
            </thead>
        </table>

<script>


</script>