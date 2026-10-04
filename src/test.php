<?php

require_once __DIR__ . '/../vendor/autoload.php';

use GithubSdkPhp\Config\GithubConfig;
use GithubSdkPhp\Http\GithubHttpClient;

$config = new GithubConfig(getenv('GITHUB_TOKEN'));

$client = new GithubHttpClient($config);

$response = $client->get("/user");

print_r($response);