<?php

namespace App\Controller;

use App\Entity\LongJob;
use App\Repository\LongJobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\HttpFoundation\Request;

#[Route('/api')]
class LongJobController extends AbstractController
{
    #[Route('/long_job/{id}', methods: ['GET'])]
    public function showStatus(LongJobRepository $repository, string $id): JsonResponse
    {
        if (!Uuid::isValid($id)) {
            return $this->json(['error' => 'Invalid uuid provided'], Response::HTTP_BAD_REQUEST);
        }

        $longJob = $repository->find($id);

        if (!$longJob) {
            return $this->json(['error' => 'No job found for the provided id'], Response::HTTP_NOT_FOUND);
        }

        $data =  [
            'id' => $longJob->getId(),
            'status' => $longJob->getStatus(),
            'startedOn' => $longJob->getStartedOn(),
            'endedAt' => $longJob->getEndedAt(),
            'finalData' => $longJob->getFinalData(),
        ];

        return $this->json($data);
    }

    #[Route('/long_job/add', methods: ['POST'])]
    public function addJob(LongJobRepository $repository, Request $request): JsonResponse
    {
        $parameters = json_decode($request->getContent(), true);

        $longJob = LongJob::fromInitialData($parameters['data']);

        $repository->add($longJob, true);

        $data =  [
            'id' => $longJob->getId(),
        ];

        return $this->json($data, Response::HTTP_ACCEPTED);
    }
}
