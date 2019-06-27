<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\City;
use CustomPaginate;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Config;
use App\Api\V1\Resources\CityResource;
use App\Api\V1\Resources\CityCollection;
use App\Api\V1\Requests\CityStore;
use App\Api\V1\Requests\CityUpdate;


class CityController extends Controller
{
    use Helpers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexMain(Request $request)
    {
        $json = $request->json()->all();
        
        if(array_key_exists('conditions', $json)) {
            return $this->find($request);
        }
        
        if (Input::get('with')) {
            $str_arr = explode(",", Input::get('with'));
            $ref = new City();
            $items = new CityCollection(City::with($str_arr)->get());

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
            return new CityCollection(City::paginate(Config::get('constants.data.page_size')));
        }
    }

    public function index(Request $request, State $state)
    {
        if (Input::get('with')) {
                $items = $state->cities()->with(explode(",", Input::get('with')))->get();
                $result = new CityCollection($items);            
        } else {
            error_log(get_class($state));
            $items = $state->cities()->get();
            $result = new CityCollection($items);
            //return City::latest()->paginate(Config::get('constants.data.page_size'));
        }

        # Paginate

        $cp = new CustomPaginate();
        if (count($cp->paginate($result, $request)) == 0) {
            return response()->json([
                'data' => [],
                'error' => "404 No Page Found. Exceeded Page Range.",
                'exception' => "No data on this page",
            ], 404);
        }
        return $cp->paginate($result, $request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityStore $request)
    {
        error_log("creating");
        $city = City::create($request->all());
        return response()->json([
            'status' => 201,
            'data' => $city,
            'message' => 'Successfully created.'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $stateid, City $city)
    {
        return $this->showMain($request, $city);
    }

    public function showMain(Request $request,City $city)
    {
        try {
            if (Input::get('with')) {
                $items = new CityResource(City::with(explode(",", Input::get('with')))->get()->find($city));
            } 
            else
            {
                $items = new CityResource($city);
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
    public function update(CityUpdate $request, City $city)
    {
        $city->update($request->all());
        return response()->json($city, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        #update
        $city = City::findOrFail($id);
        $city->delete();
        return response()->json(["message" => "Success | Item deleted"], 200);
    }

    public function find(Request $request)
    {
        $required = ["conditions", "fields"];
        try {
            $data = new City();
            $json = $request->json()->all();
            $condition = $json['conditions'];
            $cp = new CustomPaginate();

            if (isset($json['fields'])) {
                $fields = $json['fields'];
            }
            else{
                $fields = [];
            }
            
            $items = $data->findWhere($condition, $fields);
            if (count($cp->paginate($items, $request)) == 0) {
                return response()->json([
                    'data' => [],
                    'error' => "404 No Page Found. Exceeded Page Range.",
                    'exception' => "No data on this page",
                ], 404);
            }
            $result = new CityCollection($items);
            return $cp->paginate($result, $request);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'data' => [],
                'error' => "Resource not found",
                'exception' => $e,
            ], 404);
        }
    }
}