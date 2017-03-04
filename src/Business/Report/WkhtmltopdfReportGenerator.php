<?php

namespace Enimiste\LaravelWebApp\Core\Business\Report;


use Enimiste\LaravelWebApp\Core\Business\Contracts\Report\ReportFromHtmlGeneratorInterface;
use Enimiste\LaravelWebApp\Core\Exception\BusinessException;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

class WkhtmltopdfReportGenerator implements ReportFromHtmlGeneratorInterface
{

    /** @var  string */
    protected $view;

    /** @var  string */
    protected $url;
    /** @var  \Closure */
    protected $urlFunc;

    /**
     * WkhtmltopdfReportGenerator constructor.
     */
    public function __construct()
    {
        //Begin : Function neutral
        $obj = $this;
        $this->urlFunc = function (array $data) use ($obj) {
            return $obj->url;
        };
        //End : Function neutral
    }

    /**
     * @return string
     */
    function getHtmlView()
    {
        return $this->view;
    }

    /**
     * @param string $view Laravel view name
     */
    function setHtmlView($view)
    {
        $this->view = $view;
    }

    /**
     * @return string
     */
    function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url the url to use to get html content
     */
    function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @param array $data data to passe to view
     * @return string path to the generated file
     *
     * @throws BusinessException
     */
    function generate(array $data = [])
    {
        $wkhtmltopdf_exec = env('WKHTMLTOPDF_EXEC_PATH');
        if (!$this->commandExist($wkhtmltopdf_exec)) {
            throw new BusinessException('Can\'t find ' . $wkhtmltopdf_exec . ' command. It should be defined using the Env variable WKHTMLTOPDF_EXEC_PATH');
        }

        $tmpFile = sys_get_temp_dir() . '/' . time() . '_' . mt_rand(1, 10000) . '.pdf';
        $builder = new ProcessBuilder();
        $builder->setPrefix($wkhtmltopdf_exec);

        $this->setUrl(call_user_func($this->urlFunc, $data));//Required here before getUrl()
        $cmd = $builder
            ->setArguments(array($this->getUrl(), $tmpFile))
            ->getProcess()
            ->getCommandLine();

        $process = new Process($cmd);
        $process->setTimeout(120);
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw BusinessException::from(new ProcessFailedException($process));
        }

        return $tmpFile;

    }

    /**
     * @param $cmd
     *
     * @return bool
     * @source http://stackoverflow.com/questions/12424787/how-to-check-if-a-shell-command-exists-from-php
     */
    function commandExist($cmd)
    {
        $returnVal = shell_exec("which $cmd");

        return (empty($returnVal) ? false : true);
    }

    /**
     * Generate url from data passed to generate function
     * Should be called before getUrl
     *
     * @param \Closure $func
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    function setUrlGenerator(\Closure $func)
    {
        $this->urlFunc = $func;
    }
}