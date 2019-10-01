# TweetMediaViewer
収集した画像を表示します  
検索機能とお気に入り機能があります  
[TwitterMediaDownloader](https://github.com/Aotsuki55/twitter_media_downloader)とあわせて使って下さい  

## 動作環境
Laravel Framework 5.5.48  
Composer 1.7.3

## 初期設定 
```
composer install
cp .env.example .env
php artisan key:generate
```
.envを自身の環境にあわせて書き換え(DB関連とdownload_path(TwitterMediaDownloaderと同じもの))

## 使い方
`php artisan serve`  


画像を選択時もしくはカーソルが画像にのっている時に1〜3を押すと、画像にstatusを付与します  
Select All &emsp;これを押した後に1〜3を押すと、ページ内のstatusが付与されていない全ての画像に一括でstatusを付与します  
Delete &emsp; &emsp;ページ内の全てのstatusが1の画像を削除します  
All Delete &emsp;Select Allを押した後にこれを押すと、**全て**のstatusが1の画像を削除します  

Shift + → (Shift + ←)でページを進む(戻る)ことが出来ます
