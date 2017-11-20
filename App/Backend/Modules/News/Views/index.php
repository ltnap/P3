

                <div class="header">
                    <h1 class="title text-center">LES NEWS</h1>
                    <h4 class="description text-center">Il y a actuellement <?= $nombreNews ?> news</h4>
                </div>

                <div class="content table-responsive table-full-width">
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Auteur</th>
                            <th>Titre</th>
                            <th>Date d'ajout</th>
                            <th>Dernière modification</th>
                            <th>Action</th>
                        </thead>

                        <tbody>
                        <?php
                        foreach ($listeNews as $news)
                        { ?>

                            <tr>
                            <td><?= $news['id'] ?></td>
                            <td><?= $news['auteur'] ?></td>
                            <td><?= $news['titre'] ?></td>
                            <td>le <?= $news['AddDate']->format('d/m/Y à H\hi')  ?></td>
                            <td> <?php
                                if($news['AddDate'] == $news['UpdtDate']) { echo '-';  } else { echo 'le ' .  $news['UpdtDate']->format('d/m/Y à H\hi'); } ?>
                            </td>


                            <td class="td-actions">

                                <?php if ($this->app->user()->isAdmin()) { ?>
                                    <a href="news-update-<?= $news['id'] ?>.html">
                                        <button type="button"  title="Modifier" class="btn btn-light btn-simple btn-lg tooltip-action" rel="tooltip" data-toggle="tooltip" data-original-title="Modifier">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </a>
                                    <a href="news-delete-<?= $news['id'] ?>.html">
                                        <button type="button" rel="tooltip" title="Supprimer" class="btn btn-danger btn-simple btn-lg tooltip-action" rel="tooltip" data-toggle="tooltip" data-original-title="Supprimer">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </a>
                                <?php } elseif ($this->app->user()->isSubscriber()) { ?>

                                        <button type="button"  title="Modifier" class="btn btn-light btn-simple btn-lg tooltip-action disabled" rel="tooltip" data-toggle="tooltip" data-original-title="Modifier">
                                            <i class="fa fa-edit"></i>
                                        </button>


                                        <button type="button" rel="tooltip" title="Supprimer" class="btn btn-danger btn-simple btn-lg tooltip-action disabled" rel="tooltip" data-toggle="tooltip" data-original-title="Supprimer">
                                            <i class="fa fa-times"></i>
                                        </button>

                                <?php } ?>
                            </td>
                         </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>