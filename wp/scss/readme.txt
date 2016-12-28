■Sassファイルディレクトリ構成
基本はsmacssルールに基づいたディレクトリ構成になっていますが、spcでの独自ルールで再構成しています。
★は、編集不要ファイルです。

★・assetsディレクトリ
common.scss、top.scss、page.scssが入っており、特に編集する必要はありません。
common.scssでは下記がインポートされていいます。

_core.scss
_general.scss
_base.scss
_layout.scss

assets/css/の中に、
common.css、top.css、page.cssが出力されます。

・coreディレクトリ
各ファイルで使うscssをまとめたディレクトリです。
変数は_variable.scssに記述するようにしてください。
基本的なmixin、extend、functionもこのディレクトリに集約します。

・_base.scss
ベースのcssです。
各案件に合わせて編集してください。

★・_core.scss
各ファイルで使うscssを読み込むためのファイルです。
特に編集する必要はありません。

・_general.scss
汎用クラスを記述するファイルです。

・_layout.scss
各ページ共通要素のモジュールを記述するファイルです。
再利用しやすいような、設計をしてください。	

・_page.scss
下層ページのcssはこちらに記入してください。

・_top.scss
TOPページのcssはこちらに記入してください。

★・style.scss
現在はリセットcssのみ記述されています。
style.cssとして出力されます。