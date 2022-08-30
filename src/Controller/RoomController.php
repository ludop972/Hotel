<?php

namespace App\Controller;

use App\Entity\Room;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoomController extends AbstractController
{
    #[Route('/rooms', name: 'app_rooms')]
    public function index(EntityManagerInterface $em): Response
    {
        $rooms = $em->getRepository(Room::class)->findAll();

        return $this->render('room/index.html.twig', [
            'rooms' => $rooms
        ]);
    }

    #[Route('/room/{slug}', name: 'app_room')]
    public function show($slug, EntityManagerInterface $em): Response
    {
        $room = $em->getRepository(Room::class)->findOneBy(['slug' => $slug]);
//        $rooms = $em->getRepository(Room::class)->findBy(['isBest' => 1]);

        if(!$room)
        {
            return $this->redirectToRoute('app_rooms');
        }

        return $this->render('/room/show.html.twig', [
            'room' => $room
        ]);
    }
}
