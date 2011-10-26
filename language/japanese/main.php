<?php
//全ページで使用
define("_MD_CHARINAVI_ACCESS_ERROR", "このエリアにアクセスする権限がありません。");
define("_MD_CHARINAVI_FORMINPUT_ERROR", "入力内容が不正です。");
define("_MD_CHARINAVI_FORM_SUBMIT", "送信");
define("_MD_CHARINAVI_ERRORNUM", "エラー番号");

//myactivities.php
define("_MD_CHARINAVI_MYACTIVITIES_LABEL_ACTIVITY", "活動名");
define("_MD_CHARINAVI_MYACTIVITIES_LABEL_REPORT", "レポート");
define("_MD_CHARINAVI_MYACTIVITIES_LABEL_VISIT", "訪問数");
define("_MD_CHARINAVI_MYACTIVITIES_LABEL_DONATION", "寄付数");
define("_MD_CHARINAVI_MYACTIVITIES_LABEL_UPBEAT", "変化率");
define("_MD_CHARINAVI_MYACTIVITIES_LABEL_ACTIONS", "アクション");
define("_MD_CHARINAVI_MYACTIVITIES_LABEL_SHOWREPORT", "レポートを表示");
define("_MD_CHARINAVI_MYACTIVITIES_LABEL_EDIT", "編集");
define("_MD_CHARINAVI_MYACTIVITIES_LABEL_DELETE", "削除");
define("_MD_CHARINAVI_MYACTIVITIES_LABEL_ADD", "活動を新規追加");


//ボランティア団体登録ページ
define("_MD_CHARINAVI_REGISTER_TITLE", "ボランティア団体新規登録");
define("_MD_CHARINAVI_REGISTER_NAME_TITLE", "ボランティア団体名");
define("_MD_CHARINAVI_REGISTER_POST_TITLE", "郵便番号");
define("_MD_CHARINAVI_REGISTER_ADDRESS_TITLE", "住所");
define("_MD_CHARINAVI_REGISTER_PHONE_TITLE", "電話番号");
define("_MD_CHARINAVI_REGISTER_FAX_TITLE", "FAX");
define("_MD_CHARINAVI_REGISTER_ACTIVITY_TITLE", "活動内容");

define("_MD_CHARINAVI_REGISTER_SUBMIT", "送信");

define("_MD_CHARINAVI_MSG_REGISTERED", "登録が完了しました。");
define("_MD_CHARINAVI_REGISTERED_ERROR", "登録に失敗しました。");

//電子マネーへの換金
define("_MD_CHARINAVI_EXCHANGE_TITLE", "チャリコインの購入");
define("_MD_CHARINAVI_EXCHANGE_DESCRIPTION", "1円に対して、チャリコイン1枚と換金します。");
define("_MD_CHARINAVI_EXCHANGE_MSG_FORM", "枚のチャリコインと換金します。");
define("_MD_CHARINAVI_EXCHANGE_SUBMIT", "実行");
define("_MD_CHARINAVI_EXCHANGE_INTERROR", "0以上の数字を入力してください。");
define("_MD_CHARINAVI_EXCHANGE_STRINGERROR", "数字を入力してください。");

define("_MD_CHARINAVI_EXCHANGED_MSG", "枚のチャリコインを購入しました。");
define("_MD_CHARINAVI_EXCHANGED_ERROR", "不正な換金処理です。");

//寄付を募る活動の追加ページ
define("_MD_CHARINAVI_ADDACTIVITY_TITLE", "寄付を募りたい活動を登録してください。");
define("_MD_CHARINAVI_ADDACTIVITY_NAME_TITLE", "活動タイトル");
define("_MD_CHARINAVI_ADDACTIVITY_DESCRIPTION_TITLE", "活動の概要");
define("_MD_CHARINAVI_ADDACTIVITY_TAGS_TITLE", "タグ (カンマ区切りで複数設定できます。)");
define("_MD_CHARINAVI_ADDACTIVITY_SUBMIT", "登録");
define("_MD_CHARINAVI_ADDACTIVITY_COMPLETED", "活動の登録が完了しました。");

//タグページ
define("_MD_CHARINAVI_TAG_TITLE_LEFT", "「");
define("_MD_CHARINAVI_TAG_TITLE_RIGHT", "」のタグがついたボランティア活動");
define("_MD_CHARINAVI_TAG_ERROR", "指定のIDに該当するタグはありません。");

//アクティビティページ
define("_MD_CHARINAVI_ACTIVITY_VNAME_RIGHT", "さんの活動です。");
define("_MD_CHARINAVI_ACTIVITY_MSG", "この活動に寄付をしますか？");
define("_MD_CHARINAVI_ACTIVITY_UNIT", "円");
define("_MD_CHARINAVI_ACTIVITY_SUBMIT", "寄付");
define("_MD_CHARINAVI_ACTIVITY_ERROR", "指定のIDに該当するボランティア活動はありません。");
define("_MD_CHARINAVI_ACTIVITY_REVIEW_TITLE", "レビュー");
define("_MD_CHARINAVI_ACTIVITY_REVIEW_UNAME_RIGHT", "さんのレビュー");
define("_MD_CHARINAVI_ACTIVITY_REVIEW_DATE_RIGHT", "投稿日：");
define("_MD_CHARINAVI_ACTIVITY_REVIEW_NOTHING", "このボランティア活動に対するレビューはありません。");
define("_MD_CHARINAVI_ACTIVITY_REVIEW_RECOMMEND", "最初のレビューを書いて見ませんか。");
define("_MD_CHARINAVI_ACTIVITY_REVIEW_RECOMMEND2", "レビューを書いて見ませんか。");
define("_MD_CHARINAVI_ACTIVITY_REVIEW_COMPLETED", "レビューを投稿しました。");

//寄付処理
define("_MD_CHARINAVI_DONATED_COMPLETED", "寄付の手続きが完了しました。");
define("_MD_CHARINAVI_DONATED_ERROR", "不正な寄付手続きの処理です。");

//個人情報の管理
define("_MD_CHARINAVI_PERSONAL_EDIT_PHOTO", "変更したい画像を選択してください。");
define("_MD_CHARINAVI_PERSONAL_SUBMIT_PHOTO", "送信");
define("_MD_CHARINAVI_PERSONAL_CANCEL_PHOTO", "キャンセル");
define("_MD_CHARINAVI_PERSONAL_COMPLETED_PHOTO", "画像を変更しました。");
define("_MD_CHARINAVI_PERSONAL_LABEL_EMAIL", "登録メールアドレス");
define("_MD_CHARINAVI_PERSONAL_LABEL_BALANCE", "チャリコイン残高");
define("_MD_CHARINAVI_PERSONAL_MSG_BALANCE_LEFT", "あと");
define("_MD_CHARINAVI_PERSONAL_MSG_BALANCE_RIGHT", "枚あります。");
define("_MD_CHARINAVI_PERSONAL_LABEL_RANK", "ユーザランク");
define("_MD_CHARINAVI_PERSONAL_LABEL_COMMON", "あなたは一般ユーザ(寄付支援者)として登録されています。");
define("_MD_CHARINAVI_PERSONAL_LABEL_VOLUNTEER", "あなたはボランティア団体(寄付依頼者)として登録されています。");
define("_MD_CHARINAVI_PERSONAL_LABEL_DONATION", "寄付の履歴");
define("_MD_CHARINAVI_PERSONAL_LABEL_DONATION_WHEN", "いつ？");
define("_MD_CHARINAVI_PERSONAL_LABEL_DONATION_WHERE", "どこへ？");
define("_MD_CHARINAVI_PERSONAL_LABEL_DONATION_HOW", "いくら？");

//カテゴリの追加
define("_MD_CHARINAVI_ADMIN_CATEGORIES_MSG_COMPLETED", "カテゴリを更新しました。");
define("_MD_CHARINAVI_ADMIN_CATEGORIES_MSG_INCOMPLETED", "カテゴリの更新に失敗しました。");

//エラーページ
define("_MD_CHARINAVI_ERROR_MSG_NOCODE", "不正なエラーコードです。");
define("_MD_CHARINAVI_ERROR_MSG_100", "ポイント購入額の取得に失敗しました。");
define("_MD_CHARINAVI_ERROR_MSG_101", "トランザクションIDの取得に失敗しました。");
define("_MD_CHARINAVI_ERROR_MSG_102", "このフォームはすでに1度以上送信されています。");
define("_MD_CHARINAVI_ERROR_MSG_110", "不正な送信が検出されました。");
define("_MD_CHARINAVI_ERROR_MSG_111", "新規カテゴリのinsertに失敗しました。");
define("_MD_CHARINAVI_ERROR_MSG_112", "カテゴリIDの取得に失敗しました。");
define("_MD_CHARINAVI_ERROR_MSG_113", "カテゴリの削除に失敗しました。");
define("_MD_CHARINAVI_ERROR_MSG_401", "カテゴリ画像のinsertに失敗しました。");

//カテゴリのページ
define("_MD_CHARINAVI_CATEGORIES_MSG_NONE", "指定したカテゴリはありません。");
