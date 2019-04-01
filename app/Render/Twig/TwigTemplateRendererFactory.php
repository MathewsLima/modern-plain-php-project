<?php
declare(strict_types=1);

namespace App\Render\Twig;

use Twig_Environment;
use Twig_Loader_Filesystem;

final class TwigTemplateRendererFactory
{
    private $directory;

    public function __construct(TemplateDirectory $directory)
    {
        $this->directory = $directory;
    }

    public function create(): TwigTemplateRenderer
    {
        $loader = new Twig_Loader_Filesystem([
            $this->directory->toString()
        ]);

        $twigEnvironment = new Twig_Environment($loader);

        return new TwigTemplateRenderer($twigEnvironment);
    }
}
