<?php

namespace App\Repositories;

use App\Enum\PaymentStatus;
use App\Event\PaymentRegistered;
use App\Model\Payment;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Hyperf\Collection\Collection;
use Hyperf\Database\Model\Model;
use Psr\EventDispatcher\EventDispatcherInterface;

class PaymentRepository extends BaseRepository
{
//    #[Inject]
//    private EventDispatcherInterface $eventDispatcher;

    /**
     * @Inject
     * @var Client
     */
    private Client $client;
    public function __construct(Client $client)
    {
        parent::__construct(new Payment());
        $this->client = $client;
    }

    /**
     * @param array|Collection $attributes
     * @return Model
     * @throws GuzzleException
     */
    public function create(array|Collection $attributes): Model
    {
        $requestApi = $this->postApiFake($attributes['description']);

        $attributes['status'] = PaymentStatus::PENDING->value;
        $attributes['response'] = $requestApi;

        $payment = parent::create($attributes);

        //$this->eventDispatcher->dispatch(new PaymentRegistered($payment));

        return $payment;
    }

    /**
     * @param string $name
     * @return string
     * @throws GuzzleException
     */
    private function postApiFake(string $name): string
    {
        //TODO:: Procurar uma API pública para fazer post
        $response = $this->client->get("https://api.genderize.io?name=$name");
        return $response->getBody()->getContents();
    }
}
