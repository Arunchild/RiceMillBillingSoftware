<?php namespace App\Http\Controllers;


use App\Settings;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;

class SettingsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = Settings::all();
		return view('Settings.index')->withitems($items);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('Settings.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'printer_name' => 'required',
			'copy' => 'required',
			'preprint_space' 	=> 'required',
			'bill_paper' 	=> 'required'
		]);

		$input = $request->all();

		Settings::create($input);

		Session::flash('flash_message', 'Settings successfully added!');

		//TODO: redirect to Settings list page
		return redirect()->route('Settings.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$items = Settings::findOrFail($id);

		return view('Settings.edit')->withitems($items);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$items = Settings::findOrFail($id);

		$this->validate($request, [
			'printer_name' => 'required',
			'copy' => 'required',
			'preprint_space' 	=> 'required',
			'bill_paper' 	=> 'required'
		]);

		$input = $request->all();

		$items->fill($input)->save();

		Session::flash('flash_message', 'Settings successfully added!');

		return redirect()->route('Settings.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$item = Settings::findOrFail($id);

		$item->delete();

		Session::flash('flash_message', 'Settings successfully deleted!');

		return redirect()->route('Settings.index');
	}

}
