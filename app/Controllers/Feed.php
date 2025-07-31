<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\publik\PostsModel;
use CodeIgniter\I18n\Time;

class Feed extends BaseController
{
    
    /**
     * Contoh feed XML generic (bukan RSS/Atom).
     * URL: /feed.xml  (lihat routes di bawah)
     */
    public function getIndex()
    {
        helper(['url', 'Site', 'App']); // site => untuk strip_tags_truncate() jika Anda pakai

        $limit = (int) ($this->request->getGet('limit') ?? 20);

        // Ganti dengan class model CI4 Anda
        $posts = get_latest_posts($limit);

        // Normalisasi data ke struktur array agar formatter XML rapi
        $items = [];
        foreach ($posts as $p) {
            $title   = $p['post_title']   ?? ($p['title'] ?? '');
            $slug    = $p['post_slug']    ?? ($p['slug'] ?? '');
            $content = $p['post_content'] ?? ($p['content'] ?? '');
            $created = $p['created_at']   ?? ($p['updated_at'] ?? Time::now('UTC')->toDateTimeString());
            $updated = $p['updated_at']   ?? $created;

            $items[] = [
                'id'         => (int)($p['id'] ?? 0),
                'title'      => $title,
                'slug'       => $slug,
                'url'        => base_url('post/' . $slug),
                'excerpt'    => strip_tags_truncate($content, 300),
                'created_at' => date(DATE_ATOM, strtotime($created)),
                'updated_at' => date(DATE_ATOM, strtotime($updated)),
            ];
        }

        $payload = [
            'site'  => [
                'title'        => __session('nama_perpus'),
                'link'         => rtrim(base_url(), '/'),
                'generated_at' => date(DATE_ATOM),
            ],
            // Agar elemen anak tidak semuanya “<item>0</item>…”, bungkus dengan nama elemen jelas:
            'items' => [
                'item' => $items, // CI4 formatter akan membuat <items><item>...</item></items>
            ],
        ];

        // Gunakan setXML() agar header Content-Type: application/xml otomatis
        // (Anda masih bisa menambah ETag/Cache-Control bila perlu)
        $xmlResponse = $this->response->setXML($payload);

        // Opsi caching ringan (ETag)
        $etag = '"' . sha1($xmlResponse->getBody()) . '"';
        $xmlResponse
            ->setHeader('ETag', $etag)
            ->setCache(['max-age' => 300, 's-maxage' => 300]);

        if ($this->request->getHeaderLine('If-None-Match') === $etag) {
            return $xmlResponse->setStatusCode(304);
        }

        return $xmlResponse;
    }
}
