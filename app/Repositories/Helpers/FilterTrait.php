<?php

namespace App\Repositories\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;

trait FilterTrait
{
    public function filterPaginate(
        $query,
        $limit = null,
        $searchConditions = [],
        $sortConditions = [],
        $searchable = [],
        $sortable = [],
        $columns = ['*']
    ) {
        foreach ($searchConditions as $key => $value) {
            if (!isset($searchable[$key])) {
                continue;
            }

            call_user_func($searchable[$key], $query, $value);
        }

        $validDirections = ['ASC', 'DESC'];
        foreach ($sortConditions as $key => $value) {
            if (!isset($sortable[$key])) {
                continue;
            }

            if (is_string($sortable[$key])) {
                if ($sortable[$key] !== 'sortByDbField' || !in_array(strtoupper($value), $validDirections)) {
                    continue;
                }

                $query->orderBy($key, $value);
            } else {
                call_user_func($sortable[$key], $query, $value);
            }
        }

        if ($limit) {
            return $query->paginate($limit, $columns);
        }

        $results = $query->get($columns);
        $total = $results->count();

        return new LengthAwarePaginator($results, $total, $total ?: 1, 1);
    }
}
