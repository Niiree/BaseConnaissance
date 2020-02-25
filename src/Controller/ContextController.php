<?php

namespace App\Controller;

use App\Entity\Context;
use App\Form\ContextType;
use App\Repository\ContextRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContextController extends AbstractController
{
    /**
     * @Route("/user/context", name="context")
     */
    public function index(ContextRepository $contextRepository, Request $request)
    {
        return $this->render('context/index.html.twig');
    }

    /**
     * @Route("/admin/context", name="context_create")
     */
    public function create(EntityManagerInterface $entityManager, ContextRepository $contextRepository, Request $request)
    {
        $context = new Context();

        $form=$this->createForm(ContextType::class,$context);
        $form->add('edit',SubmitType::class,
            ['label'=>'Créer']);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form-> isValid()) {
            $context = $form->getData();
            $entityManager->persist($context);
            $entityManager->flush();
            return $this->redirectToRoute('context_create');
        }
        return $this ->render('context/create.html.twig',[
            'formContext' => $form->createView(),'contexts' =>$contextRepository->findAll(),
        ]);







    }
}
