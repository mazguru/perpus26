<?php

namespace App\Libraries;

use SimpleXMLElement;

class XmlFeed
{
    private $xml;
    private $channel;

    public function __construct()
    {
        $this->xml = new SimpleXMLElement('<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom"></rss>');
        $this->channel = $this->xml->addChild('channel');
        $this->channel->addChild('atom:link', null, 'http://www.w3.org/2005/Atom')->addAttribute('rel', 'self')->addAttribute('type', 'application/rss+xml')->addAttribute('href', site_url('feed')); // Sesuaikan dengan URL feed Anda
    }

    public function addChannel($title, $description, $link)
    {
        $this->channel->addChild('title', $title);
        $this->channel->addChild('description', $description);
        $this->channel->addChild('link', $link);
    }

    public function addItem($title, $description, $link, $pubDate)
    {
        $item = $this->channel->addChild('item');
        $item->addChild('title', $title);
        $item->addChild('description', $description);
        $item->addChild('link', $link);
        $item->addChild('pubDate', date('D, d M Y H:i:s T', strtotime($pubDate))); // Format tanggal yang benar
    }


    public function render()
    {
        return $this->xml->asXML();
    }
}