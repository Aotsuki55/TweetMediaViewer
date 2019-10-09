# TweetMediaViewer
収集した画像を表示します  
検索機能とお気に入り機能があります  
[TwitterMediaDownloader](https://github.com/Aotsuki55/twitter_media_downloader)とあわせて使って下さい  

## 動作環境
Laravel Framework 5.5.48  
Composer 1.7.3  
ブラウザ (FireFox推奨*)

## 初期設定 
```
composer install
cp .env.example .env
php artisan key:generate
```
.envを自身の環境にあわせて書き換え(DB関連)

## 使い方
`php artisan serve`  

ブラウザで`http://localhost:8000/view`を表示  

画像を選択時もしくはカーソルが画像にのっている時に1〜3を押すと、画像にstatusを付与します  
Select All &emsp;これを押した後に1〜3を押すと、ページ内のstatusが付与されていない全ての画像に一括でstatusを付与します  
&emsp;&emsp;&emsp; &emsp; &emsp;これを押した後に0を押すと、ページ内の全ての画像のstatusを解除   
Delete &emsp; &emsp;ページ内の全てのstatusが1の画像を削除します  
All Delete &emsp;Select Allを押した後にこれを押すと、**全て**のstatusが1の画像を削除します  

Shift + → (Shift + ←)でページを進む(戻る)ことが出来ます

## \*ブラウザ
FireFox推奨 (決してキツネがかわいいからではない)  

ブラウザによって動画再生機能に以下のような特徴があります(画像は全て同じ)  
FireFox &emsp; プレイヤー表示、シーク可能  
Chrome &emsp;プレイヤー表示、シーク不可  
Safari &emsp;&emsp;シーク不可、重い  

今後修正予定です...
