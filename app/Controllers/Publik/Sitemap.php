<?php

namespace App\Controllers\Publik;

use App\Controllers\PublicController;
use App\Models\publik\PostsModel;

class Sitemap extends PublicController
{
    public function index()
    {
        // Ambil data dari model
        $postModel = new PostsModel();
        $data = [
            'posts' => $postModel->feed(), // Sesuaikan dengan query Anda
            'siteTitle' => 'Nama Situs Anda',
            'siteDescription' => 'Deskripsi situs Anda',
        ];
        // Set header XML
        return $this->response
            ->setContentType('application/xml')
            ->setBody(view('sitemap', $data));
    }
    public function feed()
    {
        $feed = new \App\Libraries\XmlFeed();

        // Tambahkan channel dengan metadata baru
        $feed->tambahChannel(
            session('nama_perpus'),
            session('meta_description'),
            session('email'),       // dc:creator
            'Copyright 2025',             // dc:rights
            'https://www.sinmat.my.id/' // admin:generatorAgent
        );

        // Ambil data dari model
        $postModel = new PostsModel();
        $posts = $postModel->feed();

        // Tambahkan item untuk setiap post
        foreach ($posts as $post) {
            $feed->tambahItem(
                $post['post_title'],
                strip_tags_truncate($post['post_content']),
                site_url('post/' . $post['post_slug']),
                $post['created_at'],
                $post['author_email'],
                null, // GUID opsional
                [$post['category_name']] // Array kategori
            );
        }

        // Output sebagai XML
        return $this->response->setXML($feed->render());
    }
}
