<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\ResetPassword;
use App\Entity\User;
use App\Form\ResetPasswordType;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ResetPasswordController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/forbidden-password', name: 'app_reset_password')]
    public function index(Request $request): Response
    {
        if($this->getUser()){
            return $this->redirectToRoute('app_home');
        }

        if($request->get('email')){
            $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $request->get('email')]);

            if($user) {
                //1 : enregistrer en base la demande de reset_password avec user, token , createdAt.
                $reset_password = new ResetPassword();
                $reset_password->setUser($user);
                $reset_password->setToken(uniqid());
                $reset_password->setCreatedAt(new DateTimeImmutable);
                $this->entityManager->persist($reset_password);
                $this->entityManager->flush();

                // 2 : Envoyer un email à l'utilisateur avec un lien en lui permettant de mettre a jour son mot de passe

                $url = $this->generateUrl('app_update_password', [
                    'token' => $reset_password->getToken()
                ]);

                $content = "Bonjour ".$user->getName()."<br>Vous avez demandé à réinitialiser votre mot de passe sur le site \"HOTEL\".<br><br>";
                $content .= "Merci de bien vouloir cliquer sur le lien suivant pour <a href='".$url."'>mettre à jour votre mot de passe</a>.";

                $mail = new Mail();
                $mail->send(htmlentities($user->getEmail()),htmlentities($user->getName()), 'Réinitialiser votre mot de passe sur La Boutique Française',htmlentities($content));
                $this->addFlash('notice',
                    'Vous allez recevoir dans quelques secondes un mail afin de
                                            réinitialiser votre mot de passe, s\'il n\'est pas dans votre boite de réception
                                            penser à vérifier dans les spams');
           } else {
                $this->addFlash('notice', 'Cette adresse mail est inconnue');
            }
        }

        return $this->render('reset_password/index.html.twig');
    }

    #[Route('/modifier-mon-mot-de-passe/{token}', name: 'app_update_password')]
    public function update(Request $request, $token, UserPasswordHasherInterface $encoder): Response
    {
        $reset_password = $this->entityManager->getRepository(ResetPassword::class)->findOneBy(['token' => $token]);

        if(!$reset_password) {
            return $this->redirectToRoute('app_reset_password');
        }

        //vérifier si le createdAt = now - 3h

        $now = new DateTimeImmutable();


        if ($now > $reset_password->getCreatedAt()->modify('+ 3 hour')) {
            $this->addFlash('notice', 'Votre demande de mot de passe a expiré. Merci de la renouveller');
            return $this->redirectToRoute('app_reset_password');
        }

        //Rendre une vue avec mot de passe et confirmer votre mot de passe
        $form = $this->createForm(ResetPasswordType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $new_pwd = $form->get('new_password')->getData();

            //encodage des mot des passes

            $password = $encoder->hashPassword($reset_password->getUser(), $new_pwd);

            $reset_password->getUser()->setPassword($password);

            //flush en base de donnée

            $this->entityManager->flush();

            //redirection

            $this->addFlash('notice','Votre mot de passe a bien été mis a jour');
            return $this->redirectToRoute('app_login');
        }


        return $this->render('reset_password/update.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
