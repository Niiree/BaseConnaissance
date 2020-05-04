<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use http\Client\Curl\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use App\Services\Mailer;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }


    // si supérieur à 10min, retourne false
    // sinon retourne true
    private function isRequestInTime(\Datetime $passwordRequestedAt = null)
    {
        if ($passwordRequestedAt === null) {
            return false;
        }

        $now = new \DateTime();
        $interval = $now->getTimestamp() - $passwordRequestedAt->getTimestamp();

        $daySeconds = 60*10;
        $response = $interval > $daySeconds ? false : $reponse = true;
        return $response;
    }

    /**
     * @Route("/forgotten_password", name="app_forgotten_password")
     */
    public function forgottenPassword(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        \Swift_Mailer $mailer,
        TokenGeneratorInterface $tokenGenerator
    ): Response
    {

        if ($request->isMethod('POST')) {

            $email = $request->request->get('email');


            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(Users::class)->findOneByEmail($email);
            /* @var $user Users */

            if ($user === null) {
                $this->addFlash('notice', "Si l'adresse mentionnée est exacte, un mail vous a été envoyé");
                return $this->redirectToRoute('app_login');
            }
            $token = $tokenGenerator->generateToken();
            $user->setPasswordRequestedAt(new \Datetime());

            try {
                $user->setResetToken($token);
                $entityManager->persist($user);
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('app_login');
            }

            $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);

            $message = (new \Swift_Message('Mot de passe oublié'))
                ->setFrom('baseconnaissanceumanit@gmail.com')
                ->setTo($user->getEmail())
                ->setBody(
                    "Bonjour " . $user->getUsername() . ", voici le lien pour créer un nouveau mot de passe : " . $url,
                    'text/html'
                );

            $mailer->send($message);

            $this->addFlash('notice', "Si l'adresse mentionnée est exacte, un mail vous a été envoyé");

            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/forgotten_password.html.twig');
    }


    /**
     * @Route("/send_token/{id}", name="app_send_token")}
     * Reset mot de passe coté Administrateur
     */
    public function sendToken(Users $users,\Swift_Mailer $mailer, TokenGeneratorInterface $tokenGenerator): Response
    {

        $email = $users->getEmail();
        $token = $tokenGenerator->generateToken();
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(Users::class)->findOneByEmail($email);
        $user->setResetToken($token);
        $user->setPasswordRequestedAt(new \Datetime());
        $entityManager->persist($user);
        $entityManager->flush();
        $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);
        $message = (new \Swift_Message('Mot de passe oublié'))
            ->setFrom('baseconnaissanceumanit@gmail.com')
            ->setTo($user->getEmail())
            ->setBody(
                "Bonjour " . $user->getUsername() . ", voici le lien pour créer un nouveau mot de passe : " . $url,
                'text/html'
            );

        $mailer->send($message);
        $this->addFlash('notice', "Un mail de réinitialisation de mot de passe a été envoyé à cet utilisateur");
        return $this->redirectToRoute('users_index');

    }


    /**
     * @Route("/reset_password/{token}", name="app_reset_password")
     */
    public function resetPassword(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder)
    {

        if ($request->isMethod('POST')) {
            $entityManager = $this->getDoctrine()->getManager();

            $user = $entityManager->getRepository(Users::class)->findOneByResetToken($token);
            /* @var $user Users */

            if ($user->getResetToken() === null || $token !== $user->getResetToken() || !$this->isRequestInTime($user->getPasswordRequestedAt()))
            {
                $this->addFlash('notice', 'Token Inconnu ou expiré. Veuillez recommencer');
                    return $this->redirectToRoute('app_login');
            }

            $user->setResetToken(null);
            $user->setPasswordRequestedAt(null);
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
            $entityManager->flush();

            $this->addFlash('notice', 'Mot de passe mis à jour');

            return $this->redirectToRoute('app_login');
        }else {

            return $this->render('security/reset_password.html.twig', ['token' => $token]);
        }

    }
}