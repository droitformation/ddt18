<!DOCTYPE html>
    <!--[if IE 8]><html class="no-js lt-ie9" lang="en" > <![endif]-->
    <!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <title>Droit du travail</title>

        <meta name="description" content="Le site droitdutravail.ch, créé sous l'égide de la Faculté de droit de l'Université de Neuchâtel, est dédié aux nouveautés en droit du travail, en particulier la jurisprudence du Tribunal fédéral.">
        <meta name="author" content="Cindy Leschaud">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSS Files
        ================================================== -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,700italic,700,800,800italic,300italic,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/filters.css');?>" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/style.css');?>" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/blog.css');?>" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/filters.css');?>" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/color-red.css');?>" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/responsive.css');?>" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/chosen.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/jquery.fancybox.min.css');?>">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

        <!-- Javascript Files
        ================================================== -->
        <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo asset('frontend/js/chosen.jquery.js');?>"></script>
        <script src="<?php echo asset('frontend/js/jquery.fancybox.min.js');?>"></script>
        <script src="<?php echo asset('frontend/js/custom.js');?>"></script>
        <script src="<?php echo asset('frontend/js/arrets.js');?>"></script>
        <script src="<?php echo asset('frontend/js/header.js');?>"></script>
        <script src="<?php echo asset('frontend/js/contact-form-validate.js');?>"></script>

    </head>

    <body id="top">

        <div id="wrapper">

            <!-- START container -->
            <div class="container" style="flex: 1;">
                <!-- START HEADER -->
                <div id="header-wrapper">

                    <div class="isSticky">
                        <div class="row">
                            <div class="col-md-3 col-xs-12">
                                <div id="logo">
                                    <a href="/">Droit du <strong>travail</strong>.ch</a>
                                </div><!--END LOGO-->
                            </div>

                            <div class="col-md-6 col-xs-12">
                                <!-- Navigation  -->
                                @include('partials.navigation')
                            </div>

                            <div class="col-md-3 col-xs-12 logos">
                                <a target="_blank" href="http://www2.unine.ch/droit"><img src="<?php echo asset('frontend/images/logos/logo.jpg');?>" alt="" /></a>
                                <a target="_blank" href="http://www2.unine.ch/cemaj"><img src="<?php echo asset('frontend/images/logos/cemaj.jpg');?>" alt="" /></a>
                                <a target="_blank" href="http://www2.unine.ch/cert"><img src="<?php echo asset('frontend/images/logos/cert.jpg');?>" alt="" /></a>
                            </div>
                        </div>
                    </div><!--END HEADER-->
                </div><!--END HEADER-WRAPPER-->
                <!-- END HEADER -->

                <!-- START BLOG -->
                <div id="content-wrapper">
                    <!-- Contenu -->
                    @yield('content')
                    <!-- Fin contenu -->

                </div><!--END CONTENT-WRAPPER-->
                <!-- END BLOG -->

            </div><!--END WRAPPER-->

            <!-- START FOOTER -->
            <div id="footer">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 text-align-center">
                        <p><strong>Faculté de droit, Avenue du 1er-Mars 26, 2000 Neuchâtel</strong></p>
                        <p class="copyright">Copyright &copy; Droit du travail <?php echo date('Y'); ?>. Tous droits réservés.</p>
                    </div><!--END ONE-->
                </div><!--END SECTION-->
            </div><!--END FOOTER-->
            <!-- END FOOTER -->

        </div> <!-- END Container -->
    </body>
</html>