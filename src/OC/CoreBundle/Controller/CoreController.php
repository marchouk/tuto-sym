<?php

namespace OC\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    public function indexAction()
    {
        // On retourne simplement la vue de la page d'accueil
        // L'affichage des 3 dernières annonces utilisera le contrôleur déjà existant dans PlatformBundle
        return $this->render('OCCoreBundle:Core:index.html.twig');
    }
    public function contactAction()
    {

        $this->addFlash('notice', '
            La page de contact n\'est pas encore disponible, merci de revenir plus tard.');

        return $this->redirectToRoute('oc_core_homepage');

    }
}
