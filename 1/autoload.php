<?php
/**
 * Created by PhpStorm.
 * User: niksy
 * Date: 08.06.2018
 * Time: 18:06
 */


class Autoload {
    protected $load = [
        'Currency',
        'Requests'
    ];

    function __construct()
    {
        foreach ($this->load as $file) $this->load($file);
    }

    private function load($name) {
        require_once $name.'.php';
    }
}