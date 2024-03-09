<?php

namespace gs\d_t_src;


class TableHelper {



        public static function sort (string $a, string $b, array $link_data): string

            {
                $sort = $link_data['sort'] ?? null;
                $direction = $link_data['dir'] ?? 'asc';
                $icon ="";
                if ($sort === $a){
                    $icon = $direction === 'asc' ? "^" : "v";
                }
                $url = LinkHelper::Build_1($link_data, [
                    'sort' => $a,
                'dir' => $direction === 'asc' && $sort === $a ? 'desc' : 'asc'
                ]);
                return <<<HTML
                    <a href="?$url">$b $icon</a>

HTML;
            }
}