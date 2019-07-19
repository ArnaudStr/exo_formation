<?php

namespace App\Controller;

use App\Form\StagiaireType;
use App\Entity\Module;
use App\Form\ModuleType;
use App\Entity\Categorie;
use App\Entity\Formateur;
use App\Entity\Formation;
use App\Entity\Stagiaire;
use App\Form\CategorieType;
use App\Form\FormateurType;
use App\Form\FormationType;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddEditController extends AbstractController {

    /**
     * @Route("/add/formation", name="addFormation")
     * @Route("/edit/formation/{id}", name="editFormation")
     */
    public function addEditFormation(Formation $formation = null, ObjectManager $manager, Request $request) {

        // Ajout d'une formation
        if(!$formation) {
            $formation = new Formation();
            $title = 'Ajout d\'une formation ';
            $module1 = new Module();
            $module1->setNom('Module1');
            $module2 = new Module();
            $module2->setNom('Module2');
        }

 
        // Modification d'une formation
        else {
            $title = 'Modification dd la formation '.$formation;
        }
 
        // creation du formulaire (ajout ou modification)
        $form = $this->createForm(FormationType::class, $formation);

        // Pour le contrôle des données entrées dans le formulaire
        $form->handleRequest($request);
               
        // Validation du formulaire
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
     * @Route("/delete/formation/{id}", name="deleteFormation")
     */
    public function deleteFormation(Formation $formation, ObjectManager $manager) {

        $manager->remove($formation);
        $manager->flush();
  
        return $this->redirectToRoute('showListeFormations');
    }

    /**
     * @Route("/add/formateur", name="addFormateur")
     * @Route("/edit/formateur/{id}", name="editFormateur")
     */
    public function addEditFormateur(Formateur $formateur = null, ObjectManager $manager, Request $request) {
        
        if(!$formateur) {
            $formateur = new Formateur();
            $title = 'Ajout d\'un formateur';
        }
 
        else {
            $title = 'Modification du formateur '.$formateur;
        }

        $form = $this->createForm(FormateurType::class, $formateur);
 
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
     * @Route("/delete/formateur/{id}", name="deleteFormateur")
     */
    public function deleteFormateur(Formateur $formateur, ObjectManager $manager) {

        $manager->remove($formateur);
        $manager->flush();
  
        return $this->redirectToRoute('showListeFormateurs');
    }



    /**
     * @Route("/add/stagiaire", name="addStagiaire")
     * @Route("/edit/stagiaire/{id}", name="editStagiaire")
     */
    public function addEditStagiaire(Stagiaire $stagiaire = null, ObjectManager $manager, Request $request) {
       
        if(!$stagiaire) {
            $stagiaire = new Stagiaire();
            $title = "Ajout d'un stagiaire";
        }
 
        else {
            $title = 'Modification du stagiaire '.$stagiaire;
         }

        $form = $this->createForm('App\Form\StagiaireType', $stagiaire);

        $form->handleRequest($request);
               
        if($form->isSubmitted() && $form->isValid()) {

            $formateurs = $form->get('formations')->getData();

            $manager->persist($stagiaire);
            $manager->flush();
 
            return $this->redirectToRoute('showInfoStagiaire', ['id' => $stagiaire->getId()]);
        }

        return $this->render('add_edit/addStagiaire.html.twig', ['form' => $form->createView(),
            'title' => $title, 'editMode' => $stagiaire->getId() != null, 'stagiaire' => $stagiaire,
        ]);

        // return $this->render('add_edit/addEdit.html.twig', ['form' => $form->createView(),
        //     'title' => $title, 'editMode' => $stagiaire->getId() != null, 'stagiaire' => $stagiaire,
        // ]);
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
            $title = "Ajout d'une module";
        }
 
        else {
            $title = 'Modification du module '.$module;
        }

        $form = $this->createForm(ModuleType::class, $module);
 
        $form->handleRequest($request);
               
        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($module);
            $manager->flush();
 
            return $this->redirectToRoute('showListeModules');
        }

         return $this->render('add_edit/addEdit.html.twig', ['form' => $form->createView(),
            'title' => $title, 'editMode' => $module->getId() != null, 'module' => $module
     ]);
    }

    /**
     * @Route("/delete/module/{id}", name="deleteModule")
     */
    public function deleteModule(Module $module, ObjectManager $manager) {

        $manager->remove($module);
        $manager->flush();
  
        return $this->redirectToRoute('showListeModules');
    }


    /**
     * @Route("/add/categorie", name="addCategorie")
     * @Route("/edit/categorie/{id}", name="editCategorie")
     */
    public function addEditCategorie(Categorie $categorie = null, ObjectManager $manager, Request $request) {
        if(!$categorie) {
            $categorie = new Categorie();
            $title = "Ajout d'une categorie";
        }
 
        else {
            $title = 'Modification de la categorie '.$categorie;
        }
 
        $form = $this->createForm(CategorieType::class, $categorie);
        
        $form->handleRequest($request);
               
        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($categorie);
            $manager->flush();
 
            return $this->redirectToRoute('showListeModules');
        }

        return $this->render('add_edit/addEdit.html.twig', ['form' => $form->createView(),
            'title' => $title, 'editMode' => $categorie->getId() != null, 'categorie' => $categorie
        ]);
    }

    /**
     * @Route("/delete/categorie/{id}", name="deleteCategorie")
     */
    public function deleteCategorie(Categorie $categorie, ObjectManager $manager) {

        $manager->remove($categorie);
        $manager->flush();
  
        return $this->redirectToRoute('showListeCategories');
    }

}
