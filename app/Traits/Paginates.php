<?php
/**
 * Created by PhpStorm.
 * User: raoni
 * Date: 12/03/18
 * Time: 16:47
 */

namespace App\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait Paginates
{
    protected $pageSizeDefault = 15;
    protected $pageNumberKey = 'page.number';
    protected $pageSizeKey = 'page.size';

    /**
     * @param Builder $query
     * @return LengthAwarePaginator
     */
    protected function paginate(Builder $query, Request $request): LengthAwarePaginator
    {
        //$request = app('request');

        $size = $request->input($this->pageSizeKey, $this->pageSizeDefault);

        $paginator = $query->paginate($size, ['*'], $this->pageNumberKey);
        $paginator->appends(array_except($request->input(), $this->pageNumberKey));

        return $paginator;
    }

}