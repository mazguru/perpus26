<?php

namespace App\Controllers;

use App\Models\PostCategoriesModel;
use App\Models\publik\PostsModel as PublikPostsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Categories extends PublicController
{

    public function getIndex($slug = null)
    {
        if (!$slug) {
            throw PageNotFoundException::forPageNotFound('Kategori tidak ditemukan.');
        }

        // Ambil kategori
        $catModel = new PostCategoriesModel();
        $category = $catModel->where('category_slug', $slug)
                             ->where('deleted_at', null) // atau ->where('is_deleted', 0)
                             ->first();

        if (!$category) {
            throw PageNotFoundException::forPageNotFound('Kategori tidak ditemukan.');
        }

        $perPage = (int) (session('post_per_page') ?? 6);
        $page    = max(1, (int) ($this->request->getGet('page') ?? 1));

        // Ambil daftar post untuk kategori tsb
        $postModel = new PublikPostsModel();

        $postModel->select('posts.id, posts.post_title, posts.post_slug, posts.post_image, posts.post_content, posts.post_counter, posts.created_at, u.user_full_name AS post_author')
                  ->join('users u', 'u.id = posts.post_author', 'left')
                  ->forCategorySlug($slug)
                  ->where('posts.post_type', 'post')
                  ->where('posts.post_status', 'publish')
                  ->where('posts.post_visibility', 'public')
                  ->where('posts.deleted_at', null) // atau ->where('posts.is_deleted', 0)
                  ->orderBy('posts.created_at', 'DESC');

        $results = $postModel->paginate($perPage, 'default', $page);
        $pager   = $postModel->pager;

        // (Opsional) pastikan path pager tetap /kategori/{slug}
        $pager->setPath($this->request->getUri()->getPath());

        return view('layouts/master', [
            'title'    => $category['category_name'],
            'category' => $category,
            'results'  => $results,
            'pager'    => $pager,
            'content'  => 'frontend/categories/index',
        ]);
    }
    public function getList()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON([
                'status'  => 'error',
                'message' => 'Bad request (bukan AJAX).'
            ]);
        }

        $categorySlug = (string) $this->request->getPost('category_slug');
        $pageNumber   = (int) ($this->request->getPost('page_number') ?? 1);
        $pageNumber   = max(1, $pageNumber);

        $perPage = (int) (session('post_per_page') ?? 10);
        $perPage = $perPage > 0 ? $perPage : 10;

        $offset = ($pageNumber - 1) * $perPage;

        // Validasi alpha_dash sederhana: huruf, angka, strip (-)
        $isValidSlug = (bool) preg_match('/^[a-z0-9-]+$/i', $categorySlug);

        $rows = [];
        if ($isValidSlug) {
            $model = new PostsModel();
            // get_post_categories() sudah kita konversi untuk mengembalikan array
            $rows = $model->get_post_categories($categorySlug, $perPage, $offset);
        }

        return $this->response->setJSON([
            'rows' => $rows
        ]);
    }
}
