<?php
declare(strict_types=1);

use App\Controllers\HomeController;

return [
    ['GET', '/', HomeController::class . '@show']
];
