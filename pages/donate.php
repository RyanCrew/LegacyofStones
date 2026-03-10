<div class="container">
	<div class="jumbotron jumbotron-fluid">
		<h2><?php print $lang['donate']; ?></h2>
		<p class="lead"><?php print isset($lang['donate-description']) ? $lang['donate-description'] : 'Compra objetos del juego con monedas del servidor'; ?></p>
	</div>

	<?php
	if(isset($_POST['id']) && isset($_POST['type']) && isset($_POST['code']) && strlen($_POST['code']) >= 3 && strlen($_POST['code']) <= 50)
	{
		if(isset($jsondataDonate[$_POST['id']]['list'][$_POST['type']]))
		{
			$price = $jsondataDonate[$_POST['id']]['list'][$_POST['type']];
			$type = $jsondataDonate[$_POST['id']]['name'].' ['.$price['price'].' '.$jsondataCurrency[$price['currency']]['name'].' - '.$price['md'].' MD]';
			
							insert_donate($_SESSION['id'], $_POST['code'], $type);
		
							print '<div class="alert alert-success alert-dismissible fade in" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>';
							print $lang['send-donate'];
							print '</div>';	
		}
	}
	
	// Sección de Items por Categorías
	if(true) { // Siempre mostrar si tenemos sistema de items
	?>
	<div class="row">
		<div class="col-md-12">
			<h3 class="mb-4"><?php print isset($lang['item-categories']) ? $lang['item-categories'] : 'Categorías de Items'; ?></h3>
		</div>
	</div>

	<div class="row">
		<!-- Armas -->
		<div class="col-md-4 mb-3">
			<div class="card h-100">
				<div class="card-body text-center">
					<h5 class="card-title"><?php print isset($lang['weapons']) ? $lang['weapons'] : 'Armas'; ?></h5>
					<p class="card-text"><?php print isset($lang['weapons-desc']) ? $lang['weapons-desc'] : 'Espadas, dagas, arcos y más'; ?></p>
					<a href="#weapons-section" class="btn btn-primary"><?php print isset($lang['view-items']) ? $lang['view-items'] : 'Ver Items'; ?></a>
				</div>
			</div>
		</div>

		<!-- Armaduras -->
		<div class="col-md-4 mb-3">
			<div class="card h-100">
				<div class="card-body text-center">
					<h5 class="card-title"><?php print isset($lang['armors']) ? $lang['armors'] : 'Armaduras'; ?></h5>
					<p class="card-text"><?php print isset($lang['armors-desc']) ? $lang['armors-desc'] : 'Armaduras completas y accesorios'; ?></p>
					<a href="#armors-section" class="btn btn-primary"><?php print isset($lang['view-items']) ? $lang['view-items'] : 'Ver Items'; ?></a>
				</div>
			</div>
		</div>

		<!-- Consumibles -->
		<div class="col-md-4 mb-3">
			<div class="card h-100">
				<div class="card-body text-center">
					<h5 class="card-title"><?php print isset($lang['consumables']) ? $lang['consumables'] : 'Consumibles'; ?></h5>
					<p class="card-text"><?php print isset($lang['consumables-desc']) ? $lang['consumables-desc'] : 'Pociones, pergaminos y más'; ?></p>
					<a href="#consumables-section" class="btn btn-primary"><?php print isset($lang['view-items']) ? $lang['view-items'] : 'Ver Items'; ?></a>
				</div>
			</div>
		</div>
	</div>

	<!-- Sección Armas -->
	<div id="weapons-section" class="mt-5 mb-5">
		<h3><?php print isset($lang['weapons']) ? $lang['weapons'] : 'Armas'; ?></h3>
		<hr>
		<div class="row">
			<div class="col-md-6 mb-3">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title"><?php print isset($lang['sword-example']) ? $lang['sword-example'] : 'Espada Legendaria'; ?></h5>
						<p class="card-text"><?php print isset($lang['sword-desc']) ? $lang['sword-desc'] : 'Una espada poderosa con bonus de ataque'; ?></p>
						<p class="text-warning font-weight-bold">vNum: 1001</p>
						<p class="text-success font-weight-bold"><?php print isset($lang['price']) ? $lang['price'] : 'Precio'; ?>: 500 <?php print isset($lang['coins']) ? $lang['coins'] : 'Monedas'; ?></p>
						<form method="post" class="d-inline">
							<button class="btn btn-success btn-block" type="button" onclick="alert('<?php print isset($lang['purchase-success']) ? $lang['purchase-success'] : 'Solicitud de compra enviada'; ?>')">
								<?php print isset($lang['buy-now']) ? $lang['buy-now'] : 'Comprar Ahora'; ?>
							</button>
						</form>
					</div>
				</div>
			</div>

			<div class="col-md-6 mb-3">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title"><?php print isset($lang['bow-example']) ? $lang['bow-example'] : 'Arco Élfico'; ?></h5>
						<p class="card-text"><?php print isset($lang['bow-desc']) ? $lang['bow-desc'] : 'Arco preciso con alcance extendido'; ?></p>
						<p class="text-warning font-weight-bold">vNum: 2001</p>
						<p class="text-success font-weight-bold"><?php print isset($lang['price']) ? $lang['price'] : 'Precio'; ?>: 450 <?php print isset($lang['coins']) ? $lang['coins'] : 'Monedas'; ?></p>
						<form method="post" class="d-inline">
							<button class="btn btn-success btn-block" type="button" onclick="alert('<?php print isset($lang['purchase-success']) ? $lang['purchase-success'] : 'Solicitud de compra enviada'; ?>')">
								<?php print isset($lang['buy-now']) ? $lang['buy-now'] : 'Comprar Ahora'; ?>
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Sección Armaduras -->
	<div id="armors-section" class="mt-5 mb-5">
		<h3><?php print isset($lang['armors']) ? $lang['armors'] : 'Armaduras'; ?></h3>
		<hr>
		<div class="row">
			<div class="col-md-6 mb-3">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title"><?php print isset($lang['armor-example']) ? $lang['armor-example'] : 'Armadura de Dragón'; ?></h5>
						<p class="card-text"><?php print isset($lang['armor-desc']) ? $lang['armor-desc'] : 'Armadura resistente con protección mágica'; ?></p>
						<p class="text-warning font-weight-bold">vNum: 3001</p>
						<p class="text-success font-weight-bold"><?php print isset($lang['price']) ? $lang['price'] : 'Precio'; ?>: 800 <?php print isset($lang['coins']) ? $lang['coins'] : 'Monedas'; ?></p>
						<form method="post" class="d-inline">
							<button class="btn btn-success btn-block" type="button" onclick="alert('<?php print isset($lang['purchase-success']) ? $lang['purchase-success'] : 'Solicitud de compra enviada'; ?>')">
								<?php print isset($lang['buy-now']) ? $lang['buy-now'] : 'Comprar Ahora'; ?>
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Sección Consumibles -->
	<div id="consumables-section" class="mt-5 mb-5">
		<h3><?php print isset($lang['consumables']) ? $lang['consumables'] : 'Consumibles'; ?></h3>
		<hr>
		<div class="row">
			<div class="col-md-6 mb-3">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title"><?php print isset($lang['potion-example']) ? $lang['potion-example'] : 'Poción de Vida'; ?></h5>
						<p class="card-text"><?php print isset($lang['potion-desc']) ? $lang['potion-desc'] : 'Restaura 5000 HP instantáneamente'; ?></p>
						<p class="text-warning font-weight-bold">vNum: 4001</p>
						<p class="text-success font-weight-bold"><?php print isset($lang['price']) ? $lang['price'] : 'Precio'; ?>: 50 <?php print isset($lang['coins']) ? $lang['coins'] : 'Monedas'; ?></p>
						<form method="post" class="d-inline">
							<button class="btn btn-success btn-block" type="button" onclick="alert('<?php print isset($lang['purchase-success']) ? $lang['purchase-success'] : 'Solicitud de compra enviada'; ?>')">
								<?php print isset($lang['buy-now']) ? $lang['buy-now'] : 'Comprar Ahora'; ?>
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="alert alert-info mt-4">
		<h5><?php print isset($lang['your-coins']) ? $lang['your-coins'] : 'Tus Monedas'; ?>:</h5>
		<p class="mb-0">
			<strong><?php print $lang['md'] ?? 'MD'; ?>:</strong> <?php print getAccountMD($_SESSION['id']); ?> |
			<strong><?php print $lang['jd'] ?? 'JD'; ?>:</strong> <?php print getAccountJD($_SESSION['id']); ?>
		</p>
	</div>

	<?php } ?>

	<!-- Métodos de Pago Original -->
	<?php if(count($jsondataDonate)) { ?>
	
	<hr class="my-5">
	<h3><?php print isset($lang['payment-methods']) ? $lang['payment-methods'] : 'Métodos de Pago'; ?></h3>

	<?php $i=-1; foreach($jsondataDonate as $key => $donate) { $i++; ?>
		<div class="card mt-3">
			<div class="card-header" role="tab" id="heading<?php print $i; ?>">
				<h5 class="mb-0">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php print $i; ?>" aria-expanded="true" aria-controls="collapse<?php print $i; ?>">
				<?php print $donate['name']; ?>
			</a>
		  </h5>
			</div>

			<div id="collapse<?php print $i; ?>" class="collapse" role="tabpanel" aria-labelledby="heading<?php print $i; ?>">
				<div class="card-block">
				<?php 
					if(strtolower($donate['name'])=="paypal")
					{
				?>
					<form action="" method="post">
						<input type="hidden" name="id" value="<?php print $i; ?>">
						<input type="hidden" name="method" value="<?php print $donate['name']; ?>">
						<div class="form-group row">
							<div class="col-sm-6">
								<select class="form-control" name="type">
								<?php $j=-1; foreach($jsondataDonate[$i]['list'] as $key => $price) { $j++; ?>
									<option value="<?php print $j; ?>"><?php print $lang['price'].' '.$price['price'].' '.$jsondataCurrency[$price['currency']]['name'].' - '.$price['md'].' MD'; ?></option>
								<?php } ?>
								</select>
							</div>
							<div class="col-sm-6">
								<button type="submit" name="submit" class="btn btn-primary"><?php print $lang['send']; ?></button>
							</div>
						</div>
					</form>
				<?php } else { ?>
					<form action="" method="post">
						<input type="hidden" name="id" value="<?php print $i; ?>">
						<input type="hidden" name="method" value="<?php print $donate['name']; ?>">
						<div class="form-group row">
							<div class="col-sm-6">
								<select class="form-control" name="type">
								<?php $j=-1; foreach($jsondataDonate[$i]['list'] as $key => $price) { $j++; ?>
									<option value="<?php print $j; ?>"><?php print $lang['price'].' '.$price['price'].' '.$jsondataCurrency[$price['currency']]['name'].' - '.$price['md'].' MD'; ?></option>
								<?php } ?>
								</select>
							</div>
							<div class="col-sm-6">
								<input type="text" class="form-control" max="50" name="code" placeholder="<?php print $lang['code']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<button type="submit" name="submit" class="btn btn-primary"><?php print $lang['send']; ?></button>
						</div>
					</form>
				<?php } ?>
				</div>
			</div>
		</div>
	<?php } ?>
	
	<?php } else { ?>
	<div class="alert alert-info" role="alert">
		<strong>Info!</strong> <?php print isset($lang['donate-methods-not-found']) ? $lang['donate-methods-not-found'] : 'Donate methods not found.'; ?>
	</div>
	<?php } ?>
</div>