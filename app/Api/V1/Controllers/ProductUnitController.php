<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\ProductUnit;
use CustomPaginate;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Api\V1\Resources\ProductUnitResource;
use App\Api\V1\Resources\ProductUnitCollection;
use App\Api\V1\Requests\ProductUnitStore;
use App\Api\V1\Requests\ProductUnitUpdate;

use Config;

class ProductUnitController extends Controller
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
            $ref = new ProductUnit();
            $items = new ProductUnitCollection(ProductUnit::with($str_arr)->get());
            
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
            return new ProductUnitCollection(ProductUnit::paginate(Config::get('constants.data.page_size')));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductUnitStore $request)
    {
        error_log("creating");
        $productunit = ProductUnit::create($request->all());

        return response()->json([
            'status' => 201,
            'data' => $productunit,
            'message' => 'Successfully created.'
        ], 201);    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showMain(Request $request,ProductUnit $productunit)
    {
        try {
            if (Input::get('with')) {
                    $items = new ProductUnitResource(ProductUnit::with(explode(",", Input::get('with')))->get()->find($productunit));
            } 
            else
            {
                $items = new ProductUnitResource($productunit);               
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
    public function update(ProductUnitUpdate $request, ProductUnit $productunit)
    {
        $productunit->update($request->all());
        return response()->json($productunit, 200);
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
        $productunit = ProductUnit::findOrFail($id);
        $productunit->delete();
        return response()->json(["message" => "Success | Item deleted"], 200);
    }

    public function find(Request $request)
    {
        $required = ["conditions", "fields"];
        try {
            $data = new ProductUnit();
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
            $result = new ProductUnitCollection($items);
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