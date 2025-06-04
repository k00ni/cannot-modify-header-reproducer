<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\ContentFileDumpRepository;
use App\Request\TypedParameterBag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShowLocalFileController extends AbstractController
{
    public function __construct(
        private Filesystem $filesystem,
    ) {
    }

    #[Route('/', name: 'home')]
    public function handleRequest(): Response
    {
        $filepath = ROOT_PATH.'mbl-2025-7.pdf';

        // load file and show in browser
        header('Content-type:'. mime_content_type($filepath));
        echo $this->filesystem->readFile($filepath);

        return new Response();
    }
}
