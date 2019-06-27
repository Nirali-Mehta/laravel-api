<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Branch;
use CustomPaginate;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Config;
use App\Api\V1\Resources\BranchResource;
use App\Api\V1\Resources\BranchCollection;
use App\Api\V1\Requests\BranchStore;
use App\Api\V1\Requests\BranchUpdate;

// use App\Http\Requests\BranchStoreRequest;


class BranchController extends Controller
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
            $ref = new Branch();
            $items = new BranchCollection(Branch::with($str_arr)->get());
            
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
            return new BranchCollection(Branch::paginate(Config::get('constants.data.page_size')));
            // return Branch::latest()->paginate(Config::get('constants.data.page_size'));
        }
    }

    public function index(Request $request, Company $company)
    {
        $json = $request->json()->all();
        
        if(array_key_exists('conditions', $json)) {
            return $this->find($request);
        }

        if (Input::get('with')) {
            $items = $company->branches()->with(explode(",", Input::get('with')))->get();
            $result =  new BranchCollection($items);
        }

        
        else {
            error_log(get_class($company));
            $items = $company->branches()->get();
            $result = new BranchCollection($items);
            // return Branch::latest()->paginate(Config::get('constants.data.page_size'));
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
    public function store(BranchStore $request)
    {
        $branch = $request->all();
        $branch = Branch::create($branch);
        return response()->json([
            'status' => 200,
            'data' => $branch,
            'message' => 'Successfully created.'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $companyid, Branch $branch)
    {
        return $this->showMain($request, $branch);
    }

    public function showMain(Request $request,Branch $branch)
    {
        try {
            if (Input::get('with')) {
                $items = new BranchResource(Branch::with(explode(",", Input::get('with')))->get()->find($branch));
            } 
            else
            {                               
                $items = new BranchResource($branch);
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
    public function update(BranchUpdate $request, Branch $branch)
    {
        $branch->update($request->all());
        error_log("inside Update");
        return response()->json($branch, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return response()->json(["message" => "Success | Item deleted"], 200);
    }

    public function find(Request $request)
    {
        $required = ["conditions", "fields"];
        try {
            $data = new Branch();
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
            $result = new BranchCollection($items);
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