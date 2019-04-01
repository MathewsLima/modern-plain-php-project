<?php
declare(strict_types=1);

use App\Render\Twig\TemplateDirectory;
use App\Render\Twig\TemplateRenderer;
use App\Render\Twig\TwigTemplateRendererFactory;
use Auryn\Injector;

$injector = new Injector;

$injector->delegate(TemplateRenderer::class, function () use ($injector): TemplateRenderer {
    $factory = $injector->make(TwigTemplateRendererFactory::class);

    return $factory->create();
});

$injector->define(TemplateDirectory::class, [':rootDirectory' => ROOT_DIR]);

return $injector;
