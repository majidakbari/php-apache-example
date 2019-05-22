<?php

if (!function_exists('get_class_name')) {
    function get_class_name($object)
    {
        $output = get_class($object);

        return substr($output, strrpos($output, '\\') + 1);
    }
}


if (!function_exists('filter_array')) {
    function filter_array($data, $rules)
    {
        return array_intersect_key($data, array_flip($rules));
    }
}

if (!function_exists('get_paginate_params')) {
    function get_paginate_params(\Illuminate\Http\Request $request)
    {
        $perPage = $request->get('perPage');
        $page    = $request->get('page');

        if (empty($perPage) || is_array($perPage) || is_object($perPage) || intval($perPage) < 0 || intval($perPage) > 100) {
            $perPage = 10;
        }
        if (empty($page) || is_array($page) || is_object($page) || (intval($page) < 0)) {
            $page = 1;
        }

        return ['perPage' => (int)$perPage, 'page' => (int)$page];
    }
}
