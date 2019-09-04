<?php

namespace App\Libraries;

class Helpers
{
    public static function myTransformer($data, $options = null)
    {
        if ($data) {
            $total = count($data);
            $limit = (int) $options['limit'];
            $page = (int) $options['page'];
            $url = $options['url'];

            $links = null;
            if ($options['pagination'] == true) {
                $maxPage = 0;
                // $maxPage = ceil($total / $limit);

                $prev = null;
                $next = null;

                if ($page > 0 && $page < $maxPage) {
                    $prev = (int) $page - 1;
                    $next = (int) $page + 1;
                }

                $links = [
                    'first' => $url . '?limit=' . $limit . '&page=' . $page,
                    'last' => $url . '?limit=' . $limit . '&page=' . $page,
                    'prev' => $prev,
                    'next' => $next,
                ];    
            }    

            $response = [
                'meta' => [
                    'total' => $total
                ],
                'data' => $data,
                'links' => $links
            ];

            return response()->json($response);
        } else {
            return response()->json([
                'status' => 404,
                'error' => 'Not found'
            ]);
        }
    }

    public static function singleTransformer($data, $options = null)
    {
        if (!empty($data)) {
            $attributes = [];
            foreach ($data as $key => $value) {
                if ($key != 'id')
                    $attributes[$key] = $value;
            }

            $response = [
                'data' => [
                    'type' => 'history',
                    'id' => is_array($data) ? $data['id'] : $data->id,
                    'attributes' => $attributes,
                    'links' => [
                        'self' => $options ? $options['url'] : ''
                    ]
                ]
            ];

            return response()->json($response);
        } else {
            return response()->json([
                'status' => 404,
                'error' => 'Not found'
            ]);
        }
    }
}