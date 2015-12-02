
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$js = array(base_url('complementos/js/maps.js'));
echo jsload($js);
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Find-It | <?php echo $titulo; ?></title>
        <meta name="description" content="Sitio web, que busta el estado de funcionamiento de un local">
        <meta name="author" content="Grupo 2">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"><!--Meta para dispositivos moviles-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>complementos/frameworks/bootstrap3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>complementos/css/estilosportal.css">
        <!--GOOGLE MAPS-->
        <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js?ver=3.1.2'></script>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?&sensor=true"></script>
        <style type="text/css">
            #mapa_content {
                height: 20em;
            }
        </style>
    </head>
    <body>

        <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
            <div class="container headerFindIt">
                <?php
                echo $header;
                ?>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <?php
                    echo $sidebar;
                    ?>
                </div>
                <div class="col-sm-9  col-md-10 main">
                    <?php
                    echo $content;
                    ?>
                </div>
            </div>
        </div>
    </body>
        <div class="row">
            <?php
            echo $footer;
            ?>
    <script src="<?php echo base_url(); ?>complementos/frameworks/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>complementos/frameworks/bootstrap3.3.5/js/bootstrap.min.js"></script>
</body>
</html>