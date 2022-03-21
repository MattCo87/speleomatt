<?php

namespace App\Controller;

use App\Entity\Character;
use App\Entity\CharacterFormation;
use App\Entity\Fight;
use PhpParser\Node\Scalar\MagicConst\File;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PlayController extends AbstractController
{
    /**
     * @Route("/play", name="app_play")
     */
    public function index(): Response
    {
        $fights = $this->getDoctrine()->getRepository(Fight::class)->findBy(['id' => 1]);

        $tabFormation = $fights[0]->getFormations();
        $formation0 = $tabFormation[0];
        $formation1 = $tabFormation[1];


        $characters0 = $formation0->getCharacterFormations();
        $characters1 = $formation1->getCharacterFormations();

        return $this->render('play/index.html.twig', [
            'fight' => $fights[0],
            'formation0' => $formation0,
            'formation1' => $formation1,
            'characters0' => $characters0,
            'characters1' => $characters1,
        ]);
    }
}
