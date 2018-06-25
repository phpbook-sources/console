<?php namespace PHPBook\Console;

abstract class Script {

	public static $OS_WINDOWS = 'OS_WINDOWS';

	public static $OS_UNIX = 'OS_UNIX';

	public static function isConsole(): Bool {

		if (PHP_SAPI === 'cli') {

			return true;

		} else {

			return false;

		}

	}

	public static function getOS(): String {

		if (substr(php_uname(), 0, 7) == "Windows"){  
			
			return Static::$OS_WINDOWS;
	    
	    } else { 
	        
	        return Static::$OS_UNIX;

	    };

	}

	public static function setSecondsScriptLimits(Int $time) {

		set_time_limit($time);
		
	}

	public static function kill() {

		exit;

	}

}
