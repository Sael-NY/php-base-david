<?php require_once('../../view/public/partials/_header.php'); ?>


<main>

<?php if ($isFromSubmited) { ?>
        <?php if($isAutenthicatedSuccessful) { ?>

            <p>Vous êtes bien connecté !</p>

        <?php } else { ?>

            <p>Utilisateur non reconnu. Veuillez créer un compte</p>

         <?php } ?>

    <?php } ?>

<form method="post">

    <label for="email">Email</label>
    <input type="email" name="email" />

    <label for="password">Password</label>
    <input type="password" name="password" />

    <input type="submit"/>

</form>

</main>


<?php require_once('../../view/public/partials/_footer.php'); ?>