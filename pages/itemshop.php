<?php
require_once('../include/functions/basic.php');

if (!isset($_SESSION['id'])) {
    redirect($site_url);
    exit();
}

// Crear tabla si no existe
try {
    $stmt = $database->runQueryCommon("CREATE TABLE IF NOT EXISTS itemshop_sales (
        id INT AUTO_INCREMENT PRIMARY KEY,
        account_id INT NOT NULL,
        vnum INT NOT NULL,
        item_name VARCHAR(255),
        quantity INT,
        total_price INT,
        status ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending',
        purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    $stmt->execute();
} catch(Exception $e) {}

// Procesar compra
$purchase_success = false;
if(isset($_POST['buy_item'])) {
    $item_id = intval($_POST['item_id']);
    $buy_quantity = intval($_POST['buy_quantity']);
    
    $stmt = $database->runQueryCommon("SELECT * FROM itemshop WHERE id=?");
    $stmt->execute(array($item_id));
    $item = $stmt->fetch();
    
    if($item) {
        $total_price = $item['price'] * $buy_quantity;
        $player_md = getAccountMD($_SESSION['id']);
        
        if($player_md >= $total_price) {
            // Registrar compra (descontar MD sería parte de tu sistema)
            $stmt = $database->runQueryCommon("INSERT INTO itemshop_sales(account_id, vnum, item_name, quantity, total_price, status) VALUES(?,?,?,?,?,?)");
            $stmt->execute(array($_SESSION['id'], $item['vnum'], $item['name'], $buy_quantity, $total_price, 'completed'));
            $purchase_success = true;
        }
    }
}

// Obtener items activos
$items = $database->runQueryCommon("SELECT * FROM itemshop WHERE active=1 ORDER BY category ASC, name ASC");
$items->execute();
$items_list = $items->fetchAll(PDO::FETCH_ASSOC);

$account_name = getAccountName($_SESSION['id']);
$page_title = isset($lang['itemshop']) ? $lang['itemshop'] : 'Item Shop';
require_once('../include/header.php');
?>

<div class="container">
    <!-- Header -->
    <div class="jumbotron" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 60px 20px;">
        <h1 class="display-4" style="font-weight: bold; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
            🛍️ <?php print isset($lang['itemshop']) ? $lang['itemshop'] : 'Item Shop'; ?>
        </h1>
        <p class="lead" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.2);">
            <?php print isset($lang['itemshop-welcome']) ? $lang['itemshop-welcome'] : 'Bienvenido a nuestra tienda de items premium'; ?>
        </p>
        <hr style="border-color: rgba(255,255,255,0.3);">
        <div class="row">
            <div class="col-md-4 text-center">
                <h5>💰 <?php print isset($lang['your-coins']) ? $lang['your-coins'] : 'Tus Monedas'; ?></h5>
                <p style="font-size: 24px; font-weight: bold;"><?php print getAccountMD($_SESSION['id']); ?> <?php print isset($lang['coins']) ? $lang['coins'] : 'Monedas'; ?></p>
            </div>
            <div class="col-md-4 text-center">
                <h5>🎁 <?php print isset($lang['items-available']) ? $lang['items-available'] : 'Items Disponibles'; ?></h5>
                <p style="font-size: 24px; font-weight: bold;"><?php echo count($items_list); ?></p>
            </div>
            <div class="col-md-4 text-center">
                <h5>👤 <?php print isset($lang['account']) ? $lang['account'] : 'Cuenta'; ?></h5>
                <p style="font-size: 18px; font-weight: bold;"><?php echo $account_name; ?></p>
            </div>
        </div>
    </div>

    <!-- Mensaje de Éxito -->
    <?php if($purchase_success) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>✅ <?php print isset($lang['success']) ? $lang['success'] : 'Éxito'; ?>!</strong> Item comprado correctamente. Revisa tu inventario en el juego.
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    <?php } ?>

    <!-- Items por Categoría -->
    <?php 
    $categories = array(
        'weapons' => isset($lang['weapons']) ? $lang['weapons'] : 'Armas',
        'armors' => isset($lang['armors']) ? $lang['armors'] : 'Armaduras',
        'consumables' => isset($lang['consumables']) ? $lang['consumables'] : 'Consumibles',
        'accessories' => isset($lang['accessories']) ? $lang['accessories'] : 'Accesorios',
        'special' => isset($lang['special']) ? $lang['special'] : 'Especial'
    );
    
    foreach($categories as $cat_key => $cat_name) {
        $cat_items = array_filter($items_list, function($item) use ($cat_key) {
            return $item['category'] == $cat_key;
        });
        
        if(count($cat_items) > 0) {
    ?>
    <div class="mb-5">
        <h2 style="border-bottom: 3px solid #667eea; padding-bottom: 15px; margin-bottom: 30px;">
            <?php 
            $icons = array('weapons' => '⚔️', 'armors' => '🛡️', 'consumables' => '🧪', 'accessories' => '💎', 'special' => '✨');
            echo isset($icons[$cat_key]) ? $icons[$cat_key] : '📦';
            ?> <?php echo $cat_name; ?>
        </h2>
        
        <div class="row">
            <?php foreach($cat_items as $item) { ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100" style="border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s, box-shadow 0.3s;">
                    <!-- Imagen del Item -->
                    <div style="height: 250px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); position: relative; overflow: hidden;">
                        <?php if(!empty($item['image'])) { ?>
                            <img src="<?php echo $item['image']; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        <?php } else { ?>
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 80px;">
                                📦
                            </div>
                        <?php } ?>
                        <div style="position: absolute; top: 10px; right: 10px; background: #d4af37; color: black; padding: 8px 15px; border-radius: 20px; font-weight: bold; font-size: 16px;">
                            <?php echo $item['price']; ?> 💰
                        </div>
                    </div>

                    <!-- Contenido -->
                    <div class="card-body">
                        <h5 class="card-title" style="color: #2c3e50; font-weight: bold;"><?php echo $item['name']; ?></h5>
                        <p class="card-text" style="color: #7f8c8d; font-size: 14px; height: 60px; overflow: hidden;">
                            <?php echo !empty($item['description']) ? $item['description'] : 'Ítem exclusivo de la tienda'; ?>
                        </p>
                        
                        <div class="mb-3">
                            <small class="text-muted">
                                <strong>vNum:</strong> <?php echo $item['vnum']; ?> | 
                                <strong><?php print isset($lang['quantity']) ? $lang['quantity'] : 'Stock'; ?>:</strong> <?php echo $item['quantity']; ?>
                            </small>
                        </div>

                        <!-- Formulario de Compra -->
                        <form method="post" class="form-inline">
                            <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                            <div class="form-group mr-2 mb-0" style="flex: 1;">
                                <label for="qty_<?php echo $item['id']; ?>" class="mr-2" style="font-size: 12px;">Qty:</label>
                                <input type="number" name="buy_quantity" id="qty_<?php echo $item['id']; ?>" value="1" min="1" max="<?php echo $item['quantity']; ?>" class="form-control" style="width: 70px;">
                            </div>
                            <button type="submit" name="buy_item" class="btn btn-success btn-block mt-2">
                                🛒 <?php print isset($lang['buy-now']) ? $lang['buy-now'] : 'Comprar'; ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } } ?>

    <!-- Sin Items -->
    <?php if(count($items_list) == 0) { ?>
    <div class="alert alert-info text-center py-5">
        <h4>📭 <?php print isset($lang['no-items-available']) ? $lang['no-items-available'] : 'Sin items disponibles'; ?></h4>
        <p><?php print isset($lang['check-later']) ? $lang['check-later'] : 'Vuelve más tarde para ver nuevos items'; ?></p>
    </div>
    <?php } ?>

</div>

<style>
.card {
    border-radius: 10px;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.btn-success {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    font-weight: bold;
    transition: all 0.3s ease;
}

.btn-success:hover {
    transform: scale(1.02);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    color: white;
}

.form-control {
    border: 2px solid #ecf0f1;
    border-radius: 5px;
    transition: border-color 0.3s;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

@media(max-width: 768px) {
    .col-md-4 {
        margin-bottom: 20px;
    }
}
</style>

<?php require_once('../include/footer.php'); ?>
