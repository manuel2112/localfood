<div class="row">
	<div class="col-12">
		<div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title"><?php echo $empresa->EMPRESA_NOMBRE?></h4>
		</div>		
	</div>
</div>

<?php if ( $this->session->flashdata('exito') ){ ?>
    <div class="alert alert-success">
      <?php echo $this->session->flashdata('exito');?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
<?php }?>

<div class="row mt-5">
	
	<div class="col-12 col-md-8">

		<table class="table">
			<caption>DATOS DE LA EMPRESA</caption>
			<tr>
				<td class="table-primary">CIUDAD</td>
				<td><?php echo $empresa->CIUDAD_NOMBRE?></td>
			</tr>
			<tr>
				<td class="table-primary">DIRECCIÓN</td>
				<td>
					<?php echo $empresa->EMPRESA_DIRECCION?>
					<?php if($empresa->EMPRESA_LAT){?>
					<a href="<?php echo base_url()?>map/index/<?php echo $empresa->EMPRESA_ID?>" class="btn btn-warning" target="_blank"><i class="fa fa-map-pin"></i></a>
					<?php }?>
				</td>
			</tr>
			<tr>
				<td class="table-primary">WEB</td>
				<td>
					<?php echo $empresa->EMPRESA_WEB?>
					<a href="<?php echo $empresa->EMPRESA_WEB?>" class="btn btn-warning" target="_blank"><i class="fa fa-link"></i></a>
				</td>
			</tr>
			<tr>
				<td class="table-primary">FONO</td>
				<td><?php echo $empresa->EMPRESA_FONO?></td>
			</tr>
			<tr>
				<td class="table-primary">EMAIL</td>
				<td><?php echo $empresa->EMPRESA_EMAIL?></td>
			</tr>
			<tr>
				<td class="table-primary">DESCRIPCIÓN</td>
				<td><?php echo $empresa->EMPRESA_DESCRIPCION?></td>
			</tr>
		</table>
		
		<button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalEditarDatos">
			<strong>Editar datos de la empresa</strong>
		</button>
		
		<table class="table table-striped mt-5">
			<caption>HORARIOS DE ATENCIÓN</caption>
			<thead>
				<tr class="table-primary">
					<th scope="col">DÍA</th>
					<th scope="col">APERTURA</th>
					<th scope="col">CIERRE</th>
				</tr>
			</thead>
			
			<tbody>
			<?php foreach( $horario as $itemhorario ){?>
				<tr>
					<td><?php echo $itemhorario->DIA_NOMBRE?></td>
					<td><?php echo $itemhorario->HORARIO_APERTURA?></td>
					<td><?php echo $itemhorario->HORARIO_CIERRE?></td>
				</tr>
			<?php }?>
			</tbody>
		</table>
		
		<a href="#" class="btn btn-primary btn-block btnContacto" data-toggle="modal" data-target="#mdlContacto" asunto="Solicitar cambio de horarios"><strong>Solicitar cambio de horarios</strong></a>
		
	</div>
        		
	<div class="col-12 col-md-4">
		<img src="<?php echo base_url().$empresa->EMPRESA_LOGOTIPO?>" class="img-thumbnail" width="50%">

		<hr>

		<h6><strong>TIPOS DE COMIDA</strong></h6>
		<ul>
			<?php foreach( $tiposdecomida as $itemtiposdecomida ){?>
				<li><?php echo $itemtiposdecomida->TIPO_COMIDA_NOMBRE;?></li>
			<?php }?>
		</ul>

		<hr>

		<h6><strong>TIPOS DE NEGOCIO</strong></h6>
		<ul>
			<?php foreach( $tiposdenegocio as $itemtiposdenegocio ){?>
				<li><?php echo $itemtiposdenegocio->TIPO_NEGOCIO_NOMBRE;?></li>
			<?php }?>
		</ul>

		<hr>

		<h6><strong>TIPOS DE PAGO</strong></h6>
		<ul>
			<?php foreach( $tiposdepago as $itemtiposdepago ){?>
				<li><?php echo $itemtiposdepago->TIPO_PAGO_NOMBRE;?></li>
			<?php }?>
		</ul>
		
		<a href="#" class="btn btn-primary btn-block btnContacto" data-toggle="modal" data-target="#mdlContacto" asunto="Solicitar cambio de comida, negocio o pago"><strong>Solicitar cambio de comida, negocio o pago</strong></a>

	</div>
        		
</div><!-- FIN ROW -->

<!--=====================================
MODAL EDITAR EMPRESA
======================================-->
<div id="modalEditarDatos" class="modal fade" role="dialog">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?php echo base_url()?>cliente/editar" role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Editar Datos de la Empresa</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
       
        <div class="modal-body">
        	
        	<div class="row">
        	
        		<div class="col-12">
        		
        			<input type="hidden" name="idEditCliente" id="idEditCliente" value="<?php echo $empresa->EMPRESA_ID?>">

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditDireccion" id="txtEditDireccion" placeholder="DIRECCIÓN..." value="<?php echo $empresa->EMPRESA_DIRECCION?>">
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditUrl" id="txtEditUrl" placeholder="URL..." value="<?php echo $empresa->EMPRESA_WEB?>">
						</div>
					</div>
					
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditFono" id="txtEditFono" placeholder="TELÉFONO (*)..." value="<?php echo $empresa->EMPRESA_FONO?>" required>
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<textarea class="form-control" rows="5" name="txtEditDescripcion" id="txtEditDescripcion" placeholder="DESCRIPCIÓN (*)..." required><?php echo $empresa->EMPRESA_DESCRIPCION?></textarea>
						</div>
					</div>

					<div class="form-group">
						<div class="panel">LOGOTIPO</div>
						<img src="<?php echo $empresa->EMPRESA_LOGOTIPO?>" class="img-thumbnail previsualizarLogoCliente" width="100px">
						<input type="file" class="EditFotoLogoCliente" name="EditFotoLogoCliente" id="EditFotoLogoCliente">
						<p class="help-block">Peso máximo de la imagen 512KB</p>
              			<input type="hidden" name="fotoActualEmpresa" id="fotoActualEmpresa">
					</div>
        		</div>
        		
        	</div><!-- PIE ROW -->
        
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
			<button type="submit" class="btn btn-primary" id="btnEditarEmpresa">Editar Datos</button>
        </div>

      </form> 

    </div>

  </div>

</div>
    
<!--=====================================
MODAL CONTACTO
======================================-->
<div id="mdlContacto" class="modal fade" role="dialog">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" id="form-contacto-login">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title"><span id="verAsuntoContacto"></span></h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div id="contactoloading" class="text-center"></div>

        <div class="modal-body">
        	
        	<input type="hidden" id="txtAsuntoContacto" value="">
        	<input type="hidden" id="txtNombreContacto" value="<?php echo $empresa->EMPRESA_NOMBRE?>">
        	<input type="hidden" id="txtEmailContacto" value="<?php echo $empresa->EMPRESA_EMAIL?>">

			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-plus"></i></span>
					<textarea class="form-control" id="txtMensajeContacto" name="txtMensajeContacto" rows="6" placeholder="INGRESAR MENSAJE..." required></textarea>
				</div>
			</div>

			<div class="form-group">
				<div class="input-group">					   
                    <button type="submit" class="btn btn-lg btn-primary btn-block" id="sendContacto"><i class="fa fa-refresh" id="loadingContacto"></i> ENVIAR</button>
				</div>
			</div>

		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
        </div>

      </form> 

    </div>

  </div>

</div>  
