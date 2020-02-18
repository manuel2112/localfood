/*=============================================
UPDATE PASSWORD
=============================================*/
$(document).ready(function(){
	$("#formpassword").on("click", ".btnEditarPw", function(){

		$('#loadingpw').html('<img src="' + base_url + 'public/images/loading.gif" width="30">');
		var idCliente	= $("#idCliente").val();
		var actualPw	= $("#actualPw").val();
		var nuevoPw		= $("#nuevoPw").val();
		var repitePw	= $("#repitePw").val();
		
		var dataString	= {idCliente:idCliente,actualPw:actualPw,nuevoPw:nuevoPw,repitePw:repitePw};

		$.ajax({

			url: base_url + "cliente/passwordeditajax",
			method: "POST",
			data: dataString,
			success: function(respuesta){
				
				if( respuesta === "1" ){
					$('#loadingpw').html('');
					$("#actualPw").val('');
					$("#nuevoPw").val('');
					$("#repitePw").val('');
					swal({
						title: "Éxito!",
						text: 'Contraseña editada con éxito',
						type: "success"
					});
				}else{
					$('#loadingpw').html('');
					swal({
						title: "Error!",
						text: respuesta,
						type: "error"
					});
				}
			}

		});

	});
});//FIN DOCUMENT

/*=============================================
VALIDAR IMAGEN LOGOTIPO
=============================================*/	
$(document).ready(function(){

	$(".EditFotoLogoCliente").change(function(){

		var imagen = this.files[0];

		/*=============================================
		VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
		=============================================*/

		if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

			$(".EditFotoLogoCliente").val("");

			 swal({
				  title: "Error al subir la imagen",
				  text: "¡La imagen debe estar en formato JPG o PNG!",
				  type: "error",
				  confirmButtonText: "¡Cerrar!"
				});

		}else if( imagen["size"] > 512000 ){

			$(".EditFotoLogoCliente").val("");

			 swal({
				  title: "Error al subir la imagen",
				  text: "¡La imagen no debe pesar más de 512KB!",
				  type: "error",
				  confirmButtonText: "¡Cerrar!"
				});

		}else{

			var datosImagen = new FileReader();
			datosImagen.readAsDataURL(imagen);

			$(datosImagen).on("load", function(event){

				var rutaImagen = event.target.result;

				$(".previsualizarLogoCliente").attr("src", rutaImagen);

			});

		}
	});

});//FIN DOCUMENT

/*=============================================
GET MODAL CONTACTO
=============================================*/
$(document).ready(function(){
	$(".btnContacto").on("click",function(){
		
		$(".modal-body").hide();		
		$('#contactoloading').html('<img src="' + base_url + 'public/images/loading.gif" width="300">');
		
		var asunto	= $(this).attr("asunto");
		$("#verAsuntoContacto").text(asunto);
		$("#txtAsuntoContacto").val(asunto);
		$("#txtMensajeContacto").val("");
		
		$('#contactoloading').html('');
		$(".modal-body").show();		

	});
});//FIN DOCUMENT

/*=============================================
CONTACTO LOGIN
=============================================*/
$(document).ready(function(){
	$("#mdlContacto").on("click", "#sendContacto", function(){
		
		$( "#loadingContacto" ).addClass( "fa-spin" );
		var txtAsuntoContacto	= $("#txtAsuntoContacto").val();
		var txtNombreContacto	= $("#txtNombreContacto").val();
		var txtEmailContacto	= $("#txtEmailContacto").val();
		var txtMensajeContacto	= $("#txtMensajeContacto").val();
		
		var dataString	= {asunto:txtAsuntoContacto, nombre:txtNombreContacto, email:txtEmailContacto, mensaje:txtMensajeContacto};

		$.ajax({

			url: base_url + "contacto/formcliente",
			method: "POST",
			data: dataString,
			success: function(respuesta){
				if( respuesta === "" ){
					$( "#loadingContacto" ).removeClass( "fa-spin" );
					swal({
						title: "Mensaje Enviado!",
						text: "Pronto nos contactaremos contigo",
						type: "success"
					});
					$('#mdlContacto').modal('hide');
				}else{
					$( "#loadingContacto" ).removeClass( "fa-spin" );
					swal({
						title: "Error!",
						text: respuesta,
						type: "error"
					});
				}
			}

		});
		return false; 
	});
});//FIN DOCUMENT	
