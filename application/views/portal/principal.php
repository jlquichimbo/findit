<body onLoad="inicializar()">
    <br>
    <script src="assets/js/jquery-1.9.1.min.js"></script>
    <script src="owl-carousel/owl.carousel.min.js"></script>

    <!-- Frontpage Demo -->
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
                        <select id="mySelect" size="8" onchange="localIndividual()" placeholder="Buscar..."></select>
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
                                    $item .= '<img src="' . base_url() . '/uploads/images/anuncios/' . $anuncio->img . '" alt="' . $anuncio->titulo . '" style="height: 28.5em;">'
                                            . '<div class="carousel-caption">'
                                            . '<h4>' . $anuncio->titulo . '</h4>'
                                            . '<p>'
                                            . '<a class="btn btn-primary" type="button" href="' . $anuncio->url . '" target="_blank">Abre el anuncio</a>'
                                            . '</p>'
                                            . '</div>'
                                            . '</div>';
                                } else {
                                    $item .= '<div class="item" align="center">'
                                            . '<img src="' . base_url() . '/uploads/images/anuncios/' . $anuncio->img . '" alt="' . $anuncio->titulo . '" style="height: 28.5em;">'
                                            . '<div class="carousel-caption">'
                                            . '<h4>' . $anuncio->titulo . '</h4>'
                                            . '<p>'
                                            . '<a class="btn btn-primary" type="button" href="' . $anuncio->url . '" target="_blank">Abre el anuncio</a>'
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
                <br>
            </section>
        </div>
    </section>
<center><a href="#faq">Visualiza en el mapa</a></center>
<br>
<br>

<div id="faq" class="container">
    <div class="row">
        <div class="span12">
            <section class="main container well">
                <div class="row">
                    <hr>
                </div>
                <div class="row">

    <!-- <p>class="col-md-8"</p>-->
                    <div id="mapa_content"style="width: 1500px; height: 400px;" class="img-responsive"></div>
                    <br>

                </div>
            </section>
        </div>
    </div>
</div>


<?php
$js = array(base_url('complementos/js/comunes.js'),
);
//echo jsload($js);
?>
<script>

    $(document).ready(function ($) {
        $("#owl-example").owlCarousel();
    });


    $("body").data("page", "frontpage");

</script>
<script src="assets/js/bootstrap-collapse.js"></script>
<script src="assets/js/bootstrap-transition.js"></script>

<script src="assets/js/google-code-prettify/prettify.js"></script>
<script src="assets/js/application.js"></script>

<script type="text/javascript">
    jQuery(function ($) {
        var disqus_loaded = false;
        var top = $("#faq").offset().top;
        var owldomain = window.location.hostname.indexOf("owlgraphic");
        var comments = window.location.href.indexOf("comment");

        if (owldomain !== -1) {
            function check() {
                if ((!disqus_loaded && $(window).scrollTop() + $(window).height() > top) || (comments !== -1)) {
                    $(window).off("scroll")
                    disqus_loaded = true;
                    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                    var disqus_shortname = 'owlcarousel'; // required: replace example with your forum shortname
                    var disqus_identifier = 'OWL Carousel';
                    //var disqus_url = 'http://owlgraphic.com/owlcarousel/';
                    /* * * DON'T EDIT BELOW THIS LINE * * */
                    (function () {
                        var dsq = document.createElement('script');
                        dsq.type = 'text/javascript';
                        dsq.async = true;
                        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                    })();
                }
            }
            $(window).on("scroll", check)
            check();
        } else {
            $('.disqus').hide();
        }
    });
</script>

<script>
    var owldomain = window.location.hostname.indexOf("owlgraphic");
    if (owldomain !== -1) {
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-41541058-1', 'owlgraphic.com');
        ga('send', 'pageview');
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>complementos/frameworks/moment.min.js"></script>
<script src="<?php echo base_url(); ?>complementos/js/reloj.js"></script>
<script src="<?php echo base_url(); ?>complementos/js/portal.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>complementos/css/owl.carousel.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>complementos/css/owl.theme.css">

