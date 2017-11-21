<?php require 'Partials/header.php'; ?>
<body>

<div class="wrapper wrapper-full-page">

    <div class="sidebar" data-color="alaska" data-image="/img/sidebar-5.jpg">
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="/" class="simple-text">
                    BLOG
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="/admin/">
                        <i class="pe-7s-notebook"></i>
                        <p>Les News</p>
                    </a>
                </li>
                <li>
                    <a href="/admin/news-insert.html">
                        <i class="pe-7s-pen"></i>
                        <p>Ajouter une news</p>
                    </a>
                </li>
                <li>
                    <a href="/admin/comments/">
                        <i class="pe-7s-comment"></i>
                        <p>Commentaires</p>
                    </a>
                </li>
                <!--<li>
                    <a href="#">
                        <i class="pe-7s-user"></i>
                        <p>Mon compte</p>
                    </a>
                </li>-->
                <li>
                    <a href="/admin/users/">
                        <i class="pe-7s-users"></i>
                        <p>Utilisateurs</p>
                    </a>
                </li>
                <li class="logout active">
                    <a href="/auth/logout.html">
                        <i class="pe-7s-close-circle"></i>
                        <p>Déconnexion</p>
                    </a>
                </li>
            </ul>
        </div>
        <div class="sidebar-background" style="background-image: url('/img/backend/sidebar-5.jpg') "></div>
    </div>


    <div class="main-panel">
        <!--<nav class="navbar navbar-transparent navbar-fixed">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">BILLET SIMPLE POUR L'ALASKA</a>
                </div>
            </div>
        </nav>-->

        <?php if ($this->app->user()->hasFlash())
         $this->app->user()->getFlash();
        ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">

                            <?= $content ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php require 'Partials/footer.php'; ?>


    </div>




</div>

</body>

<?php require 'Partials/scripts.php'; ?>

</html>
