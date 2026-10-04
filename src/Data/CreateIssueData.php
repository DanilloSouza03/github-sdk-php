<?php

namespace GithubSdkPhp\Data;

class CreateIssueData {
    public function __construct(
        public readonly string $title,
        public readonly ?string $body = null,
        public readonly ?string $assignee = null,
        public readonly ?array $labels = []
    ) {}

    public function toArray(): array {
        return array_filter([
            'title' => $this->title,
            'body' => $this->body,
            'assignee' => $this->assignee,
            'labels' => $this->labels
        ], fn($value) => $value !== null);
    }
}