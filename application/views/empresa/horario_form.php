<div class="col-md-12">
    <form id="form_horario">
        <h2>Establecer Horario:</h2>
        <hr id ="LineaHorario">
        <div class="row">
            <div class="col-md-9">
                <div class="row nomLocal">
                    <div class="col-md-6 etiquetaHora">
                        <h4><b>Local:</b></h4>
                    </div>                
                    <div class="col-md-4">
                        <input type="text" id="nombreLocal" class="form-control" name="nombreLocal" disabled>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-5 etiquetaHora">
                                <h4><b>Hora de apertura:</b></h4>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" id="horaInicio" name="horaInicio" value="00 : 00" autofocus onclick="iniciarReloj()">                                
                                <div class="row">
                                    <div class="col-md-12" id="relojHoraInicio"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-5 etiquetaHora">
                                <h4><b>Hora de cierre:</b></h4>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" id="horaCierre" name="horaCierre" class="form-control" value="00 : 01" onclick="openReloj2()" disabled>
                                <div class="row">
                                    <div class="col-md-12" id="relojHoraCierre"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-success btn-lg" data-target="messages_div" onclick="guardarHorario()">
                            <span class="glyphicon glyphicon-fire"></span>
                            Establecer
                        </button>
                    </div>
                    <div class="col-sm-4">
                        <button id="btn_cancel" type="submit" class="btn btn-danger btn-lg" onclick="cancelarEstablecerHorario()">
                            <span class="glyphicon glyphicon-remove"></span>
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <img src="<?php echo base_url(); ?>complementos/img/reloj.gif" class="img-responsive" width="65%" alt="Reloj animado">
            </div>
        </div>          
    </form>
</div>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

