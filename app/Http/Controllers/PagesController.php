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
      $medias = Media::where("status", '<>', -1)->orWhereNull('status')->orderBy('saved_at', 'desc')->paginate(50);
      foreach($medias as $media){
        $media->path = '/twitter/' . $media->user_id_str . '/' . $media->filename;
      }
      $viewer = 'viewer';
      $browser = strtolower($_SERVER['HTTP_USER_AGENT']);
      if (strstr($browser , 'edge')) {
      } elseif (strstr($browser , 'trident') || strstr($browser , 'msie')) {
      } elseif (strstr($browser , 'chrome')) {
      } elseif (strstr($browser , 'firefox')) {
      } elseif (strstr($browser , 'safari')) {
        $viewer.="Safari";
      } elseif (strstr($browser , 'opera')) {
      }

      return view($viewer, [
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

    public function delete(){
      DB::update(
        'update media set status = -1 where status = 1'
      ,[]);
      return $this->getViewer();
    }

    public function search(Request $requests){
      $request = $requests->all();
      $max = 50;
      $typeFlag = 1;
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
              if($column == "") {
                $column = "status";
                $typeFlag = 0;
              }
              $query->where($column,$value);
              break;
            case "type":
              if($column == "") $column = "type";
              if($value == "video" || $value == "animated_gif") $max = 10;
              $query->where($column,$value);
              break;
          }
        }
      }
      if($typeFlag) {
        $query->where(function ($query) {
          $query->where("status", '<>', -1)->orWhereNull('status');
        });
      }
      $medias = $query->orderBy('saved_at', 'desc')->paginate($max);
      foreach($medias as $media){
        $media->path = '/twitter/' . $media->user_id_str . '/' . $media->filename;
      }

      $viewer = 'viewer';
      $browser = strtolower($_SERVER['HTTP_USER_AGENT']);
      if (strstr($browser , 'edge')) {
      } elseif (strstr($browser , 'trident') || strstr($browser , 'msie')) {
      } elseif (strstr($browser , 'chrome')) {
      } elseif (strstr($browser , 'firefox')) {
      } elseif (strstr($browser , 'safari')) {
        $viewer.="Safari";
      } elseif (strstr($browser , 'opera')) {
      }
      return view($viewer, [
        'medias' => $medias,
        'statusToColor' => PagesController::$statusToColor,
        'request' => $request
      ]);
    }
}
