<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\DietaryPreference;
use CustomPaginate;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Config;

class DietaryPreferenceController extends Controller
{
    use Helpers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexMain(Request $request)
    {
        if (Input::get('with')) {
            $items = $this->withType($request);

            # Paginate
            $cp = new CustomPaginate();
            if (count($cp->paginate($items, $request)) == 0) {
                return response()->json([
                    'data' => [],
                    'error' => "404 No Page Found. Exceeded Page Range.",
                    'exception' => "No data on this page",
                ], 404);
            }
            return $cp->paginate($items, $request);

        } else {
            return DietaryPreference::latest()->paginate(Config::get('constants.data.page_size'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        error_log("creating");
        $dietarypreference = DietaryPreference::create($request->all());

        return response()->json($dietarypreference, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showMain(Request $request,DietaryPreference $dietarypreference)
    {
        try {
            if (Input::get('with')) {
                if (Input::get('nested') == 1) {
                    $items = DietaryPreference::with(Input::get('with'))->get()->find($dietarypreference);
                } else {
                    $items = DietaryPreference::with(explode(".", Input::get('with')))->get()->find($dietarypreference);
                }
            } 
            else
            {
                $items= $dietarypreference;               
            }   
                $cp = new CustomPaginate();
                if (count($cp->paginate($items, $request)) == 0) {
                    return response()->json([
                        'data' => [],
                        'error' => "404 No Page Found. Exceeded Page Range.",
                        'exception' => "No data on this page",
                    ], 404);
                }
            return $cp->paginate($items, $request);
        }catch (ModelNotFoundException $e) {
            return response()->json([
                'data' => [],
                'error' => "Resource not found",
                'exception' => $e,
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DietaryPreference $dietarypreference)
    {
        $dietarypreference->update($request->all());
        return response()->json($dietarypreference, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        #update
        $dietarypreference = DietaryPreference::findOrFail($id);
        $dietarypreference->delete();
        return response()->json(["message" => "Success | Item deleted"], 200);
    }

    public function find(Request $request)
    {
        $required = ["conditions", "fields"];
        try {
            $data = new DietaryPreference();
            $json = $request->json()->all();
            $condition = $json['conditions'];

            $cp = new CustomPaginate();

            if (isset($json['fields'])) {
                $fields = $json['fields'];
                $items = $data->findWhere($condition, $fields);
                if (count($cp->paginate($items, $request)) == 0) {
                    return response()->json([
                        'data' => [],
                        'error' => "404 No Page Found. Exceeded Page Range.",
                        'exception' => "No data on this page",
                    ], 404);
                }
            } else {
                $items = $data->findWhere($condition);
                if (count($cp->paginate($items, $request)) == 0) {
                    return response()->json([
                        'data' => [],
                        'error' => "404 No Page Found. Exceeded Page Range.",
                        'exception' => "No data on this page",
                    ], 404);
                }
            }
            return $cp->paginate($items, $request);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'data' => [],
                'error' => "Resource not found",
                'exception' => $e,
            ], 404);
        }
    }

    #update
    public function withType(Request $request)
    {
        try {
            $with = Input::get('with');
            $nested = Input::get('nested');
            $ref = new DietaryPreference();
            if ($nested == 1) {
                return $ref->nestedDataDisplay($with);
            } else {
                $str_arr = explode(".", $with);
                return $ref->dataDisplay($str_arr);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'data' => [],
                'error' => "Resource not found",
                'exception' => $e,
            ], 404);
        }
    }

}
