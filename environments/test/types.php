<?php
/**
 * Created by PhpStorm.
 * User: setrais
 * Date: 06.11.2018
 * Time: 14:26
 *
 * Testing type
 *
 */

class MyTypes {
    public $mystring;

    public function is_mystring( $var ) {
        return is_string( $var );
    }

    public function is_mybool( $var ) {
        return is_bool( $var );
    }

    public function is_myint( $var ) {
        return is_int( $var );
    }

    public function is_myinteger( $var ) {
        return is_integer( $var );
    }
}