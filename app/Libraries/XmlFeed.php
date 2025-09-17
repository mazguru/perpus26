<?php

namespace App\Libraries;

use SimpleXMLElement;

class XmlFeed
{
    private $xml;
    private $channel;
    private $siteUrl;

    public function __construct()
    {
        $this->siteUrl = site_url();
        $this->inisialisasiFeed();
    }

    private function inisialisasiFeed(): void
    {
        // Namespace tambahan untuk Dublin Core dan Admin
        $namespaces = [
            'xmlns:atom' => 'http://www.w3.org/2005/Atom',
            'xmlns:dc' => 'http://purl.org/dc/elements/1.1/',
            'xmlns:admin' => 'http://webns.net/mvcb/',
            'xmlns:rdf' => 'http://www.w3.org/1999/02/22-rdf-syntax-ns#'
        ];

        $this->xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><rss version="2.0"/>');
        
        // Tambahkan namespaces
        foreach ($namespaces as $key => $value) {
            $this->xml->addAttribute($key, $value);
        }

        $this->channel = $this->xml->addChild('channel');
        
        // Link atom referensial
        $atom = $this->channel->addChild('atom:link', '', 'http://www.w3.org/2005/Atom');
        $atom->addAttribute('href', $this->siteUrl . 'feed');
        $atom->addAttribute('rel', 'self');
        $atom->addAttribute('type', 'application/rss+xml');
    }

    public function tambahChannel(
        string $judul, 
        string $deskripsi, 
        string $creator,
        string $hakCipta,
        string $generatorAgent,
        string $link = null
    ): self {
        $link = $link ?? $this->siteUrl;
        
        $this->channel->addChild('title', $this->escapeCdata($judul));
        $this->channel->addChild('description', $this->escapeCdata($deskripsi));
        $this->channel->addChild('link', $link);
        $this->channel->addChild('language', 'id-id');
        $this->channel->addChild('generator', 'CodeIgniter 4');
        $this->channel->addChild('lastBuildDate', date('r'));
        
        // Metadata Dublin Core
        $this->channel->addChild('dc:creator', $this->escapeCdata($creator), 'http://purl.org/dc/elements/1.1/');
        $this->channel->addChild('dc:rights', $this->escapeCdata($hakCipta), 'http://purl.org/dc/elements/1.1/');
        
        // Metadata Admin
        $admin = $this->channel->addChild('admin:generatorAgent', '', 'http://webns.net/mvcb/');
        $admin->addAttribute('rdf:resource', $generatorAgent, 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');

        return $this;
    }

    public function tambahItem(
        string $judul,
        string $deskripsi,
        string $link,
        string $tanggalPublikasi,
        string $creator = null,
        string $guid = null,
        array $kategori = []
    ): self {
        $item = $this->channel->addChild('item');
        $item->addChild('title', $this->escapeCdata($judul));
        $item->addChild('description', $this->escapeCdata($deskripsi));
        $item->addChild('link', $link);
        $item->addChild('pubDate', date('r', strtotime($tanggalPublikasi)));
        
        // Dublin Core untuk item
        if ($creator) {
            $item->addChild('dc:creator', $this->escapeCdata($creator), 'http://purl.org/dc/elements/1.1/');
        }
        
        // GUID
        $guidElement = $item->addChild('guid', $guid ?? $link);
        $guidElement->addAttribute('isPermaLink', ($guid === null) ? 'true' : 'false');
        
        // Kategori
        foreach ($kategori as $kat) {
            $item->addChild('category', $this->escapeCdata($kat));
        }

        return $this;
    }

    public function render(): string
    {
        return $this->xml->asXML();
    }

    private function escapeCdata(string $konten): string
    {
        return htmlspecialchars($konten, ENT_XML1, 'UTF-8');
    }

    public function output(): void
    {
        header('Content-Type: application/xml; charset=UTF-8');
        echo $this->render();
        exit;
    }
}