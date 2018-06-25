<?php namespace PHPBook\Console;

abstract class Console {

	private static function getArguments(Int $position): ?String {

		global $argv;
		
		if (array_key_exists($position, $argv)) {
			return (String) $argv[$position];
		};

		return null;
		
	}

	public static function run($resourceName, $resourceArguments): Bool {

		$resources = \PHPBook\Console\Request::getResources();

		foreach($resources as $resource) {

			if ($resource->getName() == $resourceName) {

				$run = \PHPBook\Console\Configuration\Request::getPHPPath() . ' ' . \PHPBook\Console\Configuration\Request::getConsoleScriptPath()  . ' ' . $resourceName . ' ' . implode(' ', $resourceArguments);

				switch(\PHPBook\Console\Script::getOS()) {

					case \PHPBook\Console\Script::$OS_WINDOWS:

						if (class_exists('\\COM')) {

							try {
								
								$WshShell = new \COM("WScript.Shell");

								$WshShell->Run($run, 0, false);
		
								return true;
								
							} catch(\Exception $e) {

								return false;
								
							};					

						};

						break;

					case \PHPBook\Console\Script::$OS_UNIX;

						try {

							exec($run . " > /dev/null &");

							return true;

						} catch(\Exception $e) {

							return false;

						};	

						break;

				};

			};

		};

		return false;

	}

	public static function start() {

		$resources = \PHPBook\Console\Request::getResources();

		if (Static::getArguments(1)) {

			$handler = Null;
	
			foreach($resources as $resource) {
				
				if ($resource->getName() == Static::getArguments(1)) {
	
					$handler = $resource;
	
					break;
	
				};
	
			};
	
			if ($handler) {
				
				list($classController, $method) = $handler->getController();
				
				$controller = new $classController;

				$arguments = [];
	
				foreach($handler->getArguments() as $sequence => $argument) {
					$arguments[] = Static::getArguments($sequence + 2);
				};

				call_user_func_array(array($controller, $method), $arguments);

			} else {
	
				print 'Resource "' . Static::getArguments(1) . '" Not Found!'  . PHP_EOL;
	
			};       
	
		} else {
	
			print PHP_EOL;
	
			print '###################################################' . PHP_EOL;
			print '##           		Resources'						. PHP_EOL;
			print '###################################################' . PHP_EOL;
	
			print PHP_EOL;
	
			foreach($resources as $resource) {
				
				print 'notes: ' . $resource->getNotes() . PHP_EOL;
	
				print 'resource: ' . $resource->getName() . PHP_EOL;
				
				print 'arguments: ' . implode('|', $resource->getArguments()) . PHP_EOL;
	
				print 'example: ' . \PHPBook\Console\Configuration\Request::getPHPPath() . ' ' . \PHPBook\Console\Configuration\Request::getConsoleScriptPath() . ' ' . $resource->getName() . ' ' . implode(' ', $resource->getArguments()) . PHP_EOL;
	
				print '..................................................' . PHP_EOL . PHP_EOL;
	
			};
	
		};

	}

}