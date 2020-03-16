<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\patient_profile;
use App\nurse_profile;
use DB;
use App\distance_table;
use Spatie\Geocoder\Geocoder;

class PatientController extends Controller
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
    public function cancel_schedule(Request $request)
    {
           $patient_id = $request->patient_id;
           patient_profile::where('id','=',$patient_id)->update(['availability_status'=>0]);
    }
    public function change_schedule(Request $request)
    {
        $patient_id = $request->patient_id;
        $change_date = explode(' ',$request->change_date);
        $change_date = $change_date[0].' '.$change_date[1]." ".$change_date[2].' '.$change_date[3];
        $newDate = date("d-m-Y", strtotime($change_date));
        patient_profile::where('id','=',$patient_id)->update(['re-schedule-date'=>$newDate,'availability_status'=>0]);
        //file_put_contents('test.txt',$newDate);
    //     date_default_timezone_set('Asia/Dhaka');
    //     $date = date('d-m-Y H:i:s');
    //   $patient_id = $request->patient_id;
    //     $patient_note = $request->patient_note;
    //     $user_id = 1;

    //     $note_archive = array();

    //     $note_archive_existing = patient_profile::where('id','=',$patient_id)->first();

    //     $existing_note = $note_archive_existing->note_archive;

    //         //$existing_note = json_decode($existing_note);
    //        // file_put_contents('test.txt',$existing_note);
    //         //array_push($note_archive,$existing_note);
    //         if ($existing_note) {
    //             $note_archive = json_decode($existing_note);
    //         }


    //     array_push($note_archive,array('patient_note'=>$patient_note,'date'=>$date,'update_by'=>$user_id));



    //     patient_profile::where('id','=',$patient_id)->update(['note'=>$patient_note,'note_archive'=>$note_archive]);

    }
     public function submit_edit_information(Request $request)
     {
        date_default_timezone_set('Asia/Dhaka');
        $date = date('d-m-Y H:i:s');
      $patient_id = $request->patient_id;
        $patient_note = $request->patient_note;
        $user_id = 1;

        $note_archive = array();

        $note_archive_existing = patient_profile::where('id','=',$patient_id)->first();

        $existing_note = $note_archive_existing->note_archive;
            if ($existing_note) {
                $note_archive = json_decode($existing_note);
            }


        array_push($note_archive,array('patient_note'=>$patient_note,'date'=>$date,'update_by'=>$user_id));

         $second_address = $request->second_addresss;
         $pet = $request->pet;
         $sex = $request->sex;
         $recertification = $request->recertification;
         //$note_archive = json_encode($note_archive);

        //  $note_archive =json_enco
         //$note_archive = json_decode($note_archive);
         //file_put_contents('test.txt',json_encode($note_archive[5]->date));

         $data="";
         for($i=0;$i<sizeof($note_archive);$i++)
         {
             $note = (object)$note_archive[$i];
            // file_put_contents('test.txt',$note->date);

            $data.='
            <label  for="exampleInputName1">'.$note->date.'</label>
            <p style="color:black;font-weight:bold; font-size:15px">'.$note->patient_note.'</p><br>
            ';
         }
         //return $data;

         if($second_address)
         {
             patient_profile::where('id','=',$patient_id)->update(['second_address'=>$second_address]);
         }

         if($pet)
         {
            patient_profile::where('id','=',$patient_id)->update(['pet'=>$pet]);
         }

         if($sex)
         {
            patient_profile::where('id','=',$patient_id)->update(['sex'=>$sex]);
         }
         if($recertification)
         {
            patient_profile::where('id','=',$patient_id)->update(['recertification'=>$recertification]);
         }
         if($patient_note)
         {
            patient_profile::where('id','=',$patient_id)->update(['note'=>$patient_note,'note_archive'=>$note_archive]);
         }

         //patient_profile::where('id','=',$patient_id)->update(['second_address'=>$second_address,'pet'=>$pet,'sex'=>$sex,'recertification'=>$recertification,'note'=>$patient_note,'note_archive'=>$note_archive]);
         return $data;
        // $nurse = nurse_profile::get();

        //  for ($m = 0; $m < sizeof($nurse); $m++) {

        //      $nurse_id = $nurse[$m]->id;
        //      //file_put_contents('test.txt',$patient_id);
        //      $nurse_address = $nurse[$m]['prefered_location'].",".$nurse[$m]['prefered_city'].",".$nurse[$m]['prefered_country'].','.$nurse[$m]['prefered_zip'];
        //    // $nurse_zip = $nurse[$m]['prefered_zip'];
        //      $shortest_distance = $this->find_distance($nurse_address, $patient_address);



        //      distance_table::where('patient_id','=',$patient_id)->where('nurse_id','=',$nurse_id)->update(['shortest_distance'=>$shortest_distance['distance'],'patient_lat'=>$shortest_distance['patient_lat'],'patient_lon'=>$shortest_distance['patient_lon'],'shortest_nurse_lat'=>$shortest_distance['nurse_lat'],'shortest_nurse_lon'=>$shortest_distance['nurse_lon'],'duration'=>$shortest_distance['duration']]);


        //  }
         //file_put_contents('test.txt',$patient_id." ".$change_address." ".$change_city);
     }
    public function show_patient_list()
    {
        $patient_lists = patient_profile::get();
        //file_put_contents('test.txt',$patient_lists);
        return view('intaker.view_patient_list', ['patient_lists' => $patient_lists]);
    }

public function send_message()
{
    $nexmo = app('Nexmo\Client');

    $nexmo->message()->send([
        'to'   => '+8801819210184',
        'from' => '+8801675974419',
        'text' => 'You have a nurse appointment.'
    ]);
}

    public function get_shortest_distance($nurse_zip,$patient_zip)
    {
        // $nurse_address = 'Bahaddarhat,Chittagong:GEC,Chitttagong:Agrabad,Chittagong';
        // $patient_address = 'Dampara,Chittagong';
        //file_put_contents('test.txt',$nurse_address." ".$patient_address);
        //$nurse_address = explode(':', $nurse_address);

        //$distance = $this->find_distance($nurse_address,$patient_address);
        //return $distance;

        $nurse = DB::table('zip_code_lat_lon')->where('zip','=',$nurse_zip)->first();
        $nurse_lat = $nurse->lat;
        $nurse_lon = $nurse->lon;

        $patient = DB::table('zip_code_lat_lon')->where('zip','=',$patient_zip)->first();
        $patient_lat = $patient->lat;
        $patient_lon = $patient->lon;

       $distance = $this->distance($nurse_lat,$nurse_lon,$patient_lat,$patient_lon);


       $path = [
        'patient_lat'=>$patient_lat,
        'patient_lon'=>$patient_lon,
        'nurse_lat'=>$nurse_lat,
        'nurse_lon'=>$nurse_lon,
        'distance'=>$distance['distance'],
        'duration'=>$distance['duration']

    ];

    return $path;



        // $distance = array();

        // for ($i = 0; $i < sizeof($nurse_address); $i++) {

        //     $distance[]=$this->find_distance($nurse_address[$i], $patient_address);
        //     //echo json_encode($distance);

        //     //array_push($distance,$this->find_distance($nurse_address[$i], $patient_address));
        // }
        // $get_distance = array_column($distance, 'distance');
        // $min_array = $distance[array_search(min($get_distance), $get_distance)];
        // return $min_array;
        //echo json_encode($distance);
       // echo json_encode($distance[0]);
        //return min($distance);
        //file_put_contents('test2.txt',$min_array);
        //file_put_contents("test.txt", json_encode($distance));
        // file_put_contents('test.txt',$nurse_address." ".$patient_address);

    }

    public function find_distance($nurse_address, $patient_address)
    {
        $client = new \GuzzleHttp\Client();

        $geocoder = new Geocoder($client);

        $geocoder->setApiKey(config('geocoder.key'));

// $geocoder->setCountry(config('US'));

        $nurse_address = $geocoder->getCoordinatesForAddress($nurse_address);
        $patient_address = $geocoder->getCoordinatesForAddress($patient_address);

        $nurse_lat = round($nurse_address['lat'],7);
        $nurse_lon = round($nurse_address['lng'],7);

        $patient_lat = round($patient_address['lat'],7);
        $patient_lon = round($patient_address['lng'],7);

        //file_put_contents('test2.txt', $nurse_lat . " " . $nurse_lon . " " . $patient_lat . " " . $patient_lon);

        $distance = $this->distance($nurse_lat, $nurse_lon, $patient_lat, $patient_lon);

        $path = [
            'patient_lat'=>$patient_lat,
            'patient_lon'=>$patient_lon,
            'nurse_lat'=>$nurse_lat,
            'nurse_lon'=>$nurse_lon,
            'distance'=>$distance['distance'],
            'duration'=>$distance['duration'],

        ];

        return $path;


    }


    public function patient_information_upload(Request $request)
    {
                $patients = new patient_profile();
                $patients->user_id = 1;
                $patients->insurance_plan = $request->insurance_plan;
                $patients->date_received =$request->date_received;
                $patients->date_need_to_be_finished =$request-> date_need_to_be_finished;
                $patients->medicaid_id = $request->medicaid_id;
                $patients->member_id = $request->member_id;
                $patients->first_name = $request->first_name;
                $patients->last_name = $request->last_name;
                $patients->sex = $request->sex;
                $patients->date_of_birth = $request->date_of_birth;
                $patients->primary_language = $request->primary_language;
                $patients->cell_phone = $request->cell_phone;
                $patients->home_phone = $request->home_phone;

                $patients->marital_status = $request->marital_status;
                $patients->email = $request->email;
                $patients->address = $request->address;

                $patients->city = $request->city;
                $patients->state = $request->state;
                $patients->zip_code = $request->zip_code;
                $patients->country = $request->country;
                $patients->assesment_type = $request->assesment_type;
                $patients->save();

                $patient_id = $patients->id;
                $patient_address = $request->address . ',' . $request->city.','.$request->country.",".$request->zip_code;

                //$patient_zip = $patients->zip_code;


                $nurse = nurse_profile::get();

                for ($m = 0; $m < sizeof($nurse); $m++) {

                    $nurse_id = $nurse[$m]->id;
                    //file_put_contents('test.txt',$patient_id);
                   $nurse_address = $nurse[$m]['prefered_location'].",".$nurse[$m]['prefered_city'].",".$nurse[$m]['prefered_country'].','.$nurse[$m]['prefered_zip'];
                  // $nurse_zip = $nurse[$m]['prefered_zip'];
                    $shortest_distance = $this->find_distance($nurse_address, $patient_address);

                    // $distance_table = new distance_table();
                    // $distance_table->patient_id = $patient_id;
                    // $distance_table->nurse_id = $nurse_id;
                    // $distance_table->shortest_distance = $shortest_distance;
                    // $distance_table->save();

                    $distance_table = new distance_table();
                    $distance_table->patient_id = $patient_id;
                    $distance_table->nurse_id = $nurse_id;
                    $distance_table->shortest_distance = $shortest_distance['distance'];
                    $distance_table->duration = $shortest_distance['duration'];
                    $distance_table->patient_lat = $shortest_distance['patient_lat'];
                    $distance_table->patient_lon = $shortest_distance['patient_lon'];
                    $distance_table->shortest_nurse_lat = $shortest_distance['nurse_lat'];
                    $distance_table->shortest_nurse_lon = $shortest_distance['nurse_lon'];

                    $distance_table->save();

                }
    }


}
