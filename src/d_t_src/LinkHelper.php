<?php

namespace gs\d_t_src;

class LinkHelper {

    public static function Build (array $link_data, string $ch, $value) : string

    {
        return http_build_query(array_merge($link_data, [$ch => $value]));
    }


    public static function Build_1 (array $link_data, array $params):string

    {
        return http_build_query(array_merge($link_data, $params));
    }

}
