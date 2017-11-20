

<?php if (isset($erreurs)) : ?>
    <div class="row">
        <div class="alert alert-danger text-center">
            <strong>&Eacute;chec de l\'inscription</strong> <?= $erreurs ?>
        </div>
    </div>
<?php endif; ?>



<form action="" method="post">

    <div class="card card-hidden">
        <div class="text-center">
        <div class="header text-center"><?= $title; ?></div>
        <h6><a href="/auth/login.html">Se connecter</a></h6>
        </div>
        <div class="content">
            <?= $form ?>
        </div>
        <div class="footer text-center">
            <button type="submit" value="register" class="btn btn-fill btn-warning btn-wd">S'inscrire</button>
        </div>
    </div>

</form>