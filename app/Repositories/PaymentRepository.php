<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Enum\PaymentStatus;
use App\Job\PaymentJob;
use App\Model\Payment;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Hyperf\Collection\Collection;
use Hyperf\Database\Model\Model;
use Hyperf\AsyncQueue\Driver\DriverFactory;
use Hyperf\AsyncQueue\Driver\DriverInterface;
use Hyperf\Di\Annotation\Inject;

class PaymentRepository extends BaseRepository
{
    /**
     * @var DriverInterface
     */
    protected DriverInterface $driver;

    #[Inject]
    private Client $client;

    public function __construct(DriverFactory $driverFactory)
    {
        $this->driver = $driverFactory->get('default');
        parent::__construct(new Payment());
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

        $this->driver->push(new PaymentJob($payment));

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
