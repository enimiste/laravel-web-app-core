<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 04/03/2017
 * Time: 16:10
 */

namespace Enimiste\LaravelWebApp\Core\Http\Requests\Traits;


trait PaginationAwareTrait
{
    /** @var  integer */
    protected $page = null;
    /** @var  integer */
    protected $pageSize = null;

    /**
     * @return int
     */
    public function getPage()
    {
        if ($this->page == null) {
            $page = $this->get('page');
            if (is_numeric($page)) {
                $this->page = abs(intval($page));
            } else {
                $this->page = 1;
            }

            $this->attributes->set('page', $this->page);
        }

        return $this->page;
    }

    /**
     * @return int
     */
    public function getPageSize()
    {
        if ($this->pageSize == null) {
            $pageSize = $this->get('pageSize', 100);
            if (!is_numeric($pageSize)) {
                $this->pageSize = config('PAGINATION_PAGE_SIZE', 100);
            } else {
                $this->pageSize = abs(intval($pageSize));
            }

            $this->attributes->set('pageSize', $this->pageSize);
        }

        return $this->pageSize;
    }
}