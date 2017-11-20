
<!-- /**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 02/11/2017
 * Time: 21:02
 */ -->

<div class="title">
    <h1>Episodes</h1>
</div>

<div class="content-card">



    <?php foreach ($listeNews as $news)
    {
        ?>
                    <div class="card-container">
                        <div class="card">

                            <div class="card-head">
                                <div class="card-head-title">
                                    <h2 class=""><?= $news['titre'] ?></h2>
                                </div>
                                <span class="back-text"><?= $news['id'] ?></span>
                            </div>

                            <div class="card-body">
                                <div class="card-body-desc">

                                    <span class="card-body-title"><b><?= ($news['content']) ?></b></span>
                                    <hr>
                                    <span class="card-body-caption">

                                        <?php if ($news['AddDate'] != $news['UpdtDate']) { ?> Modifiée le <?= $news['UpdtDate']->format('d/m/Y à H\hi') ?>

                                        <?php } else { ?> Créée le <?= $news['AddDate']->format('d/m/Y à H\hi') ?> <?php } ?></span>

                                    <a href="#" id="<?= $news['id'] ?>" class="card-body-plus news"><b>VOIR</b> plus...</a>
                                </div>
                            </div>

                        </div>
                    </div>



        <?php
    } ?>

</div>

