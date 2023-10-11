<?php

declare(strict_types=1);

namespace Aih\AihBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HealthCheckController extends AbstractController
{
    #[Route('/healthcheck', name: 'healthcheck')]
    public function index(): Response
    {
        return $this->json([
            'status' => 'L\'Application est en ligne',
        ], 200);
    }
}
