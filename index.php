<?php
require_once("/resources/config.php");
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/favicon.png">

    <title>Hinnakalkulaator</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="bootstrap/js/html5shiv.js"></script>
    <script src="bootstrap/js/respond.min.js"></script>
    <![endif]-->
</head>

<body data-spy="scroll" data-target="#topnav">

<section class="slider" id="features">
    <div class="container">
        <div class="inner-page">
            <h2 class="page-headline large text-center">Genereeri hinnapakkumine</h2>

            <p class="text-center">
                NB! Kalkulaatoriga leitud summades sisalduvad täpselt ja ainult need parameetrid, mida vormilt valiti. 
                Erisoovide maksumuse teada saamiseks on kõik küsimused oodatud kontakt-epostile. 
            </p>
        </div>
        <div class="row hidden" id="product-list">

        </div>
        <div class="row">
            <div class="col-xs-12">
                <form id="product-form" accept-charset="utf-8" method="get" action="#">
                    <div class="row  form-group">
                        <div class="col-xs-12 col-md-3 priceform-lbl">
                            TOODE*
                        </div>
                        <div class="col-xs-12 col-md-9">
                            <div class="transp-container">
                                <span class="radio-item">
                                    <input type="radio" name="product" value="<?php echo Products::Window; ?>">
                                    <label>Aken</label>
                                </span>
                                <span class="radio-item">
                                    <input type="radio" name="product" value="<?php echo Products::Door; ?>">
                                    <label>Uks</label>
                                </span>
                                <span class="radio-item">
                                    <input type="radio" name="product" value="<?php echo Products::Stairs; ?>">
                                    <label>Trepp</label>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row  form-group" id="js-product-types" style="display: none;"></div>
                    <div class="row">
                        <div class="col-xs-12" id="js-product-spec"></div>
                    </div>
                    <div class="row" style="display: none;" id="js-price-container">
                        
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-3"></div>
                        <div class="col-xs-12 col-md-9 hidden" id="product-form-btns">
                            <button class="btn btn-info btn-xlg" id="product-form-submit-btn" type="submit">ARVUTA</button>
                            <button class="btn btn-info btn-xlg hidden" id="add-to-offer-btn" type="button">LISA PAKKUMISELE VEEL TOOTEID</button>
                        </div>
                    </div>
                </form>
               
            </div>
        </div>
    </div>
    <div id="js-window-types-rbtns" style="display: none;">
        <div class="col-xs-12 col-md-3 priceform-lbl">
            TÜÜP*
        </div>
        <div class="col-xs-12 col-md-9">
            <div class="transp-container">
                <span class="radio-item">
                    <input type="radio" name="type" value="<?php echo WindowTypes::Cottage ?>">
                    <label>Suvemaja aken</label>
                </span>
                <span class="radio-item">
                    <input type="radio" name="type" value="<?php echo WindowTypes::House ?>">
                    <label>Elumaja aken</label>
                </span>
            </div>
        </div>
    </div>
    <div id="js-door-types-rbtns" style="display: none;">
        <div class="col-xs-12 col-md-3 priceform-lbl">
            TÜÜP*
        </div>
        <div class="col-xs-12 col-md-9">
            <div class="transp-container">
                <span class="radio-item">
                    <input type="radio" name="type" value="<?php echo DoorTypes::Internal ?>">
                    <label>Siseuks</label>
                </span>
                <span class="radio-item">
                    <input type="radio" name="type" value="<?php echo DoorTypes::External ?>">
                    <label>Välisuks</label>
                </span>
            </div>
        </div>
    </div>
    <div id="js-stairs-types-rbtns" style="display: none;">
        <div class="col-xs-12 col-md-3 priceform-lbl">
            TÜÜP*
        </div>
        <div class="col-xs-12 col-md-9">
            <div class="transp-container">
                <span class="radio-item">
                    <input type="radio" name="type" value="<?php echo StairsTypes::Straight ?>">
                    <label>Sirge trepp</label>
                </span>
                <span class="radio-item">
                    <input type="radio" name="type" value="<?php echo StairsTypes::StairsL ?>">
                    <label>L-trepp</label>
                </span>
                <span class="radio-item">
                    <input type="radio" name="type" value="<?php echo StairsTypes::StairsU ?>">
                    <label>U-trepp</label>
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="js/scripts.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
