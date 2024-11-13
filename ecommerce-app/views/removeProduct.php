<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        require_once("../views/partials/.header.php");
    ?>
    <p>
        <?php echo $message; ?>
    </p>

        <p>
            Commande numéro : <?php echo $order->getId() ?>
        </p>
        <ul>
            <?php
            foreach ($order -> getProducts() as $product) { ?>
                <li> <?php echo $product ?> </li>
            <?php } ?>
        </ul>
    <?php  ?>

    <?php require_once("../views/partials/.footer.php"); ?>;
</body>
</html>