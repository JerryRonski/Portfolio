<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Ted's Taco Truck" />
    <title>Ted's Taco Truck</title>

    <?php include("./includes/head.html"); ?>
</head>

<body>
    <?php include("./includes/header.php"); ?>

    <main class="row">
        <header class="bg-dark small mb-3">
            <h1 class="text-center">Ted's Tasty Taco Truck</h1>
        </header>

        <section class="col-md-8 cart justify-content-between align-items-start">
            <?php
            require_once("./includes/connect_db.php");

            $sql = "SELECT * FROM items";

            $stmt = $db->prepare($sql);

            if ($stmt->execute()) {
                $items = $stmt->fetchAll();
                $stmt->closeCursor();
            }

            $itemMap = [];
            foreach ($items as $item) {
                $itemMap[$item['item_id']] = $item;
            }

            if (!empty($_SESSION['cart'])) {
                echo '<ul>';
                foreach ($_SESSION['cart'] as $productId => $qty) {
                    // escape output for safety
                    $safeId = htmlspecialchars($productId, ENT_QUOTES, 'UTF-8');
                    $safeQty = htmlspecialchars($qty, ENT_QUOTES, 'UTF-8');

                    ?>
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="./images/<?= $itemMap[$safeId]['src'] ?>" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text"><?= $itemMap[$safeId]['desc'] ?></p>

                                    <div class="btn-group">
                                        <input type="text" name="id" value="<?= $safeId ?>" readonly hidden>
                                        <input class="form-control" type="number" name="qty" value="1">
                                        <button class="form-control btn btn-success addToCart" type="button">Add</button>
                                        <button class="form-control btn btn-danger removeFromCart" type="button">Remove</button>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                echo '</ul>';
            } else {
                echo '<p>Your cart is empty.</p>';
            }
            ?>

        </section>

        <section class="col-md-3 cart-info">
            <div class="card">
                <h1 class="card-title text-center">Order Info</h1>
            </div>
        </section>
    </main>

    <?php include("./includes/footer.php"); ?>
</body>