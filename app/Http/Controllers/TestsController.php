<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestsController extends Controller
{
{
    public function index()
    {
        return Test::all();
    }
 
    public function show($test_id)
    {
        return Test::findOrFail($test_id);
    }
 
    public function update(Request $request, $test_id)
    {
        $test = Test::findOrFail($test_id);
        $test->update($request->all());
 
        return $test;
    }
 
    public function store(Request $request)
    {
        $test = Test::create($request->all());
        return $test;
    }
 
    public function destroy($test_id)
    {
        $test = Test::findOrFail($test_id);
        $test->delete();
        return '';
    }
}
