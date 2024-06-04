<?php

declare(strict_types=1);

namespace App\Job;

use Hyperf\AsyncQueue\Job;

class PaymentJob extends Job
{
    public $payment;
    public function __construct($payment)
    {
        $this->payment = $payment;
    }

    public function handle(): void
    {
        $maxRetries = 5;
        $interval = 3;
        $attempt = 0;

        while ($attempt < $maxRetries) {
            $attempt+=1;

            //TODO:: 1 Realizar o get na API,
            // 2 Atualizar o status caso seja diferente do que está salvo
            // Parar a execução baseado no status ou número de tentativas

            $this->payment->update(['description' => "Atualizado $attempt"]);

            if ($attempt < $maxRetries) {
                sleep($interval);
            }
        }
    }
}
