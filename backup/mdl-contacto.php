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
			<h4 class="modal-title">Formulario de Contacto</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">			

			<div class="form-group">              
				<div class="input-group">
					<input type="text" class="form-control" name="txtNombreContacto" id="txtNombreContacto" placeholder="NOMBRE..." required>
				</div>
			</div>			

			<div class="form-group">
				<div class="input-group">
					<input type="email" class="form-control" name="txtEmailContacto" id="txtEmailContacto" placeholder="EMAIL..." required>
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">
					<textarea class="form-control" id="txtMensajeContacto" name="txtMensajeContacto" rows="3" placeholder="MENSAJE..." required></textarea>
				</div>
			</div>
					
			<div class="col-12">
				<div id="error-contacto"></div>
			</div>
			
			<div class="form-group">
				<div class="input-group">					   
                    <button type="submit" class="btn btn-lg btn-primary btn-block" id="sendContacto"><i class="fas fa-sync-alt" id="loadingContacto"></i> ENVIAR</button>
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