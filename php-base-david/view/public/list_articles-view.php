<?php require_once('../../view/public/partials/_header.php'); ?>

<main>

    <h1>Les articles du blog</h1>

    <p>Filtrer des articles</p>




    <?php foreach ($articles as $article) { ?>

        <article>
            <?php if (isStringTooLong($article['title'])) { ?>
                <h2><?php echo shortenString($article['title']) ?></h2>
            <?php } else { ?>
                <h2><?php echo $article['title']; ?></h2>
            <?php } ?>

            <p><?php echo $article['content']; ?></p>
            <img src="<?php echo $article['image']; ?>" alt="<?php echo $article['title']; ?>">
        </article>

    <?php } ?>

</main>

<?php require_once('../../view/public/partials/_footer.php'); ?>