<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Christophe Corenthy" />
    <meta name="description" content="Blog de Jean Forteroche" />
    <meta name="keywords"  content="blog, openclassrooms, alaska, forteroche, episodes" />
    <meta name="Resource-type" content="Document" />

    <!-- FAVICON -->
    <link rel="icon" href="/img/favicon.ico">

    <!-- TITLE -->
    <title>
        Billet simple pour l'Alaska
    </title>

    <!-- Style CSS     -->
    <link href="css/style.css" rel="stylesheet" />

    <!-- Bootstrap core CSS  GRID ONLY   -->
<!--    <link href="/css/bootstrap.css" rel="stylesheet" />-->

    <!-- Custom styles for this template -->
<!--    <link href="http://getbootstrap.com/docs/4.0/examples/starter-template/starter-template.css" rel="stylesheet">-->


</head>

<body>

<!-- ********************************************************************** -->
<!-- ============================== LOADING =============================== -->
<!-- ********************************************************************** -->

<div id="page">

    <div id="phrase_box">
        <svg width="100%" height="100%">
            <defs>
                <mask id="mask" maskUnits="userSpaceOnUse" maskContentUnits="userSpaceOnUse">
                    <linearGradient id="linearGradient" gradientUnits="objectBoundingBox" x2="0" y2="1">
                        <stop stop-color="white" stop-opacity="0" offset="0%"/>
                        <stop stop-color="white" stop-opacity="1" offset="30%"/>
                        <stop stop-color="white" stop-opacity="1" offset="70%"/>
                        <stop stop-color="white" stop-opacity="0" offset="100%"/>
                    </linearGradient>
                    <rect width="100%" height="100%" fill="url(#linearGradient)"/>
                </mask>
            </defs>
            <g width="100%" height="100%" style="mask: url(#mask);">
                <g id="phrases"></g>
            </g>
        </svg>
    </div>

</div>


<!-- ******************************************************************** -->
<!-- ============================== HEADER ============================== -->
<!-- ******************************************************************** -->

<header>
    <div>
    <?php if ($this->app->user()->hasFlash())
        $this->app->user()->getFlash();
    ?>
    </div>
    <!--============================== MENU ==============================-->
    <div class="header">
        <div class="container">


            <div class="menubar">
                <div class="menu-label js-menuToggle clickable">
                    <div class="icon-menu-animated-container inline-block">
                        <div class="js-animatedMenuIcon icon-menu-animated">
                            <span class="icon-menu-animated-shape"></span>
                            <span class="icon-menu-animated-shape"></span>
                            <span class="icon-menu-animated-shape"></span>
                            <span class="icon-menu-animated-shape"></span>
                        </div>
                    </div>
                </div>
            </div>

            <nav class="js-menu nav-modal animated fadeIn clickable">

                <div class="nav-links">

                    <div data-menuanchor="firstPage" class="nav-link-container scrollOn">
                        <a href="/#firstPage" class="navLink">Accueil</a>
                    </div>

                    <div data-menuanchor="secondPage" class="nav-link-container scrollOn">
                        <a href="/#secondPage" class="navLink">Biographie</a>
                    </div>

                    <div data-menuanchor="3rdPage" class="nav-link-container scrollOn">
                        <a href="/#3rdPage" class="navLink">Le Livre</a>
                    </div>

                    <div data-menuanchor="3rdPage/1" class="nav-link-container scrollOFF">
                        <a href="/#3rdPage/1" class="navLink">Episodes</a>
                    </div>

                    <div data-menuanchor="4thPage" class="nav-link-container scrollOn">
                        <a href="/#4thPage" class="navLink">Contact</a>
                    </div>

                </div>

                <div class="social-account-links">

                    <hr class="style1">

                    <a href="#" class="social-link">
                        <i class="fa fa-facebook"></i>
                    </a>


                    <a href="#" class="social-link">
                        <i class="fa fa-instagram"></i>
                    </a>


                    <a href="#" class="social-link">
                        <i class="fa fa-twitter"></i>
                    </a>


                    <a href="#" class="social-link">
                        <i class="fa fa-linkedin-square"></i>
                    </a>


                </div>

                <!--============================== AUTHENTIFICATION CONNEXION ==============================-->
                <?php if($user->isAdmin()) { ?>
                    <div class="nav-link-container connexion-link">
                        <a class="nav-link btn" href="/admin/">Dashboard</a>
                        <br>
                        <a class="nav-link btn" href="/auth/logout.html">Se Déconnecter</a>
                    </div>
                <?php } elseif($user->isAuthenticated()) { ?>
                    <div class="nav-link-container connexion-link">
                        <a class="nav-link btn" href="/auth/logout.html">Se Déconnecter</a>
                    </div>
                <?php } else { ?>
                    <div class="nav-link-container connexion-link">
                        <a class="nav-link btn" href="/auth/login.html">Se Connecter</a> |
                        <a class="nav-link btn" href="/auth/register.html">S'inscrire</a>
                    </div>
                <?php } ?>



            </nav>
        </div>
    </div>

    <!--============================== SEARCH ==============================-->
    <div class="header search-Icon">
        <svg class="hidden">
            <defs>
                <symbol id="icon-arrow" viewBox="0 0 24 24">
                    <title>arrow</title>
                    <polygon points="6.3,12.8 20.9,12.8 20.9,11.2 6.3,11.2 10.2,7.2 9,6 3.1,12 9,18 10.2,16.8 "/>
                </symbol>
                <symbol id="icon-drop" viewBox="0 0 24 24">
                    <title>drop</title>
                    <path d="M12,21c-3.6,0-6.6-3-6.6-6.6C5.4,11,10.8,4,11.4,3.2C11.6,3.1,11.8,3,12,3s0.4,0.1,0.6,0.3c0.6,0.8,6.1,7.8,6.1,11.2C18.6,18.1,15.6,21,12,21zM12,4.8c-1.8,2.4-5.2,7.4-5.2,9.6c0,2.9,2.3,5.2,5.2,5.2s5.2-2.3,5.2-5.2C17.2,12.2,13.8,7.3,12,4.8z"/><path d="M12,18.2c-0.4,0-0.7-0.3-0.7-0.7s0.3-0.7,0.7-0.7c1.3,0,2.4-1.1,2.4-2.4c0-0.4,0.3-0.7,0.7-0.7c0.4,0,0.7,0.3,0.7,0.7C15.8,16.5,14.1,18.2,12,18.2z"/>
                </symbol>
                <symbol id="icon-search" viewBox="0 0 24 24">
                    <title>search</title>
                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                </symbol>
                <symbol id="icon-cross" viewBox="0 0 24 24">
                    <title>cross</title>
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                </symbol>
            </defs>
        </svg>
        <main class="main-wrap">
            <div class="search-wrap">
                <button id="btn-search" class="btn btn--search">
                    <svg class="icon icon--search">
                        <use xlink:href="#icon-search"></use>
                    </svg>
                </button>
            </div>
        </main>
        <div class="search">
            <button id="btn-search-close" class="btn btn--search-close" aria-label="Close search form">
                <svg class="icon icon--cross">
                    <use xlink:href="#icon-cross"></use>
                </svg>
            </button>
            <form class="search__form" action="">
                <input class="search__input" name="search" type="search" placeholder="" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
                <span class="search__info">Appuyez sur Entrée pour rechercher ou Echap pour quitter</span>
            </form>
            <div class="search__related">
                <div class="search__suggestion">
                    <h3>Des suggestions?</h3>
                    <p>#alaska #froid #glacier #blanc #rechauffement #minimaliste #billet #simple #OpenClassrooms #blog #projet3 #backend #chefdeprojet #developpeur #aurore #boreale</p>
                </div>
                <div class="search__suggestion">
                    <h3>Recherches récentes?</h3>
                    <p>#broken #lost #good #red #funny #lala #hilarious #catgif #blue #nono #why #yes #yesyes #aliens #green #drone</p>
                </div>
            </div>
        </div>
    </div>

</header>



<!-- ********************************************************************** -->
<!-- ============================== FULLPAGE ============================== -->
<!-- ********************************************************************** -->

<div id="fullpage">



    <!--    SECTION 0 -- ACCUEIL -->
    <div class="section " id="section0">
        <section class="cd-intro">
            <div class="row">
            <!-- Canvas displaying the constellation effect -->
            <canvas id="background"></canvas>
            <h1 class="col-sm-12 cd-headline letters type">
                <span>Billet simple pour</span>
                <span class="cd-words-wrapper waiting">
				<b class="is-visible">le froid</b>
				<b>nulle part</b>
				<b>l'alaska</b>
			</span>
            </h1>
            </div>
        </section>
    </div>




    <!--    SECTION 1 -- BIOGRAPHIE -->
    <div class="section" id="section1">
        <div class="intro profile">
            <h1>Jean <br> Forteroche</h1>
            <div class="infoHolder">
                <h2>Acteur &amp; &Eacute;crivain </h2>
                <p>Lorem ipsum dolor sit amet, metus convallis ut malesuada, qui semper, at non. Tincidunt donec aliquam vestibulum nisl. Pulvinar curabitur tellus, a sed sit vitae morbi. Suscipit saepe et praesent aenean laoreet, morbi justo pede eget, cras vestibulum, blandit mauris dignissimos pharetra dui, ut enim mauris nec adipiscing blandit.
                </p>
            </div>
            <div class="imageHolder">
                <img class="profilePic" src="img/frontend/jeanprofile.jpg">
            </div>

        </div>
    </div>




    <!--    SECTION 2 -- EPISODES -->
    <div class="section" id="section2">

        <!-- SLIDE 1 -->
        <div class="slide" id="slide1">
            <section class="cd-intro">
                <h1 class="cd-headline letters type">
                    <span>LES</span>
                    <span class="cd-words-wrapper waiting">
                    <b class="is-visible">&Eacute;PISODES</b>
                    <b>CHAPITRES</b>
                    <b>HISTOIRES</b>
                     <b>INEPTIES</b>
			     </span>
                </h1>
            </section>
        </div>

        <!-- SLIDE 2-->
        <div class="slide slide2" id="slide2">

            <div id="div1">
                <?= $content ?>
            </div>

            <div id="div2" style="display: none">
            </div>

        </div>
    </div>







                <!--                    FIN EPISODES                          </div>-->









    <!--    SECTION 3 -- CONTACT -->
    <div class="section" id="section3">
        <div class="codrops-header">
            <h1>ME CONTACTER <span>Vous pouvez me contacter via le formulaire</span></h1>
        </div>
        <section>
            <form id="theForm" class="simform" autocomplete="off">
                <div class="simform-inner">
                    <ol class="questions">
                        <li>
                            <span><label for="q1">Quel est votre Prénom ?</label></span>
                            <input id="q1" name="q1" type="text"/>
                        </li>
                        <li>
                            <span><label for="q2">Quel est votre Nom ?</label></span>
                            <input id="q2" name="q2" type="text"/>
                        </li>
                        <li>
                            <span><label for="q3">Quel est votre Mail ?</label></span>
                            <input id="q3" name="q3" type="text"/>
                        </li>
                        <li>
                            <span><label for="q4">Quel est votre Numéro de Téléphone ?</label></span>
                            <input id="q4" name="q4" type="text"/>
                        </li>
                        <li>
                            <span><label for="q5">Quel est le Sujet ?</label></span>
                            <input id="q5" name="q5" type="text"/>
                        </li>
                        <li>
                            <span><label for="q6">&Eacute;crivez ici votre Message</label></span>
                            <input id="q6" name="q6" type="text"/>
                        </li>
                    </ol><!-- /questions -->
                    <button class="submit" type="submit">Envoyez votre message</button>
                    <div class="controls">
                        <button class="next"></button>
                        <div class="progress"></div>
                        <span class="number">
								<span class="number-current"></span>
								<span class="number-total"></span>
							</span>
                        <span class="error-message"></span>
                    </div><!-- / controls -->
                </div><!-- /simform-inner -->
                <span class="final-message"></span>
            </form><!-- /simform -->
        </section>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script type="text/javascript" src="js/jquery/jquery.fullPage.js"></script>
    <script type="text/javascript" src="js/jquery/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="js/jquery/jquery.mousewheel.min.js"></script>
    <script src="https://use.fontawesome.com/5559d04296.js"></script>

    <!--   Core JS Files   -->
<!--    <script src="/js/jquery/jquery-1.10.2.js" type="text/javascript"></script>-->
<!--    <script src="/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>-->

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<!--    <script src="/js/bootstrap/light-bootstrap-dashboard.js"></script>-->

</body>
</html>
