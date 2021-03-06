<?php

use Illuminate\Database\Eloquent\Builder;
use AidynMakhataev\EloquentJsonMacros\EloquentJsonMacros;

/*
 * Add an orWhere "json_contains_path" clause to the query.
 *
 * @param string $column
 * @param mixed $path
 * @param string $oneOrAll
 *
 * @return Builder
 */
Builder::macro('orWhereJsonContainsPath', function ($column, $path, $oneOrAll = 'one') {
    if (is_array($path)) {
        foreach ($path as $key => $item) {
            $path[$key] = "'".EloquentJsonMacros::formatJsonPath($item)."'";
        }
        $path = implode(',', $path);
    } else {
        $path = "'".EloquentJsonMacros::formatJsonPath($path)."'";
    }

    return $this->orWhereRaw("JSON_CONTAINS_PATH($column, '$oneOrAll', $path)");
});
