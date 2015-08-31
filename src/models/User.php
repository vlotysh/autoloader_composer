<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace application\models;

/**
 * Description of User
 *
 * @author vlad
 */
class User extends \vlad\Model {
    
    public function __construct() {
        parent::__construct();
        echo '<br>child model';
    }
    
}
