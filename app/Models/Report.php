<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public static $report_rule = [
        'target_content_id' => 'required',
        'report_content' => 'required',
    ];
}
