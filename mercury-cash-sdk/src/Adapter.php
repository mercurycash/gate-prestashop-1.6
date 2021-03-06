<?php

namespace MercuryCash\SDK;

use MercuryCash\SDK\Exceptions\JSONException;
use MercuryCash\SDK\Exceptions\ResponseException;
use MercuryCash\SDK\Interfaces\AuthInterface;
use MercuryCash\SDK\Interfaces\AdapterInterface;
use GuzzleHttp\Client;
use MercuryCash\SDK\Interfaces\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;

class Adapter implements AdapterInterface
{
    /**
     * @var Client|null
     */
    protected $client = null;

    /**
     * @var AuthInterface|null
     */
    protected $auth = null;

    /**
     * @var string[]
     */
    protected $methods = ['get', 'post', 'put', 'patch', 'delete'];


    protected $base_uri;


    /**
     * @inheritDoc
     */
    public function __construct($auth, $baseURI = 'https://api-way.mercury.cash')
    {
        $this->auth = $auth;
        $this->base_uri = $baseURI.'/';
        $this->client = new Client([
            'base_uri' => $baseURI,
            'Accept' => 'application/json'
        ]);
    }

    /**
     * @inheritDoc
     */
    public function get($uri, $request = null, $headers = [])
    {
        return $this->request('get', $this->base_uri . $uri, $request, $headers);
    }

    /**
     * @inheritDoc
     */
    public function post($uri, $request = null, $headers = [])
    {
        return $this->request('post', $this->base_uri . $uri, $request, $headers);
    }

    /**
     * @inheritDoc
     */
    public function put($uri, $request = null, $headers = [])
    {
        return $this->request('put', $this->base_uri . $uri, $request, $headers);
    }

    /**
     * @inheritDoc
     */
    public function patch($uri, $request = null, $headers = [])
    {
        return $this->request('patch', $this->base_uri . $uri, $request, $headers);
    }

    /**
     * @inheritDoc
     */
    public function delete($uri, $request = null, $headers = [])
    {
        return $this->request('delete', $this->base_uri . $uri, $request, $headers);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param RequestInterface|null $request
     * @param array $headers
     * @return ResponseInterface
     * @throws JSONException
     * @throws ResponseException
     */
    public function request($method, $uri, $request = null, $headers = [])
    {
        if (!in_array($method, $this->methods)) {
            throw new \InvalidArgumentException('Request method must be get, post, put, patch, or delete');
        }

        $data = $request ? $request->toArray() : [];
        $headers = array_merge($this->auth->getHeaders($data), $headers);

        $this->client->setDefaultOption('verify', false);

        $response = $this->client->$method($uri, [
            'headers' => $headers,
            ($method === 'get' ? 'query' : 'json') => $data,
        ]);

        $this->checkError($response);

        return $response;
    }

    /**
     * @param ResponseInterface $response
     * @throws JSONException
     * @throws ResponseException
     */
    private function checkError($response)
    {
        $json = json_decode($response->getBody());

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new JSONException();
        }

        if (isset($json->errors) && count($json->errors) >= 1) {
            throw new ResponseException($json->errors[0]->message, $json->errors[0]->code);
        }

        if (isset($json->data) && !$json->data) {
            throw new ResponseException('Request was unsuccessful.');
        }
    }

}
