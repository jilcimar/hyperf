<?php
namespace App\Listener;

use App\Enum\PaymentStatus;
use App\Event\PaymentRegistered;
use App\Model\Payment;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Hyperf\Event\Contract\ListenerInterface;

class PaymentRegisteredListener implements ListenerInterface
{
    /**
     * @Inject
     * @var Client
     */
    private Client $client;
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    public function listen(): array
    {
        return [
            PaymentRegistered::class,
        ];
    }

    /**
     * @param object $event
     */
    public function process(object $event): void
    {
        $payment = Payment::find($event->payment->id);

        for ($i = 0; $i < 5; $i++) {
            sleep(5);
            $payment->update(['status' => PaymentStatus::APPROVED->value]);
        }
    }

    /**
     * @param string $name
     * @return string
     * @throws GuzzleException
     */
    private function getApiFake(string $name): string
    {
        $response = $this->client->get("https://api.genderize.io?name=$name");
        return $response->getBody()->getContents();
    }
}
