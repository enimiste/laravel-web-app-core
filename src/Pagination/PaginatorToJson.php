<?php
namespace Enimiste\LaravelWebApp\Core\Pagination;


use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

final class PaginatorToJson
{

    /**
     * @param Paginator|LengthAwarePaginator $paginator
     * @param callable|null $mapFunc
     *
     * @return array
     */
    public static function toJson($paginator, callable $mapFunc = null)
    {
        $data = [
            "total" => "",
            "per_page" => $paginator->perPage(),
            "current_page" => $paginator->currentPage(),
            "last_page" => "",
            "next_page_url" => $paginator->nextPageUrl(),
            "prev_page_url" => $paginator->previousPageUrl(),
            "from" => $paginator->firstItem(),
            "to" => $paginator->lastItem(),
        ];
        if ($paginator instanceof LengthAwarePaginator) {
            $data['total'] = $paginator->total();
            $data['last_page'] = $paginator->lastPage();
        }
        if (is_callable($mapFunc)) {
            $data['data'] = array_map($mapFunc, $paginator->items());
        } else {
            $data['data'] = $paginator->items();
        }

        return $data;
    }
}