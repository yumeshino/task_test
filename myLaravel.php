LaravelはMVCモデル
Model・・・・・データベースとのやり取り
View・・・・・見た目
Controller・・処理
Routing・・・アクセスの振り分け
Migration・・DBテーブルとの履歴管理


コマンド一覧の表示
	
php artisan list
php artisan
使えるArtisanコマンドの一覧を表示するもの



ヘルプの表示
	
php artisan help コマンド
php artisan コマンド -h
このコマンドはコマンドの使い方を確認するもの



モデル

php artisan make:model ファイル名
このコマンドを実行することでモデルのテンプレートが作成される
ファイル名は「ファイル名.php」となっており、中にテンプレート文が記述されている


マイグレーション
マイグレーションとはデータベースへのテーブル定義を管理するもので、マイグレーション機能によってSQL（データベースを構築する際の言語）についての知識がなくてもデータベースを構築することができる
流れとしては

	
php artisan make:migration ファイル名
ファイル名で指定した名前のマイグレーションファイルを作成することができる
	
php artisan make:migration ファイル名 --create=テーブル名
新規テーブルの作成

	
php artisan make:migration ファイル名 table=テーブル名
既存テーブルの構造を変更

	
php artisan migrate
作成したマイグレーションファイルのUPファンクションの部分を実行

php artisan migrate:rollback
最後にマイグレーションを実行する前の状態に戻

	
php artisan migrate:refresh
一度すべてのテーブルを削除し、その後もう一度マイグレーションしていきます。

tinker（データベース簡易接続）
データベースと簡単に繋ぐための仕組み
$php artisan tinker

モデルファイル
→appフォルの中に命名したので作られる
  modelファイルを作るときはappの直下にフォルダがたくさんになっちゃうのでファイル/フォルダで作るようにする


ルーティングファイル
→routeasファイルのweb.phpファイル

コントローラーファイル
→appファイルのhttpフォルダの命名したフォルダ名

ビューファイル
→resourcesファイルのviewsフォルダの中に命名したフォルダを作る
  viewsファイルは基本的に.bladeをつける

モデルのデータを持ってくるためにuse構文を使う
→作成したappファイルのmodelフォルダをひっぱてくる

compact関数
→変数をviewsファイルに表示する際に使う
  複数の変数でも渡すことができる

------------------------------------------------------


ヘルパ関数
ララベルが用意している便利関数
その中でも特によく使うもの
route,auth,app,bcrypt,collect,dd,env,factory,old,viewなど

コレクション型
配列を拡張した型でLaravel独自の型
データベースからデータを取得時はコレクション型になっているのが特徴
コレクション型専用の記述可能
コレクション型の独自の型もたくさん用意されている
その中でもよく見る関数は
all,chunk,get,pluck,whereln,toArray

クエリビルダ
データベースとアクセスする時に本来ならSQL文をたたく必要があるが
それをphpの構文でかけるようにしたもの
クエリをphpでかける
Select ,where ,groupbyなど
＜SQLに近い構文＞
DB ::table（テーブル名）->と繋ぐ

データベースからデータを取ってくる場合は関数がたくさん用意されている
コレクション型で、細かく条件を指定する場合はよりっっsqlに近い状態のクエリビルダ
それでも表現が難しい場合はrawメソッドを使った生のsqlを書いていくのがbetter

ファサード
正面、入口

ーーーーーーーーーーーーーーーーーーーーーーーーーーー
blade
Laravelkで組み込まれたテンプレートエンジン
ファイル名には.blade.phpファイル拡張子をつける
通常はresources/viewsディレクトリ中に設置する


１、テンプレートエンジンとは？
２、＠で書かれたものがbladeの構文になる
３、{{}}の理由
４、bladeの便利機能、レイアウト定義

ーーーーーーーーーーーセクション７ーーーーーーーーーーーーーーーーーーーーーー

・マイグレーションでテーブルを追加する場合
  →コマンド
    php artisan make:migration add_votes_to_users_table --table=users

    新規作成の時はcreate
    Schema::create('contact_forms', function (Blueprint $table) 

    追加した時はtable
    Schema::table('contact_forms', function (Blueprint $table) 
          {
            $table->string('title', 50)->after('name');
            //afterの修飾子で追加する場所を指定できる
          });

    追加したものを削除したい場合
    ①マイグレーションファイルにdropColumnを追加
     public function down()
    {
        Schema::table('contact_forms', function (Blueprint $table) {
            //
            $table->dropColumn('title');
        });
    }

    ②ターイナルに
      $php artisan migrate:rollback
      一つ前の動作にもどる（追加したぶんがなかったことになる）

      $php artisan migrate:status
      マイグレーションの実行状況が確認できる

      $php artisan migrate:rollback --step=2
      stepでいくつ戻るかの指定もできる


    

