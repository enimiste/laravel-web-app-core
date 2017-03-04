<?php

namespace Enimiste\LaravelWebApp\Core\Business\Contracts\Report;

/**
 * This interface define the contract of report generator that will uses html as input.
 * The user of this an implementation of this interface have tow options :
 *   - From a laravel view (Blade)
 *   - From an Url
 *
 * If the tow option are setted by the user, the view one have a high level
 *
 * Interface ReportFromHtmlGeneratorInterface
 * @package Enimiste\LaravelWebApp\Core\Business\Contracts\Report
 */
interface ReportFromHtmlGeneratorInterface extends ReportGeneratorInterface
{

    /**
     * @return string
     */
    function getHtmlView();

    /**
     * @param string $view Laravel view name
     */
    function setHtmlView($view);

    /**
     * @return string
     */
    function getUrl();

    /**
     * @param string $url the url to use to get html content
     */
    function setUrl($url);

    /**
     * Generate url from data passed to generate function
     * $func Should be called before getUrl
     *
     * @param \Closure $func
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    function setUrlGenerator(\Closure $func);
}