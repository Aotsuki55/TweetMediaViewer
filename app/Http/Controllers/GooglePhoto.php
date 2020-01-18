<?php

namespace App\Http\Controllers;

use Google\Auth\OAuth2;
use Google\Auth\Credentials\UserRefreshCredentials;
use Google\Photos\Library\V1\PhotosLibraryClient;
use Google\Photos\Library\V1\PhotosLibraryResourceFactory;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\SearchRequest;


class GooglePhoto extends Controller
{
    static $scopes = array('https://www.googleapis.com/auth/photoslibrary.readonly');
    // static $photosLibraryClient = null;
    
    public function getConnection(Request $request){
        // \Debugbar::info("mediaItem");
        info('1');
        if(!$request->session()->has('authCredentials')){
            if(!Cache::has('refreshToken')) {
                info('2');
                return GooglePhoto::connectWithGooglePhotos($request);
            }
            else{
                info('3');
                $clientId = Config::get('google.client_id');
                $clientSecret = Config::get('google.client_secret');
                $refreshToken = Cache::get('refreshToken');
                $authCredentials = new UserRefreshCredentials(
                    GooglePhoto::$scopes,
                    [
                        'client_id' => $clientId,
                        'client_secret' => $clientSecret,
                        'refresh_token' => $refreshToken
                    ]
                );
                $request->session()->put('authCredentials', $authCredentials);
            }
        }
        // $photosLibraryClient = new PhotosLibraryClient(['credentials' => session('authCredentials')]);
        return redirect('/view');
    }

    function connectWithGooglePhotos(Request $request){
        $clientId = Config::get('google.client_id');
        $clientSecret = Config::get('google.client_secret');
        $redirectURI = Config::get('google.redirect_URI')."/connection";
        
        $oauth2 = new OAuth2([
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
            'authorizationUri' => 'https://accounts.google.com/o/oauth2/v2/auth',
            // Where to return the user to if they accept your request to access their account.
            // You must authorize this URI in the Google API Console.
            'redirectUri' => $redirectURI,
            'tokenCredentialUri' => 'https://www.googleapis.com/oauth2/v4/token',
            'scope' => GooglePhoto::$scopes,
        ]);
        // The authorization URI will, upon redirecting, return a parameter called code.
        if (!$request->input('code',null)) {
            $authenticationUrl = $oauth2->buildFullAuthorizationUri(['access_type' => 'offline']);
            return redirect()->away($authenticationUrl);
        } else {
            // With the code returned by the OAuth flow, we can retrieve the refresh token.
            $oauth2->setCode($request->input('code'));
            $authToken = $oauth2->fetchAuthToken();
            $refreshToken = $authToken['refresh_token'];
            Cache::forever('refreshToken', $refreshToken);
            info($authToken);
            return redirect('/view');
        }
    }

    public static function getPhotoURL($photoIDs){
        // if(!GooglePhoto::$photosLibraryClient) 
            $photosLibraryClient = new PhotosLibraryClient(['credentials' => session('authCredentials')]);
            try {
                $photoURLs = array();
                $response = $photosLibraryClient->batchGetMediaItems($photoIDs);
                foreach ($response->getMediaItemResults() as $itemResult) {
                    $mediaItem = $itemResult->getMediaItem();
                    if(!is_null($mediaItem)){
                        $id = $mediaItem->getId();
                        $parameter = "=";
                        if(strpos($mediaItem->getMimeType(), "video")===0) $parameter .= "dv";
                        else $parameter .= "w2048-h2048";
                        $photoURLs[$id] = $mediaItem->getBaseUrl().$parameter;
                    }
                }
                // \Debugbar::info($mediaItem);
                return $photoURLs;
                
            }catch (\Google\ApiCore\ValidationException $e) {
                echo $e;
            }
        }

}
