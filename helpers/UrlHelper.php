<?php

namespace helpers;

/**
 * Class UrlHelper
 * @package helpers
 */
class UrlHelper
{
    /**
     * @param string $field
     *
     * @return string
     */
    public static function getSortLink(string $field): string
    {
        $sort = $_GET['sort'];
        $page = $_GET['page'];

        [$column, $direction] = explode('-', $sort);

        if ($column == $field) {
            $direction = $direction == 'asc' ? 'desc' : 'asc';
        } else {
            $direction = 'desc';
        }

        return http_build_query(['sort' => $field . '-' . $direction, 'page' => $page]);
    }

    public static function getSorts()
    {
        $sortable = ['name', 'email', 'state', 'id'];
        $directions = ['asc', 'desc'];

        $sort = $_GET['sort'];

        [$field, $direction] = explode('-', $sort);

        if (!in_array($field, $sortable) || !in_array($direction, $directions)) {
            return [];
        }

        $url = http_build_query(['sort' => $field . '-' . $direction]);

        return [$field, $direction, $url];
    }
}
