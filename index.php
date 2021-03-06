<?php include("header.php"); ?>   
 
	<section id="content" class="page-template a">   
		<div class="fw-page-builder-content">
                    
			<article id="welcome" class="header-static ">

				<figure class="mobile-a">
					<img src="images/mobile-z1.png" alt="">
				</figure>

				<h2><span>LocalFood</span></h2>
				<p>La app para tu smartphone</p>

				<ul class="download-a a">
<!--					<li class="as"><a rel="external" target="_blank" href="#"></a></li>-->
					<li class="gp"><a href="https://play.google.com/store/apps/details?id=cl.localfood.qv" target="_blank"></a></li>
				</ul>
				
			</article>


			<article id="services" class="about-section">
				<div class="wrapper-section">
					<header class="heading-a">
						<h3>
							<span class="small">Servicios</span>
							<span>Te ofrecemos
						</h3>
						
						<p>En LocalFood encontrarás una variada gama de servicios delivery/restaurant, contactarte directamente con ellos, ver sus promociones diarias, horarios de atención, te enviaremos notificaciones con las mejores ofertas del día, ya no busques más, nosotros te daremos la mejor opción para ti.</p>
					</header>

					<ul class="list-a">
						<li>
							<i class="fas fa-store-alt"></i>
							<span class="title">Local</span>
							Enfocado para las comunas de <strong>Quilpué</strong> y <strong>Villa Alemana</strong>, encontrarás sobre 100 locales de comida con multiples ofertas
						</li>
						
						<li>
							<i class="fas fa-utensils"></i>
							<span class="title">Comidas</span>
							Variedad en comidas desde desayunos hasta exóticas, servicios de almuerzo a la puerta de hogar, servicios delivery, restaurante, formas de pago y mucho más...
						</li>
						
						<li>
							<i class="fas fa-mobile-alt"></i>
							<span class="title">Contacto</span>
							Contáctate directamente con el local de comida y realiza tu solicitud o consulta. No busques ni preguntes por local atendiendo, aquí te lo diremos.
						</li>						
					</ul>
					
				</div>
			</article>		


			<article id="about" class="module-a va">
				<header class="heading-a a">
					<h3>
						<span class="small">Acerca de</span>
						<span class="strong">LocalFood</span>
					</h3>
					<p>LocalFood es una app de promoción para pequeñas y medianas empresas del área culinaria local. Promocionando ofertas y productos atractivos para tu bolsillo. Te contactarás directamente con tu empresa de interes, sin intermediarios ni cobros extras.</p>
				</header>
				
				<figure class="sticky-b">
					<img src="images/mobile-about.png" alt="">
				</figure>
			</article>


			<article id="features">
				<header class="heading-a">
					<h3>
						<span class="small">Características</span>
						<span class="strong">LocalFood</span>
					</h3>
				</header>
				
				<ol class="list-b a">
					<li>
						<span class="title">Empresas</span>
						+100 empresas con excelentes ofertas
					</li>
					<li>
						<span class="title">Comidas</span>
						Las empresas están segmentadas en tipo de comida ofrecida.
					</li>
					<li>
						<span class="title">Notificaciones</span>
						Te enviaremos notificaciones periódicas con las mejores ofertas
					</li>
					<li>
						<span class="title">Geolocalización</span>
						Podrás ver la ubicación de la empresa y geolocalizarte respecto a ella.
					</li>
					<li class="mobile-f">
						<img src="images/mobile-features.png" alt="Placeholder" width="738" height="681">
					</li>
				</ol>
			</article>
			
			
			<article id="numbers" class="vb">
				<header class="heading-a b">
					<h3><span class="strong">Obtén</span> la app</h3>
					<p>Descarga desde Google play</p>
				</header>

				<ul class="download-a a">
<!--					<li class="as"><a rel="external" target="_blank" href="#"></a></li>-->
					<li class="gp"><a href="https://play.google.com/store/apps/details?id=cl.localfood.qv" target="_blank"></a></li>
				</ul>

				<figure class="sticky-b a">
					<img src="images/mobile-get.png" alt="">
				</figure>

				<p class="counter"><span><?php echo $rowBase["BASE_DESCARGAS"]?></span> Descargas</p>
			</article>
		


			<article id="carousel3d" class="carousel-slider">
			
				<header class="heading-a">
					<h3>
						<span class="small">PANTALLAS</span>
						<span class="strong">LocalFood</span>
					</h3>
					<p>Ve lo que está incluido en la app</p>
				</header>
       
				<ul class="slider-b" data-carousel-3d>
					<li>
						<a href="#">
							<img src="images/slider1.jpg" alt="" width="320" height="568">
						</a>
					</li>
					<li>
						<a href="#">
							<img src="images/slider2.jpg" alt="" width="320" height="568">
						</a>
					</li>
					<li>
						<a href="#">
							<img src="images/slider3.jpg" alt="" width="320" height="568">
						</a>
					</li>
					<li>
						<a href="#">
							<img src="images/slider4.jpg" alt="" width="320" height="568">
						</a>
					</li>
					<li>
						<a href="#">
							<img src="images/slider5.jpg" alt="" width="320" height="568">
						</a>
					</li>
				</ul>
			</article>
			
			
			<article id="numbers" class="vb">
				<header class="heading-a b">
					<h3 id="contacto"><span class="strong">Contacto</span></h3>
				</header>
				
				<div class="container">
					<div class="row">
						<div class="col-8 offset-2">
							<form id="form-contacto">
							
								<div class="form-group row">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="txtNombreContacto" placeholder="NOMBRE..." required>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-12">
										<input type="email" class="form-control" id="txtEmailContacto" placeholder="EMAIL...">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-12">
										<textarea class="form-control" rows="5" id="txtMensajeContacto" placeholder="MENSAJE..."></textarea>
									</div>
								</div>
								
								<div class="form-group row">
									<div class="col-sm-12 text-center">
										<div id="loadingcontacto"></div>
										<div id="msn-contacto"></div>
									</div>
								</div>

								<div class="text-right">                  
									<input type="submit" id="sendContacto" class="btn btn-outline-secondary" value="ENVIAR">
								</div>
								
							</form>
						</div>
					</div>
				</div>
				
				
			</article>


		</div>
	</section>

<?php include("footer.php"); ?>