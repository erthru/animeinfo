<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;

class ContentController extends Controller
{
    public function all()
    {
        $content = Content::with("studio")->orderBy("id","DESC")->paginate(5);
        
        $response["msg"]="SUCCESS";
        $response["result"]=$content;
        return $response;
    }

    public function by_id($id)
    {
        $content = Content::with("studio")->find($id);

        $response["msg"]="SUCCESS";
        $response["result"]=$content;
        return $response;
    }

    public function search(Request $request)
    {
        $content = Content::with("studio")->where("title","LIKE","%".$request->query("q")."%")
        ->orWhere("synopsis","LIKE","%".$request->query("q")."%")
        ->take(10)
        ->get();

        $response["msg"]="SUCCESS";
        $response["result"]=$content;
        return $response;
    }

    public function by_studio_id($id)
    {
        $content = Content::with("studio")->where("studio_id",$id)->paginate(5);

        $response["msg"]="SUCCESS";
        $response["result"]=$content;
        return $response;
    }

    public function store(Request $request)
    {
        $uploaded_name = uniqid().".jpg";
        $request->file("thumbnail")->move("uploads",$uploaded_name);

        $content = new Content;
        $content->title = $request->input("title");
        $content->synopsis = $request->input("synopsis");
        $content->thumbnail = $uploaded_name;
        $content->studio_id = $request->input("studio_id");
        $content->save();

        $response["msg"]="SUCCESS";
        $response["result"]=$content;
        return $response;
    }

    public function update_thumbnail($id, Request $request)
    {
        $uploaded_name = uniqid().".jpg";
        $request->file("thumbnail")->move("uploads",$uploaded_name);

        $content = Content::find($id);
        $deleted_thumbnail = $content->thumbnail;
        $content->thumbnail = $uploaded_name;
        $content->save();

        unlink("uploads/".$deleted_thumbnail);

        $response["msg"]="SUCCESS";
        $response["result"]=$content;
        return $response;
    }

    public function update($id, Request $request)
    {
        $content = Content::find($id);
        $content->title = $request->input("title");
        $content->synopsis = $request->input("synopsis");
        $content->studio_id = $request->input("studio_id");
        $content->save();

        $response["msg"]="SUCCESS";
        $response["result"]=$content;
        return $response;
    }

    public function delete($id)
    {
        $content = Content::find($id);
        $deleted_thumbnail = $content->thumbnail;
        $content->delete();

        unlink("uploads/".$deleted_thumbnail);

        $response["msg"]="SUCCESS";
        $response["result"]=$content;
        return $response;
    }
}
