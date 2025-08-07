# 丹後王国ウェブサイトリニューアル要件定義書

**（Gemini‑CLI 向け — WordPress / Kadence Theme & Kadence Blocks 最適化版）**

---

## 1. プロジェクト概要と目的

### 1.1 目的

- ウェブサイトのデザインとユーザビリティを刷新し、現代的で魅力的なサイトにする。
- 主要ターゲットである「犬連れのお客様」と「親子連れのお客様」に特化した情報提供と導線を強化し、来園・利用を促進する。
- 情報構造を整理し、ユーザーが必要な情報に迷わずアクセスできるようにする。
- 施設の職員が**ノーコード**でコンテンツを容易に更新できる運用体制を確立する。
- サイト内回遊率・予約・問い合わせ数の増加を図る。

### 1.2 現状の課題

- デザインが旧態化しモバイル最適化も不十分。
- ターゲットが不明確で導線が分散。
- 更新作業が HTML/CSS 編集前提で非技術職員には困難。
- 海藻情報・営業日など重要情報が埋もれている。

### 1.3 達成目標 (KPI)

| 指標                   | 旧サイト  | 目標値       |
| -------------------- | ----- | --------- |
| モバイル PageSpeed (LCP) | 55    | **80 以上** |
| サイト内回遊 (平均 PV)       | 2.1   | **3.0**   |
| 予約 / 問合せ CVR         | 0.9 % | **1.8 %** |

---

## 2. 採用テーマ・プラグイン構成

### 2.1 テーマ

- **Kadence Theme (無料版)** — 軽量 / ブロックエディタ最適化 / ヘッダー・フッタービルダー / パフォーマンス設定内蔵

### 2.2 主要プラグイン（全て無料）

| 目的        | プラグイン                           | 備考                                    |
| --------- | ------------------------------- | ------------------------------------- |
| ブロック拡張    | Kadence Blocks                  | Row Layout, Advanced Gallery, Form など |
| カスタムフィールド | Advanced Custom Fields          | ページ毎の画像・文言管理                          |
| フォーム      | Contact Form 7                  | お問い合わせ                                |
| イベント      | The Events Calendar             | カレンダー & 単一イベント表示                      |
| SEO       | Yoast SEO                       | タイトル / メタ / OGP                       |
| キャッシュ     | WP Super Cache                  | HTML キャッシュ & 圧縮                       |
| SNS 連携    | Smash Balloon Social Photo Feed | Instagram グリッド表示                      |

> **Gemini‑CLI への指示**：WP‑CLI を用いて上記テーマ・プラグインをインストール / 有効化するコマンドを自動生成すること。

---

## 3. デザイン & ユーザビリティ原則（Kadence 対応）

1. **モダンなビジュアル**
   - 提供済みモック「トップページ改修イメージ.jpg」を参考に、Kadence Design Library から近しいレイアウトを選択。
2. **レスポンシブデザイン**
   - Kadence のコンテナ幅 & モバイルブレイクポイント設定を使用。
3. **視覚的魅力**
   - Advanced Gallery ブロック・Cover ブロック・動画埋め込みを活用。
4. **直感的ナビゲーション**
   - ヘッダー・フッタービルダーでグローバルメニュー / SNS アイコンをドラッグ＆ドロップ配置。
5. **アクセシビリティ**
   - Kadence のアクセシビリティ設定（フォーカスリング・ARIA ラベル）を有効化。

---

## 4. コンテンツ管理要件（ノーコード運用）

- **Gutenberg + Kadence Blocks** で全ページを構築。HTML 直書き禁止。
- **ACF** を用い、以下の共通フィールドセットを作成：
  - ヒーロー画像 / キャッチコピー
  - セクションリスト（画像・タイトル・リンク URL のリピータ）
- **職員操作フロー**：

1. 固定ページを開く → Kadence Row Layout を追加
2. “Tango ハイライトカード” パターンを選択
3. サイドバーで画像 / テキスト / リンクを入力

---

## 5. サイト構成 & ページ別要件

### 5.1 トップページ

| セクション     | 主なブロック / 設定                                 |
| --------- | ------------------------------------------- |
| ヘッダー      | Kadence ヘッダービルダー + ロゴ + 2 階層メニュー            |
| ヒーロー      | Cover ブロック + Row Layout (中央見出し & CTA ボタン)   |
| ターゲット導線   | Highlight Cards パターン（犬連れ / 親子向け）            |
| おすすめ      | Query Loop + Card デザイン / ACF リピータ           |
| 新着情報      | Query Loop (post\_type=post, orderby=date)  |
| Instagram | `[instagram-feed layout=grid num=6 cols=3]` |
| フッター      | フッタービルダー：会社情報 / ポリシー / SNS                  |

> **Gemini‑CLI**：`page-home.php` テンプレートを子テーマに生成し、上記ブロックコメントを含む HTML スケルトンを記述すること。

### 5.2 犬連れのお客様向けページ

- 固定ページ + Row Layout 3 カラム
- コンテンツは ACF リピータで管理
- 施設利用情報ボックス：Kadence Info Box ブロック

### 5.3 親子連れのお客様向けページ

- 固定ページ + Tabs ブロック（体験プログラム / 遊び場 / 周辺観光）
- 体験プログラム一覧を Query Loop + ACF カスタム投稿タイプ `program` で管理

### 5.4 ホテル / アンテナショップ 他

- 外部サイトリンクは Buttons ブロック
- よくある質問：Kadence Accordion ブロック

### 5.5 イベントカレンダー

- 月間ビュー：`[tribe_events view="month"]`
- イベント詳細：The Events Calendar シングルテンプレートをデザイン調整（子テーマ `tribe-events/single-event.php`）

---

## 6. 技術的考慮事項

| 項目           | Kadence 対応策                                        |
| ------------ | -------------------------------------------------- |
| **SEO**      | Yoast SEO にてタイトル・メタ・スキーマ自動生成                       |
| **画像最適化**    | Kadence > Performance > Enable WebP & Lazy Load    |
| **パフォーマンス**  | CSS/JS ファイル分割・縮小化を Kadence 設定で有効化 + WP Super Cache |
| **カスタム CSS** | 子テーマ `style.css` もしくは「外観 > カスタマイズ > 追加 CSS」        |
| **ブロックパターン** | `register_block_pattern()` で再利用可                   |
| **多言語対応**    | 予算次第で TranslatePress (無料版) 検討                      |

---

## 7. 運用 & 保守計画

### 7.1 権限ロール

| ロール | 権限                          |
| --- | --------------------------- |
| 管理者 | 全権 + テーマ / プラグイン更新 + バックアップ |
| 編集者 | ページ・投稿・イベントの公開 / SEO 調整     |
| 投稿者 | お知らせ・イベント下書き / 画像アップロード     |

### 7.2 定期タスク

- **毎月**：コンテンツ確認 + プラグイン更新
- **四半期**：PageSpeed Insights 計測 / バックアップ保存 / セキュリティスキャン

### 7.3 トレーニング

1. WordPress 基本操作（1 h）
2. Kadence ブロック編集（1 h）
3. ACF フィールド更新 / 画像最適化（1 h）

---

## 8. Gemini‑CLI への具体的指示（抜粋）

```
1. WordPress CLI でテーマ / プラグイン導入

bash
!wp theme install kadence --activate
!wp plugin install kadence-blocks advanced-custom-fields contact-form-7 the-events-calendar wordpress-seo wp-super-cache smash-balloon-social-photo-feed --activate

2. 子テーマ作成 (kadence-child)

bash
!wp scaffold child-theme kadence-child --parent_theme=kadence --activate

3. ACF JSON 書き込み
- write_file で JSON を配置
   - 場所：wp-content/themes/kadence-child/acf-json/group_tango.json
   - 読み込み：ACF の “ローカル JSON” 機能で自動認識
{
  "key": "group_tango",
  "title": "Tango Fields",
  "fields": [
    { "key": "field_hero_image",   "label": "ヒーロー画像",  "name": "hero_image",  "type": "image" },
    { "key": "field_hero_caption", "label": "キャッチコピー","name": "hero_caption","type": "text"  },
    { "key": "field_section_rep",  "label": "セクション",    "name": "sections",    "type": "repeater",
      "sub_fields":[
        { "key": "field_sec_title", "label": "タイトル", "name": "title", "type": "text" },
        { "key": "field_sec_link",  "label": "リンク",   "name": "link",  "type": "url"  },
        { "key": "field_sec_img",   "label": "画像",     "name": "image", "type": "image"}
      ]
    }
  ],
  "location":[[{"param":"post_type","operator":"==","value":"page"}]]
}


4.functions.php にパターン登録コード追記

<?php
add_action( 'init', function() {
  register_block_pattern(
    'tango/highlight-cards',
    array(
      'title'   => 'Tango ハイライトカード',
      'content' =>
        '<!-- wp:kadence/rowlayout -->
          <div class="kt-row-layout">
            <!-- wp:kadence/column -->
              <div class="kt-inside-inner-col">
                <figure class="wp-block-image"><img src="%image%" /></figure>
                <h3>%title%</h3>
                <p><a href="%link%" class="kb-button">詳しく見る</a></p>
              </div>
            <!-- /wp:kadence/column -->
          </div>
        <!-- /wp:kadence/rowlayout -->'
    )
  );
} );
?>


5. ページテンプレート追加
write_file wp-content/themes/kadence-child/page-templates/page-home.php

<?php
/* Template Name: Tango Home */
get_header(); ?>
<main id="primary" class="site-main">

<?php $hero = get_field('hero_image'); ?>
<section class="hero" style="background:url('<?php echo esc_url($hero['url']); ?>') center/cover no-repeat">
  <h1><?php echo esc_html(get_field('hero_caption')); ?></h1>
</section>

<section class="highlights">
  <InnerBlocks /> <!-- 職員が Gutenberg でカードを追加 -->
</section>

</main>
<?php get_footer(); ?>


6. ダミーページ & 投稿生成

bash
!wp post create --post_type=page --post_title="Home" --page_template="page-templates/page-home.php" --post_status=publish
!wp post create --post_type=page --post_title="犬連れのお客様へ" --post_status=publish
!wp post create --post_type=page --post_title="親子連れのお客様へ" --post_status=publish

7.メニュー登録 & ヘッダーロケーションに割当

bash
!wp menu create "global-nav"
!wp menu item add-post global-nav $(wp post list --post_title="Home" --field=ID)
# （他ページも同様に追加）
!wp menu location assign global-nav primary

8. Yoast 初期設定（タイトル/OGP 共通テンプレ）

bash
!wp yoast index

9.キャッシュ設定 & パーマリンク更新

bash
!wp option update permalink_structure "/%postname%/"
!wp rewrite flush
!wp wp-super-cache enable

10. Instagram フィードショートコードを “Home” ページ末尾へ追加

bash
!wp post meta add $(wp post list --post_title="Home" --field=ID) _kadence_blocks_content
```

---

## 9. 完了判定

1. `https://example.com` にアクセスし、ヒーロー画像・ハイライトカード・新着情報・Instagram グリッドが表示される。
2. 管理画面で「Home」固定ページを開き、ブロックエディタ上で各セクションが編集可能。
3. PageSpeed Insights（モバイル）スコア 80 以上。

---


