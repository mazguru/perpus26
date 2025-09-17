<?= '<?xml version="1.0" encoding="UTF-8"?>' . "\n" ?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title><![CDATA[<?= esc($siteTitle) ?>]]></title>
        <link><?= base_url() ?></link>
        <description><![CDATA[<?= esc($siteDescription) ?>]]></description>
        <language>id-id</language>
        <atom:link href="<?= base_url('sitemap.xml') ?>" rel="self" type="application/rss+xml" />
        <lastBuildDate><?= date('r') ?></lastBuildDate>
        <generator>CodeIgniter 4</generator>

        <?php foreach ($posts as $post): ?>
        <item>
            <title><![CDATA[<?= esc($post['post_title']) ?>]]></title>
            <link><?= base_url($post['post_slug']) ?></link>
            <guid isPermaLink="true"><?= base_url($post['post_slug']) ?></guid>
            <description><![CDATA[<?= strip_tags_truncate($post['post_content']) ?>]]></description>
            <pubDate><?= date('r', strtotime($post['created_at'])) ?></pubDate>
            <?php if (!empty($post['category_name'])): ?>
            <category><![CDATA[<?= esc($post['category_name']) ?>]]></category>
            <?php endif; ?>
        </item>
        <?php endforeach; ?>
    </channel>
</rss>