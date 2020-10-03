<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Income;
use App\Wallet;
use Illuminate\Http\Request;

use Validator;

class IncomeController extends Controller
{
    public $successStatus = 200;

    /**
     * api endpoint for recording income
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'income_source_id' => 'required',
            'amount' => 'required',
            'wallet_id' => 'required',
            'user_id' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $income = Income::create($input);
        
        $balance = Wallet::where('id', $request->wallet_id)->value('balance');
        $update_wallet = Wallet::where('id', $request->wallet_id)->update(array('balance'=>($balance+$request->amount)));
        $success['message'] = 'Income recorded successfully!';

        return response()->json(['success'=>$success], $this->successStatus);
    }


    /**
     * endpoints to retrieve all income of current user
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request) {
        $income = Income::where('user_id', $request->user_id)->get();
        return response()->json(['success' => $income], $this->successStatus);
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
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income $income)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        //
    }
}
