<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nurse_assesment_form extends Model
{
    //

   protected $fillable = ['scheduler_id','t1_q1_answer','t1_q2_answer','t1_q3_answer','t2_q1_answer','t2_q2_answer','t2_q3_answer','narrative_note_answer'];
}
