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

use function Hyperf\Support\now;

class IndexController extends AbstractController
{
    public function index(): array
    {
        //TODO:: Test coroutine: https://hyperf.wiki/3.1/#/en/coroutine?id=parallel

        $parallel = new \Hyperf\Coroutine\Parallel();

        $parallel->add(function () {
            echo "\n - Entrou para executar a 1\n";

            \Hyperf\Coroutine\Coroutine::sleep(1);

            return now()->format('Y-m-d H:i:s');
        });

        $parallel->add(function () {
            echo "\n - Entrou para executar a 2\n";

            \Hyperf\Coroutine\Coroutine::sleep(1);

            return now()->format('Y-m-d H:i:s');
        });

        $result = $parallel->wait();

//        Result =
//        [
//            "2024-06-03 09:27:48",
//            "2024-06-03 09:27:50"
//        ]

        //TODO:: Sem coroutine
//        $result = [];
//
//        sleep(1);
//        $this->addArray($result);
//
//        sleep(3);
//        $this->addArray($result);

//        Result =
//        [
//        	"2024-06-03 09:26:16",
//        	"2024-06-03 09:26:19"
//        ]

        return $result;
    }

    function addArray(&$array): void
    {
        $array[] = now()->format('Y-m-d H:i:s');
    }
}
