<?php require 'Partials/header.php'; ?>
<body>

<?php if ($this->app->user()->hasFlash()) echo '<div class="alert alert-success text-center">
                                <button type="button" aria-hidden="true" class="close">×</button>
                                <span><b>', $this->app->user()->getFlash(), '</b></span></div>';
?>

<nav class="navbar navbar-transparent navbar-absolute">
    <div class="container">
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="/">Accueil</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="wrapper wrapper-full-page">
    <div class="full-page login-page" data-color="orange" data-image="/img/backend/full-screen-image-1.jpg">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">

                            <?= $content ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="full-page-background" style="background-image: url('/img/backend/full-screen-image-1.jpg') "/>
    </div>
</div>

</body>

<?php require 'Partials/scripts.php'; ?>

</html>
