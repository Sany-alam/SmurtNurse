<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class patient_profile extends Model
{
    //
    // protected $fillablle = ['insurance_plan','note','date_received','date_need_to_be_finished','date_need_to_be_finished','member_id','first_name','last_name','sex','date_of_birth','primary_language','cell_phone','home_phone','marital_status','email','address','city','state','zip_code','country','user_id','assesment_type','cancel','note_archvie','area','second_address','recertification','pet',];
    protected $fillablle = ['member_id',
                            'user_id',
                            'first_name',
                            'last_name',
                            'date_of_birth',
                            'medicaid_id',
                            'schedule_date',
                            'completed_within_180_days',
                            'completed_date_after_180_days',
                            'days_scheduled_to_completed_date',
                            'finalized_date',
                            'days_from_completed_to_finalize',
                            'documents_received_date',
                            'days_from_finalize_to_documents_received',
                            'disenrollment_date',
                            'deceased',
                            'adhoc',
                            'special_case',
                            'team_name',
                            'cm',
                            'sw',
                            'cell_phone',
                            'home_phone',
                            'phone_number_3',
                            'phone_number_4',
                            'address',
                            'second_address',
                            'city',
                            'state',
                            'zip_code',
                            'updates',
                            'rn',
                            'agency',
                            'primary_language',
                            'country',
                            'insurance_plan',
                            'sex',
                            'status',
                            'assesment_type',
                            'cancel',
                            'note',
                            'note_archive',
                            'recertification',
                            'pet',
                            'area',
                            'available_status'
                            ];
}
