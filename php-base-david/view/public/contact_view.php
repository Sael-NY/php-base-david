<?php require_once('../../view/public/partials/_header.php'); ?>

<form method="post">

    <label for="firstname">Firstname</label>
    <input type="text" name="firstname" />

    <label for="lastname">Lastname</label>
    <input type="text" name="lastname" />

    <label for="sujet">Sujet</label>
    <input type="text" name="sujet" />

    <label for="message">Message</label>
    <input type="text" name="message" />

    <input type="submit"/>

</form>

<?php if($isContactCreated) { ?>

<?php if ($isFormValid) { ?>
    <p>Message envoyé !</p>
<?php } else { ?>
    <p>Merci de remplir les champs !</p>
<?php }  ?>

<?php }  ?>

<?php require_once('../../view/public/partials/_footer.php'); ?>