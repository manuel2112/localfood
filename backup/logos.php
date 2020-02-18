<?php
	require_once("clases/class.clientes.php");
	$cliente = new Cliente;	
	$allClientes = $cliente->getClientes();
?>
<?php include("header.php"); ?>

<main>
	<div class="container">
		<div class="row">
			<div class="col-12 mt-5">
				<?php foreach( $allClientes as $item ){?>
				<img src="cliente/<?php echo $item["EMPRESA_LOGOTIPO"]?>" class="img-thumbnail" width="80" alt="">
				<?php }?>
			</div>
		</div>
	</div>	
</main>

<?php include("footer.php"); ?>
