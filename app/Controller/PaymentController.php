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

use function Hyperf\Support\env;
use GuzzleHttp\Client;

class PaymentController extends AbstractController
{
    /**
     * @Inject
     * @var Client
     */
    protected Client $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Handle the request to the index endpoint.
     *
     * This method retrieves the 'user' input from the request and
     * returns a greeting message along with the HTTP method used.
     *
     * @return array An array containing the HTTP method and a greeting message.
     */
    public function index(): array
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}."
        ];
    }

    /**
     * Handle the request to store user data.
     *
     * This method retrieves 'name' and 'email' inputs from the request
     * and returns them in an array. Default values are used if the inputs
     * are not provided.
     *
     * @return array An array containing the 'name' and 'email' from the request.
     */
    public function store(): array
    {
        return $this->getApiFake($this->request->input('name'));
    }

    private function getApiFake(string $name): array
    {
        $response = $this->client->get(env('API_FAKE') . "?name=$name");

        $data = $response->getBody()->getContents();

        return json_decode($data, true);
    }
}
