<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\nurse_profile;
use App\patient_profile;
use App\nurse_status;
use App\nurse_assesment_form;
use App\nurse_assesment_form_error;
use DB;


class ExaminerController extends Controller
{

    public function nurse_assesment_form_value(Request $request)
    {
        $scheduler_id = $request->scheduler_id;
        $answer = nurse_assesment_form::where('scheduler_id','=',$scheduler_id)->first();
        $question = DB::table('dummy_question')->first();




            $data='<tr>
               <td>'.$question->t1_q1.' </td>
               <td colspan="4">'.$answer->t1_q1_answer.'</td>
               <td class="test"> <input type="checkbox" class="form-check-input checkbox edit_form_field"  value="t1_q1"></td>
            </tr>

            <tr>
               <td>'.$question->t1_q2.' </td>
               <td colspan="4">'.$answer->t1_q2_answer.'</td>
               <td> <input type="checkbox" class="form-check-input checkbox edit_form_field"  value="t1_q2"></td>
            </tr>




            <tr>
               <td>'.$question->t1_q3.' </td>
               <td colspan="4">'.$answer->t1_q3_answer.'</td>
               <td> <input type="checkbox" class="form-check-input checkbox edit_form_field"  value="t1_q3"></td>
            </tr>

            <tr>
               <td>'.$question->t2_q1.' </td>
               <td colspan="4">'.$answer->t2_q1_answer.'</td>
               <td> <input type="checkbox" class="form-check-input checkbox edit_form_field"  value="t2_q1"></td>
            </tr>

            <tr>
               <td>'.$question->t2_q2.' </td>
               <td colspan="4">'.$answer->t2_q2_answer.'</td>
               <td> <input type="checkbox" class="form-check-input checkbox edit_form_field"  value="t2_q2"></td>
            </tr>

            <tr>
               <td>'.$question->t2_q2.' </td>
               <td colspan="4">'.$answer->t2_q2_answer.'</td>
               <td> <input type="checkbox" class="form-check-input checkbox edit_form_field"  value="t2_q3"></td>
            </tr>

            <tr>
               <td>'.$question->narrative_question.' </td>
               <td colspan="4">'.$answer->narrative_note_answer.'</td>
               <td> <input type="checkbox" class="form-check-input checkbox edit_form_field"  value="t2_q3"></td>
            </tr>

            <tr id="error_text_field">
                     <td colspan="6">
                     <label for="exampleTextarea1">Edit Note</label>
                      <textarea class="form-control" id="error_text" rows="5"></textarea>
                      </td>
                  </tr>





            ';
            return $data;




    }

    public function send_nurse_form_error(Request $request)
    {
       $scheduler_id = $request->scheduler_id;
       $error_question_list = $request->error_question_list;
       $error_note = $request->error_text;
       nurse_assesment_form_error::create(['scheduler_id'=>$scheduler_id,'question_no'=>$error_question_list,'error_note'=>$error_note]);

       nurse_status::where('scheduler_id','=',$scheduler_id)->update(['status'=>'6']);


    }

    public function accept_nurse_assesment_form(Request $request)
    {
$scheduler_id = $request->scheduler_id;
nurse_assesment_form::where('scheduler_id','=',$scheduler_id)->update(['status'=>1]);
nurse_status::where('scheduler_id','=',$scheduler_id)->update(['status'=>'5']);


    }

    public function nurse_progression_list ()
    {
        $nurse_status = nurse_status::get();
    //   $array_size = sizeof($nurse_status);
    //   file_put_contents('test.txt',$nurse_status[0]->nurse_id);
        $nurse_lists = array();

        for($i=0;$i<sizeof($nurse_status);$i++)
        {
            $nurse_id = $nurse_status[$i]->nurse_id;
            $nurse_name = nurse_profile::where('id','=',$nurse_id)->first()->name;
            $nurse_email = nurse_profile::where('id','=',$nurse_id)->first()->email_address;
            $nurse_phone_number = nurse_profile::where('id','=',$nurse_id)->first()->phone_number;
            if($nurse_status[$i]->nurse_finish_time)
            {
               $status = 'completed';
               $nurse_progression = 100;
            }
            else
            {
                $status = 'running';
                $estimate_distance_to_go_patient_home =$nurse_status[$i]->estimate_distance_to_go_patient_home;
                $current_distance_covered = $nurse_status[$i]->current_distance_covered;
                $nurse_progression = ceil(($current_distance_covered/$estimate_distance_to_go_patient_home)*100);


            }
            $nurse_assesment_form = nurse_assesment_form::where('scheduler_id','=',$nurse_status[$i]->scheduler_id)->first();

            if($nurse_assesment_form)
            {
                if($nurse_assesment_form->status == 0)
                {
                    $assesment_form_confirmation = 'Not Accepted';

                }
                else
                {
                    $assesment_form_confirmation = 'Accepted';
                }

                $form = $nurse_status[$i]->scheduler_id;

            }
            else
            {
                $assesment_form_confirmation = 'Form Not Submitted';
                $form = 'Form Not Available';
            }


            array_push($nurse_lists,array('nurse_name'=>$nurse_name,'nurse_email'=>$nurse_email,'nurse_phone_number'=>$nurse_phone_number,'nurse_status'=>$status,'nurse_progression'=>$nurse_progression,'assesment_form_confirmation'=>$assesment_form_confirmation,'form'=>$form));

        }

     //$nurse_list = (object)$nurse_lists;

     $nurse_lists = json_decode(json_encode((object) $nurse_lists), FALSE);
    // file_put_contents('test.txt',$nurse_lists);






        return view('examiner.nurse_progress_list', ['nurse_lists' => $nurse_lists]);
    }

}
