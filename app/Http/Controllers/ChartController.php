<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller ;
use Illuminate\Support\Arr;

class ChartController extends Controller
{
    
    public $title = ' | Asteroid Neo';

    # To display datepicker form view
    public function showChartDate(){

    	 $data['title'] = 'Chart date'.$this->title;
    	 return view('datepicker')->with($data);
    }

    # To get chart date 
    public function getChartDate(Request $request){

    	if(!empty($request->all())){

    		$chart_date = explode('-',$request->chart_date); 
    		$start_date = date('Y-m-d',strtotime($chart_date[0]));
    		$end_date = date('Y-m-d',strtotime($chart_date[1]));

    		# To get asteroid records as per date by api request 		
    		$data = $this->getApiDetail($start_date,$end_date);
    		if(empty($data)){
    			return view('datepicker',['error'=>'Please select dates between 7 days.','title' => 'Chart date'.$this->title]);
    		}else{
    			return view('barchart')->with($data);
    		}	
    	}else{
    		return redirect('show_chart_date');
    	}
    	
    }

    # To get api records for asteroid details as per date
    public function getApiDetail($start_date,$end_date){
    
    	$url = "https://api.nasa.gov/neo/rest/v1/feed?start_date=$start_date&end_date=$end_date&api_key=fbccNcc7qfSEd29vHq9eX4O3hZgb4bAugrX4OqZo";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        $neo_api_data = json_decode($output, true);

        if(!empty($neo_api_data['http_error'])){

        	return false;
        }else{

		$neo_data_by_date = [];
        $neo_by_array = [];
        $E = [];
        $neo_velocity_kmph = [];
        $neo_distance_km = [];
        $neo_diameter_km = [];
        $neo_count_by_date = [];

        # To collect near_earth_objects details as per date
        foreach ($neo_api_data['near_earth_objects'] as $key => $value) {

            $neo_data_by_date[$key] = $value;

            foreach ($neo_data_by_date[$key] as $data_by_date) {

                $neo_by_array[] = $data_by_date;              

            }
        }

        # To collect esimated diameter record, relative velocity, miss distance.
        foreach ($neo_by_array as $neo) {
            $E[] = $neo;

            foreach ($neo['estimated_diameter'] as $estemetd_diameterkey => $value) {
             
                if ($estemetd_diameterkey == 'kilometers') {
                    $neo_diameter_km[] = $value;
                }
               
            }
            foreach ($neo['close_approach_data'] as $specification) {
                foreach ($specification['relative_velocity'] as $relative_velocitykey => $value) {
                    if ($relative_velocitykey == 'kilometers_per_hour') {
                        $neo_velocity_kmph[] = $value;
                    }
                }
                foreach ($specification['miss_distance'] as $miss_distancekey => $value) {
                    if ($miss_distancekey == 'kilometers') {
                        $neo_distance_km[] = $value;
                    }
                }
            }
        }

        $neo_data_by_date_arrkeys = array_keys($neo_data_by_date);

        foreach ($neo_data_by_date_arrkeys as $key => $value) {
            $neo_count_by_date[$value] = count($neo_data_by_date[$value]);
        }

        # To calculate fastest asteroid
        arsort($neo_velocity_kmph);
        $fastestAseroid = Arr::first($neo_velocity_kmph);
        $fastestAseroidkey = array_key_first($neo_velocity_kmph);
        $fastestAseroidId = $neo_by_array[$fastestAseroidkey]['id'];
        
        # To calculate closet asteroid
        asort($neo_distance_km);
        $closestAseroid = Arr::first($neo_distance_km);
        $closestAseroidkey = array_key_first($neo_velocity_kmph);
        $closestAseroidId = $neo_by_array[$closestAseroidkey]['id'];
       

        $neo_count_by_date_arry_keys = array_keys($neo_count_by_date);
        $neo_count_by_date_arry_values = array_values($neo_count_by_date);
     
     	$title = 'Chart detail '.$this->title;
        
       return compact('fastestAseroidId', 'fastestAseroid', 'closestAseroidId', 'closestAseroid', 'neo_count_by_date_arry_keys', 'neo_count_by_date_arry_values','title');
        }    
        
        

    }
    

}
