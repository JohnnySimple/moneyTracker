<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Spending_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Validator;

class CategoryController extends Controller
{

    public $successStatus = 200;

    /**
     * api endpoint for adding category
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'user_id' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $category = Spending_category::create($input);
        $success['message'] = 'Category addedd successfully!';

        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * api endpoint for retrieving categories of a particular user
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request) {

        $categories = Spending_category::where('user_id', $request->user_id)->get();

        return response()->json(["success"=>$categories], 200);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Spending_category  $spending_category
     * @return \Illuminate\Http\Response
     */
    public function show(Spending_category $spending_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Spending_category  $spending_category
     * @return \Illuminate\Http\Response
     */
    public function edit(Spending_category $spending_category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spending_category  $spending_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spending_category $spending_category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Spending_category  $spending_category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spending_category $spending_category)
    {
        //
    }
}
