<?php

namespace App\Controller;

use App\Entity\LongJob;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class LongJobController extends AbstractController
{
    #[Route('/long_job/{id}', methods: ['GET'])]
    public function showStatus(string $id): JsonResponse
    {
        $longJob = $this->getDoctrine()
            ->getRepository(LongJob::class)
            ->find($id);

        if (!$longJob) {
            return $this->json('No job found for id' . $id, 404);
        }

        $data =  [
            'id' => $longJob->getId(),
            'status' => $longJob->getStatus(),
            'startedOn' => $longJob->getStartedOn(),
            'finalData' => $longJob->getFinalData(),
        ];

        return $this->json($data);
    }
}
