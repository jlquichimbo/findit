
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
        <link href="<?php echo base_url(); ?>complementos/css/estiloswitch.css" rel="stylesheet">


        <!--GOOGLE MAPS-->
        <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js?ver=3.1.2'></script>
<!--        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjSP5qZdefYhf1lI6iuBh0gT5BUgYQUWw&amp;sensor=true"></script>
        <script type="text/javascript" src='https://www.google.com/jsapi'></script>-->

        <style type="text/css">
            #mapa_content {
                height: 60em;
            }
        </style>
    </head>
    <body>
        <?php
        echo $header;
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <?php
                    if (!$sidebar) {
                        $sidebar = '';
                    }
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
    <script src="<?php echo base_url(); ?>complementos/frameworks/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>complementos/frameworks/bootstrap3.3.5/js/bootstrap.min.js"></script>

</body>
</html>
