<?php

namespace App\Transformers;

use App\Checklist;
use League\Fractal\TransformerAbstract;

class ChecklistTransformer extends TransformerAbstract
{
    public function transform(Checklist $checklist)
    {
        return [
            'type' => 'checklists',
            'id' => $checklist->id,
            'attributes' => [
                'object_domain' => $checklist->object_domain,
                'object_id' => $checklist->object_id,
                'description' => $checklist->description,
                'is_completed' => $checklist->is_completed,
                'due' => $checklist->due,
                'urgency' => $checklist->urgency,
                'completed_at' => $checklist->completed_at,
                'last_update_by' => $checklist->last_update_by,
                'update_at' => $checklist->update_at,
                'created_at' => $checklist->created_at,
            ],
            'links' => [
                'self' => self::url()
            ]
        ];
    }
}