





<div class="header">
                    <h1 class="title text-center"><?= $title ?></h1>
                    <h4 class="description text-center">Il y a actuellement <?= $nombreUsers ?> utilisateurs</h4>
</div>

<div class="content table-responsive table-full-width">
    <table class="table table-hover table-striped">
        <thead>
        <th>ID</th>
        <th>Pseudo</th>
        <th>Privilèges</th>
        <th>Action</th>
        </thead>

        <tbody>
        <?php
        foreach ($allUsersList as $users)
        { ?>

            <tr>
                            <td><?= $users['id'] ?></td>
                            <td><?= $users['username'] ?></td>


                            <td class="td-actions">
                                <a href="/admin/users-rights-<?= $users['id'] ?>.html">

                                    <?php if($users['rights'] == 'ADMIN') { ?>
                                        <button type="button" rel="tooltip" title="Modifier" class="btn btn-warning btn-fill btn-wd tooltip-action" rel="tooltip" data-toggle="tooltip" data-original-title="Modifier">
                                    <?php } ?>

                                    <?php if($users['rights'] == 'SUBSCRIBER') { ?>
                                        <button type="button" rel="tooltip" title="Modifier" class="btn btn-light btn-fill btn-wd tooltip-action" rel="tooltip" data-toggle="tooltip" data-original-title="Modifier">
                                    <?php } ?>
                                    <?= $users['rights'] ?>
                                    </button>
                                </a>
                            </td>
                            <td class="td-actions">
                                <a href="/admin/users-delete-<?=$users['id'] ?>.html">
                                    <button type="button" rel="tooltip" title="Supprimer" class="btn btn-danger btn-simple btn-lg tooltip-action" rel="tooltip" data-toggle="tooltip" data-original-title="Supprimer">
                                    <i class="fa fa-times"></i>
                                    </button>
                                </a>
                            </td>
                         </tr>
        <?php }
        ?>
        </tbody>
    </table>
</div>










