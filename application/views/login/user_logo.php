<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    echo Image(base_url('uploads/images/users/user.jpg'), array('alt'=>$this->user->id,'class'=>'img-responsive pull-left','style'=>'height:50px;width:50px; margin-right:4px'));
    echo tagcontent('a', $this->user->nombres.' '.$this->user->apellidos, array('href'=>  base_url('/login/editprofile'),'style'=>'font-weight:bold; color:#141823'));