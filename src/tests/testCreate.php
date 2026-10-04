<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use GithubSdkPhp\Config\GithubConfig;
use GithubSdkPhp\Http\GithubHttpClient;
use GithubSdkPhp\Data\CreateIssueData;
use GithubSdkPhp\Services\IssueService;

$config = new GithubConfig(getenv('GITHUB_TOKEN'));

$httpClient = new GithubHttpClient($config);

$dataIssue = new CreateIssueData(
    title: 'Issue created by the lib SDK',
    body: 'Issue description coming from my PHP lib',
    labels: ['bug', 'test']
);

$service = new IssueService($httpClient);

$result = $service->create('DanilloSouza03', 'github-sdk-php', $dataIssue);

print_r($result);