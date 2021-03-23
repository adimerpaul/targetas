
<!doctype html>
<html class="fixed">
<head>

    <!-- Basic -->
    <meta charset="UTF-8">

    <meta name="keywords" content="HTML5 Admin Template" />
    <meta name="description" content="Porto Admin - Responsive HTML5 Template">
    <meta name="author" content="okler.net">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/stylesheets/theme.css" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/stylesheets/skins/default.css" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/stylesheets/theme-custom.css">

    <!-- Head Libs -->
    <script src="<?=base_url()?>assets/vendor/modernizr/modernizr.js"></script>

</head>
<body>
<!-- start: page -->
<section class="body-sign body-locked">
    <div class="center-sign">
        <div class="panel panel-sign">
            <div class="panel-body">
                <form action="index.html">
                    <div class="current-user text-center">
                        <?php
                        if ($estado=='ENTRADA'){
                            echo "<img src='".base_url()."assets/img/success.jpg' alt='John Doe' class='img-circle user-image' />";
                        }elseif ($estado=='SALIDA'){
                            echo "<img src='".base_url()."assets/img/danger.png' alt='John Doe' class='img-circle user-image' />";
                        }elseif ($estado=='NO'){
                            echo "<img src='".base_url()."assets/img/stop.png' alt='John Doe' class='img-circle user-image' />";
                        }
                        ?>
                        <h6 class="user-name text-dark m-none"><?=$cargo?></h6>
                        <p class="user-email m-none"><?=$nombre?></p>
                    </div>
                    <div class="form-group mb-lg">
                        <div class="input-group input-group-icon">
                            <?php
                            if ($estado=='ENTRADA'){
                                echo "
                                    <div class='alert alert-success' role='alert'>
                                        Ingreso ".date('H:m:s')."
                                    </div>";
                            }elseif ($estado=='SALIDA'){
                                echo "
                                    <div class='alert alert-danger' role='alert'>
                                        Salida ".date('H:m:s')."
                                    </div>";
                            }elseif ($estado=='NO'){
                                echo "
                                    <div class='alert alert-danger' role='alert'>
                                        Solo se puede agregar 2 ingresos
                                    </div>";
                            }
                            ?>


                            <!--                            <input id="pwd" type="password" class="form-control input-lg" placeholder="Password" />-->
<!--                            <span class="input-group-addon">-->
<!--										<span class="icon icon-lg">-->
<!--											<i class="fa fa-lock"></i>-->
<!--										</span>-->
<!--									</span>-->
                        </div>
                    </div>

<!--                    <div class="row">-->
<!--                        <div class="col-xs-6">-->
<!--                            <p class="mt-xs mb-none">-->
<!--                                <a href="#">Not John Doe?</a>-->
<!--                            </p>-->
<!--                        </div>-->
<!--                        <div class="col-xs-6 text-right">-->
<!--                            <button type="submit" class="btn btn-primary">Unlock</button>-->
<!--                        </div>-->
<!--                    </div>-->
                </form>
            </div>
        </div>
    </div>
</section>
<!-- end: page -->

<!-- Vendor -->
<script src="<?=base_url()?>assets/vendor/jquery/jquery.js"></script>
<script src="<?=base_url()?>assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="<?=base_url()?>assets/vendor/bootstrap/js/bootstrap.js"></script>
<script src="<?=base_url()?>assets/vendor/nanoscroller/nanoscroller.js"></script>
<script src="<?=base_url()?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>assets/vendor/magnific-popup/magnific-popup.js"></script>
<script src="<?=base_url()?>assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="<?=base_url()?>assets/javascripts/theme.js"></script>

<!-- Theme Custom -->
<script src="<?=base_url()?>assets/javascripts/theme.custom.js"></script>

<!-- Theme Initialization Files -->
<script src="<?=base_url()?>assets/javascripts/theme.init.js"></script>

</body>
</html>
