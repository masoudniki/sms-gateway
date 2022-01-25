<?php

namespace MODULES\SMS\Http\Controllers;

use App\Http\Controllers\Controller;
use MODULES\SMS\Http\Requests\ValidateSubmitSMSRequest;
use MODULES\SMS\Http\Resources\SMSCollection;
use MODULES\SMS\Http\Resources\SMSResource;
use MODULES\SMS\Models\SMS;


class SMSController extends Controller
{
    public function index(){
        return response()->json(
            SMSCollection::make(SMS::query()
                ->paginate(15)
            )
        );
    }
    public function show(SMS $SMS){
        return response()->json(new SMSResource($SMS));
    }
    public function submit(ValidateSubmitSMSRequest $request){
        SMS::query()->create($request->validated());
        return response()->json([
            "data"=>[
                "message"=>__("sms::sms.your_request_submitted")
            ]
        ]);
    }
}
