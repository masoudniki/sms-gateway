<?php

namespace MODULES\SMS\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SMSResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "id"=>$this->id,
            "number"=>$this->number,
            "body"=>$this->body,
            "status"=>$this->status
        ];
    }
}
