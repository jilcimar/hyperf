<?php

declare(strict_types=1);

use App\Controller\PaymentController;

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');

Router::get('/payments', [PaymentController::class, 'index']);
Router::post('/payment', [PaymentController::class, 'store']);

Router::get('/favicon.ico', function () {
    return '';
});
