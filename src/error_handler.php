<?php  declare(strict_types=1);

return [
    'whoops' => function() {
        $whoops = new Whoops\Run;
        $whoops->pushHandler(new Whoops\Handler\PrettyPageHandler);
        $whoops->register();
    }
];
