<?php
require_once('../../include/functions/basic.php');

if($web_admin<$jsondataPrivileges['edit-info']) {
	redirect($site_url);
	exit();
}

// Crear tabla si no existe
$database->runQuery("CREATE TABLE IF NOT EXISTS itemshop (
	id INT AUTO_INCREMENT PRIMARY KEY,
	vnum INT NOT NULL,
	name VARCHAR(255) NOT NULL,
	price INT NOT NULL,
	image VARCHAR(255),
	quantity INT DEFAULT 999,
	description TEXT,
	category VARCHAR(100),
	active TINYINT DEFAULT 1,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	UNIQUE KEY(vnum)
)");

// Procesar formulario de agregar/editar
if(isset($_POST['action'])) {
	if($_POST['action'] == 'add' || $_POST['action'] == 'edit') {
		$vnum = intval($_POST['vnum']);
		$name = htmlspecialchars($_POST['name']);
		$price = intval($_POST['price']);
		$quantity = intval($_POST['quantity']);
		$category = htmlspecialchars($_POST['category']);
		$description = htmlspecialchars($_POST['description']);
		
		// Procesar imagen
		$image = '';
		if(!empty($_FILES['image']['name'])) {
			$target_dir = "../../images/itemshop/";
			if(!is_dir($target_dir)) mkdir($target_dir, 0755, true);
			
			$file_name = basename($_FILES['image']['name']);
			$file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
			$allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
			
			if(in_array($file_ext, $allowed_ext)) {
				$new_name = $vnum.'_'.time().'.'.$file_ext;
				$target_file = $target_dir.$new_name;
				
				if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
					$image = '/images/itemshop/'.$new_name;
				}
			}
		}
		
		if($_POST['action'] == 'add') {
			if(!empty($image)) {
				$stmt = $database->runQuery("INSERT INTO itemshop(vnum, name, price, quantity, category, description, image) VALUES(?,?,?,?,?,?,?)");
				$stmt->execute(array($vnum, $name, $price, $quantity, $category, $description, $image));
			} else {
				$stmt = $database->runQuery("INSERT INTO itemshop(vnum, name, price, quantity, category, description) VALUES(?,?,?,?,?,?)");
				$stmt->execute(array($vnum, $name, $price, $quantity, $category, $description));
			}
			echo '<div class="alert alert-success">Item agregado correctamente</div>';
		} else if($_POST['action'] == 'edit') {
			$id = intval($_POST['id']);
			if(!empty($image)) {
				$stmt = $database->runQuery("UPDATE itemshop SET vnum=?, name=?, price=?, quantity=?, category=?, description=?, image=? WHERE id=?");
				$stmt->execute(array($vnum, $name, $price, $quantity, $category, $description, $image, $id));
			} else {
				$stmt = $database->runQuery("UPDATE itemshop SET vnum=?, name=?, price=?, quantity=?, category=?, description=? WHERE id=?");
				$stmt->execute(array($vnum, $name, $price, $quantity, $category, $description, $id));
			}
			echo '<div class="alert alert-success">Item actualizado correctamente</div>';
		}
	} else if($_POST['action'] == 'delete') {
		$id = intval($_POST['id']);
		$stmt = $database->runQuery("DELETE FROM itemshop WHERE id=?");
		$stmt->execute(array($id));
		echo '<div class="alert alert-success">Item eliminado correctamente</div>';
	} else if($_POST['action'] == 'toggle_active') {
		$id = intval($_POST['id']);
		$stmt = $database->runQuery("UPDATE itemshop SET active = NOT active WHERE id=?");
		$stmt->execute(array($id));
	}
}

// Obtener items
$items = $database->runQuery("SELECT * FROM itemshop ORDER BY created_at DESC");
$items_list = $items->fetchAll();
?>

<div class="container">
	<div class="jumbotron">
		<h2><?php print $lang['itemshop'] ?? 'Item Shop'; ?></h2>
		<p><?php print $lang['itemshop-desc'] ?? 'Gestiona los items disponibles en la tienda'; ?></p>
	</div>

	<!-- Formulario de Agregar -->
	<div class="card mb-4">
		<div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-weight: bold;">
			<h5 class="mb-0">➕ <?php print $lang['add-item'] ?? 'Agregar Nuevo Item'; ?></h5>
		</div>
		<div class="card-body">
			<form method="post" enctype="multipart/form-data">
				<input type="hidden" name="action" value="add">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label><strong>vNum:</strong></label>
							<input type="number" name="vnum" class="form-control" required>
							<small class="form-text text-muted">ID único del item</small>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label><strong><?php print $lang['item-name'] ?? 'Nombre'; ?>:</strong></label>
							<input type="text" name="name" class="form-control" required>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label><strong><?php print $lang['price'] ?? 'Precio'; ?>:</strong></label>
							<input type="number" name="price" class="form-control" required>
							<small class="form-text text-muted"><?php print $lang['coins'] ?? 'Monedas'; ?></small>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label><strong><?php print $lang['quantity'] ?? 'Cantidad'; ?>:</strong></label>
							<input type="number" name="quantity" class="form-control" value="999">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label><strong><?php print $lang['category'] ?? 'Categoría'; ?>:</strong></label>
							<select name="category" class="form-control">
								<option value="weapons"><?php print isset($lang['weapons']) ? $lang['weapons'] : 'Armas'; ?></option>
								<option value="armors"><?php print isset($lang['armors']) ? $lang['armors'] : 'Armaduras'; ?></option>
								<option value="consumables"><?php print isset($lang['consumables']) ? $lang['consumables'] : 'Consumibles'; ?></option>
								<option value="accessories"><?php print $lang['accessories'] ?? 'Accesorios'; ?></option>
								<option value="special"><?php print $lang['special'] ?? 'Especial'; ?></option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label><strong><?php print $lang['image'] ?? 'Imagen'; ?>:</strong></label>
							<input type="file" name="image" class="form-control" accept="image/*">
							<small class="form-text text-muted">Max 2MB (JPG, PNG, GIF)</small>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label><strong><?php print $lang['description'] ?? 'Descripción'; ?>:</strong></label>
					<textarea name="description" class="form-control" rows="3" placeholder="Describe el item..."></textarea>
				</div>

				<button type="submit" class="btn btn-success btn-lg btn-block">
					<i class="fa fa-plus"></i> <?php print $lang['add'] ?? 'Agregar'; ?>
				</button>
			</form>
		</div>
	</div>

	<!-- Tabla de Items -->
	<div class="card">
		<div class="card-header" style="background: #2c3e50; color: white; font-weight: bold;">
			<h5 class="mb-0">📦 <?php print $lang['items-list'] ?? 'Lista de Items'; ?> (<?php echo count($items_list); ?>)</h5>
		</div>
		<div class="card-body p-0">
			<?php if(count($items_list) > 0) { ?>
			<div class="table-responsive">
				<table class="table table-striped table-hover mb-0">
					<thead style="background: #34495e; color: white;">
						<tr>
							<th>ID</th>
							<th>vNum</th>
							<th><?php print $lang['item-name'] ?? 'Nombre'; ?></th>
							<th><?php print $lang['category'] ?? 'Categoría'; ?></th>
							<th><?php print $lang['price'] ?? 'Precio'; ?></th>
							<th><?php print $lang['quantity'] ?? 'Cantidad'; ?></th>
							<th><?php print $lang['image'] ?? 'Imagen'; ?></th>
							<th><?php print $lang['actions'] ?? 'Acciones'; ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($items_list as $item) { ?>
						<tr>
							<td><span class="badge badge-primary"><?php echo $item['id']; ?></span></td>
							<td><strong><?php echo $item['vnum']; ?></strong></td>
							<td><?php echo $item['name']; ?></td>
							<td><span class="badge badge-info"><?php echo ucfirst($item['category']); ?></span></td>
							<td><span class="text-success font-weight-bold"><?php echo $item['price']; ?> <?php print isset($lang['coins']) ? $lang['coins'] : 'Monedas'; ?></span></td>
							<td><?php echo $item['quantity']; ?></td>
							<td>
								<?php if(!empty($item['image'])) { ?>
									<img src="<?php echo $item['image']; ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
								<?php } else { ?>
									<span class="text-muted">N/A</span>
								<?php } ?>
							</td>
							<td>
								<button class="btn btn-sm btn-warning" onclick="editItem(<?php echo $item['id']; ?>, '<?php echo $item['vnum']; ?>', '<?php echo htmlspecialchars($item['name']); ?>', <?php echo $item['price']; ?>, <?php echo $item['quantity']; ?>, '<?php echo $item['category']; ?>')">
									✏️ <?php print $lang['edit'] ?? 'Editar'; ?>
								</button>
								<form method="post" style="display:inline;">
									<input type="hidden" name="action" value="delete">
									<input type="hidden" name="id" value="<?php echo $item['id']; ?>">
									<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este item?')">
										🗑️ <?php print $lang['delete'] ?? 'Eliminar'; ?>
									</button>
								</form>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<?php } else { ?>
			<div class="alert alert-info m-3"><?php print $lang['no-items'] ?? 'No hay items registrados'; ?></div>
			<?php } ?>
		</div>
	</div>
</div>

<style>
.card {
	border: none;
	box-shadow: 0 2px 10px rgba(0,0,0,0.1);
	border-radius: 8px;
	margin-bottom: 20px;
	overflow: hidden;
}

.card-header {
	border-bottom: 2px solid rgba(0,0,0,0.1);
}

.btn-success, .btn-warning, .btn-danger {
	transition: all 0.3s ease;
}

.btn:hover {
	transform: translateY(-2px);
	box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.form-control:focus {
	border-color: #667eea;
	box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.table-hover tbody tr:hover {
	background-color: rgba(102, 126, 234, 0.1);
}
</style>
