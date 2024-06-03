<?php

namespace App\Repositories;

use App\Enum\PaymentStatus;
use App\Model\Payment;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Hyperf\Collection\Collection;
use Hyperf\Database\Model\Model;

class PaymentRepository extends BaseRepository
{
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
        $attributes['status'] = PaymentStatus::PENDING->value;
        $requestApi = $this->getApiFake($attributes['status']);
        $attributes['response'] = $requestApi;

        return parent::create($attributes);
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
