<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nurse_status extends Model
{
    //
    protected $fillablle = ['nurse_id','status','patient_id','scheduler_id','nurse_start_time','nurse_finish_time','nurse_start_lat','nurse_start_lon','estimate_distance_to_go_patient_home','estimate_time_to_go_patient_home','current_distance_covered','distance_required','time_required'];

}
