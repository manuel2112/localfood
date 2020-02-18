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
				$( "#loadingContacto" ).addClass( "fa-spin" );
				$.ajax({
					type: "POST",
					url: "sp/sp_contacto.php",
					data: dataString,
					cache: false,
					success: function(html)					
					{
						if( html === '' )
						{
							$( "#loadingContacto" ).removeClass( "fa-spin" );
							 swal({
							  title: "PRONTO NOS CONTACTAREMOS CONTIGO",
							  type: "success",
							  confirmButtonText: "¡Cerrar!"
							}).then(function(result) {
								window.location = "index";
							});
						}
						else//ERROR VALIDACIONES
						{
							$("#error-contacto").html(html).show();
							$( "#loadingContacto" ).removeClass( "fa-spin" );
						}
					}
				});
			}
			return false;    
		});				
	});
