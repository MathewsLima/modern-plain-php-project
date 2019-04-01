<?php
declare(strict_types=1);

namespace App\Render\Twig;

interface TemplateRenderer
{
    public function render(string $template, array $data = []): string;
}