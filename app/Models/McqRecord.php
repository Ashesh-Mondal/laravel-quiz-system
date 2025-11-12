<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class McqRecord extends Model
{
    //
    function scopeWithMCQ($query)
    {
        return $query->join('mcqs', 'mcq_records.mcq_id', '=', 'mcqs.id')->select('mcqs.question', 'mcq_records.*');
    }
}
