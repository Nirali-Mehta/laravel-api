<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Menu;
use CustomPaginate;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Api\V1\Resources\MenuResource;
use App\Api\V1\Resources\MenuCollection;
use App\Api\V1\Requests\MenuStore;
use App\Api\V1\Requests\MenuUpdate;

use Config;

class MenuController extends Controller
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
            $ref = new Menu();
            $items = new MenuCollection(Menu::with($str_arr)->get());
            
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
            return new MenuCollection(Menu::latest()->paginate(Config::get('constants.data.page_size')));
        }
    }

    public function index(Request $request, Branch $branch)
    {
        if (Input::get('with')) {
            $items = $branch->menus()->with(explode(",", Input::get('with')))->get();
            $result = new MenuCollection($items);    
        } else {
            error_log(get_class($menu));
            $items = $branch->menus()->get();
            $result = new MenuCollection($items);
            //return Menu::latest()->paginate(Config::get('constants.data.page_size'));
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
        return $cp->paginate($result, $request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuStore $request)
    {
        $menu = Menu::create($request->all());
        return response()->json([
            'status' => 201,
            'data' => $branch,
            'message' => 'Successfully created.'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $branchid, Menu $menu)
    {
        return $this->showMain($request, $menu);
    }

    public function showMain(Request $request,Menu $menu)
    {
        try {
            if (Input::get('with')) {
                $items = new MenuResource(Menu::with(explode(",", Input::get('with')))->get()->find($menu));
            } 
            else
            {
                $items= new MenuResource($menu);               
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
    public function update(MenuUpdate $request, Menu $menu)
    {
        $menu->update($request->all());
        return response()->json($menu, 200);
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
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return response()->json(["message" => "Success | Item deleted"], 200);
    }

    public function find(Request $request)
    {
        $required = ["conditions", "fields"];
        try {
            $data = new Menu();
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
            $result = new MenuCollection($items);
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