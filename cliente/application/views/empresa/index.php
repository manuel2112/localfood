<div class="row mb-2">
	<div class="col">
		<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEmpresa">
			Agregar Empresa
		</button>
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

<table class="table table-bordered table-dark table-hover" id="empresa" style="width:100%">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">ID</th>
      <th scope="col">LOGOTIPO</th>
      <th scope="col">EMPRESA</th>
      <th scope="col">CIUDAD</th>
      <th scope="col">GEO</th>
      <th scope="col">OPEN</th>
      <th scope="col">ACCIONES</th>
    </tr>
  </thead>
</table>
<button type='button' class='btn btn-primary' data-toggle='popover' data-trigger='hover' data-placement='top' data-content='Now hover out.'>
  xxx
</button>
<!--=====================================
MODAL AGREGAR EMPRESA
======================================-->
<div id="modalAgregarEmpresa" class="modal fade" role="dialog">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?php echo base_url()?>empresa/insert" role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Agregar Empresa</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
        
        	<div id="respuesta"></div>
        	
        	<div class="row">
        		<div class="col-12 col-md-6">
					<div class="form-group">              
						<div class="input-group">              
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<select class="form-control" id="cmbCiudad" name="cmbCiudad" required>
								<option value="">SELECCIONAR CIUDAD (*)...</option>
								<?php foreach( $ciudades as $itemCiudades){?>
									<option value="<?php echo $itemCiudades->CIUDAD_ID?>"><?php echo $itemCiudades->CIUDAD_NOMBRE?></option>
								<?php }?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEmpresa" id="txtEmpresa" placeholder="NOMBRE EMPRESA (*)..." required>
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtDireccion" id="txtDireccion" placeholder="DIRECCIÓN...">
						</div>
					</div>
					
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtLatitud" id="txtLatitud" placeholder="LATITUD...">
						</div>
					</div>
					
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtLongitud" id="txtLongitud" placeholder="LONGITUD...">
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtUrl" id="txtUrl" placeholder="URL...">
						</div>
					</div>
					
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtFono" id="txtFono" placeholder="TELÉFONO (*)..." required>
						</div>
					</div>
					
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEmail" id="txtEmail" placeholder="EMAIL...">
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<textarea class="form-control" rows="5" name="txtDescripcion" id="txtDescripcion" placeholder="DESCRIPCIÓN (*)..." required></textarea>
						</div>
					</div>

					<div class="form-group">
						<div class="panel">LOGOTIPO</div>
						<input type="file" class="nuevaFotoEmpresa" name="nuevaFotoEmpresa" id="nuevaFotoEmpresa">
						<p class="help-block">Peso máximo de la foto 512KB</p>
						<img src="<?php echo base_url('public/images/food-defecto.png')?>" class="img-thumbnail previsualizarEmpresa" width="100px">
					</div>
        		</div>
        		
        		<div class="col-12 col-md-3">
        			<h6><strong>TIPOS DE COMIDA</strong></h6>
					<?php foreach( $comidas as $itemComidas ){?>
						<div class="form-check">
							<label class="form-check-label">
								<input type="checkbox" class="form-check-input chktipocomida" name="chktipocomida[]" value="<?php echo $itemComidas->TIPO_COMIDA_ID?>"> <?php echo $itemComidas->TIPO_COMIDA_NOMBRE?>
							</label>
						</div>     				
      				<?php }?>        			
        		</div>
        		
        		<div class="col-12 col-md-3">
        			<h6><strong>TIPOS DE NEGOCIO</strong></h6>
					<?php foreach( $negocios as $itemNegocios ){?>
						<div class="form-check">
							<label class="form-check-label">
								<input type="checkbox" class="form-check-input chktiponegocio" name="chktiponegocio[]" value="<?php echo $itemNegocios->TIPO_NEGOCIO_ID?>"> <?php echo $itemNegocios->TIPO_NEGOCIO_NOMBRE?>
							</label>
						</div>     				
      				<?php }?>
      				
      				<br>
      				<hr>
      				<br>
      				
        			<h6><strong>TIPOS DE PAGO</strong></h6>
					<?php foreach( $pagos as $itemPagos ){?>
						<div class="form-check">
							<label class="form-check-label">
								<input type="checkbox" class="form-check-input chktipopago" name="chktipopago[]" value="<?php echo $itemPagos->TIPO_PAGO_ID?>"> <?php echo $itemPagos->TIPO_PAGO_NOMBRE?>
							</label>
						</div>     				
      				<?php }?>
        		</div>
        		
        	</div><!-- PIE ROW -->
        
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
			<button type="submit" class="btn btn-primary" id="btnGuardarEmpresa">Guardar Empresa</button>
        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR EMPRESA
======================================-->
<div id="modalEditarEmpresa" class="modal fade" role="dialog">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?php echo base_url()?>empresa/editar" role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Editar Empresa</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
		<div id="editarloading" class="text-center"></div>
       
        <div class="modal-body">
        
        	<div id="respuesta"></div>
        	
        	<div class="row">
        		<div class="col-12 col-md-6">
					<div class="form-group">              
						<div class="input-group">              
							<span class="input-group-addon"><i class="fa fa-plus"></i></span> 
							<select class="form-control" id="cmbEditCiudad" name="cmbEditCiudad" required>
								<?php foreach( $ciudades as $itemCiudades){?>
									<option value="<?php echo $itemCiudades->CIUDAD_ID?>"><?php echo $itemCiudades->CIUDAD_NOMBRE?></option>
								<?php }?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="hidden" name="idEditEmpresa" id="idEditEmpresa" >
							<input type="text" class="form-control" name="txtEditEmpresa" id="txtEditEmpresa" placeholder="NOMBRE EMPRESA (*)..." required>
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditDireccion" id="txtEditDireccion" placeholder="DIRECCIÓN...">
						</div>
					</div>
					
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditLatitud" id="txtEditLatitud" placeholder="LATITUD...">
						</div>
					</div>
					
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditLongitud" id="txtEditLongitud" placeholder="LONGITUD...">
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditUrl" id="txtEditUrl" placeholder="URL...">
						</div>
					</div>
					
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditFono" id="txtEditFono" placeholder="TELÉFONO (*)..." required>
						</div>
					</div>
					
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditEmail" id="txtEditEmail" placeholder="EMAIL...">
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<textarea class="form-control" rows="5" name="txtEditDescripcion" id="txtEditDescripcion" placeholder="DESCRIPCIÓN (*)..." required></textarea>
						</div>
					</div>

					<div class="form-group">
						<div class="panel">LOGOTIPO</div>
						<img class="img-thumbnail previsualizarEmpresa" width="100px">
						<input type="file" class="EditFotoEmpresa" name="EditFotoEmpresa" id="EditFotoEmpresa">
						<p class="help-block">Peso máximo de la foto 512KB</p>
              			<input type="hidden" name="fotoActualEmpresa" id="fotoActualEmpresa">
					</div>
        		</div>
        		
        		<div class="col-12 col-md-3">
        			<h6><strong>TIPOS DE COMIDA</strong></h6>
        			<span id="editarTiposComida"></span>
        		</div>
        		
        		<div class="col-12 col-md-3">
        			<h6><strong>TIPOS DE NEGOCIO</strong></h6>
        			<span id="editarTiposNegocio"></span>
      				
      				<br>
      				<hr>
      				<br>
      				
        			<h6><strong>TIPOS DE PAGO</strong></h6>
        			<span id="editarTiposPago"></span>
        		</div>
        		
        	</div><!-- PIE ROW -->
        
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
			<button type="submit" class="btn btn-primary" id="btnEditarEmpresa">Editar Empresa</button>
        </div>

      </form> 

    </div>

  </div>

</div>

<!--=====================================
MODAL VER EMPRESA
======================================-->
<div id="modalVerEmpresa" class="modal fade" role="dialog">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title"><span id="verNmbEmpresa"></span></h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
		<div id="verloading" class="text-center"></div>

        <div class="modal-body">
        	
        	<div class="row">
        		<div class="col-12 col-md-8">
        		
					<table class="table">
						<tr>
							<td class="table-primary">ID</td>
							<td><span id="verIdEmpresa"></span></td>
						</tr>
						<tr>
							<td class="table-primary">EMPRESA</td>
							<td><span id="verNmbEmpresa2"></span></td>
						</tr>
						<tr>
							<td class="table-primary">CIUDAD</td>
							<td><span id="verCiudadEmpresa"></span></td>
						</tr>
						<tr>
							<td class="table-primary">DIRECCIÓN</td>
							<td><span id="verDireccionEmpresa"></span></td>
						</tr>
						<tr>
							<td class="table-primary">LATITUD</td>
							<td><span id="verLatEmpresa"></span></td>
						</tr>
						<tr>
							<td class="table-primary">LONGITUD</td>
							<td><span id="verLongEmpresa"></span> <span id="verUbicacionEmpresa"></span></td>
						</tr>
						<tr>
							<td class="table-primary">WEB</td>
							<td><span id="verWebEmpresa"></span> <span id="verWebUrlEmpresa"></span></td>
						</tr>
						<tr>
							<td class="table-primary">FONO</td>
							<td><span id="verFonoEmpresa"></span></td>
						</tr>
						<tr>
							<td class="table-primary">EMAIL</td>
							<td><span id="verEmailEmpresa"></span></td>
						</tr>
						<tr>
							<td class="table-primary">DESCRIPCIÓN</td>
							<td><span id="verDescEmpresa"></span></td>
						</tr>
					</table>
        		</div>
        		
        		<div class="col-12 col-md-4">
        			<img src="" class="img-thumbnail previsualizarVerLogoEmpresa" width="80%">
     				
      				<hr>
        			
        			<h6><strong>TIPOS DE COMIDA</strong></h6>
					<span id="verTiposComida"></span>
     				
      				<hr>
      				
        			<h6><strong>TIPOS DE NEGOCIO</strong></h6>
					<span id="verTiposNegocio"></span>
					
      				<hr>
      				
        			<h6><strong>TIPOS DE PAGO</strong></h6>
					<span id="verTiposPago"></span>     			
        		</div>
        		
        	</div><!-- PIE ROW -->
        
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
        </div>

    </div>

  </div>

</div>

<!--=====================================
MODAL VER/AGREGAR HORARIO EMPRESA
======================================-->
<div id="modalInsertHorario" class="modal fade" role="dialog">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Horario de <span id="verNmbEmpresaHorario"></span></h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
		<div id="horaloading" class="text-center"></div>

        <div class="modal-body">
        	
        	<div class="row">
        		<div class="col-12 col-md-8">        		
        			
        			<div id="tblHorario"></div>
        		
        			<hr>

        		</div>
        		
        		<div class="col-12 col-md-4">
        			<img src="" class="img-thumbnail previsualizarVerLogoEmpresa" width="80%">
        		</div>

        		<div class="col-12">

					<form role="form" method="post" id="formInsertHorario">
						<div id="horarioingresado" class="text-center"></div>

						<input type="hidden" name="idEmpresaHour" id="idEmpresaHour">

						<div class="row">
							<div class="col">
								<div class="form-group">
									<h5><strong>HORA INICIO</strong></h5>
									<div class="input-group">
										<?php foreach( $dias as $itemDia){?>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input type="radio" class="form-check-input cmbDiaInicio" name="cmbDiaInicio" value="<?php echo $itemDia->DIA_ID?>"><?php echo $itemDia->DIA_NOMBRE?>
											</label>
										</div>
										<?php }?>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">              
									<div class="">
										<?php 
										for( $i = 0 ; $i < 24 ; $i++ ){
											$hora = $i < 10 ? '0'.$i.':00:00' : $i.':00:00' ;
										?>
											<div class="form-check-inline">
												<label class="form-check-label">
													<input type="radio" class="form-check-input cmbHoraInicio" name="cmbHoraInicio" value="<?php echo $hora?>"><?php echo $hora?>
												</label>
											</div>
										<?php
											$hora = $i < 10 ? '0'.$i.':30:00' : $i.':30:00' ;
										?>
											<div class="form-check-inline">
												<label class="form-check-label">
													<input type="radio" class="form-check-input cmbHoraInicio" name="cmbHoraInicio" value="<?php echo $hora?>"><?php echo $hora?>
												</label>
											</div>
										
										<?php
										}//FIN FOR
										?>
									</div>
								</div>
							</div>
						</div>
						
						<hr>

						<div class="row">
							<div class="col">
								<div class="form-group">
									<h5><strong>HORA TÉRMINO</strong></h5>
									<div class="input-group">
										<?php foreach( $dias as $itemDia){?>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input type="radio" class="form-check-input cmbDiaCierre" name="cmbDiaCierre" value="<?php echo $itemDia->DIA_ID?>"><?php echo $itemDia->DIA_NOMBRE?>
											</label>
										</div>
										<?php }?>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">              
									<div class="">
										<?php 
										for( $i = 0 ; $i < 24 ; $i++ ){
											$hora = $i < 10 ? '0'.$i.':00:00' : $i.':00:00' ;
										?>
											<div class="form-check-inline">
												<label class="form-check-label">
													<input type="radio" class="form-check-input cmbHoraCierre" name="cmbHoraCierre" value="<?php echo $hora?>"><?php echo $hora?>
												</label>
											</div>
										<?php
											$hora = $i < 10 ? '0'.$i.':30:00' : $i.':30:00' ;
										?>
											<div class="form-check-inline">
												<label class="form-check-label">
													<input type="radio" class="form-check-input cmbHoraCierre" name="cmbHoraCierre" value="<?php echo $hora?>"><?php echo $hora?>
												</label>
											</div>
										
										<?php
										}//FIN FOR
										?>
									</div>
								</div>
							</div>
						</div>

						<div class="row mt-3">
							<div class="col-12 text-right">
								<button type="button" class="btn btn-primary" id="guardarHorario">Guardar Horario</button>
							</div>
						</div>
        		</div>

        	</div><!-- PIE ROW -->

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

<!--=====================================
MODAL VER/AGREGAR FOTOS PROMOCIÓN EMPRESA
======================================-->
<div id="modalInsertFoto" class="modal fade" role="dialog">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?php echo base_url()?>empresa/insertfoto" role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Imágenes de Perfil - <span id="verNmbEmpresaFoto"></span></h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
		<div id="fotoloading" class="text-center"></div>

        <div class="modal-body">

        	<div class="row">
        		<div class="col-12 col-md-8">

        			<div id="tblFoto"></div>

        			<hr>
        		
        			<input type="hidden" name="idEmpresaFoto" id="idEmpresaFoto">

					<div class="form-group">
						<div class="file-loading">
							<input type="file" id="file-es" name="file-es[]" multiple>
						</div>
						<span class="help-block text-secondary">5 imagenes máximo.</span><br>
						<span class="help-block text-secondary">512MB máximo por imagen.</span>
					</div>

        		</div>

        		<div class="col-12 col-md-4">
        			<img src="" class="img-thumbnail previsualizarVerLogoEmpresa" width="80%">
        		</div>

        	</div><!-- PIE ROW -->

		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
				<button type="submit" class="btn btn-primary" id="btnGuardarDestacado">Guardar Imágenes</button>
			</div>

		</form>

    </div>

  </div>

</div>

<!--=====================================
MODAL PLAN EMPRESA
======================================-->
<div id="modalInsertPlan" class="modal fade" role="dialog">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">PLAN DE <span id="verNmbEmpresaPlan"></span></h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
		<div id="planloading" class="text-center"></div>

        <div class="modal-body">
        	
        	<div class="row">
        		<div class="col-12 col-md-8">

      			<form role="form" method="post">
        			<div id="planingresado" class="text-center"></div>
        			
					<input type="hidden" name="idEmpresaPlan" id="idEmpresaPlan">
					
					<div class="row">
						<div class="col">
							<div class="form-group">              
								<div class="input-group">              
									<span class="input-group-addon"><i class="fa fa-plus"></i></span>
									<select class="form-control" id="cmbPlan" name="cmbPlan" required>
										<option value="">SELECCIONAR PLAN (*)...</option>
										<?php foreach( $planes as $itemPlan){?>
											<option value="<?php echo $itemPlan->PLAN_ID?>"><?php echo $itemPlan->PLAN_NOMBRE?></option>
										<?php }?>
									</select>
								</div>
							</div>
						</div>
					</div>					

					<div class="row mt-3">
						<div class="col-12 text-right">
							<button type="button" class="btn btn-primary btn-block" id="guardarPlan">INGRESAR PLAN</button>
						</div>
					</div>

        			<hr>

        			<div id="tblPlanes"></div>

        		</div>
        		
        		<div class="col-12 col-md-4">
        			<img src="" class="img-thumbnail previsualizarVerLogoEmpresa" width="80%">
        		</div>
        		
        	</div><!-- PIE ROW -->
        
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
    