<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use CustomPaginate;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Config;
use App\Api\V1\Resources\StateResource;
use App\Api\V1\Resources\StateCollection;
use App\Api\V1\Requests\StateStore;
use App\Api\V1\Requests\StateUpdate;

class StateController extends Controller
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
            $ref = new State();
            $items = new StateCollection(State::with($str_arr)->get());
            
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
            return new StateCollection(State::latest()->paginate(Config::get('constants.data.page_size')));
        }
    }

    public function index(Request $request, Country $country)
    {
        if (Input::get('with')) {
            $items = $country->states()->with(explode(",", Input::get('with')))->get();
            $result =  new StateCollection($items);
        } else {
            error_log(get_class($state));
            $items = $country->states()->get();
            $result = new StateCollection($items);
            //return State::latest()->paginate(Config::get('constants.data.page_size'));
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
    public function store(StateStore $request)
    {
        error_log("creating");
        $state = State::create($request->all());
        return response()->json([
            'status' => 201,
            'data' => $state,
            'message' => 'Successfully created.'
        ], 201);    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $countryid, State $state)
    {
        return $this->showMain($request, $state);
    }

    public function showMain(Request $request,State $state)
    {
        try {
            if (Input::get('with')) {
                $items = new StateResource(State::with(explode(",", Input::get('with')))->get()->find($state));
            } 
            else
            {
                $items = new StateResource($state);               
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
    public function update(StateUpdate $request, State $state)
    {
        $state->update($request->all());
        return response()->json($state, 200);
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
        $state = State::findOrFail($id);
        $state->delete();
        return response()->json(["message" => "Success | Item deleted"], 200);
    }

    public function find(Request $request)
    {
        $required = ["conditions", "fields"];
        try {
            $data = new State();
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
            $result = new StateCollection($items);
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