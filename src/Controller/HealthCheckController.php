<?php

declare(strict_types=1);

namespace Aih\AihBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HealthCheckController extends AbstractController
{
    #[Route('/healthcheck', name: 'healthcheck')]
    public function index(): Response
    {
        return $this->json([
            'status' => 'OK',
        ], 200);
    }
}
