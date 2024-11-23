<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\company;

class CompanyController extends Controller{
    /** index */
    public function index(Request $request){
        return view('company.index');   
    }
    /** index */

    /** create */
    public function create(Request $request){
        return view('company.create');
    }
    /** create */

    /** insert */
    public function insert(Request $request){
        
    }
    /** insert */

    /** update */
    public function update(Request $request){
        return view('company.update');
    }
    /** update */

    /** alter */
    public function alter(Request $request){
    
    }
    /** alter */

    /** read */
    public function read(Request $request){
        return view('company.read');
    }
    /** read */

    /** delete */
    public function delete(Request $request){
    
    }
    /** delete */
}
