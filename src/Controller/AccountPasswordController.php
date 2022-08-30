<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AccountPasswordController extends AbstractController
{
    #[Route('/account/change-password', name: 'app_account_password')]
    public function index(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $hasher): Response
    {
        $notificationError = null;
        $notificationSuccess = null;

        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $oldPassword = $form->get('old_password')->getData();
            if($hasher->isPasswordValid($user, $oldPassword)) { //compare le mot de passe de l'user et celui tappé dans le formulaire
                $new_password = $form->get('new_password')->getData();
                $password = $hasher->hashPassword($user, $new_password);
                $user->setPassword($password);
                $em->flush();
                $notificationSuccess = "Votre mot de passe a bien été mis à jour";
            } else {
                $notificationError = "Votre mot de passe actuel n'est pas identique à celui que vous avez renseigné lors de votre inscription";
            }
        }
        return $this->render('account/password.html.twig', [
            'notificationSuccess' => $notificationSuccess,
            'notificationError' => $notificationError,
            'form' => $form->createView()
        ]);
    }
}
