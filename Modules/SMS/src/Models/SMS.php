<?php

namespace MODULES\SMS\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MODULES\SMS\Events\SMSCreated;

class SMS extends Model
{
    use HasFactory;
    const FAILED="failed";
    const SENT="sent";
    const SENDING="sending";
    protected $table="sms";
    protected $fillable=[
        "number",
        "body",
        "provider",
        "status",
        "error_message"
    ];
    protected $dispatchesEvents=[
        "created"=>SMSCreated::class
    ];
}
