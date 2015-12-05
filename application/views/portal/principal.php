<div class="container hidden-xs">
    <div class="row">
        <div id="carousel-example-generic" class="carousel slider" data-ride="carousel">
            <ul class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                <li data-target="#carousel-example-generic" data-slide-to="3"></li>
            </ul>
            <div class="carousel-inner">
                <div class="item active">
                    <img src="<?php echo base_url(); ?>/complementos/img/slider1.jpg" alt="Slider-1">
                    <div class="carousel-caption">
                        <h4>Ferreter&iacute;a</h4>
                        <p>
                            <button type="button" class="btn btn-primary">Visita este Local</button>
                        </p>
                    </div>
                </div>
                <div class="item">
                    <img src="<?php echo base_url(); ?>/complementos/img/slider2.jpg" alt="Slider-2">
                    <div class="carousel-caption">
                        <h4>Restaurante</h4>
                        <p>
                            <button type="button" class="btn btn-primary">Visita este Local</button>
                        </p>
                    </div>
                </div>
                <div class="item">
                    <img src="<?php echo base_url(); ?>/complementos/img/slider3.jpg" alt="Slider-3">
                    <div class="carousel-caption">
                        <h4>Centro comercial</h4>
                        <p>
                            <button type="button" class="btn btn-primary">Visita este Local</button>
                        </p>
                    </div>
                </div>
                <div class="item">
                    <img src="<?php echo base_url(); ?>/complementos/img/slider4.jpg" alt="Slider-4">
                    <div class="carousel-caption">
                        <h4>Piscina</h4>
                        <p>
                            <button type="button" class="btn btn-primary">Visita este Local</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="main container">
    <div class="row">
        <hr>
    </div>
    <div class="row">
        <aside class="col-md-4 filtrador">
            <div class="row">
                <!--                <div class="col-md-3">
                                    <h4><b>Categor&iacute;as:</b></h4>
                                </div>                -->              
                <div class="col-md-9">
                    <!--<select id="selectCategoria" name="selectCategoria" class="form-control">-->
                    <?php
                    //Lista de tipos
                    $combo_tipos = combobox(
                            $tipos_empresa, 
                            array('label' => 'nombre', 'value' => 'id', 'nombre' => 'tipo_local'), 
                            array('name' => 'local_id', 'id' => 'local_id', 'class' => 'form-control'), true);
                    echo get_combo_group('Categoria', $combo_tipos, 'col-md-12 form-group');
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="light" id="reloj">
                        <div class="Pantalla">
                            <div class="DiasSemana"></div>
                            <div class="ampm"></div>
                            <div class="alarm"></div>
                            <div class="digits"></div>
                        </div>
                    </div>	
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"><br>
                    <select id="mySelect" size="8" onchange="localIndividual()"></select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6"><br>
                    Hora Inicio: <label for="">19:00:00</label>
                </div>
                <div class="col-md-6"><br>
                    Hora Cierre: <label for="">00:00:00</label>
                </div>
            </div>
        </aside>
        <section class="col-md-8">
            <div id="mapa_content"></div>
        </section>
    </div>
</section>
<?php
$js = array(base_url('complementos/js/comunes.js'),
    base_url('complementos/js/autosuggest/hogan-2.0.0.js'),
    base_url('complementos/js/autosuggest/bootstrap-typeahead.js'),
);
echo jsload($js);
?>
<script src="<?php echo base_url(); ?>complementos/frameworks/moment.min.js"></script>
<script src="<?php echo base_url(); ?>complementos/js/reloj.js"></script>
<script src="<?php echo base_url(); ?>complementos/js/portal.js"></script>

