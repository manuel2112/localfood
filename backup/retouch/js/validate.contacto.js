/*=============================================
CONTACTO LOGIN
=============================================*/
	$(function(){		           
		           
		$("#sendContacto").on("click",function() 
		{
			var nombre	= $.trim($('#txtNombreContacto').val());
			var email	= $.trim($('#txtEmailContacto').val());
			var mensaje	= $.trim($('#txtMensajeContacto').val());
			
			var dataString	= {nombre:nombre, email:email, mensaje:mensaje};
			if( true )
			{
				$('#loadingcontacto').html('<img src="images/loading.gif" width="50">');
				$.ajax({
					type: "POST",
					url: "sp/sp_contacto.php",
					data: dataString,
					cache: false,
					success: function(html)					
					{
						if( html === '' )
						{
							$('#loadingcontacto').html('');
							$('#form-contacto').trigger("reset");
							$("#msn-contacto").html('<div class="col-xs-12 alert alert-success text-center" role="alert"><h3>Gracias<br />Pronto te responderemos.</h3></div>').show();
						}
						else//ERROR VALIDACIONES
						{
							$('#loadingcontacto').html('');
							$("#msn-contacto").html(html).show();
						}
					}
				});
			}
			return false;    
		});				
	});
