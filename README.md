# 丹後王国「食のみやこ」WordPressサイト

このリポジトリは、WordPressサイト「丹後王国 食のみやこ」のソースコードを管理しています。主にLocal by Flywheelなどのローカル開発環境での利用を想定しており、サイトの継続的な開発と管理を目的としています。

## プロジェクト概要

「丹後王国 食のみやこ」は、道の駅としての情報発信、施設案内、イベント情報などを提供するWordPressベースのウェブサイトです。KadenceテーマとKadence Blocksプラグインを主要なツールとして使用しています。

## 開発環境のセットアップ

このリポジトリをクローンして開発を継続する際の基本的な手順と留意事項です。

### 1. リポジトリのクローン

```bash
git clone https://github.com/daichira-gif/tango-kingdom-wordpress.git
cd tango-kingdom-wordpress
```

### 2. ローカル開発環境の準備

Local by Flywheel、XAMPP、MAMP、DockerなどのWordPress開発環境をご利用ください。
`app/public` ディレクトリがWordPressのルートディレクトリとなるように設定します。

### 3. データベースのインポート

`app/sql/local.sql` にサイトのデータベースダンプが含まれています。ローカル環境のデータベースにこのファイルをインポートしてください。

**注意:** データベースのバックアップは `sql_backup.tar.gz` として別途管理されています。

### 4. メディアファイルの配置

`app/public/wp-content/uploads/` ディレクトリに、必要なメディアファイルを配置してください。これらのファイルはGitの管理対象外です。

### 5. WordPressのURL更新

データベースをインポートした後、WordPressのサイトURLがローカル環境に合わせていない場合があります。以下のいずれかの方法でURLを更新してください。

*   **WP-CLI (推奨):**
    ```bash
    wp option update home http://your-local-site.local
    wp option update siteurl http://your-local-site.local
    ```
    (`http://your-local-site.local` は実際のローカルサイトURLに置き換えてください。)
*   **phpMyAdminなどのデータベースツール:** `wp_options` テーブルの `siteurl` と `home` の値を直接更新します。
*   **`wp-config.php` で定義 (一時的または開発用):**
    ```php
    define('WP_HOME','http://your-local-site.local');
    define('WP_SITEURL','http://your-local-site.local');
    ```
    (これらの行は、本番環境にデプロイする前に削除またはコメントアウトしてください。)

### 6. プラグインとテーマ

*   **Kadence Blocks:** このサイトではKadence Blocksプラグインを多用しています。アコーディオンブロックの動作には、特定のHTML構造とJSONデータが必要です。
    *   **留意点:** 以前の作業で、アコーディオンブロックのコードがWordPressの自動修正機能によって調整されることが確認されました。これは、Kadence Blocksが期待する厳密な構文に合致させるためのものです。手動でコードを編集する際は、WordPressのビジュアルエディタで生成されるコードを参考にすることをお勧めします。
*   **子テーマ (`kadence-child`):** カスタムCSSや機能追加は、この子テーマの `style.css` や `functions.php` に記述されています。親テーマのアップデートに影響されないよう、子テーマでの開発を推奨します。
*   **カスタムCSS (`custom_style.css`):** サイト全体のデザイン調整や、特定のカスタムHTMLブロックにスタイルを適用するために使用されます。このファイルは子テーマの `functions.php` から読み込まれます。

### 7. Git運用に関する留意点

*   **コミットメッセージ:** コミットメッセージにスペースが含まれる場合は、必ずダブルクォーテーションで囲んでください（例: `git commit -m "Your commit message"`）。
*   **履歴の競合:** `git pull` 時に `refusing to merge unrelated histories` エラーが発生した場合、通常は `git pull --allow-unrelated-histories` で解決できます。ただし、**強制プッシュ (`git push -f`) は、他の開発者がいないことを確認した上で、最終手段としてのみ使用してください。**

## 成果物

*   `page-faq.html`: 修正された「よくある質問」ページのHTMLコンテンツ。
*   `page-harvest-farm.html`: 「収穫体験農園」ページのHTMLコンテンツ。
*   `page-small-zoo.html`: 「小さな動物園」ページのHTMLコンテンツ。
*   `page-grass-sliding.html`: 「芝すべり」ページのHTMLコンテンツ。
*   `page-wood-athletic.html`: 「木製アスレチック広場」ページのHTMLコンテンツ。
*   `page-blueberry-farm.html`: 「ブルーベリー園」ページのHTMLコンテンツ。
*   `page-forest-walk.html`: 「森の散策路」ページのHTMLコンテンツ。
*   `page-tango-takumian.html`: 「お土産処 丹後匠庵」ページのHTMLコンテンツ。
*   `sql_backup.tar.gz`: データベースのダンプファイル (`app/sql/local.sql`) の圧縮アーカイブ。Git管理対象外。
