<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillPeriod;


use Illuminate\Http\Request;

class BillsController extends Controller
{
    
    public function index(){
        $Bills=Bill::all();
        return view('bills.index',compact('Bills'));
    }
    public function create(){
        return view('bills.create');
    }
    
    public function show(){
        return view('bills.show');
    }
    public function store(){
        return view('bills.create');
    }
    public function delete(){
        return view('bills.create');
    }
}
