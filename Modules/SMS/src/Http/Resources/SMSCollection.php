<?php

namespace MODULES\SMS\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SMSCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
