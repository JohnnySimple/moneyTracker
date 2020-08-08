<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Income_source;
use Illuminate\Http\Request;

use Validator;

class SourceController extends Controller
{

    public $successStatus = 200;

    /**
     * api endpoint for adding income source
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
        $source = Income_source::create($input);
        $success['message'] = 'Income source addedd successfully!';

        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * api endpoint for retrieving income sources of a particular user
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request) {

        $sources = Income_source::where('user_id', $request->user_id)->get();

        return response()->json(["success"=>$sources], 200);
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
     * @param  \App\Income_source  $income_source
     * @return \Illuminate\Http\Response
     */
    public function show(Income_source $income_source)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Income_source  $income_source
     * @return \Illuminate\Http\Response
     */
    public function edit(Income_source $income_source)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Income_source  $income_source
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income_source $income_source)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Income_source  $income_source
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income_source $income_source)
    {
        //
    }
}
