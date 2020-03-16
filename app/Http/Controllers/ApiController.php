<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nurse_profile;
use App\nurse_scheduler;
use App\patient_profile;
use App\distance_table;
use App\nurse_status;
use App\nurse_assesment_form;
use App\nurse_assesment_form_error;

class ApiController extends Controller
{
    //


    public function distance($lat1,$lon1,$lat2,$lon2)
    {
        $curl = curl_init();

curl_setopt_array($curl, array(
    //CURLOPT_URL => "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=Washington%2CDC&destinations=New%20York%20City%2CNY&key=AIzaSyAXhRPj6NklgCWF5h8Gn-nptIFXX0jpVhE",
 CURLOPT_URL =>'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins='.$lat1.','.$lon1.'&destinations='.$lat2.','.$lon2.'&key=AIzaSyAXhRPj6NklgCWF5h8Gn-nptIFXX0jpVhE',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",

));

$distance = curl_exec($curl);
//file_put_contents('test.txt',$distance);
 $distance_arr = json_decode($distance);
        $elements = $distance_arr->rows[0]->elements;
        $distance = $elements[0]->distance->text;
        $duration = $elements[0]->duration->text;
        $distance = explode(" ",$distance);

        $total_distance = $distance[0];

        $duration = explode(' ',$duration);
          if (sizeof($duration)>2) {
              $total_duration = $duration[0]*60 + $duration[2];
          }
          else{
              $total_duration = $duration[0];
          }

        $arr = ['distance'=>$total_distance,
                  'duration'=>$total_duration];
                  return $arr;

$err = curl_error($curl);

curl_close($curl);


    }
    public function submit_nurse_form(Request $request)
    {
        //file_put_contents('submit_nurse_form.txt',json_encode($request->all()));
        $scheduler_id = $request->scheduler_id;
        $narrative_note = $request->narrative_note;
        $t1_q1 = $request->t1_q1;
        $t1_q2 = $request->t1_q2;
        $t1_q3 = $request->t1_q3;
        $t2_q1 = $request->t2_q1;
        $t2_q2 = $request->t2_q2;
        $t2_q3 = $request->t2_q3;

        nurse_assesment_form::create(['scheduler_id'=>$scheduler_id,'narrative_note_answer'=>$narrative_note,'t1_q1_answer'=>$t1_q1,'t1_q2_answer'=>$t1_q2,'t1_q3_answer'=>$t1_q3,'t2_q1_answer'=>$t2_q1,'t2_q2_answer'=>$t2_q2,'t2_q3_answer'=>$t2_q3]);
        //nurse_assesment_form::create($request->all());



        nurse_status::where('scheduler_id','=',$scheduler_id)->update(['status'=>'3']);
         return response()->json(['response'=>'ok']);
    }

     public function submit_nurse_form_not_available(Request $request)
    {
        //file_put_contents('submit_nurse_form_not_available.txt',json_encode($request->all()));
        $scheduler_id = $request->scheduler_id;

        nurse_status::where('scheduler_id','=',$scheduler_id)->update(['status'=>'4']);
         return response()->json(['response'=>'ok']);
    }
    public function nurse_current_distance_update(Request $request)
    {
        $nurse_current_lat = $request->nurse_current_lat;
        $nurse_current_lon = $request->nurse_current_lon;
        $nurse_status_id =$request->nurse_status_id;

         $nurse_start_lat = nurse_status::where('id','=',$nurse_status_id)->first()->nurse_start_lat;
        $nurse_start_lon = nurse_status::where('id','=',$nurse_status_id)->first()->nurse_start_lon;

         $distance_duration_array = $this->distance($nurse_start_lat,$nurse_start_lon,$nurse_current_lat,$nurse_current_lon);

         $current_distance_covered = $distance_duration_array['distance'];

          if(nurse_status::where('id','=',$nurse_status_id)->update(['current_distance_covered'=>$current_distance_covered]))

         {
              return response()->json(['response'=>'ok']);
         }
         else
         {
             return response()->json(['response'=>'not_ok']);
         }


    }
    public function nurse_finish(Request $request)
    {
        date_default_timezone_set('Asia/Dhaka');
        $scheduler_id =$request->scheduler_id;
        nurse_scheduler::where('id','=',$scheduler_id)->update(['status'=>'Completed']);
        $nurse_finish_lat =22.367727;//$request->nurse_finish_lat;
        $nurse_finish_lon =91.832673;//$request->nurse_finish_lon;

        $nurse_finish_time = date("H:i:s");

        $nurse_start_lat = nurse_status::where('scheduler_id','=',$scheduler_id)->first()->nurse_start_lat;
        $nurse_start_lon = nurse_status::where('scheduler_id','=',$scheduler_id)->first()->nurse_start_lon;

         $distance_duration_array = $this->distance($nurse_start_lat,$nurse_start_lon,$nurse_finish_lat,$nurse_finish_lon);

         $distance_required = $distance_duration_array['distance'];
         $time_required = $distance_duration_array['duration'];

         if(nurse_status::where('scheduler_id','=',$scheduler_id)->update(['nurse_finish_time'=>$nurse_finish_time,'distance_required'=>$distance_required,'time_required'=>$time_required]))

         {
             nurse_status::where('scheduler_id','=',$scheduler_id)->update(['status'=>2]);
              return response()->json(['response'=>'ok']);
         }
         else
         {
             return response()->json(['response'=>'not_ok']);
         }







    }
    public function get_status(Request $request)
    {
        $scheduler_id = $request->scheduler_id;
        $nurse_status = nurse_status:: where('scheduler_id','=',$scheduler_id)->first();
       // $status = 6;
        if($nurse_status)
        {
        $status = $nurse_status->status;


        }
        else
        {
            $status = 0;
        }

        if($status == 6)
        {
             $answer = nurse_assesment_form::where('scheduler_id','=',$scheduler_id)->first();
             $nurse_error = nurse_assesment_form_error::where('scheduler_id','=',$scheduler_id)->first();
             $error_question_no = explode(',',$nurse_error->question_no);
             $question_key = array('t1_q1','t1_q2','t1_q3','t2_q1','t2_q2','t2_q3','narrative_note');

             $error = array();

             for($i=0;$i<sizeof($question_key);$i++)
             {
                 $key_name = $question_key[$i];
                 $key = $key_name.'_answer';
                 $key_answer = $answer->$key;
                 if(in_array($key_name,$error_question_no))
                 {
                     $error_status = 'yes';
                 }
                 else{
                     $error_status = 'no';
                 }
                 array_push($error,['keyword'=>$key_name,'value'=>$key_answer,'status'=>$error_status]);

             }

             return response()->json(['form_field'=>$error,'error_note'=>$nurse_error->error_note,'status'=>$status]);

             //file_put_contents('test.txt',json_encode($error));


        }

        return response()->json(['status'=>$status]);

    }
     public function nurse_start(Request $request)
    {
        date_default_timezone_set('Asia/Dhaka');

        $scheduler_id = $request->scheduler_id;
        nurse_scheduler::where('id','=',$scheduler_id)->update(['status'=>'Running']);
        $nurse_id = nurse_scheduler::where('id','=',$scheduler_id)->first()->nurse_id;
        $patient_id = nurse_scheduler::where('id','=',$scheduler_id)->first()->patient_id;

        $nurse_start_lat = $request->nurse_start_lat;
        $nurse_start_lon = $request->nurse_start_lon;
        $patient_lat = 22.359069;//distance_table::where('patient_id','=',$patient_id)->first()->patient_lat;
        $patient_lon = 91.821216;//distance_table::where('patient_id','=',$patient_id)->first()->patient_lon;
      $distance_duration_array = $this->distance($nurse_start_lat,$nurse_start_lon,$patient_lat,$patient_lon);
        $nurse_estimate_distance_to_go_patient_home = 5;//$distance_duration_array['distance'];
        $nurse_estimate_time_to_go_patient_home =6;// $distance_duration_array['duration'];
        $nurse_start_time = date("H:i:s");
        $nurse_status = new nurse_status();

        $nurse_status->nurse_id = $nurse_id;
        $nurse_status->patient_id = $patient_id;
        $nurse_status->scheduler_id = $scheduler_id;
        $nurse_status->nurse_start_time = $nurse_start_time;
        $nurse_status->nurse_start_lat = $nurse_start_lat;
        $nurse_status->nurse_start_lon = $nurse_start_lon;
        $nurse_status->estimate_distance_to_go_patient_home = $nurse_estimate_distance_to_go_patient_home;
        $nurse_status->estimate_time_to_go_patient_home = $nurse_estimate_time_to_go_patient_home;
        $nurse_status->status = 1;
        $nurse_status->save();
        $nurse_status_id = $nurse_status->id;

        //file_put_contents('nurse_start_test.txt',$nurse_id." ".$patient_id." ".$nurse_start_lat." ".$nurse_start_lon." ".$patient_lat." ".$patient_lon);
        return response()->json(['response'=>'ok']);

    }
    public function login(Request $reuqest)
    {

       // return 'hello';
        $phone_number = $reuqest->msisdn;
        $password = $reuqest->password;

        $is_avail = nurse_profile::where('phone_number','=',$phone_number)->first();

       // file_put_contents('test.txt',$phone_number." ".$password." ".$is_avail);
        if($is_avail)
        {
            $name = $is_avail->name;
            // $image = $is_avail->user_id;
            $image = 'http://www.quiz-hunt.com/smart_nurse/image/nurse_image/'.$is_avail->id.".jpg";
            return response()->json(['error'=>'no','name'=>$name,'image'=>$image,'address'=>$is_avail->address,'user_id'=>$is_avail->id,'working_day'=>$is_avail->prefered_days,'email'=>$is_avail->email_address]);
        }
        else{
            return response()->json(['error'=>'yes']);
        }
    }

    public function get_schedule(Request $request)
    {
         //date_default_timezone_set('Asia/Dhaka');
         $date = $request->date;
         $date2 = explode("-",$date);
         $month = $date2[1];
         if(strlen($month)==1)
         {
             $month ="0".$month;
         }
         $date = $date2[0]."-".$month."-".$date2[2];

        $nurse_id = $request->user_id;
        $appointment = nurse_scheduler::where('nurse_id','=',$nurse_id)->where('appointed_date','=',$date)->where('cancle','=','no')->get();
        $appointment_list = array();

        if($appointment->isEmpty())
        {
            //return $date;
            return json_encode($appointment_list);
        }
        else
        {
            for($i = 0 ;$i<sizeof($appointment);$i++)
            {
                $patient_id = $appointment[$i]->patient_id;
                $patient = patient_profile::where('id','=',$patient_id)->first();
                $patient_name = $patient->first_name." ".$patient->last_name;
                $address = $patient->address.",".$patient->city.",".$patient->country;
                $patient_lat = distance_table::where('patient_id','=',$patient_id)->first()->patient_lat;
                $patient_lon = distance_table::where('patient_id','=',$patient_id)->first()->patient_lon;




                array_push($appointment_list,['scheduler_id'=>$appointment[$i]->id,'p_name'=>$patient_name,'p_id'=>$patient_id,'appointment_time'=>$appointment[$i]->appointed_start_time,'lat'=>$patient_lat,'lon'=>$patient_lon,'p_address'=>$address]);
            }
            return json_encode($appointment_list);
        }


    }

      public function get_schedule_week(Request $request)
    {
         //date_default_timezone_set('Asia/Dhaka');
         date_default_timezone_set('Asia/Dhaka');
         $date = date('d-m-Y');

            $date_limit = 7;
            $date_array = array();

            $date_array[0] =$date;



            for($i = 1;$i<$date_limit;$i++)
            {
                $date1 = date('d-m-Y', strtotime($date. '+1 days'));
                $date_array [$i] = $date1;
                $date = $date1;

            }




        $nurse_id = $request->user_id;




        $total_appointment_array = array();

            for($j=0;$j<sizeof($date_array);$j++)
            {
                  $appointment = nurse_scheduler::where('nurse_id','=',$nurse_id)->where('appointed_date','=',$date_array[$j])->where('cancle','=','no')->get();
                    $appointment_list = array();

         if($appointment->isEmpty())
         {
             $appointment_list = $appointment_list;
         }
         else{
            for($i = 0 ;$i<sizeof($appointment);$i++)
            {

                $patient_id = $appointment[$i]->patient_id;
                $patient = patient_profile::where('id','=',$patient_id)->first();
                $patient_name = $patient->first_name." ".$patient->last_name;
                $address = $patient->address.",".$patient->city.",".$patient->country;
                $patient_lat = distance_table::where('patient_id','=',$patient_id)->first()->patient_lat;
                $patient_lon = distance_table::where('patient_id','=',$patient_id)->first()->patient_lon;

                array_push($appointment_list,['scheduler_id'=>$appointment[$i]->id,'p_name'=>$patient_name,'p_id'=>$patient_id,'appointment_time'=>$appointment[$i]->appointed_start_time,'lat'=>$patient_lat,'lon'=>$patient_lon,'p_address'=>$address]);
            }

            }
            array_push($total_appointment_array,['date'=>$date_array[$j],'appointment'=>$appointment_list]);
        }
            return json_encode($total_appointment_array);



    }

    public function get_schedule_today(Request $request)
    {
         date_default_timezone_set('Asia/Dhaka');
         $date = date('d-m-Y');
         $nurse_id = $request->user_id;
         //return $nurse_id;
         //return $date;

         $date2 = explode("-",$date);
         $month = $date2[1];
         if(strlen($month)==1)
         {
             $month ="0".$month;
         }
         $date = $date2[0]."-".$month."-".$date2[2];

        $appointment = nurse_scheduler::where('nurse_id','=',$nurse_id)->where('appointed_date','=',$date)->get();
        //file_put_contents('test.txt',$nurse_id);
        $appointment_list = array();

        if($appointment->isEmpty())
        {
           // return $date;
            return json_encode($appointment_list);
        }
        else
        {
            for($i = 0 ;$i<sizeof($appointment);$i++)
            {
                $patient_id = $appointment[$i]->patient_id;
                $patient = patient_profile::where('id','=',$patient_id)->first();
                $patient_name = $patient->first_name." ".$patient->last_name;
                $address = $patient->address.",".$patient->city.",".$patient->country;
                $patient_lat = distance_table::where('patient_id','=',$patient_id)->first()->patient_lat;
                $patient_lon = distance_table::where('patient_id','=',$patient_id)->first()->patient_lon;

                array_push($appointment_list,['scheduler_id'=>$appointment[$i]->id,'p_name'=>$patient_name,'p_id'=>$patient_id,'appointment_time'=>$appointment[$i]->appointed_start_time,'lat'=>$patient_lat,'lon'=>$patient_lon,'p_address'=>$address]);
            }
            return json_encode($appointment_list);
        }


    }

    public function notification(Request $request)
    {
        $nurse_id = $request->user_id;

           $appointment = nurse_scheduler::where('nurse_id','=',$nurse_id)->orderBy('id','DESC')->limit(20)->get();
        $appointment_list = array();

        if($appointment->isEmpty())
        {
           // return $date;
            return json_encode($appointment_list);
        }
        else
        {
            for($i = 0 ;$i<sizeof($appointment);$i++)
            {
                $patient_id = $appointment[$i]->patient_id;
                $patient = patient_profile::where('id','=',$patient_id)->first();
                $patient_name = $patient->first_name." ".$patient->last_name;
                $address = $patient->address.",".$patient->city.",".$patient->country;
                $patient_lat = distance_table::where('patient_id','=',$patient_id)->first()->patient_lat;
                $patient_lon = distance_table::where('patient_id','=',$patient_id)->first()->patient_lon;

                array_push($appointment_list,['p_name'=>$patient_name,'p_id'=>$patient_id,'appointment_time'=>$appointment[$i]->appointed_start_time,'lat'=>$patient_lat,'lon'=>$patient_lon,'p_address'=>$address,'appointment_date'=>$appointment[$i]->appointed_date]);
            }
            return json_encode($appointment_list);
        }


    }

    public function cancle_schedule(Request $request)
    {
        $scheduler_id = $request->scheduler_id;
       // file_put_contents('test.txt',$scheduler_id);
        nurse_scheduler::where('id','=',$scheduler_id)->update(['cancle'=>'yes']);

        $patient_id = nurse_scheduler::where('id','=',$scheduler_id)->first()->patient_id;
        patient_profile::where('id','=',$patient_id)->update(['status'=>'not_assign','cancel'=>'yes']);


        	return response()->json(['response'=>'ok']);

    }
    public function get_distance(Request $request)
    {
        $nurse_lat = $request->lat;
        $nurse_lon = $request->lon;
    }

    public function update_firebase_token(Request $request)

    {


        $user_id = $request->user_id;
        $key = $request->key;
        nurse_profile::where('id','=',$user_id)->update(['firebase_token'=>$key]);

        	return response()->json(['response'=>'ok']);


    }

    public function update_image(Request $request)
    {
        $user_id =$request->user_id;
        $image = $request->image;
        $upload_path = "image/nurse_image/".$user_id.".jpg";
         file_put_contents($upload_path,base64_decode($image));

         if(nurse_profile::where('id','=',$user_id)->update(['image'=>$upload_path]))
         {
             return  response()->json(['response'=>'ok']);
         }
         else
         {
              return response()->json(['response'=>'not_ok']);
         }


    }

    public function update_profile(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $address = $request->address;
        $user_id = $request->user_id;

        if($name)
        {
            $nurse_profile = nurse_profile::where('id','=',$user_id)->update(['name'=>$name]);
        }
        if($email)
        {
            $nurse_profile = nurse_profile::where('id','=',$user_id)->update(['email_address'=>$email]);
        }
        if($phone)
        {
            $nurse_profile = nurse_profile::where('id','=',$user_id)->update(['phone_number'=>$phone]);
        }
        if($address)
        {
            $nurse_profile = nurse_profile::where('id','=',$user_id)->update(['address'=>$address,'prefered_location'=>$address]);

        }

        if($nurse_profile)
        {
             return response()->json(['response'=>'ok']);
        }

        else
        {
              return response()->json(['response'=>'not_ok']);
        }


    }
}
