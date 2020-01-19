<?php

namespace App\Controller;

use App\Repository\KnowledgesheetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/knowledgesheet/create", name="knowledgesheet_create)
     *
     */
    public create ()

}
