

<main>

    <h1>Créer un article</h1>

    <form method="post">

        <label for="title">Titre</label>
        <input type="text" name="title" />

        <label for="content">Contenu</label>
        <input type="text" name="content" />

        <label for="image">Image</label>
        <input type="text" name="image" />

        <input type="submit"/>

    </form>

    <?php if ($isArticleCreated) { ?>
        <p>Article bien créé !</p>
    <?php } else { ?>
        <p>Merci de mieux remplir les données !</p>
    <?php } ?>

</main>