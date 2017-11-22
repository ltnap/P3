


<div class="header">
    <h1 class="title text-center">LES COMMENTAIRES</h1>
    <h4 class="description text-center">Il y a actuellement <?= $nombreComs ?> commentaires</h4>
</div>

<div class="content table-responsive table-full-width">

    <table class="table table-hover table-striped">
        <thead><th>ID</th><th>Auteur</th><th>Commentaire</th><th>Signalement</th><th>Action</th></thead>
        <tbody>
        <?php foreach ($comments as $comment) {

            echo '<tr><td>', $comment->id(), '</td><td>', $comment->auteur(),'</td><td>', $comment->content(),'</td><td>', $comment->state(),'</td><td class="td-actions">
                <a href="\admin\comment-update-', $comment->id(), '.html">
                    <button type="button" rel="tooltip" title="Modifier" class="btn btn-light btn-simple btn-lg tooltip-action" rel="tooltip" data-toggle="tooltip" data-original-title="Modifier">
                    <i class="fa fa-edit"></i>
                    </button>
                </a> 
                <a href="\admin\comment-delete-', $comment->id(), '.html">            
                    <button type="button" rel="tooltip" title="Supprimer" class="btn btn-danger btn-simple btn-lg tooltip-action" rel="tooltip" data-toggle="tooltip" data-original-title="Supprimer">
                    <i class="fa fa-times"></i>
                    </button>
                </a>
            </td></tr>';
        } ?>
        </tbody>

    </table>
</div>
