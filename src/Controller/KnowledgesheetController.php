<?php

namespace App\Controller;

use App\Entity\Knowledgesheet;
use App\Form\KnowledgesheetType;
use App\Repository\KnowledgesheetRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
     * @Route("/knowledgesheet/create", name="knowledgesheet_create")
     */
    public function create(EntityManagerInterface $entityManager)
    {
    $knowledge = new Knowledgesheet();
    $knowledge->setTitle("Hello");
    $knowledge->setContent("Essai",TextareaType::class);
    $entityManager->persist($knowledge);
    $entityManager->flush();
    return $this->redirectToRoute('knowledgesheet');
    }
}
