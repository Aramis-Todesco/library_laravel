<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use App\Models\Copy;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LoanController extends Controller
{

    /**
     * index
     */
    public function index()
    {
        $loans = Loan::orderBy('loan_start_date','desc')
            ->orderBy('status','desc')
            ->get();
        
        return view('loans.index_loans')->with('loans',$loans);
    }

    /**
     * show a specific loan
     */
    public function show($loan_id)
    {
        $loan = Loan::find($loan_id);
        
        return view('loans.show_loans')->with('loan',$loan);
    }

    /**
     * create
     */
    public function create($copy_id)
    {
        $users = User::where('is_blocked',false)->get();
        $copy = Copy::find($copy_id);

        return view('loans.create_loans')
            ->with('users',$users)
            ->with('copy',$copy);

    }

    /**
     * store new loan - avvio prestito del libro
     */
    public function store(Request $request)
    {
        $loan = new Loan([
            'status' => true,
            'loan_start_date' => date(now()),
            'loan_expiration_date' => Carbon::now()->addDays(30),
            'fk_copy' => $request->input('copy'),
            'fk_user' => $request->input('user')
        ]);
        $loan->save();

        $copy = Copy::find($request->input('copy'));
        $copy->update([
            'status' => 2,
        ]);

        return redirect()->route('loans.index');
    }

    /**
     * end a specific loan - termina il prestito
     */
    public function end_loan(Request $request)
    {
        $loan = Loan::find($request->input('loan_id'));
        $loan->update([
            'status' => false,
            'loan_real_end_date' => Carbon::now(),
        ]);

        $copy = Copy::find($request->input('fk_copy'));
        $copy->update([
            'status' => 1,
        ]);

        return redirect()->route('loans.index');
    }


    /**
     * extend a specific loan - proroga del presito
     */
    public function extension_loan(Request $request)
    {
        $loan = Loan::find($request->input('loan_id'));
        $loan->update([
            'loan_expiration_date' => Carbon::now()->addDays(30),
        ]);

        return redirect()->route('loans.index');
    }
}

