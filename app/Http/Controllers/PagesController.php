<?php

namespace App\Http\Controllers;
use App\Media;
use App\Http\Requests\SearchRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    static $statusToColor = array(
      "0" => 'transparent',
      "1" => '#0000ff',
      "2" => '#00ff00',
      "3" => '#ff0000',
      "-1" => '#000000',
    );

    public function getViewer(){
      $download_path = config('env.download_path');
      // $medias = Media::orderBy('saved_at', 'desc')->orderBy('tweet_id_str', 'desc')->orderBy('photo_number', 'asc')->take(50)->get();
      $medias = Media::orderBy('saved_at', 'desc')->paginate(50);
      // $medias = Media::orderBy('saved_at', 'desc')->orderBy('tweet_id_str', 'desc')->orderBy('photo_number', 'asc')->where('type', '!=', "video")->take(50)->get();//->simplePaginate(1);
      // $medias = Media::where('favorite_count', '<', 10000)->orderBy('favorite_count', 'desc')->orderBy('tweet_id_str', 'desc')->orderBy('photo_number', 'asc')->skip(0)->take(50)->get();//->simplePaginate(1);
      // ->orderBy('filename', 'asc')
      foreach($medias as $media){
        $media->path = '/twitter/' . $media->user_id_str . '/' . $media->filename;
      }
      return view('viewerY', [
        'medias' => $medias,
        'statusToColor' => PagesController::$statusToColor,
        'request' => null
      ]);
    }

    public function saveTmp(Request $request){
      $id = $request->input('id');
      $status = $request->input('status');
      DB::update(
        'update media set status = '.$status.'
        where media_id_str in ("'.$id.'")'
      ,[]);
    }

    public function search(Request $requests){
      $request = $requests->all();
      \Debugbar::addMessage($request);
      $query = Media::query();
      foreach ($request as $key => $value){
        if($value!=null){
          $column = "";
          switch($key){
            case "userName":
              if($column == "") $column = "user_name";
            case "screenName":
              if($column == "") $column = "user_screen_name";
              $query->where($column,'like',"%{$value}%");
              break;
            case "fabMin":
              if($column == "") $column = "favorite_count";
            case "rtMin":
              if($column == "") $column = "retweet_count";
              if(is_numeric($value)) $query->where($column,'>=',$value);
              break;
            case "fabMax":
              if($column == "") $column = "favorite_count";
            case "rtMax":
              if($column == "") $column = "retweet_count";
              if(is_numeric($value)) $query->where($column,'<=',$value);
              break;
            case "savedAtSince":
              if($column == "") $column = "saved_at";
            case "updatedAtSince":
              if($column == "") $column = "updated_at";
              $query->where($column,'>=',$value);
              break;
            case "savedAtMax":
              if($column == "") $column = "saved_at";
            case "updatedAtMax":
              if($column == "") $column = "updated_at";
              $query->where($column,'>=',$value);
              break;
            case "status":
              if($column == "") $column = "status";
            case "type":
              if($column == "") $column = "type";
              $query->where($column,$value);
              break;
          }
        }
      }
      $medias = $query->orderBy('saved_at', 'desc')->paginate(50);
      foreach($medias as $media){
        $media->path = '/twitter/' . $media->user_id_str . '/' . $media->filename;
      }
      \Debugbar::addMessage($medias);
      return view('viewerY', [
        'medias' => $medias,
        'statusToColor' => PagesController::$statusToColor,
        'request' => $request
      ]);
    }
}
