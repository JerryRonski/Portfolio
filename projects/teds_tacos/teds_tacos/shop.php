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

    <main>
        <header class="bg-dark small">
            <h1 class="text-center">Ted's Tasty Taco Truck</h1>
        </header>

        <section class="shop row justify-content-center">
            <?php
            require_once("./includes/connect_db.php");

            $sql = "SELECT * FROM items";

            $stmt = $db->prepare($sql);

            if ($stmt->execute()) {
                $items = $stmt->fetchAll();
                $stmt->closeCursor();
            }
            ?>

            <?php foreach ($items as $i) { ?>
                <div class="card col-md-2 m-3 p-0">
                    <img class="card-img-top" src="./images/<?= $i['src'] ?>" alt="<?= $i['desc'] ?>">

                    <div class="card-body">
                        <h5 class="card-title"><?= $i['name'] ?></h5>

                        <p class="card-text">
                            <?= $i['desc'] ?>
                        </p>

                        <div class="input-group">
                            <input type="text" name="id" value="<?= $i['item_id'] ?>" readonly hidden>
                            <input class="form-control" type="number" name="qty" value="1">
                            <button class="form-control btn btn-success addToCart" type="button">Add</button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </section>
    </main>

    <?php include("./includes/footer.php"); ?>
</body>

</html>