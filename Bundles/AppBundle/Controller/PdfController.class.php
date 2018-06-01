<?php

namespace Bundles\AppBundle\Controller;

use Core\Controller\Controller;
use Spipu\Html2Pdf\MyPdf;

class PdfController extends Controller
{
    public function __construct()
    {
        parent::__construct();

//        if (!App::getUser()) {
//            App::redirectToRoute('login');
//        }
    }

    /**
     * @RouteName pdf_facture
     * @RouteUrl /salarie/facture
     */
    public function showPdfAction(){
        ob_start();
        $this->render('appBundle:pdf:generateur');
        $content = ob_get_clean();
        try{
            $pdf = new MyPdf('P','A4','fr');
            $pdf->writeHTML($content);
            $pdf->Output('test.pdf');

        }catch (HTML2PDF_exception $e){
            $e->getMessage();
            die($e);
        }

    }

}