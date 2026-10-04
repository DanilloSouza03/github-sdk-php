<?php

namespace GithubSdkPhp\Services;

use GithubSdkPhp\Data\CreateIssueData;
use GithubSdkPhp\Http\HttpClientInterface;

class IssueService {
    public function __construct(
        private readonly HttpClientInterface $http_client
    ) {}

    public function create(
        string $owner,
        string $repo,
        CreateIssueData $issueData
    ): array {
        $endpoint = "/repos/{$owner}/{$repo}/issues";

        return $this->http_client->post($endpoint, $issueData->toArray());
    }
}


