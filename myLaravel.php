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

ーーーーーーーーーーーーーーーーーーーーーーーーー
リソースコントローラー
Laravelリソースルートは一行のコードで、典型的な「CRUD」ルートをコントローラへ割り付ける。
make:controller Artisanコマンドを使えば、このようなコントローラは素早く生成できる
php artisan make:controller PhotoController --resource

ルートグループ
ルートグループは多くのルートで共通なミドルウェアや名前空間のようなルート属性をルートごとに定義するのではなく、一括して適用するための手法
Route::groupメソッドの最初の引数には、共通の属性を配列で指定する

メソッドの種類
→middleware
グループ中の全ルートにミドルウェアを指定するには、そのグループを定義する前にmiddlewareメソッドを使用する。
ミドルウェアは、配列に定義された順番で実行される。

namespace
ルートグループのもう一つのよくあるユースケースで、グループ内のコントローラに同じPHP名前空間を指定する場合は、namespaceメソッドを使用する。
例えばApp\Http\Controllers名前空間をコントローラルート登録時に毎回指定しなくても済むように、デフォルトでRouteServiceProviderが名前空間グループの中でroutes.phpファイルを読み込み、指定できる。これにより、先頭のApp\Http\Controllers名前空間を省略でき、続きの部分を指定するだけでOK

domain
ルートグループはワイルドカードサブドメインをルート定義するためにも使うことができる。サブドメインの部分を取り出しルートやコントローラで使用するために、ルートURIにおけるルートパラメーターのように指定できる。サブドメインはグループを定義する前に、domainメソッドを呼び出し指定する。

prefix
prefixメソッドはグループ内の各ルートに対して、指定されたURIのプレフィックスを指定するために使用する。例えばグループ内の全ルートのURIにadminを付けたければ、次のように指定する。
Route::prefix('admin')->group(function () {
    Route::get('users', function () {
        // Matches The "/admin/users" URL
    });
});

name
nameメソッドはグループ内の各ルート名へ、指定した文字列をプレフィックスするために使用する。例えば、グループ内の全ルート名へadminというプレフィックスを付けたいと仮定。指定した文字列はそのままルート名の前に付きます。そのため、プレフィックスへ最後の.文字を確実に指定する。

---------------------------------------------------
バリデーション
バリデーションとは、入力されたデータが、あるいはプログラミング言語やマークアップ言語の記述が、規定された文法に即して、または要求された仕様にそって、適切に記述されているかどうかを検証すること。

フォームリクエストバリデーション
バリデーションロジックを含んだカスタムリクエストクラス。コントローラーの処理に入る前のリクエストの処理の段階でバリデーションが行われる。 バリデーションでエラーがあった場合は、前ページに自動的にリダイレクトされる。
コントローラーとバリデーションロジックが分離できるの為、ロジックをスッキリさせることが出来る。お問合せフォームなどによく使われる。


->php artisan make:request ◯◯◯（ファイル名）
  生成されたクラスはapp/Http/Requestディレクトリへ設置される
  生成したファイルの中にバリデーションのルールを書いていく
  ※authorizeの中のreturnはtrueに変更する

  コントローラーファイルでバリデーションのファイルを読み込む。

  エラー文の表示
    @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif

  エラーメッセージの変更の仕方
  resources/lang/ja/validationから変更できる
----------------------------------------------
  シーダー
  データベースに初期データを登録するために使用するもの
  シーダ（初期値設定）クラスを使用し、テストデーターをデーターベースに設定するシンプルな方法もLaravelには備わっている。全シーダクラスはdatabase/seedsに保存される

シーダクラス定義
 シーダを生成するには、make:seeder Artisanコマンドを実行。フレームワークが生成するシーダはすべてdatabase/seedsディレクトリに設置される。
  php artisan make:seeder ◯◯◯（ファイル名）


シーダの実行
シーダクラスを書き上げたら、Composerのオートローダを再生成するために、dump-autoloadコマンドを実行する必要がある
composer dump-autoload
また、データベースへ初期値を設定するためにdb:seed Artisanコマンドを使用。デフォルトでdb:seedコマンドは、他のシーダクラスを呼び出すDatabaseSeederクラスを実行する。特定のファイルを個別に実行したい場合は、--classオプションを使いシーダを指定する。
php artisan db:seed
php artisan db:seed --class=UsersTableSeeder
もしくはテーブルをすべてドロップし、マイグレーションを再実行するmigrate:freshコマンドを使っても、データベースに初期値を設定可能。このコマンドはデータベースを完全に作成し直したい場合に便利。
php artisan migrate:fresh --seed


ダミーデータの作り方
  Laravelでダミー（テスト）データを作るにはfakerとfactoryでダミーデータを大量生成する
  factoryの中でfakerが働いてダミーデータをいくつも作って、それをseederにセットして大量のダミーデータを作る、みたいなイメージ

  1.ファクトリの生成
  ファクトリを生成するには、make:factory Artisanコマンドを使用。新しいファクトリは、database/factoriesディレクトリに設置される。
  ※作成したファイルは実際にダミーデータを作るファイルを指定すること。defineの部分も合わせる
  ※日本語設定に直すためにconfig/app.phpのfaker_locale => ja_JPに直す

  作成したfactoryファイルに設定したいfakerを記述していく
  $factory->define(ContactForm::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'title' => $faker->realText(50),
        'email' => $faker->unique()->email,
        'url' => $faker->url,
        'gender' => $faker->randomElement(['0','1']),
        'age' => $faker->numberBetween($min = 1,$max = 6),
        'contact' => $faker->realText(200),

    ];
});


seederに書き加えていく
public function run()
    {
      factory(ContactForm::class,200)->create();//200個のダミーデータを生成
    }
  ※この時に追加するseederのファイルはfactoryのファイル共通のものに追記する
  なければArtisanコマンドで生成する
  基本的にseederはテーブルごとに生成する
  seederを変えたらcomposer dump-autoloadを実行する

  ----------------------------------------
要件定義・基本設計（デザイン）
誰が何をどう使いたいか→抽象から具体的へ
    画面設計・・view
    機能設計・・Controller
    データ設計・・Model

    モデルの数＝テーブルの数

  おすすめ描画アプリ
  基本的にはexcelで完結する
  →drow.io
  ------------------------------------------------
  リレーション
  膨大なデータを管理
  ・・数百万、数千万でも可能
  RDB
  ・・リレーショナルデータベース
      複数のテーブルを紐付けることができる
  NoSQL
  ・・高速処理

  DBテーブル同士の関係
  1対１・・・あまり使わない
  1対多・・・複数の中から1つを選べる（お店と住所）
  多対多・・複数の条件を紐付ける（お店と路線）
  SQLだとJOINで紐付ける

  1対多 外部キー設定時の注意点
  FK設定の場合
  主テーブルの内容がないと従テーブルに値を設定できない
  必ず主テーブルから設定する
  （マイグレーション、シーダー）

  ダミーデータを追加したらcomposer dumop-autoload

ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー

１対多
→主（親）hasMany
  従（子）belongsTo
モデルにhasMany/belongsToを追加
  親テーブルと子テーブルを紐付けてエロクワントでphpで描けるようになる 
  SQL文のJOINを使わなくても紐付いたテーブルの情報を持って来れるようになる
親モデル名_idにしておくと楽

外部キー制約
PK・・・主キー、プライマリーキー（primary）
FK・・・外部キー制約（foreign）
（それぞれの複数の設定も可能）
外部キーを設定すると、、、存在しない値が外部キーとして登録されることを防ぐことができる データの整合性が保てる。
設定方法
外部キーをLaravelで設定するにはマイグレーションファイルの子テーブルの方に
 $table->foreign('外部キーをつけたい列')->references('相手先の列')->on('相手先のテーブル名');


 多対多
 中間テーブル（pivot table）を作成
 PKをid以外にする場合には
 マイグレーションにprimaryを追記
 モデル・・・belongsTo

 DBのテーブルを作成する場合は必ずprimaryキーが必要
 Laravelでテーブルを作成する場合にはbigIncrementがprimaryキー
 なのでその部分を変更したときには改めて設定する必要がある
  $table->primary(['route_id','shop_id']);

コントローラが取ってくるデータを指示
モデルでDBと紐付ける用意  細かい要件に応えてDBからデータを取ってきてくれる
マイグレーションでDBのテーブルを定義
シーダーでテーブルのデータを挿入
→DBでデータが格納される

gitignoreファイル
githubにアップロードしないファイルやフォルダを書くファイル
----------------------------------------------------------------------
サンプルプロダクトダウンロード後にすること

git clone サンプルプロダクトURL
  ダウンロードコマンド

php artisan key:generate
 キーの生成

php artisan migrate
  .envの編集

compser install

npm install

npm run dev/npm run prod

--------------------------------------
ダウンロードしたファイルは既に誰かが作成したものだからそのファイルをダウンロードして自分で手直しする場合は、URLを変更する必要がある
$ git remote set-url origin [変更先のURL]
追加は「git remote add」
削除は「git remote rm」
確認は「git remote -v」
URL変更は「git remote set-url」
名前変更は「git remote rename」
