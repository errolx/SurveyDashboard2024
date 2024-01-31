<?php

namespace App\Http\Controllers\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use SheetDB\SheetDB;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): view
	{
		$datestart = $request->datestart ?? null;
		$dateend = $request->dateend ?? null;
		
		if(Auth::user()->role == 'Admin')
		{
			$searchdept = '*';
            $searchVal = $request->search ?? null;
		}
		if(Auth::user()->role == 'viewer')
		{
			$searchdept = Auth::user()->dept;
            $searchVal = $searchdept;
		}
		

		//check sheetDB validity
		$sheetdb = new SheetDB('s47ie9ra0xerf');
		$response = $sheetdb->get();
		if($response == null)
		{
			$sheetdb = new SheetDB('0j8ry2s6jptn9');
			//$sheetdb = new SheetDB('s47ie9ra0xerf');
			$response = $sheetdb->get();
		}
		if($response == null)
		{
			//$sheetdb = new SheetDB('s47ie9ra0xerf');
			$sheetdb = new SheetDB('3bv3vzg90oar8');
			$response = $sheetdb->get();
		}
		if($response == null)
		{
			//$sheetdb = new SheetDB('s47ie9ra0xerf');
			$sheetdb = new SheetDB('vnukdyvyhfn2b');
			$response = $sheetdb->get();
		}
		if($response == null)
		{
			return view('response.warning');
		}				
		//check sheetDB validity

        $sheets = $sheetdb->search(['dept'=>$searchdept]);
        

		return view('response.index', compact('sheets','datestart','dateend','searchVal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
