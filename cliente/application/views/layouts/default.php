<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $this->layout->getTitle(); ?></title>
    <meta name="description" content="<?php echo $this->layout->getDescripcion(); ?>"  />
    <meta name="keywords" content="<?php echo $this->layout->getKeywords(); ?>" />
    
    <link rel="stylesheet" href="<?php echo base_url('public/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('public/fileinput/css/fileinput.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('public/css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('public/css/dataTables.bootstrap4.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('public/sweetalert/sweetalert.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('public/datetimepicker/bootstrap-datetimepicker.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('public/css/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('public/css/responsive.css')?>">
    
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>	
	
    <link rel="stylesheet" href="<?php echo base_url('public/plugins/chosen/chosen.min.css')?>">
	
</head>

<body>

	<div class="container-fluid">
        <div class="row">
        	<div class="barra-lateral col-12 col-sm-auto">
            	<div class="logo mx-auto text-center">
                	<a href="<?php echo base_url()?>" title="INICIO"><img src="<?php echo base_url('public/images/logo.png')?>" alt="" class="img-fluid logo" width="200"></a>
                </div>
                <nav class="menu d-flex d-sm-block justify-content-center flex-wrap">
                
					<!--SESION ADMINISTRADOR-->
                	<?php if( $this->session->userdata('adminappchan') ){?>
						<a href="<?php echo base_url()?>" title="INICIO"><i class="fa fa-home"></i> <span>Inicio</span></a>
						<a href="<?php echo base_url()?>empresa" title="EMPRESA" class="<?php echo $this->uri->segment(1) == 'empresa' ? 'active' : '' ;?>"><i class="fa fa-users"></i> <span>Empresa</span></a>
						<a href="<?php echo base_url()?>destacados" title="DESTACADOS" class="<?php echo $this->uri->segment(1) == 'destacados' ? 'active' : '' ;?>"><i class="fa fa-users"></i> <span>Destacados</span></a>
                		<a href="<?php echo base_url()?>notificacion" title="NOTIFICACIÓN" class="<?php echo $this->uri->segment(1) == 'notificacion' ? 'active' : '' ;?>"><i class="fa fa-bell"></i> <span>Notificación</span></a>
						<a href="<?php echo base_url()?>tipocomida" title="TIPO DE COMIDA" class="<?php echo $this->uri->segment(1) == 'tipocomida' ? 'active' : '' ;?>"><i class="fa fa-list"></i> <span>Tipo de Comida</span></a>
						<a href="<?php echo base_url()?>tiponegocio" title="TIPO DE NEGOCIO" class="<?php echo $this->uri->segment(1) == 'tiponegocio' ? 'active' : '' ;?>"><i class="fa fa-list"></i> <span>Tipo de Negocio</span></a>
						<a href="<?php echo base_url()?>ciudad" title="CIUDAD" class="<?php echo $this->uri->segment(1) == 'ciudad' ? 'active' : '' ;?>"><i class="fa fa-list"></i> <span>Ciudad</span></a>
						<a href="<?php echo base_url()?>correo" title="CORREO" class="<?php echo $this->uri->segment(1) == 'correo' ? 'active' : '' ;?>"><i class="fa fa-list"></i> <span>Correo</span></a>
						<a href="<?php echo base_url()?>apirest" title="API REST" class="<?php echo $this->uri->segment(1) == 'apirest' ? 'active' : '' ;?>"><i class="fa fa-list"></i> <span>API Rest</span></a>
                	<?php }?>

               		<!--SESION CLIENTE-->
                	<?php if( $this->session->userdata('clienteappchan') ){?>
                		<?php $idPlan = $this->plan_id;?>
                	
                		<a href="<?php echo base_url()?>cliente" title="INICIO" class="<?php echo $this->uri->segment(2) == '' ? 'active' : '' ;?>"><i class="fa fa-home"></i> <span>Inicio</span></a>
                		
                		<?php if( $idPlan == 2 || $idPlan == 3 || $idPlan == 4 || $idPlan == 5 ){?>
                		<a href="<?php echo base_url()?>cliente/imagenesperfil" title="IMÁGENES DE PERFIL" class="<?php echo $this->uri->segment(2) == 'imagenesperfil' ? 'active' : '' ;?>"><i class="fa fa-picture-o"></i> <span>Imágenes de Perfil</span></a>
                		<?php }?>
                		
                		<?php if( $idPlan == 3 || $idPlan == 4 || $idPlan == 5 ){?>
                		<a href="<?php echo base_url()?>cliente/destacado" title="DESTACADO" class="<?php echo $this->uri->segment(2) == 'destacado' ? 'active' : '' ;?>"><i class="fa fa-star"></i> <span>Destacado</span></a>
                		<?php }?>
                		
                		<?php if( $idPlan == 4 || $idPlan == 5 ){?>
                		<a href="<?php echo base_url()?>cliente/notificacion" title="NOTIFICACIÓN" class="<?php echo $this->uri->segment(2) == 'notificacion' ? 'active' : '' ;?>"><i class="fa fa-bell"></i> <span>Notificación</span></a>
                		<?php }?>
                		
                		<?php if( $idPlan == 4 || $idPlan == 5 ){?>
                		<a href="<?php echo base_url()?>cliente/estadistica" title="ESTADÍSTICAS" class="<?php echo $this->uri->segment(2) == 'estadistica' ? 'active' : '' ;?>"><i class="fa fa-bar-chart"></i> <span>Estadística</span></a>
                		<?php }?>
                		
                		<a href="<?php echo base_url()?>cliente/password" title="PASSWORD" class="<?php echo $this->uri->segment(2) == 'password' ? 'active' : '' ;?>"><i class="fa fa-key"></i> <span>Cambiar Contraseña</span></a>
                	<?php }?>
                	
                	<a href="<?php echo base_url()?>cliente/planes" title="PLANES" class="<?php echo $this->uri->segment(2) == 'password' ? 'active' : '' ;?>"><i class="fa fa-key"></i> <span>Planes</span></a>
                	
                	<a href="<?php echo base_url()?>login/logout" title="SALIR"><i class="fa fa-sign-out"></i> <span>Salir</span></a>
                </nav>
            </div>
            
            <main class="col">
            	<div class="row">
                	<div class="columna col-lg-12">
                    	<div class="widget">
                            <?php echo $content_for_layout;?>
                        </div>
                    </div>
                </div>
            </main>
            
        </div>
    </div>
  
<script type="text/javascript">
	var base_url	= '<?php echo base_url();?>';
</script>
	
<script src="<?php echo base_url('public/js/jquery.min.js')?>"></script>
<script src="<?php echo base_url('public/js/jquery-3.3.1.js')?>"></script>
<script src="<?php echo base_url('public/js/popper.min.js')?>"></script>
<script src="<?php echo base_url('public/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('public/js/fileinput.min.js')?>"></script>
<script src="<?php echo base_url('public/fileinput/js/locales/es.js')?>"></script>
<script src="<?php echo base_url('public/fileinput/js/theme.js')?>"></script>
<script src="<?php echo base_url('public/js/theme.js')?>"></script>
<script src="<?php echo base_url('public/fileinput/themes/explorer-fas/theme.js')?>"></script>
<script src="<?php echo base_url('public/sweetalert/sweetalert.min.js')?>"></script>
<script src="<?php echo base_url('public/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('public/js/dataTables.bootstrap4.min.js')?>"></script>
<script src="<?php echo base_url('public/datetimepicker/moment.min.js')?>"></script>
<script src="<?php echo base_url('public/datetimepicker/bootstrap-datetimepicker.min.js')?>"></script>
<script src="<?php echo base_url('public/plugins/chosen/chosen.jquery.min.js')?>"></script>
<script src="<?php echo base_url('public/js/tablas.js')?>"></script>


<!--SESION ADMINISTRADOR-->
<?php if( $this->session->userdata('adminappchan') ){?>
	<script src="<?php echo base_url('public/js/validate.tipo.negocio.js')?>"></script>
	<script src="<?php echo base_url('public/js/validate.tipo.comida.js')?>"></script>
	<script src="<?php echo base_url('public/js/validate.empresa.js')?>"></script>
	<script src="<?php echo base_url('public/js/validate.destacado.js')?>"></script>
	<script src="<?php echo base_url('public/js/validate.ciudad.js')?>"></script>
	<script src="<?php echo base_url('public/js/validate.notificacion.js')?>"></script>
	<script src="<?php echo base_url('public/js/validate.graph.back.js')?>"></script>
	<script src="<?php echo base_url('public/js/validate.correo.js')?>"></script>
	<script src="<?php echo base_url('public/js/validate.base.js')?>"></script>
<?php }?>

<!--SESION CLIENTE-->
<?php if( $this->session->userdata('clienteappchan') ){?>
	<script src="<?php echo base_url('public/js/validate.cliente.js')?>"></script>
<?php }?>

<script src="<?php echo base_url('public/js/validate.files.js')?>"></script>
<script src="<?php echo base_url('public/js/function.date.js')?>"></script>
<script src="<?php echo base_url('public/js/validate.graph.js')?>"></script>
<script src="<?php echo base_url('public/js/function.popup.js')?>"></script>
<script src="<?php echo base_url('public/js/funciones.js')?>"></script>

</body>
</html>