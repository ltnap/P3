
<!-- Affichage des erreurs si il y en a-->
<?php if (isset($erreurs)) : ?>
    <div class="row">
        <div class="alert alert-danger text-center">
            <strong>&Eacute;chec de la connexion</strong> <?= $erreurs ?>
        </div>
    </div>
<?php endif; ?>


<form action="" method="post">

    <div class="card card-hidden">
        <div class="text-center">

            <div class="header text-center"><?= $title; ?></div>
            <h6><a href="/auth/register.html">s'inscrire</a></h6>

        </div>
        <div class="content">
            <?= $form ?>
        </div>
        <div class="footer text-center">
            <button type="submit" class="btn btn-fill btn-warning btn-wd">Connexion</button>
        </div>
    </div>

</form>