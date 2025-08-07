# 丹後王国ウェブサイト コンテンツ生成指示書

Gemini-CLIへ：
以下の指示に従い、各WordPress固定ページにコンテンツを生成し、適用してください。
指示に記載の画像パスは、GitHubリポジトリ `https://github.com/daichira-gif/tango_kingdom` をローカルにクローンした際のパスを基準としています。
`C:\Users\daich\Local Sites\tangokingdom\app\public\tango_kingdom_assets` をクローン先と想定します。
画像のインポートが必要な場合は、WP-CLIの `wp media import` コマンドを使用してください。
コンテンツを生成・適用する前に、必ず私に確認を求めてください。

---

## 1. ホームページ (`Home` ページ) のコンテンツ生成

「Home」固定ページに対して、以下の要件に基づいてコンテンツを生成し、既存のページに上書きしてください。
Homeページは、WordPress管理画面で「設定」>「表示設定」から「固定ページ」として設定されることを想定しています。

**参照元ファイル:**
`C:\Users\daich\Local Sites\tangokingdom\app\publictango_kingdom_assets\front-page.php`
`C:\Users\daich\Local Sites\tangokingdom\app\publictango_kingdom_assets\assets` ディレクトリ内の画像ファイル

### 1.1 メインビジュアル / ヒーローセクション

-   `front-page.php` の `.main-visual-slider` セクションの内容を基に、Kadence Blocks の `Row Layout` または `Cover` ブロックを使用してメインビジュアルを構築してください。
-   **画像:** `tango_kingdom_assets/assets/slider/` 内にある画像ファイル (`*.jpg, *.png`) をWordPressのメディアライブラリにインポートし、これらをメインビジュアルのスライダー画像として設定してください。
    -   `wp media import` コマンドを使用し、各画像をインポート後、そのURLを取得してHTMLに埋め込むか、適切なKadenceブロックのスライダー機能に設定してください。
-   **テキスト:**
    -   大見出し: 「家族も愛犬も、とっておきの休日を」
    -   小見出し: 「丹後王国「食のみやこ」で自然・体験・グルメを満喫」
    -   これらのテキストは、Kadence Blocks の `Advanced Heading` または `Text` ブロックで配置し、適切にスタイリングしてください。
-   `page-home.php` テンプレートのACFフィールド（hero_image, hero_caption）を使用できる場合は、それらを活用し、画像URLとキャッチコピーを設定してください。ACFフィールドに設定された内容が、`page-home.php` で表示されるようにしてください。

### 1.2 カテゴリナビゲーションセクション

-   `front-page.php` の `.category-grid` の内容を基に、Kadence Blocks の `Buttons` ブロックや `Row Layout` を組み合わせて作成してください。
-   各ボタンは「体験」「愛犬と楽しむ」「グルメ」「泊まる」「新着情報」「アクセス」とし、それぞれ対応するセクションへのアンカーリンクを設定してください。

### 1.3 体験プログラムセクション (`#experience`)

-   `front-page.php` の `#experience` セクションの内容を基に、Kadence Blocks の `Row Layout` と、その中に3つの `Info Box` または `Advanced Gallery` と `Caption` の組み合わせを使用し、カード形式で表示してください。
-   各カードの内容（画像、タイトル、説明、リンク）は、`front-page.php` に記述されているものを正確に再現してください。
    -   **画像パスの変換:** 各画像のパス（例: `<?php echo get_stylesheet_directory_uri(); ?>/assets/cards/Sea_Tango-Kingdom-Shoku-no-Miyako-04-1024x683.webp`）は、WordPressのメディアライブラリにインポートした後の実際の画像URLに変換してください。インポートには `wp media import` を使用します。
    -   **リンクの変換:** `home_url()` で生成されている内部リンクは、WordPressの固定ページへの内部リンクとして設定してください。

### 1.4 ペット向けサービスセクション (`#dog`)

-   `front-page.php` の `#dog` セクションの内容を基に、Kadence Blocks の `Row Layout` と3つのカード（`Info Box` または `Advanced Gallery` + `Caption`）でコンテンツを生成してください。
-   背景色は「light-bg」に相当するKadence Blocksの背景設定を適用してください。
-   画像パスとリンクは、上記「体験プログラムセクション」と同様にWordPress対応の形式に変換してください。

### 1.5 グルメセクション (`#gourmet`)

-   `front-page.php` の `#gourmet` セクションの内容を基に、Kadence Blocks の `Row Layout` と3つのカード（`Info Box` または `Advanced Gallery` + `Caption`）でコンテンツを生成してください。
-   画像パスとリンクは、上記と同様にWordPress対応の形式に変換してください。外部サイトへのリンクは `target="_blank"` を付与してください。

### 1.6 宿泊プランセクション (`#stay`)

-   `front-page.php` の `#stay` セクションの内容を基に、Kadence Blocks の `Row Layout` と2つのカード（`Info Box` または `Advanced Gallery` + `Caption`）でコンテンツを生成してください。
-   背景色は「light-bg」に相当するKadence Blocksの背景設定を適用してください。
-   画像パスとリンクは、上記と同様にWordPress対応の形式に変換してください。外部サイトへのリンクは `target="_blank"` を付与してください。

### 1.7 新着情報セクション (`#news`)

-   `front-page.php` の `#news` セクションの内容を基に、Kadence Blocks の `Query Loop` ブロックを使用して新着情報を表示してください。
-   `post_type` は `post`、`posts_per_page` は `3` とし、日付順で最新の3件を表示するように設定してください。
-   「もっと見る」リンクは、新着情報の一覧ページ（例: `home_url('/news/')`）へ設定してください。
-   このセクションを正確に機能させるためには、事前にいくつかダミーの投稿（記事）を作成しておく必要があるかもしれません。

### 1.8 Instagram フィードセクション

-   `front-page.php` の `[instagram-feed layout=grid num=6 cols=3]` ショートコードを `Home` ページのコンテンツに含めてください。
-   このショートコードが正しく機能するためには、`Smash Balloon Social Photo Feed` プラグインの設定（Instagramアカウントとの連携など）が完了している必要があります。

### 1.9 アクセスセクション (`#access`)

-   `front-page.php` の `#access` セクションの内容を基に、Google Maps の埋め込み (`<iframe>`) を含むセクションを生成してください。
-   Kadence Blocks の `Row Layout` や `Embed` ブロックなどを活用してください。
-   `src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3241.1080253723735!2d135.068268!3d35.674341999999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5fffa4c27b6bc53b%3A0x4f7ddc708ea650ce!2z6YGT44Gu6aeFIOS4ueW-jOeOi-WbvSDpo5_jga7jgb_jgoTjgZM!5e0!3m2!1sja!2sjp!4v1750574517068!5m2!1sja!2sjp"` のURLは、実際の丹後王国のGoogle Maps埋め込みコード（iframe）に置き換える必要があります。この点については、もしGoogle Maps APIキーがあればそれを考慮することも可能ですが、現時点ではプレースホルダーとして保持してください。

---

**Gemini-CLIへの指示:**
これらの指示を実行する際、以下のツールを適切に使用してください。
-   `ReadFile`: 既存のHTMLファイルや画像の内容を読み込むため。
-   `Shell wp media import`: ローカルの画像ファイルをWordPressのメディアライブラリにインポートするため。
-   `Shell wp post meta update`: ACFフィールドやその他の投稿メタデータを更新するため。
-   `Shell wp post update`: 既存のページのコンテンツをWordPressのブロックエディタ形式（HTMLコメント付きのブロックデータ）で更新するため。
-   `Shell wp option update`: WordPressのオプションを更新するため。

**最終確認:**
すべてのコンテンツが `Home` 固定ページにブロックエディタの形式で適用されたことを、WordPress管理画面の固定ページ編集画面で確認できるようにしてください。