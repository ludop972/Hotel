<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function index(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $encoder): Response
    {
        $notificationSuccess = null;
        $notificationError = null;
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $user = $form->getData();
            
            $searchEmail = $em->getRepository(User::class)->findOneBy(['email'=>$user->getEmail()]);

            if(!$searchEmail)
            {
                $password = $encoder->hashPassword($user, $user->getPassword());
                $user->setPassword($password);

                $em->persist($user);
                $em->flush();
                $notificationSuccess = 'Votre inscription s\'est correctement déroulée. Vous pouvez dès à présent vous connecter à votre compte.';
            }
        } else {
            $notificationError = 'L\'email que vous avez renseigné existe déjà';
        }
        
        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
            'notification_error' => $notificationError,
            'notification_success' => $notificationSuccess
        ]);
    }
}
