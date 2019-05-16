<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Studio;
use DataTables;

class StudioController extends Controller
{
    public function all()
    {
        $studio = Studio::orderBy("id","DESC")->paginate(10);

        $response["msg"]="SUCCESS";
        $response["result"]=$studio;
        return $response;
    }

    public function all_no_paging()
    {
        $studio = Studio::orderBy("name","ASC")->get();

        $response["msg"]="SUCCESS";
        $response["result"]=$studio;
        return $response;
    }

    public function by_id($id)
    {
        $studio = Studio::find($id);

        $response["msg"]="SUCCESS";
        $response["result"]=$studio;
        return $response;
    }

    public function search(Request $request)
    {
        $studio = Studio::where("name","LIKE","%".$request->query("q")."%")->take(10)->get();

        $response["msg"]="SUCCESS";
        $response["result"]=$studio;
        return $response;
    }

    public function datatable()
    {
        return DataTables::of(Studio::all())->make(true);
    }

    public function store(Request $request)
    {
        $studio = new Studio;
        $studio->name = $request->input("name");
        $studio->save();

        $response["msg"]="SUCCESS";
        $response["result"]=$studio;
        return $response;
    }

    public function update($id, Request $request)
    {
        $studio = Studio::find($id);
        $studio->name = $request->input("name");
        $studio->save();

        $response["msg"]="SUCCESS";
        $response["result"]=$studio;
        return $response;
    }

    public function delete($id)
    {
        $studio = Studio::find($id);
        $studio->delete();

        $response["msg"]="SUCCESS";
        $response["result"]=$studio;
        return $response;
    }
}
