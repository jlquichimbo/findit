<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
        <link href="<?= base_url('resources/AdminLTE-2.0.3') ?>/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?= base_url('resources/AdminLTE-2.0.3') ?>/dist/css/skins/_all-skins.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?= base_url('resources/AdminLTE-2.0.3') ?>/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <?php
        echo input(array('type'=>'hidden','id'=>'main_path','value'=>  base_url()));    
        $css = array(
            base_url('resources/bootstrap-3.2.0/css/bootstrap.min.css'),
            base_url('resources/bootstrap-3.2.0/css/bootstrap-theme.css'),
        );
        echo csslink($css);  
        echo $slidebar;   
        $open_content_div = Open('div', array('class'=>'content-wrapper'));
        $close_content_div = Close('div'); 
        echo $open_content_div;?>

        <!-- Content Header (Page header) -->
        <section class="content-header col-md-12" style="background: #ddd; margin-bottom: 5px; padding: 2px; border-bottom: solid 1px #ddddee">
        <?php
//              echo $header;              
        
        ?>              
        </section>
        
        <!-- Main content -->
        <section class="content" id="content" >
          <!-- Main row -->
          <div class="row" >
              <?php
                echo $view;
              ?>
          </div> <!--/.row (main row) -->

        </section> <!--/.content -->


