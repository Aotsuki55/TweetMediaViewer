<?php

namespace App\Http\Controllers;
use App\Media;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function getViewer(){
      $download_path = config('env.download_path');
      $medias = Media::orderBy('saved_at', 'desc')->orderBy('tweet_id_str', 'desc')->orderBy('photo_number', 'asc')->take(50)->get();//->simplePaginate(1);
      // $medias = Media::where('favorite_count', '<', 10000)->orderBy('favorite_count', 'desc')->orderBy('tweet_id_str', 'desc')->orderBy('photo_number', 'asc')->skip(0)->take(50)->get();//->simplePaginate(1);
      // ->orderBy('filename', 'asc')
      foreach($medias as $media){
        $media->path = '/twitter/' . $media->user_id_str . '/' . $media->filename;
      }
      
      return view('viewerY', [
        'medias' => $medias
      ]);
    }
}
