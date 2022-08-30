<?php

namespace App\Controller;

use App\Entity\Imgs;
use App\Entity\Room;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $em): Response
    {
        $rooms = $em->getRepository(Room::class)->findBy(['isBest' => 1]);
        $pictures = $em->getRepository(Imgs::class)->findBy(['intro' => 1]);

        return $this->render('home/index.html.twig', [
            'rooms' => $rooms,
            'pictures' => $pictures
        ]);
    }
}
