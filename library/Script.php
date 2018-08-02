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

	public static function echoLine(String $message) {

		echo $message . PHP_EOL;
		
	}

	public static function echoBreakLine() {

		echo PHP_EOL;
		
	}

	public static function echoTable(String $label, Array $headers, Array $rows) {
		
		$data = array_merge([$headers], $rows);

		$columns_size = [];

		foreach($headers as $name => $title) {
			$columns_size[$name] = mb_strwidth($title, 'utf-8');
		};

		foreach($data as $item) {
			foreach($headers as $name => $title) {
				if (array_key_exists($name, $item)) {
					if ($columns_size[$name] < mb_strwidth($item[$name], 'utf-8')) {
						$columns_size[$name] = mb_strwidth($item[$name], 'utf-8');
					};
				};
			};
		};

		$total_columns_size = 0;

		foreach($columns_size as $size) {
			$total_columns_size += $size;
		};

		echo ' .' .  str_pad('', $total_columns_size + (count($columns_size)), '.') . PHP_EOL;

		echo ' .' .  str_pad($label, strlen($label)-mb_strlen($label,'UTF-8')+$total_columns_size+(count($columns_size)) - 1, ' ', STR_PAD_BOTH) . '.' . PHP_EOL;

		echo ' .' .  str_pad('', $total_columns_size + (count($columns_size)), '.') . PHP_EOL;

		$heads = false;

		foreach($data as $item) {

			if (!$heads) {

				$parameters = [];

				foreach($headers as $name => $title) {

					$parameters[] = str_pad('', $columns_size[$name], '.');

				};

				echo ' .' . implode('.', $parameters) . '.' . PHP_EOL;
			};

			$parameters = [];

			foreach($headers as $name => $title) {

				$parameters[] = str_pad($item[$name], strlen($item[$name])-mb_strlen($item[$name],'UTF-8')+$columns_size[$name]);

			};

			echo ' |' . implode('|', $parameters) . '|' . PHP_EOL;

			if (!$heads) {

				$heads = true;

				$parameters = [];

				foreach($headers as $name => $title) {

					$parameters[] = str_pad('', $columns_size[$name], '.');

				};

				echo ' |' . implode('|', $parameters) . '|' . PHP_EOL;

			};

		};

		echo PHP_EOL;

	}

	public static function kill() {

		exit;

	}

}
