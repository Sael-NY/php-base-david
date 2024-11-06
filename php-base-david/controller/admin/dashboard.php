<?php require_once('../../controller/admin/partials/_header.php');
require_once('../../service/authentification-service.php'); 

redirectNotLoggedUser();
?>
<p>Bienvenue à ton compte !</p>


<?php require_once('../../view/admin/dashboard-view.php') ?>
<?php require_once('../../controller/admin/partials/_footer.php'); ?>