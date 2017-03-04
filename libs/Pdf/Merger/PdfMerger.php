<?php
/**
 * Created by PhpStorm.
 * User: nounielbachir
 * Date: 22/11/14
 * Time: 21:18
 */

namespace Nouni;


use Exception;
use Pdf\CommonLibraries\PdfCommonLibrariesLoader;

class PdfMerger
{
    /**
     * @var PdfCommonLibrariesLoader
     */
    protected $load;

    function __construct()
    {
        $this->loader = new PdfCommonLibrariesLoader();
        $this->init();
    }

    /**
     * @param array $files_paths array of files paths
     * @param string $o_file
     * @param int $window_size
     * @param int $index
     * @throws \Exception
     */
    public function mergeAll(array  $files_paths, $o_file, $window_size = -1, &$index = 1)
    {
        $files_chunked = $this->_chunk_files($files_paths, $window_size);

        $this->mergeChunkedFiles($files_chunked, $o_file, $index);
    }

    /**
     * @param array $chunked_files array of array each array contains a list of file path to merge in one file
     * @param string $o_file
     * @param int $index
     * @throws \Exception
     */
    public function mergeChunkedFiles(array  $chunked_files, $o_file, &$index = 1)
    {
        $merge_pdf_paths = array();

        try {
            $this->_merge_chunk($o_file, $index, $chunked_files, $merge_pdf_paths);
        } catch (\Exception $e) {
            foreach ($merge_pdf_paths as $f) {
                @unlink($f);
            }
            throw new \Exception(__FUNCTION__ . ' ' . $e->getMessage());
        }
    }

    /**
     * @param int $nbr_files
     * @param int $default_window
     * @param int $window_min_width
     * @return int
     */
    public function generateChunkWindowSize($nbr_files, $default_window, $window_min_width)
    {
        if ($nbr_files == $default_window OR $default_window < 0 OR $window_min_width > $default_window) return $nbr_files;
        if ($nbr_files % $default_window == 0) return $default_window;

        if ($nbr_files < $default_window) return $nbr_files;
        elseif ($nbr_files % $default_window < $window_min_width) {
            $pas = -10;
            if (floatval($default_window) / $nbr_files <= 0.5) $pas = 10;
            $default_window += $pas;
            return $this->generateChunkWindowSize($nbr_files, intval($default_window), $window_min_width);
        } else return $default_window;
    }

    protected function init()
    {
        $this->loader->LoadFPDF();
        $this->loader->LoadFPDI();

        ini_set('memory_limit', -1);
        ini_set('max_execution_time', -1);
    }

    /**
     * @param string $o_file
     * @param int $index integer by reference
     * @param array $files_chunked
     * @param array $merge_pdf_paths array by reference
     * @return boolean
     * @throws \Exception
     */
    protected function _merge_chunk($o_file, &$index, array  $files_chunked, array &$merge_pdf_paths)
    {
        try {
            $o_file_pathinfo = pathinfo($o_file);
            $o_file_basename = $o_file_pathinfo['filename'];
            $use_index = count($files_chunked) > 1 ? true : false;
            foreach ($files_chunked as $files) {
                $pdf = new \FPDI();
                foreach ($files as $f) {
                    $pagecount = $pdf->setSourceFile($f);
                    for ($j = 0; $j < $pagecount; $j++) {
                        $tplidx = $pdf->importPage(($j + 1)); // template index.
                        $pdf->addPage('P', 'A4');// orientation can be P|L
                        $pdf->useTemplate($tplidx, 0, 0, 0, 0, TRUE);
                    }
                }
                $o_file_path = $o_file_pathinfo['dirname'] . DIRECTORY_SEPARATOR . $o_file_basename .
                    ($use_index ? '_part' . $index : '') . '(' . count($files) . 'pages).' . $o_file_pathinfo['extension'];
                if (file_exists($o_file_path))
                    throw new \Exception('The file ' . $o_file_path . ' already exists.');

                $merge_pdf_paths[] = $o_file_path;
                $pdf->Output($o_file_path, 'F');
                $index++;
            }
        } catch (Exception $e) {
            throw new \Exception(__FUNCTION__ . ' ' . $e->getMessage());
        }
        return true;
    }

    /**
     * @param array $files_paths
     * @param int $window_size
     * @return array array of strings
     * @throws \Exception
     */
    protected function _chunk_files(array $files_paths, $window_size)
    {
        try {
            array_walk($files_paths, function ($item) {
                if (!is_string($item))
                    throw new \Exception('PdfMerger::_chunk_files the file path should be a string.');
            });

            sort($files_paths);
            if ($window_size > 0) $files_chunked = array_chunk($files_paths, $window_size, true);
            else
                $files_chunked = array($files_paths);

            return $files_chunked;
        } catch (Exception $e) {
            throw new \Exception(__FUNCTION__ . ' ' . $e->getMessage());
        }
    }


} 