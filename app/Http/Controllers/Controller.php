<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\products;
use App\airlines;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function products(){
    	return view('products')->with('products',products::all());
    }
    public function addProduct(Request $request){
    	$product = new products;
    	$product->service = $request->service;
    	$product->save();
    	return redirect()->route('products')->with('products',products::all());
    }
    public function destroyProduct($id){
    	$product = products::find($id);
    	$product->delete();
    	return redirect()->route('products')->with('products',products::all());
    }

    public function airlines(){
    	return view('airlines')->with('airlines',airlines::all());
    }
    public function addAirline(Request $request){
    	$airline = new airlines;
    	$airline->name = $request->name;
    	$airline->save();
    	return redirect()->route('airlines')->with('airlines',airlines::all());
    }
    public function destroyAirline($id){
    	$airline = airlines::find($id);
    	$airline->delete();
    	return redirect()->route('airlines')->with('airlines',airlines::all());
    }
}
