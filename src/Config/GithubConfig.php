<?php

namespace GithubSdkPhp\Config;

class GithubConfig {
    public const BASE_URL = 'https://api.github.com';

    public function __construct(
        private readonly string $token
    ){}

    public function getToken(): string {
        return $this->token;
    }

    public function getBaseUrl(): string {
        return self::BASE_URL;
    }
}