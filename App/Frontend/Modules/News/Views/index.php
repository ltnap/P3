
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

<div>
    <?php
    echo 'pagination';

    $pagination = '';

    if($nbrPages != 1)
    {
        if($pageNum > 1)
        {
            $previous = $pageNum - 1;
            $pagination .= '<a href="/page- '. $previous .' ">Précédent</a> &nbsp; &nbsp;';

            for($i = $pageNum - $nbrMaxBefAft; $i < $pageNum; $i++){
                if($i > 0){
                    $pagination .= '<a href="/page-' . $i . '">' . $i . '</a> &nbsp;';
                }
            }
        }

        $pagination .= '<span class="active">' . $pageNum . '</span>&nbsp;';

        for ($i = $pageNum+1; $i <= $nbrPages; $i++){
            $pagination .= '<a href="/page-' . $i . '">' . $i . '</a>';

            if ($i >= $pageNum + $nbrMaxBefAft)
            {
                break;
            }
        }

        if($pageNum != $nbrPages)
        {
            $next = $pageNum + 1;
            $pagination .= ' <a href="/page-' . $next . '">Suivant</a> ';
        }
    }
    echo'PAGE NUM : ';
    var_dump($pageNum);

    echo'NBR PAGES : ';
    var_dump($nbrPages);

    echo'NBR MAX AFTER BEF : ';
    var_dump($nbrMaxBefAft);

    echo '<div id="pagination"> ' . $pagination . ' </div>';

        ?>
</div>

