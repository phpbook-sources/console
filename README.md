    
+ [About Console](#about-console)
+ [Composer Install](#composer-install)
+ [Declare Configurations](#declare-configurations)
+ [Register Console Controller](#register-console-controller)
+ [Declare Console Controller](#declare-console-controller)
+ [Console Run Resource](#console-run-resource)
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
\PHPBook\Console\Configuration\Request::setPHPPath('php/bin/path');

//the php script console file, read below the link [Start Application Console]
\PHPBook\Console\Configuration\Request::setConsoleScriptPath(__DIR__ . DIRECTORY_SEPARATOR . 'console.php');


```

### Register Console Controller

```php
<?php

/***************************************************
* 
*  Register Console Controller
* 
* *************************************************/

\PHPBook\Console\Request::setResource((new \PHPBook\Console\Resource())
	->setName('resource')
	->setNotes('Any important note')
	->setController('ConsoleController', 'runConsole')
	->setArguments(['name', 'age']));

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

	public function runConsole($name, $age) {
		
		//your console here
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