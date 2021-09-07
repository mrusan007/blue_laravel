<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Models\Meal;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class IndexController extends Controller
{   

    function attachToCategory($array){

        $new_array = [];

        
    }

    function categoryFilter($category){
      
            if($category == '!NULL'){
                
                $meals = Meal::all()->whereNotIn('category_id', [NULL]);
                return $meals
                ->makeHidden(['created_at', 'updated_at','deleted_at','category_id']);
            }
            else{
                return Meal::where('category_id', $category)->get()
                ->makeHidden(['created_at', 'updated_at','deleted_at','category_id']);
            }
            
            
    }

    function tagFilter($tag_input){


        $meals = Meal::all();

        if(str_contains($tag_input,',')){
            
            $tag_list = explode(',', $tag_input);
            
            $data = [];

            foreach($meals as $meal){
               $tag_data = [];

                foreach($meal->tags as $tag){
                    $tag_data[]=$tag->id;
                }

                $arrayDiz = empty(array_diff($tag_list, $tag_data));
                if($arrayDiz == true){
                    $data[]=$meal;
                }
            }
            
            return $data;



        }else{
            $data = [];
            foreach($meals as $meal){

                foreach($meal->tags as $tag){
                    if($tag->id == $tag_input){
                        $data[] = $meal;
                        break;
                        }
                    }
            }       
            return $data;
        }
    }

    function paginateArray($array, $request){

        $per_page = $request->input('per_page');
        $page = $request->input('page');

        $total = count($array);
        $per_page = $per_page ?? 3;
        $current_page = $page ?? 1;

        $starting_point = ($current_page * $per_page) - $per_page;

        $array = array_slice($array, $starting_point, $per_page, true);

        $array = new Paginator($array, $total, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        return $array;

    }

    function validateRequest($request){

        $rules = [
            'lang' => 'required'
        ];

        $validation = Validator::make($request->all(), $rules, $messages = [
            'required' => 'The :attribute field is required.',]);
       
        if($validation->fails()){
            
            throw new \ErrorException('Langauge required!');
        }
    
       
   
    

    }

    public function show(Request $request)
    {
        self::validateRequest($request);

        #$category = $request->input('category');
        $tags = $request->input('tags');
        #$meal_list = self::categoryFilter($category);
        $lang = $request->input('lang');
        $meal_list = self::tagFilter($tags);
        app()->setLocale($lang);
        
        // $response = array(
        //     'products'   => $myList->getItems(),
        //     'pagination' => array(
        //         'total'        => $myList->getTotal(),
        //         'per_page'     => $myList->getPerPage(),
        //         'current_page' => $myList->getCurrentPage(),
        //         'last_page'    => $myList->getLastPage(),
        //         'from'         => $myList->getFrom(),
        //         'to'           => $myList->getTo()
        //     )
        // );
        
        $paginated_array = self::paginateArray($meal_list, $request);
        

       

        #return Response::json($response); 
        return response()->json([
             $paginated_array    
        ]);
    }
}
