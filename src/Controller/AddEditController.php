<?php

namespace App\Controller;

use App\Entity\Module;
use App\Form\ModuleType;
use App\Entity\Categorie;
use App\Entity\Formateur;
use App\Entity\Formation;
use App\Entity\Stagiaire;
use App\Form\CategorieType;
use App\Form\FormateurType;
use App\Form\FormationType;
use App\Form\StagiaireType;
use App\Repository\FormateurRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddEditController extends AbstractController
{
    /**
     * @Route("/add/formation", name="addFormation")
     * @Route("/edit/formation/{id}", name="editFormation")
     */
    public function addEditFormation(Formation $formation = null, ObjectManager $manager, Request $request)
    {
        // Ajout d'une formation
        if(!$formation) {
            $formation = new Formation();
            // creation du formulaire d'ajout
            $form = $this->createForm(FormationType::class, $formation);

            $title = 'Ajout d\'une formation ';
        }
 
        // Modification d'une formation
        else {
            // creation du formulaire de modification
            $form = $this->createForm(FormationType::class, $formation);

            $title = 'Modification d\'une formation ';
         }
 
        // Va controler les données entrées dans le formulaire
        $form->handleRequest($request);
               
        // Validation du formulaire (Ajout ou modification)
        if($form->isSubmitted() && $form->isValid()) {
                 
            // On ajoute la formation en BDD
            $manager->persist($formation);
            $manager->flush();
 
            // On redirige vers la route (affichage des infos de la formation)
            return $this->redirectToRoute('showInfoSession', ['id' => $formation->getId()]);
        }

        // Affichage de la vue contenant le formulaire
        return $this->render('add_edit/addEdit.html.twig', ['form' => $form->createView(),
            'title' => $title, 'editMode' => $formation->getId() != null, 'formation' => $formation
        ]);
    }

    /**
     * @Route("/add/formateur", name="addFormateur")
     * @Route("/edit/formateur/{id}", name="editFormateur")
     */
    public function addEditFormateur(Formateur $formateur = null, ObjectManager $manager, Request $request)
    {
        if(!$formateur) {
            $formateur = new Formateur();
            $form = $this->createForm(FormateurType::class, $formateur);

            $title = 'Ajout d\'un formateur ';
        }
 
        else {
            // form edit

            $title = 'Modification du formateur '.$formateur;
         }
 
         $form->handleRequest($request);
               
         if($form->isSubmitted() && $form->isValid()) {
                
            $manager->persist($formateur);
            $manager->flush();
 
            return $this->redirectToRoute('showInfoFormateur', ['id' => $formateur->getID()]);
         }

        return $this->render('add_edit/addEdit.html.twig', ['form' => $form->createView(),
            'title' => $title, 'editMode' => $formateur->getId() != null, 'formateur' => $formateur,
        ]);
    }


    /**
     * @Route("/add/stagiaire", name="addStagiaire")
     * @Route("/edit/stagiaire/{id}", name="editStagiaire")
     */
    public function addEditStagiaire(Stagiaire $stagiaire = null, ObjectManager $manager, Request $request) {
        if(!$stagiaire) {
            $stagiaire = new Stagiaire();
            $form = $this->createForm(StagiaireType::class, $stagiaire);

            $title = "Ajout d'un stagiaire";
        }
 
        else {
            $form = $this->createForm(StagiaireType::class, $stagiaire);

            $title = 'Modification du stagiaire '.$stagiaire;
         }
 
         $form->handleRequest($request);
               
         if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($stagiaire);
            $manager->flush();
 
            return $this->redirectToRoute('showInfoStagiaire', ['id' => $stagiaire->getId()]);
         }

        return $this->render('add_edit/addEdit.html.twig', ['form' => $form->createView(),
            'title' => $title, 'editMode' => $stagiaire->getId() != null, 'stagiaire' => $stagiaire,
        ]);
    }

    /**
     * @Route("/delete/stagiaire/{id}", name="deleteStagiaire")
     */
    public function deleteStagiaire(Stagiaire $stagiaire, ObjectManager $manager) {

        $manager->remove($stagiaire);
        $manager->flush();
  
        return $this->redirectToRoute('showListeStagiaires');
  
    }

    /**
     * @Route("/add/module", name="addModule")
     * @Route("/edit/module/{id}", name="editModule")
     */
    public function addEditModule(Module $module = null, ObjectManager $manager, Request $request) {

        if(!$module) {
            $module = new Module();
            $form = $this->createForm(ModuleType::class, $module);

            $title = "Ajout d'une module";
        }
 
        else {
            $form = $this->createForm(ModuleType::class, $module);

            $title = 'Modification du module '.$module;
         }
 
         $form->handleRequest($request);
               
         if($form->isSubmitted() && $form->isValid()) {
        
            $manager->persist($module);
            $manager->flush();
 
            return $this->redirectToRoute('showListeAllCategories');
         }

         return $this->render('add_edit/addEdit.html.twig', ['form' => $form->createView(),
            'title' => $title, 'editMode' => $module->getId() != null, 'module' => $module
     ]);
    }

    /**
     * @Route("/add/categorie", name="addCategorie")
     * @Route("/edit/categorie/{id}", name="editCategorie")
     */
    public function addEditCategorie(Categorie $categorie = null, ObjectManager $manager, Request $request) {
        if(!$categorie) {
            $categorie = new Categorie();
          
            $form = $this->createForm(CategorieType::class, $categorie);

            $title = "Ajout d'une categorie";
        }
 
        else {
            $form = $this->createForm(CategorieType::class, $categorie);

            $title = 'Modification de la categorie '.$categorie;
         }
 
         $form->handleRequest($request);
               
         if($form->isSubmitted() && $form->isValid()) {
            
            $manager->persist($categorie);
            $manager->flush();
 
            return $this->redirectToRoute('showListeAllCategories');
         }

        return $this->render('add_edit/addEdit.html.twig', ['form' => $form->createView(),
            'title' => $title, 'editMode' => $categorie->getId() != null, 'categorie' => $categorie
        ]);
    }
}
