<?php

//****************************************
//各ページへ適切な<title>タグの出力
//****************************************
add_theme_support('title-tag');

//****************************************
//各ページのタイトル区切り文字を変更する
//****************************************
// add_filter('document_title_parts', 'my_document_title_parts');
// function my_document_title_parts($title) {
//     if ( is_home()) {
//         unset($title['tagline']); //タグラインを削除
//         $title['title'] = 'BISTORO CALMEは、カジュアルなワインバーよりなビストロです。';
// //テキストを変更
//     }
//     return $title;
// }
add_filter('document_title_separator', 'my_document_title_separator');
function my_document_title_separator ($separator) {
    $separator = '|'; //区切り文字を 「|」に変更
    return $separator;
}

//****************************************
//アイキャッチ画像を使用可能にする
//****************************************
add_theme_support('post-thumbnails');

//****************************************
//カスタムメニュー機能を使用可能にする
//****************************************
add_theme_support('menus');

//*************************************************
//pre_get_postsアクションフックでメインクエリを変更する
//*************************************************
add_action('pre_get_posts', 'my_pre_get_posts');
function my_pre_get_posts($query) {
    //管理画面、メインクエリ以外には設定しない
    if( is_admin() || ! $query->is_main_query() ){
        return;
    }
    //トップページの場合
    if( $query->is_home() ) {
        $query->set('posts_per_page', 3 );
        return;
    }
}

//*************************************************
//<p>タグが勝手に入るのを削除
//*************************************************
add_action('wp', 'my_wpautop');
function my_wpautop() {
	if( is_page('contact')) {
		remove_filter('the_content', 'wpautop');
	}
}




