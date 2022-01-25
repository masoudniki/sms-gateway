<?php

namespace MODULES\SMS\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMS extends Model
{
    use HasFactory;
    protected $table="sms";
    protected $fillable=[
        "number",
        "body",
        "provider",
        "status",
        "error_message"
    ];
}
