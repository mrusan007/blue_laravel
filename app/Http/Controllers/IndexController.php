<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Models\Meal;
use App\Models\Category;
use App\Models\MealTranslation;
use App\Models\TagTranslations;
use App\Models\IngredientTranslations;
use App\Models\CategoryTranslations;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class IndexController extends Controller
{   


    
    function attachTagToMeal($meal, $lang){
        $tags_array = [];

        foreach($meal->tags as $tag){
            $temp_array = [];
            $translation = TagTranslations::all()
                        ->where('tag_id',$tag->id)
                        ->where('locale',$lang)
                        ->first();
            
            $temp_array['id'] = $tag->id;
            $temp_array['title'] = $translation->title;
            $temp_array['slug'] = $tag->slug;
            $tags_array[] = $temp_array;
        }

        return $tags_array;


    }


    function attachIngredientsToMeal($meal, $lang){
        $ingredients_array = [];

        foreach($meal->ingredients as $ingredient){
            $temp_array = [];
            $translation = IngredientTranslations::all()
                        ->where('ingredient_id',$ingredient->id)
                        ->where('locale',$lang)
                        ->first();
            
            $temp_array['id'] = $ingredient->id;
            $temp_array['title'] = $translation->title;
            $temp_array['slug'] = $ingredient->slug;
            $ingredients_array[] = $temp_array;
        }

        return $ingredients_array;


    }

    function attachToMeal($array, $lang, $with_array){

        $new_array = [];

        foreach($array as $meal){

            $object_array = [];

            $translation = MealTranslation::all()
            ->where('meal_id', $meal->id)
            ->where('locale', $lang)->first();
            


                    
           $object_array['id'] =$meal->id;
           $object_array['title'] =$translation->title;
           $object_array['description'] =$translation->description;
           $object_array['status'] =$meal->status;
           
           if(array_key_exists('category', $with_array)){
            $object_array['category'] = self::attachCategoryToMeal($meal, $lang);
           }

           if(array_key_exists('tags', $with_array)){
            $object_array['tags'] = self::attachTagToMeal($meal, $lang);
           }
           
           if(array_key_exists('ingredients', $with_array)){
            $object_array['ingredients'] = self::attachIngredientsToMeal($meal, $lang);
           }
           

           $new_array[] = $object_array;

        }
        return $new_array;
    }

    function attachCategoryToMeal($meal, $lang){
        
            $category_array = [];
            $category = Category::findOrFail($meal->category_id);
            $translation = CategoryTranslations::all()
                        ->where('category_id',$meal->category_id)
                        ->where('locale',$lang)
                        ->first();
            
            $category_array['id'] = $category->id;
            $category_array['title'] = $translation->title;
            $category_array['slug'] = $category->slug;
            
        

        return $category_array;


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
    function filterWith($with){

        $with_array = [];

        if(str_contains($with, 'category')){
            $with_array['category'] = true;
        }
        if(str_contains($with, 'tags')){
            $with_array['tags'] = true;
        }
        if(str_contains($with, 'ingredients')){
            $with_array['ingredients'] = true;
        }

        return $with_array;

    }   
   
    

    

    public function show(Request $request)
    {
        self::validateRequest($request);

        $category = $request->input('category');
        $tags = $request->input('tags');
        $lang = $request->input('lang');
        $with = $request->input('with');
        $with_array = self::filterWith($with);
        
        if(!empty($category)){
            $meal_list = self::categoryFilter($category);
        }
        else{
            $meal_list = self::tagFilter($tags);
        }
        
       
        
        $array1 = self::attachToMeal($meal_list, $lang, $with_array);
        
        $paginated_array = self::paginateArray($array1, $request);
        

       

        #return Response::json($response); 
        return response()->json([
             $paginated_array   
        ]);
    }
}
