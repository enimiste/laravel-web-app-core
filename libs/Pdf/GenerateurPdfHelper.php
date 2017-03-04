<?php
namespace NickelIt;

use Com\Nouni\Nextbilling\PdfGenerationTrait;
use HTML2PDF;

class GenerateurPdfHelper {

	use PdfGenerationTrait;

    /**
     * Generate a pdf file from data and an HTML template to a destination output file
     * If the output file exists it will be removed before generation.
     *
     * @param HTML2PDF $lib
     * @param array $data
     * @param $pdf_template_fullpath
     * @param callable $output_filepath_func
     * @return string pdffilepath
     * @throws \Exception
     */
	public function generate(HTML2PDF $lib, array $data, $pdf_template_fullpath, callable $output_filepath_func){
		if(!file_exists($pdf_template_fullpath))
			throw new \Exception(sprintf('Template file [%s] not found', $pdf_template_fullpath));

		$this->html_pdf_lib = $lib;

		return $this->generate_pdf($data, $output_filepath_func, function($data) use($pdf_template_fullpath) {
			return $pdf_template_fullpath;
		});
	}
}