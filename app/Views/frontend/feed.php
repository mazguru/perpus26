<?= '<?xml version="1.0" encoding="' . $encoding . '"?>' . "\n"; ?>
<rss version="2.0"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:admin="http://webns.net/mvcb/"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:wfw="http://wellformedweb.org/CommentAPI/"
    xmlns:atom="http://www.w3.org/2005/Atom"
    xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
    xmlns:georss="http://www.georss.org/georss"
    xmlns:geo="http://www.w3.org/2003/01/geo/wgs84_pos#"
    xmlns:media="http://search.yahoo.com/mrss/"
    xmlns:content="http://purl.org/rss/1.0/modules/content/">
<channel>
    <title><?= esc($feed_name) ?></title>
    <link><?= esc($feed_url) ?></link>
    <description><?= esc($page_description) ?></description>
    <dc:language><?= esc($page_language) ?></dc:language>
    <dc:creator><?= esc($creator_email) ?></dc:creator>
    <dc:rights>Copyright <?= gmdate("Y") ?></dc:rights>
    <admin:generatorAgent rdf:resource="https://www.sekolahku.web.id/" />

    <?php foreach ($posts as $post): ?>
        <item>
            <title><?= esc($post['post_title']) ?></title>
            <link><?= base_url($post['post_type'] . '/' . $post['post_slug']) ?></link>
            <guid><?= base_url($post['post_type'] . '/' . $post['post_slug']) ?></guid>
            <description><![CDATA[ <?= strip_tags_truncate($post['post_content'], 200) ?> ]]></description>
            <pubDate><?= esc($post['created_at']) ?></pubDate>
        </item>
    <?php endforeach ?>
</channel>
</rss>
