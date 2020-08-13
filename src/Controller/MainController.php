<?php

namespace App\Controller;

use App\Model\BirdModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        // On va chercher la liste des oiseaux
        $birdModel = new BirdModel();
        $birds = $birdModel->getBirds();

        dump($birds);

        return $this->render('main/index.html.twig', [
            'birds' => $birds,
        ]);
    }

    /**
     * @Route("/bird/{id}", name="bird_show", requirements={"id"="\d+"})
     */
    public function birdShow($id, SessionInterface $session)
    {
        // On va chercher la liste des oiseaux
        $birdModel = new BirdModel();
        $bird = $birdModel->getBirdById($id);

        // 404 ?
        if ($bird === null) {
            throw $this->createNotFoundException('Oiseau non trouvé');
        }

        // Session cf : https://symfony.com/doc/current/controller.html#managing-the-session
        // On mémorise l'id de l'oiseau
        $session->set('lastBirdId', $id); // $_SESSION['lastBirdId'] = $id;

        return $this->render('main/show.html.twig', [
            'bird' => $bird,
        ]);
    }

    /**
     * @Route("/download", name="download")
     */
    public function download()
    {
        // L'inclusion du fichier se fait par défaut depuis le dossier public
        // car elle se fait depuis le fichier index.php (comme les includes PHP)
        // ce comportement est modifiable => @todo
        $file = new File('files/angry_birds_2015_calendar.pdf');

        return $this->file($file, 'new_angry_calendar_2015.pdf', ResponseHeaderBag::DISPOSITION_ATTACHMENT);
    }
}