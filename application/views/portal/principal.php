<body onLoad="inicializar()">

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
                    <?php
                    $item = '<div class="item active" align="center">';
                    $i = 0;
                    foreach ($anuncios as $anuncio) {
                        //Si es el primer anuncio va con la clase item active  
                        if ($i == 0) {
                            $item .= '<img src="' . base_url() . '/uploads/images/anuncios/' . $anuncio->img . '" alt="' . $anuncio->titulo . '" style="height: 20em;">'
                                    . '<div class="carousel-caption">'
                                    . '<h4>' . $anuncio->titulo . '</h4>'
                                    . '<p>'
                                    . '<a class="btn btn-primary" type="button" href="'.$anuncio->url .'" target="_blank">Abre el anuncio</a>'
                                    . '</p>'
                                    . '</div>'
                                    . '</div>';
                        } else {
                            $item .= '<div class="item" align="center">'
                                    . '<img src="' . base_url() . '/uploads/images/anuncios/' . $anuncio->img . '" alt="' . $anuncio->titulo . '" style="height: 20em;">'
                                    . '<div class="carousel-caption">'
                                    . '<h4>' . $anuncio->titulo . '</h4>'
                                    . '<p>'
                                    . '<a class="btn btn-primary" type="button" href="'.$anuncio->url .'" target="_blank">Abre el anuncio</a>'
                                    . '</p>'
                                    . '</div>'
                                    . '</div>';
                        }
                        $i++;
                    }
                    echo $item;
                    ?>
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <section class="main container well">
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
                                $tipos_empresa, array('label' => 'nombre', 'value' => 'id', 'nombre' => 'tipo_local'), array('name' => 'local_id', 'id' => 'local_id', 'class' => 'form-control'), true);
                        echo get_combo_group('Categorias', $combo_tipos, 'col-md-12 form-group');
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
                         Hora Inicio: <label id="labelHinicio">_ _:_ _:_ _</label>
                    </div>
                    <div class="col-md-6"><br>
                         Hora Cierre: <label id="labelHCierre">_ _:_ _:_ _</label>
                    </div>
                </div>
            </aside>
            <section class="col-md-8">
               <!-- <p>class="col-md-8"</p>-->
                <div id="mapa_content"style="width: 750px; height: 400px;" class="img-responsive"></div>
                <br>
            </section>
        </div>
    </section>
    <?php
    $js = array(base_url('complementos/js/comunes.js'),
    );
//echo jsload($js);
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script src="<?php echo base_url(); ?>complementos/frameworks/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>complementos/js/reloj.js"></script>
    <script src="<?php echo base_url(); ?>complementos/js/portal.js"></script>

