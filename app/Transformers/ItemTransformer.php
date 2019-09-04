<?php

namespace App\Transformers;

use App\Item;
use League\Fractal\TransformerAbstract;

class ItemTransformer extends TransformerAbstract
{
    public function transform(Item $item)
    {
        return [
            'id' => $item->id,
            'object_domain' => $item->object_domain,
            'object_id' => $item->object_id,
            'description' => $item->description,
            'is_completed' => $item->is_completed,
            'due' => $item->due,
            'urgency' => $item->urgency,
            'completed_at' => $item->completed_at,
            'last_update_by' => $item->last_update_by,
            'update_at' => $item->update_at,
            'created_at' => $item->created_at,
        ];
    }
}