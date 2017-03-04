<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 26/08/2015
 * Time: 10:59
 */

namespace Com\Nouni\Nextbilling;


use Exception;
use HTML2PDF;

trait PdfGenerationTrait
{
    /**
     * @return HTML2PDF
     */
    protected function getHTMLPDFLib()
    {
        return $this->html_pdf_lib;
    }


    /**
     * Génére le fichier PDF
     *
     * @param array $data
     * @param callable $filepath
     * @param callable $pdf_template_fullpath
     * @return string Chemin vers le fichier pdf ou NULL/FALSE en cas d'erreur
     * @throws Exception
     */
    function generate_pdf(array $data, callable $filepath, callable $pdf_template_fullpath)
    {
        $file_path = call_user_func($filepath, $data);
        $tempalte_path = call_user_func($pdf_template_fullpath, $data);
        // get the HTML
        extract($data);
        ob_start();
        require($tempalte_path);
        $content = ob_get_clean();
        // convert in PDF
        if (file_exists($file_path))
            @unlink($file_path);

        try {
            $html2pdf = $this->getHTMLPDFLib();
            $html2pdf->writeHTML($content);
            //dest : 'I', 'D', 'F', 'S', 'FI','FD'
            /*  I : send the file inline to the browser (default). The plug-in is used if available.
             *  The name given by name is used when one selects the "Save as" option on the link generating the PDF.
             *  D : send to the browser and force a file download with the name given by name.
             *  F : save to a local server file with the name given by name.
             *  S : return the document as a string. name is ignored.
             *  FI: equivalent to F + I option
             *  FD: equivalent to F + D option
             *  true  => I
             *  false => SA_ALL
             */

            $html2pdf->Output($file_path, "F");
        } catch (\Exception $ex) {
            @unlink($file_path);
            throw new \Exception("HTML2PDF ERROR :[ " . $ex->getFile() . "][" . $ex->getLine() . "][" . $ex->getMessage() . "]", 4);
        }
        return $file_path;
    }

}