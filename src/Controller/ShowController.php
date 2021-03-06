<?php

namespace App\Controller;

use App\Entity\Module;
use App\Entity\Categorie;
use App\Entity\Formateur;
use App\Entity\Formation;
use App\Entity\Stagiaire;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShowController extends AbstractController {

    /**
     * @Route("/", name="showListeFormations")
     */
    public function showListeFormations() {
        // On enregistre les formations
        $all_formations = $this->getDoctrine()->getRepository(Formation::class)->findAll();

        // Appel à la vue d'affichage des formations
        return $this->render('show/listeFormations.html.twig', [
            'title' => 'Liste des formations',
            'formations' => $all_formations
        ]);
    }

    /**
     * @Route("/show/infoSession/{id}", name="showInfoSession")
     */
    public function showInfoSession(Formation $formation, ObjectManager $manager, Request $request){

        return $this->render('show/infoSession.html.twig', [
            'title' => 'Informations de la formation '.$formation,
            'formation' => $formation
        ]);
    }

    /**
     * @Route("/show/listeStagiaires", name="showListeStagiaires")
     */
    public function showListeStagiaires() {

        $all_stagiaires = $this->getDoctrine()->getRepository(Stagiaire::class)->findAll();

        return $this->render("show/listePersonnes.html.twig", [
            'title' => 'Liste des stagiaires',
            'stagiaires' => $all_stagiaires
        ]);
    }

    /**
     * @Route("/show/infoStagiaire/{id}", name="showInfoStagiaire")
     */
    // public function showInfoStagiaire(Stagiaire $stagiaire, ObjectManager $manager, Request $request) {
    public function showInfoStagiaire(Stagiaire $stagiaire) {

        return $this->render('show/infoStagiaireFormateur.html.twig', [
            'title' => 'Informations du stagiaire '.$stagiaire,
            'stagiaire' => $stagiaire
        ]);
    }

    /**
     * @Route("/show/listeFormateurs", name="showListeFormateurs")
     */
    public function showListeFormateurs() {

        $all_formateurs = $this->getDoctrine()->getRepository(Formateur::class)->findAll();

        return $this->render("show/listePersonnes.html.twig", [
            'title' => 'Liste des formateurs',
            'formateurs' => $all_formateurs
        ]);
    }

    /**
     * @Route("/show/infoFormateur/{id}", name="showInfoFormateur")
     */
    public function showInfoFormateur(Formateur $formateur, ObjectManager $manager, Request $request) {

        return $this->render('show/infoStagiaireFormateur.html.twig', [
            'title' => 'Informations du formateur '.$formateur,
            'formateur' => $formateur
        ]);
    }

    /**
     * @Route("/show/listeModules", name="showListeModules")
     */
    public function showListeModules() {
        // On récupere toutes les categories et donc tous les modules
        $all_categories = $this->getDoctrine()->getRepository(Categorie::class)->findAll();

        return $this->render('show/listeModules.html.twig', [
            'title' => 'Liste de tous les modules',
            'categories' => $all_categories
        ]);
    }

    /**
     * @Route("/show/infoCategorie/{id}", name="showInfoCategorie")
     */
    public function showInfoCategorie(Categorie $categorie, ObjectManager $manager, Request $request) {

        return $this->render('show/infoCategorie.html.twig', [
            'title' => 'Informations de la  categorie '.$categorie,
            'categorie' => $categorie
        ]);
    }

    /**
     * @Route("/show/calendar", name="session_calendar")
     */
    public function calendar() {
        return $this->render('show/calendar.html.twig', [
            'title' => 'Planning'
        ]);
    }
}
