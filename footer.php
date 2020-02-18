
<footer id="footer">
  <figure> <img src="images/logo.png" alt="" width="174" height="55"> </figure>
  <h3>Síguenos</h3>
  <ul class="social-a">
    <li class="fb"><a href="https://www.facebook.com/LocalFood-582165198953546/" target="_blank">Facebook</a></li>
    <!--
			<li class="tw"><a rel="external" target="_blank" href="#">Twitter</a></li>
			<li class="in"><a rel="external" target="_blank" href="#">Instagram</a></li>
-->
  </ul>
  <ul class="download-a">
    <!--			<li class="as"><a rel="external" target="_blank" href="#"></a></li>-->
    <li class="gp"><a href="https://play.google.com/store/apps/details?id=cl.localfood.qv" target="_blank"></a></li>
  </ul>
  <p>© <span class="date">2019</span> LocalFood. <a href="politicas">Políticas de Privacidad</a></p>
</footer>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 
<script src='js/jquery.js'></script> 
<!--<script src='js/jquery-migrate.min.js'></script>--> 
<script src='js/head.js'></script> 
<!--<script src='js/mobile.js'></script>--> 
<script src='js/scripts.js'></script> 
<script src='js/carousel-3d.js'></script> 
<script src='js/validate.contacto.js'></script> 
<!--<script src='js/jquery.carouFredSel-6.2.1-packed.js'></script>--> 
<!--<script src='js/wp-embed.min.js'></script>--> 
<script>	   
		$(document).on('click', '.ir-arriba', function() {
			
				$('body, html').animate({
					scrollTop: '0px'
				}, 1000);

		});//FIN DOCUMENT
	   
		$(document).ready(function(){

		  $("a").on('click', function(event) {

			if (this.hash !== "") {

			  event.preventDefault();

			  var hash = this.hash;

			  $('html, body').animate({
				scrollTop: $(hash).offset().top
			  }, 1000, function(){
				window.location.hash = hash;
			  });
			} // End if
		  });
		});	   
	</script>
</body></html>