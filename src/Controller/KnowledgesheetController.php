<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class KnowledgesheetController extends AbstractController
{
    /**
     * @Route("/knowledgesheet", name="knowledgesheet")
     */
    public function index()
    {
        return $this->render('knowledgesheet/index.html.twig', [
            'controller_name' => 'KnowledgesheetController',
        ]);
    }
}
