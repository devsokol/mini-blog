<?php

namespace App\Services\JsonPlaceholder;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class JsonPlaceholderService
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * JsonPlaceholderService constructor.
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('JSON_PLACEHOLDER_BASE_URI')
        ]);
    }

    /**
     * Get data from JSONPlaceholder API.
     *
     * @param string $entity
     * @return array|null
     */
    public function get(string $entity)
    {
        try {
            $response = $this->client->get($entity);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            \Log::debug($e->getMessage());

            return null;
        }
    }
}
