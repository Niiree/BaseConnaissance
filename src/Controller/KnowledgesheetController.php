<?php

namespace App\Controller;

use App\Entity\Knowledgesheet;
use App\Form\KnowledgesheetType;
use App\Form\SearchType;
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
        $knowledgesheet = $knowledgesheetRepository->searchfultexte("5");

        return $this->render('knowledgesheet/index.html.twig', [
            'knowledgesheet' => $knowledgesheet,
        ]);
    }

    /**
     * @Route("/knowledgesheet/search", name="search")
     */
    public function search()
    {
        $form = $this->createForm(SearchType::class); // Création de la barre de recherche vers la vue /search
        $form->add('patate',SubmitType::class,
            ['label'=>'Rechercher']);
        return $this ->render('knowledgesheet/searchKnow.html.twig',[
            'formSearch' => $form->createView(),
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


    /**
     * @Route("/knowledgesheet/{id}/edit", name="edit")
     */
    public function edit(Knowledgesheet $knowledgesheet, EntityManagerInterface $entityManager, request $request)
    {
        $form=$this->createForm(KnowledgesheetType::class,$knowledgesheet);
        $form->add('edit',SubmitType::class,
            ['label'=>'Enregistrer']);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form-> isValid()){
            $knowledgesheet = $form->getData();
            $entityManager->persist($knowledgesheet);
            $entityManager->flush();
            return $this->redirectToRoute('knowledgesheet');

        }

        return $this ->render('knowledgesheet/edit.html.twig',[
            'formKnowledgesheet' => $form->createView(),
        ]);

    }



}
