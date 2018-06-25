<?php namespace PHPBook\Console\Configuration;

abstract class Request {

    private static $phpPath = 'php';

    private static $consoleScriptPath;

    public static function setPHPPath(String $phpPath) {
        Static::$phpPath = $phpPath;
    }

    public static function getPHPPath(): String {
        return Static::$phpPath;
    }

    public static function setConsoleScriptPath(String $consoleScriptPath) {
        Static::$consoleScriptPath = $consoleScriptPath;
    }

    public static function getConsoleScriptPath(): String {
        return Static::$consoleScriptPath;
    }


}
