<?php namespace PHPBook\Console\Configuration;

abstract class Request {

    private static $phpPath = 'php';

    private static $consoleScriptPath = null;

    private static $controllersPathRoot = null;

	private static $proxiesPathRoot = null;

	private static $proxiesNamespace  = null;

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

    public static function getControllersPathRoot(): ?String {
		return Static::$controllersPathRoot;
	}

	public static function setControllersPathRoot(String $controllersPathRoot) {
		Static::$controllersPathRoot = $controllersPathRoot;
	}

	public static function getProxiesPathRoot(): ?String {
		return Static::$proxiesPathRoot;
	}

	public static function setProxiesPathRoot(String $proxiesPathRoot) {
		Static::$proxiesPathRoot = $proxiesPathRoot;
	}

	public static function getProxiesNamespace(): ?String {
		return Static::$proxiesNamespace;
	}

	public static function setProxiesNamespace(String $proxiesNamespace) {
		Static::$proxiesNamespace = $proxiesNamespace;
	}

}
