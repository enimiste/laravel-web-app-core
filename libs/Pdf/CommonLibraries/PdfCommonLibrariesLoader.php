<?php
/**
 * Created by PhpStorm.
 * User: nounielbachir
 * Date: 23/11/14
 * Time: 14:42
 */

namespace Pdf\CommonLibraries;


class PdfCommonLibrariesLoader
{

    protected $fpdi_loaded;
    protected $fpdi_protection_loaded;
    protected $fpdf_loaded;

    function __construct()
    {
        $this->fpdf_loaded = false;
        $this->fpdi_loaded = false;
        $this->fpdi_protection_loaded = false;
    }


    /**
     * You should load first fpdf library
     *
     * @throws \Exception
     */
    public function LoadFPDI()
    {
        $this->_fpdiPrerequis();

        if (!$this->fpdi_loaded) require_once __DIR__ . '/../CommonLibraries/FPDI-1.5.2/fpdi.php';
        $this->fpdi_loaded = true;
    }

    /**
     * You should load first fpdf library
     *
     * @throws \Exception
     */
    public function LoadFPDIProtection()
    {
        $this->_fpdiPrerequis();

        if (!$this->fpdi_loaded) require_once __DIR__ . '/../CommonLibraries/FPDI_Protection.php';
        $this->fpdi_loaded = true;
    }

    /**
     * @throws \Exception
     */
    public function LoadFPDF()
    {
        if (!$this->fpdf_loaded) require_once __DIR__ . '/../CommonLibraries/fpdf17/fpdf.php';
        $this->fpdf_loaded = true;
    }

    protected function _fpdiPrerequis()
    {
        if (!$this->fpdf_loaded)
            throw new \Exception('You should load FPDF library first before FPDI');
    }
}