<?php

namespace App\Services;

use Symfony\Component\HtmlSanitizer\HtmlSanitizer;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;

class HtmlSanitizerService
{
    private HtmlSanitizer $sanitizer;
    private bool $allowLinks;

    public function __construct($allowLinks = false)
    {
        $this->allowLinks = $allowLinks;
        $this->createSanitizer();
    }

    public function sanitize(string $rawHtml): string
    {
        return $this->sanitizer->sanitize($rawHtml);
    }

    private function createSanitizer(): void
    {
        if (!$this->allowLinks) {
            $this->sanitizer = new HtmlSanitizer((new HtmlSanitizerConfig())
                ->allowSafeElements()
                ->blockElement('a')
                ->blockElement('img')
                ->allowLinkHosts([])
                ->allowMediaHosts([])
            );
        } else {
            $this->sanitizer = new HtmlSanitizer((new HtmlSanitizerConfig())
                ->allowSafeElements()
                ->allowLinkSchemes(['https', 'http'])
                ->forceAttribute('a', 'rel', 'noopener noreferrer')
                ->blockElement('img')
                ->allowMediaHosts([])
            );
        }
    }
}
