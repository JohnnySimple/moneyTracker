<?php

namespace App\Http\Controllers\API;

use App\Expense;
use App\Wallet;
use App\Spending_category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
class ExpenseController extends Controller
{

    public $successStatus = 200;

    /**
     * endpoint for recording expenses
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'spending_category_id' => 'required',
            'amount' => 'required',
            'wallet_id' => 'required',
            'user_id' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $expense = Expense::create($input);

        $exp = Wallet::where('id', $request->wallet_id)->value('balance');
        $update_wallet = Wallet::where('id', $request->wallet_id)->update(array('balance'=>($exp-$request->amount)));
        $success['message'] = 'Expense recorded successfully!';

        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * endpoint for retrieving expenses of a user
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request) {
        $expenses = Expense::where('user_id', $request->user_id)->get();
        return response()->json(['success'=>$expenses], $this->successStatus);
    }

    /**
     * endpoint for retrieving expenses of a user on a given day
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $expenses = Expense::where('user_id', $request->user_id)->whereDate('time_made', $request->time_made)->get();
        $categories = Spending_category::where('user_id', $request->user_id)->get();

        $success = [];
        foreach ($expenses as $expKey => $expValue) {
            $success[$expKey] = $expValue;
            // $success[$expKey]['category_name'] = $success[$expKey]->amount;
            foreach ($categories as $catkey => $catValue) {
                if ($success[$expKey]->spending_category_id == $categories[$catkey]->id) {
                    $success[$expKey]['category_name'] = $categories[$catkey]->name;
                }
            }
            
        }
        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * endpoint for retrieving expenses of a user in a given month
     * @return \Illuminate\Http\Response
     */
    public function monthlyExpenses(Request $request) {
        $expenses = Expense::where('user_id', $request->user_id)
        ->whereMonth('time_made', $request->month)
        ->whereYear('time_made', $request->year)
        ->get();
        
        return response()->json(['success'=>$expenses], $this->successStatus);
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
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        //
    }
}
