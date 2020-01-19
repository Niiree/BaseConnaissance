<?php

namespace App\Controller;

use App\Form\KnowledgesheetType;
use App\Repository\KnowledgesheetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Annotation\Route;

class KnowledgesheetController extends AbstractController
{
    /**
     * @Route("/knowledgesheet", name="knowledgesheet")
     */
    public function index(KnowledgesheetRepository $knowledgesheetRepository)
    {
        return $this->render('knowledgesheet/index.html.twig', [
            'controller_name' => 'KnowledgesheetController',
        ]);
    }
    /**
     * @Route("/knowledgesheet/create", name="knowledgesheet")
     */
    public function create(KnowledgesheetRepository $knowledgesheetRepository)
    {
        return $this->render('knowledgesheet/create.html.twig', [
            'controller_name' => 'KnowledgesheetController',
        ]);
    }
}
