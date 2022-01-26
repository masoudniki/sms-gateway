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
        \MODULES\SMS\Facade\SMS::send("09101490337","this is a simple text");
        return new SMSCollection(SMS::query()
            ->paginate(15)
        );
    }
    public function show(SMS $sms){
        return new SMSResource($sms);
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
