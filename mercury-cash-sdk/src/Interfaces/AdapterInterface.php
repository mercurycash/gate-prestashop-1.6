<?php

namespace MercuryCash\SDK\Interfaces;

use GuzzleHttp\Message\ResponseInterface;

interface AdapterInterface
{
    /**
     * AdapterInterface constructor.
     *
     * @param AuthInterface $auth
     * @param string $baseURI
     */
    public function __construct($auth, $baseURI);

    /**
     * @param string $uri
     * @param RequestInterface|null $request
     * @param array $headers
     * @return ResponseInterface
     */
    public function get($uri, $request = null, $headers = []);

    /**
     * @param string $uri
     * @param RequestInterface|null $request
     * @param array $headers
     * @return ResponseInterface
     */
    public function post($uri, $request = null, $headers = []);

    /**
     * @param string $uri
     * @param RequestInterface|null $request
     * @param array $headers
     * @return ResponseInterface
     */
    public function put($uri, $request = null, $headers = []);

    /**
     * @param string $uri
     * @param RequestInterface|null $request
     * @param array $headers
     * @return ResponseInterface
     */
    public function patch($uri, $request = null, $headers = []);

    /**
     * @param string $uri
     * @param RequestInterface|null $request
     * @param array $headers
     * @return ResponseInterface
     */
    public function delete($uri, $request = null, $headers = []);
}
