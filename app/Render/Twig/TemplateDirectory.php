<?php
declare(strict_types=1);

namespace App\Render\Twig;

final class TemplateDirectory
{
    private $directory;

    public function __construct(string $rootDirectory)
    {
        $this->directory = $rootDirectory . '/templates';
    }

    public function toString(): string
    {
        return $this->directory;
    }
}
