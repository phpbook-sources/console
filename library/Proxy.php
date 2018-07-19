<?php namespace PHPBook\Console;

abstract class Proxy {    

    private static $started = false;
    
    public static function generate() {

        $allFiles = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(\PHPBook\Console\Configuration\Request::getControllersPathRoot()));

        $phpFiles = new \RegexIterator($allFiles, '/\.php$/');

        foreach ($phpFiles as $phpFile) {

            require_once $phpFile->getRealPath();

        };

        $phpClasses = get_declared_classes();

        $classesProxies = '';

        foreach($phpClasses as $phpClass) {

            $rc = new \ReflectionClass($phpClass);

            foreach($rc->getMethods() as $method) {

                preg_match_all('/@PHPBookConsoleRequestResource{(.*?)}/s', $rc->getMethod($method->name)->getDocComment(), $matches);

                foreach($matches[1] as $item) {
                    preg_match_all('(["]+[\w]+["]:[\s]*["].+["])', $item, $layoutPattern);
                    $attributes = json_decode('{' . str_replace('\\', "\\\\", implode(',', $layoutPattern[0])) . '}');
                    if ($attributes) {
                        $classesProxies .= "\t" . "\t" . '\PHPBook\Console\Request::setResource((new \PHPBook\Console\Resource)' . PHP_EOL;
                        foreach($attributes as $attribute => $value) {
                            $classesProxies .= "\t" . "\t" . "\t" . '->' . $attribute . '(' . $value . ')' . PHP_EOL;
                        };
                        $classesProxies .= "\t" . "\t" . "\t" . '->' . 'setController' . '(\'' . $phpClass . '\', \'' . $method->name . '\')' . PHP_EOL;
                        $classesProxies .= "\t" . "\t" . ');' . PHP_EOL . PHP_EOL;
                    };
                };

            };

        };

        if (\PHPBook\Console\Configuration\Request::getProxiesNamespace()) {
            $contents = '<?php namespace ' . \PHPBook\Console\Configuration\Request::getProxiesNamespace() . ';' . PHP_EOL . PHP_EOL;
        } else {
            $contents = PHP_EOL;
        };

        $contents .= '// YOU CANNOT EDIT THIS FILE. GENERATED BY PHPBOOK' . PHP_EOL . PHP_EOL;
        $contents .= 'abstract class PHPBook_Console_Proxy {' . PHP_EOL . PHP_EOL;
        $contents .= "\t" . 'public static function init() {' . PHP_EOL . PHP_EOL;
        $contents .= $classesProxies . PHP_EOL;
        $contents .= "\t" . '}' . PHP_EOL . PHP_EOL;
        $contents .= '}' . PHP_EOL;

        file_put_contents(\PHPBook\Console\Configuration\Request::getProxiesPathRoot() . DIRECTORY_SEPARATOR . 'PHPBook_Console_Proxy.php', $contents);

    }

    public static function start() {

        if (\PHPBook\Console\Configuration\Request::getProxiesNamespace()) {
            $classProxy = '\\' . \PHPBook\Console\Configuration\Request::getProxiesNamespace() . '\\\PHPBook_Console_Proxy'::class;
        } else {
            $classProxy = 'PHPBook_Console_Proxy';
        };

        $classFile = \PHPBook\Console\Configuration\Request::getProxiesPathRoot() . DIRECTORY_SEPARATOR . 'PHPBook_Console_Proxy.php';

        if ((!class_exists($classProxy)) and (file_exists($classFile))) {
    
            require_once $classFile;

        };

        if (class_exists($classProxy)) {

            if (!Static::$started) {

                Static::$started = true;

                $classProxy::init();
                
            };

        };

    }

}
