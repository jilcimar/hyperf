<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Controller;

use Hyperf\Coroutine\Coroutine;
use Hyperf\Coroutine\Parallel;
use function Hyperf\Support\now;

class IndexController extends AbstractController
{
    public function index(): array
    {
        //TODO:: Test coroutine: https://hyperf.wiki/3.1/#/en/coroutine?id=parallel

        $parallel = new Parallel();

        $parallel->add(function () {
            echo "\n - Entrou para executar a 1\n";

            Coroutine::sleep(1);

            return now()->format('Y-m-d H:i:s');
        });

        $parallel->add(function () {
            echo "\n - Entrou para executar a 2\n";

            Coroutine::sleep(1);

            return now()->format('Y-m-d H:i:s');
        });

        return $parallel->wait();
    }
}
