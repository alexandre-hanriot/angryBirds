<?php

namespace App\Controller;

use App\Model\BirdModel;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/birds", name="api_birds_get")
     */
    public function getBirds()
    {
        $birdModel = new BirdModel();
        $birds = $birdModel->getBirds();

        return $this->json([
            // On ajoute une clé contre la faille JSON (à retrouver sur OWASP)
            'birds' => $birds,
        ]);
    }
}
