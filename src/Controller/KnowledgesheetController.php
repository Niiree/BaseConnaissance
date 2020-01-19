<?php

namespace App\Controller;

use App\Entity\Knowledgesheet;
use App\Form\KnowledgesheetType;
use App\Repository\KnowledgesheetRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
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
        $knowledgesheet = $knowledgesheetRepository->findAll();

        return $this->render('knowledgesheet/index.html.twig', [
            'knowledgesheet' => $knowledgesheet,
        ]);
    }
    /**
     * @Route("/knowledgesheet/create", name="knowledgesheet_create")
     */
    public function create(EntityManagerInterface $entityManager, Request $request)
    {
        $knowledge = new Knowledgesheet();

        $form=$this->createForm(KnowledgesheetType::class,$knowledge);
        $form->add('edit',SubmitType::class,
            ['label'=>'Contribuer']);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form-> isValid()) {
            $knowledge = $form->getData();
            $entityManager->persist($knowledge);
            $entityManager->flush();
            return $this->redirectToRoute('knowledgesheet');
        }

        return $this ->render('knowledgesheet/create.html.twig',[
            'formKnowledgesheet' => $form->createView(),
        ]);
    }

    /**
     * @Route("/knowledgesheet/{id}/delete", name="delete")
     */
    public function delete(Knowledgesheet $knowledgesheet, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($knowledgesheet);
        $entityManager->flush();
        return $this->redirectToRoute('knowledgesheet');
    }


}
