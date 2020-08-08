<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Wallet;
use Illuminate\Http\Request;

use Validator;

class WalletController extends Controller
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
        $wallet = Wallet::create($input);
        $success['message'] = 'Wallet addedd successfully!';

        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * api endpoint for retrieving income sources of a particular user
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request) {

        $wallet = Wallet::where('user_id', $request->user_id)->get();

        return response()->json(["success"=>$wallet], 200);
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
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function show(Wallet $wallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function edit(Wallet $wallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wallet $wallet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wallet $wallet)
    {
        //
    }
}
