<?php namespace PHPBook\Console;

abstract class Request {
	
    private static $resources = [];

    public static function setResource(Resource $register) {
        Static::$resources[] = $register;
    }

    public static function getResources() {
        return Static::$resources;
    }	

}
