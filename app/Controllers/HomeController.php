<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Render\Twig\TemplateRenderer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class HomeController
{
    private $templateRenderer;

    public function __construct(TemplateRenderer $templateRenderer)
    {
        $this->templateRenderer = $templateRenderer;
    }

    public function show(Request $request): Response
    {
        $links = [
            ['url' => 'https://google.com.br', 'title' => 'Google'],
            ['url' => 'https://bing.com.br', 'title' => 'Bing'],
            ['url' => 'https://yahoo.com.br', 'title' => 'Yahoo'],
        ];

        $content = $this->templateRenderer->render('home.html.twig', [
            'links' => $links
        ]);

        return new Response($content);
    }
}
