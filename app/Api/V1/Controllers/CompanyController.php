<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CompanyType;
use App\Models\Company;
use CustomPaginate;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Config;
use App\Api\V1\Resources\CompanyResource;
use App\Api\V1\Resources\CompanyCollection;
use App\Api\V1\Requests\CompanyStore;
use App\Api\V1\Requests\CompanyUpdate;

class CompanyController extends Controller
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
            $items = $this->withType($request);
            $ref = new Company();
            $items = new CompanyCollection(CompanyCollection::with($str_arr)->get());
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
            return new CompanyCollection(Company::paginate(Config::get('constants.data.page_size')));
        }
    }

    public function index(Request $request, CompanyType $companytype)
    {
        if (Input::get('with')) {
                $items = $companytype->companies()->with(explode(",", Input::get('with')))->get();
                $result =  new CompanyCollection($items);
        } else {
            error_log(get_class($companytype));
            $items = $companytype->companies()->get();
            $result = new CompanyCollection($items);
            //return Company::latest()->paginate(Config::get('constants.data.page_size'));
        }

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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyStore $request)
    {
        $company = Company::create($request->all());
        return response()->json([
            'status' => 200,
            'data' => $company,
            'message' => 'Successfully created.'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $companytypeid, Company $company)
    {
        return $this->showMain($request, $company);
    }

    public function showMain(Request $request,Company $company)
    {
        try {
            if (Input::get('with')) {
                    $items = new CompanyResource(Company::with(explode(",", Input::get('with')))->get()->find($company));
            } 
            else
            {
                $items = new CompanyResource($company);               
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
    public function update(CompanyUpdate $request, Company $company)
    {
        $company->update($request->all());
        return response()->json($company, 200);
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
        $company = Company::findOrFail($id);
        $company->delete();
        return response()->json(["message" => "Success | Item deleted"], 200);
    }

    public function find(Request $request)
    {
        $required = ["conditions", "fields"];
        try {
            $data = new Company();
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
            $result = new CompanyCollection($items);
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