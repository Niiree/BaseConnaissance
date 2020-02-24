<?php

namespace App\Controller;

use App\Repository\ContextRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContextController extends AbstractController
{
    /**
     * @Route("/user/context", name="context")
     */
    public function index(ContextRepository $contextRepository, Request $request)
    {
        return $this->render('context/index.html.twig', [
            'contexts' => $contextRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/context_create", name="context_create")
     */
    public function create(ContextRepository $contextRepository, Request $request)
    {
        return $this->render('context/index.html.twig', [
            'contexts' => $contextRepository->findAll(),
        ]);
    }
}
