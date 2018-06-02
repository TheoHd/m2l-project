<?php

namespace Bundles\AppBundle\Controller;

use App;
use Core\Controller\Controller;
use Spipu\Html2Pdf\Html2Pdf;

class PdfController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!App::getUser()) {
            App::redirectToRoute('login');
        }
    }

    /**
     * @RouteName pdf_facture
     * @RouteUrl /salarie/facture
     */
    public function showPdfAction(){
        ob_start();
        $content = $this->render('appBundle:pdf:generateur',null,true);
        try{
            $pdf = new Html2Pdf('P','A4','fr');
            $pdf->writeHTML($content);
            $pdf->Output('test.pdf');

        }catch (HTML2PDF_exception $e){
            $e->getMessage();
            die($e);
        }

    }

}