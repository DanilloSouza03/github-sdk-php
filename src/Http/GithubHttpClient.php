<?php

namespace GithubSdkPhp\Http;

use GithubSdkPhp\Config\GithubConfig;
use RuntimeException;

class GithubHttpClient implements HttpClientInterface {

    public function __construct(
        private readonly GithubConfig $config
    ){}


    public function get(string $endpoint): array {
        return $this->request('GET', $endpoint);
    } 

    public function post(string $endpoint, array $data = []): array {
        return $this->request('POST', $endpoint, $data);
    }

    public function put(string $endpoint, array $data = []): array {
        return $this->request('PUT', $endpoint, $data);
    }

    public function delete(string $endpoint): array {
        return $this->request('DELETE', $endpoint);
    }     

    private function request(string $method, string $endpoint, array $data = []): array {
        $url = $this->config->getBaseUrl() . $endpoint;
        $curl = curl_init($url);

        curl_setopt_array(
            $curl,
            [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_HTTPHEADER => [
                    'Authorization: Bearer ' . $this->config->getToken(),
                    'User-Agent: SDKGitHub',
                    'Accept: application/vnd.github+json',
                    'X-GitHub-Api-Version: 2022-11-28',
                    'Content-Type: application/json',
                ],
            ]
        );

        if (!empty($data)) {
            curl_setopt(
                $curl,
                CURLOPT_POSTFIELDS,
                json_encode($data)
            );
        }

        $response = curl_exec($curl);

        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        $decodedResponse = json_decode($response, true);

        if ($statusCode >= 400) {
            throw new \RuntimeException(
                'API GitHub return HTTP ' . $statusCode 
            );
        }

        return $decodedResponse ?? [];
    }
}