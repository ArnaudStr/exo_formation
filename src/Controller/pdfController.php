<?php

namespace App\Controller;

use Dompdf\Dompdf;

// Include Dompdf required namespaces
use Dompdf\Options;
use App\Entity\Formation;
use App\Entity\Stagiaire;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class pdfController extends Controller
{

    /**
     * @Route("/createPdf/{id}/formation/{id_formation}", name="createPdf")
     */
    public function createPdf(Stagiaire $stagiaire, Formation $formation)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('show/diplome.html.twig', [
            'title' => "Diplôme du stagiaire ".$stagiaire." dans la formation ".$formation,
            "stagiaire"=> $stagiaire,
            "formation"=> $formation

        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
    }
}