<div class="col-md-12">
    <form id="form_horario">
        <h2>Horario del local: <?php echo $locales[0]->nombre; ?></h2>
        <hr id ="LineaHorario">
        <div class="row">
            
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-5 pull-left etiquetaHora">
                                <h4><b>Hora de apertura:</b></h4>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" id="horaInicio" name="horaInicio" value="00 : 00 : 00" autofocus onclick="iniciarReloj()" readonly="readonly">                                
                                <div class="row">
                                    <div class="col-md-12" id="relojHoraInicio"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class=" col-md-5 pull-left etiquetaHora">
                                <h4><b>Hora de cierre:</b></h4>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" id="horaCierre" name="horaCierre" class="form-control" value="00 : 00 : 00" onclick="openReloj2()" readonly="readonly">
                                <div class="row">
                                    <div class="col-md-12" id="relojHoraCierre"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <br>
                <div class="form-group">
                    <div class="pull-right">
                     <label for="formGroup" class="col-sm-12 control-label">
                    <div class="col-sm-7">
                        <button type="submit" class="btn btn-success btn-lg" data-target="messages_div" onclick="guardarHorario()">
                            <span class="glyphicon glyphicon-floppy-saved"> </span>
                            Guardar
                        </button>
                    </div>
                        
                    <div class="col-sm-2">
                        <button id="btn_cancel" type="submit" class="btn btn-danger btn-lg" onclick="cancelarEstablecerHorario()">
                            <span class="glyphicon glyphicon-remove"></span>
                            Cancelar
                        </button>
                    </div>
                     </label>
                </div>
                </div>
            </div>
            <div class="pull-left relogif">
                <center><img src="<?php echo base_url(); ?>complementos/img/reloj.gif" class="img-responsive" width="65%" alt="Reloj animado"></center>
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

