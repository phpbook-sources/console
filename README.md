    
+ [About Console](#about-console)
+ [Composer Install](#composer-install)
+ [Declare Configurations](#declare-configurations)
+ [Declare Console Controller](#declare-console-controller)
+ [Console Run Resource](#console-run-resource)
+ [Generate Request Proxies](#generate-request-proxies)
+ [Start Request Proxies](#start-request-proxies)
+ [Start Application Console](#start-application-console)
+ [Scheduler](#scheduler)

### About Console

- A PHP library to run asynchronous task in console.
- Requires PHP Extension COM on Windows.

### Composer Install

	composer require phpbook/console
	
### Declare Configurations

```php
<?php

/********************************************
* 
*  Declare Configurations
* 
* ******************************************/

//you php bin path
//Default "php"
\PHPBook\Console\Configuration\Request::setPHPPath('php/bin/path');

//the php script console file, read below the link [Start Application Console]
//Default null
\PHPBook\Console\Configuration\Request::setConsoleScriptPath(__DIR__ . DIRECTORY_SEPARATOR . 'console.php');

//Controllers path, the phpbook will load all controllers by folders recursively inside
//Default null. But its required to set if you want use phpbook console.
\PHPBook\Console\Configuration\Request::setControllersPathRoot('controllers');

//Controllers proxies path, the phpbook will generate the proxies based on controllers
//Default null. But its required to set if you want use phpbook console.
\PHPBook\Console\Configuration\Request::setProxiesPathRoot('proxies');

//Controllers proxies namespace, the phpbook will generate the proxies classes using this namespace
//Default null. But its required to set if you want use phpbook console.
\PHPBook\Console\Configuration\Request::setProxiesNamespace('App\Controllers');

```

##### Declare Console Controller

```php
<?php

/***************************************************
* 
*  Declare Console Controller
* 
* *************************************************/

class ConsoleController {

	/**
	 * @PHPBookConsoleRequestResource{
	 *      "setName": "'greetings'"
	 * 		"setNotes": "'Any important note'"
	 * 		"setArguments": "['name', 'age']"
	 * }
	 */
	public function runConsole($name, $age) {
		
		//your console here

		//when a parameter is not defined in prompt the value will be null.
		$name; $age;

		//set the time to the script finish, zero to unlimited time
		//if you set again, the current timer reset the counter to zero, and starts counting again
		\PHPBook\Console\Script::setSecondsScriptLimits(0);

		//you can check the O.S.
		switch(\PHPBook\Console\Script::getOS()) {
			case \PHPBook\Console\Script::$OS_WINDOWS:

				break;
			case \PHPBook\Console\Script::$OS_UNIX;

				break;
		};

		//you can write script line
		\PHPBook\Console\Script::echo('Hello Jhon');

		//you can kill the script process
		\PHPBook\Console\Script::kill();

		//you can call another asynchronous console
		$run = \PHPBook\Console\Console::run('resource-name', ['parameter-one', 'parameter-two']);

		if ($run) {
			//start success
		} else {
			//start error
		};

	}

}

```

##### Console Run Resource

```php
<?php

/***************************************************
* 
*  Console Run Resource
* 
* *************************************************/

//run a asynchronous console on php
$run = \PHPBook\Console\Console::run('resource-name', ['parameter-one', 'parameter-two']);

if ($run) {
	//start success
} else {
	//start error
};

```

##### Generate Request Proxies

```php
<?php

/***************************************************
* 
*  Generate Request Proxies
* 
* *************************************************/

/* The Directory will be cleared recursively before generate, so you should have a unique folder to this proxies.*/

/* You must generate or re-generate de proxy file when create or change controllers notations */

/* You cannot start console without proxies */

\PHPBook\Console\Proxy::generate();

?>
```

##### Start Request Proxies

```php
<?php

/***************************************************
* 
*  Start Request Proxies
* 
* *************************************************/

/* You must start proxies before start the console */

\PHPBook\Console\Proxy::start();

?>
```

##### Start Application Console

```php
<?php

/***************************************************
* 
*  Start Application Console
* 
* *************************************************/

/* FILE console.php */

if (\PHPBook\Console\Script::isConsole()) {

	\PHPBook\Console\Console::start();

};

```

You can execute console with "php console.php" and all your available resources will be shown.

You can execute console with "php console.php resoure-name parameter-one parameter-two" to run a resource.

### Scheduler

- You need register the php console scripts inside your s.o. server environment scheduler. Each operating system and its server has its way of registering as console scheduler.