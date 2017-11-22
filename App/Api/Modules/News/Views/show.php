<div class="content-article">
    <div class="scrollable-element">
        <article>

            <header id="art-header">
                <h2><?= $news->titre() ?></h2>
            </header>

            <section id="article">
                <p><?= ($news->content()) ?></p>
            </section>


            <footer class="art-info">

                <div class="art-border-auteur"></div>

                <section class="art-auteur"><?= $news->auteur() ?></section>

                <time class="art-date"><small>le <?= $news->AddDate()->format('d/m/Y à H\hi') ?></small></time>

                <?php if ($news->AddDate() != $news->UpdtDate()) { ?>
                    <time class="art-update"><small>Modifiée le <?= $news->UpdtDate()->format('d/m/Y à H\hi') ?></small></time>
                <?php } ?>

            </footer>



        </article>

        <section class="comments">
            <hr>
            <?php
            if (empty($comments))
            {
                ?>
                <p>Aucun commentaire n'a encore été posté. <br > Soyez le premier à en laisser un !</p>
                <?php
            }

            foreach ($comments as $comment)
            {
            ?>

            <article class="comment">
                <div class="comment-body">
                    <div class="text">
                        <p><?= (htmlspecialchars($comment->content())) ?></p>
                    </div>
                    <div class="datas">
                    <p class="attribution">posté par <strong><?= htmlspecialchars($comment->auteur()) ?></strong> le <?= $comment->date()->format('d/m/Y à H\hi') ?></p>
                    <p class="crud">
                        <?php if ($user->isAuthenticated()) { ?>
                            <a href="#" id="<?= $comment->id() ?>" class="report">Signaler</a>
                        <?php } ?>
                        <?php if ($user->isAdmin()) { ?>
                            | <a href="/admin/comment-update-<?= $comment->id() ?>.html">Modifier</a> |
                            <a href="/admin/comment-delete-<?= $comment->id() ?>.html">Supprimer</a>
                        <?php } ?>
                    </p>
                    </div>
                </div>
            </article>

            <?php
            }
            ?>

        </section>​

        <section class="comments-nav">
            <a href="#" id="<?= $news->id() ?>" class="add"><button type="button" >Ajouter un commentaire</button></a>
            <a href="#" class="retour"><button type="button">Retour</button></a>
        </section>

    </div>
</div>