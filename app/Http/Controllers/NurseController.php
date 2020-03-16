<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\nurse_profile;
use App\patient_profile;
use DB;
use App\distance_table;
use Spatie\Geocoder\Geocoder;
class NurseController extends Controller
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
    public function find_distance($nurse_address, $patient_address)
    {
        $client = new \GuzzleHttp\Client();

        $geocoder = new Geocoder($client);

        $geocoder->setApiKey(config('geocoder.key'));

// $geocoder->setCountry(config('US'));

        $nurse_address = $geocoder->getCoordinatesForAddress($nurse_address);
        $patient_address = $geocoder->getCoordinatesForAddress($patient_address);

        $nurse_lat = $nurse_address['lat'];
        $nurse_lon = $nurse_address['lng'];

        $patient_lat = $patient_address['lat'];
        $patient_lon = $patient_address['lng'];

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

    public function show_nurse_list()
    {
        $nurse_lists = nurse_profile::all();
        return view('intaker.view_nurse_list', ['nurse_lists' => $nurse_lists]);
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
     public function nurse_detail()
     {
         return view('nurse_detail');
     }
    public function nurse_information_upload(Request $request)
    {
       $prefered_date = $request->prefered_date;
       $prefered_date = explode(',',$prefered_date);

     $start_time = $request->start_time;
     $start_time = explode(',',$start_time);

       $finish_time =$request->finish_time;
       $finish_time = explode(',',$finish_time);


    //file_put_contents('test.txt',json_encode($start_time));

       $prefered_date_time = array();
       for($i=0;$i<sizeof($prefered_date);$i++)
       {
         array_push($prefered_date_time,['date'=>$prefered_date[$i],'start_time'=>$start_time[$i],'finish_time'=>$finish_time[$i]]);
       }
        $nurse = new nurse_profile();
        $nurse->user_id = 1;
        $nurse->name = $request->name;
        $nurse->gender =$request->gender;
        $nurse->language =$request->language;

        $nurse->email_address =$request->email;
        $nurse->nurse_registration_no =$request->registration_no;
        $nurse->phone_number =$request->phone_number;
        $nurse->address =$request->address;
        $nurse->prefered_date_time =$request->prefered_day;
        $nurse->prefered_location =$request->address;
        $nurse->prefered_date_time = json_encode($prefered_date_time);

        $nurse->prefered_city =$request->city;
        $nurse->prefered_county =$request->country;
        $nurse->prefered_zip =$request->zip;
        $nurse->nurse_area =$request->prefered_area;
        $nurse->save();
        $nurse_id = $nurse->id;
        $nurse_zip = $nurse->prefered_zip;
        $patient = patient_profile::get();
        $nurse_address = $request->address.",".$request->city.",".$request->country.','.$request->zip;
        for ($m = 0; $m < sizeof($patient); $m++) {

            $patient_id = $patient[$m]->id;
            //file_put_contents('test.txt', $patient_id);
            $patient_address = $patient[$m]['address'] . ',' . $patient[$m]['city'].','.$patient[$m]['country'].','.$patient[$m]['zip_code'];
           //$patient_zip = $patient[$m]['zip_code'];
            $shortest_distance = $this->find_distance($nurse_address, $patient_address);


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

    //     //file_put_contents('test.txt',$request->all());

    }
}
