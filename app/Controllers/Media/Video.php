<?php

namespace App\Controllers\Media;

use App\Controllers\AdminController;
use App\Models\PostsModel;
use CodeIgniter\HTTP\ResponseInterface;

class Video extends AdminController
{
    protected $m_videos;
    protected $photoModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->m_videos = new PostsModel();
        // 🔑 Inisialisasi Primary Key & Table
        $this->pk = 'id';            // Ganti dengan nama kolom PK sebenarnya
        $this->table = 'posts';      // Nama tabel
        $this->model = new \App\Models\GenericModel($this->table, $this->pk);
        helper(['form', 'url']);
    }

    public function getIndex(): string
    {
        $data = [
            'title' => 'Galeri Video',
            'content' => 'admin/media/video',
        ];
        return view('layouts/master_admin', $data);
    }

    public function getList()
    {
        $data = [
            'data' => $this->m_videos
                ->where('is_deleted', 'false')
                ->where('post_type', 'video')
                ->findAll(),
            'alldata' => $this->m_videos
                ->where('post_type', 'video')
                ->findAll()
        ];

        return $this->response->setJSON($data);
    }

    public function postCreate()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Permintaan bukan AJAX.'
            ]);
        }

        // Ambil slug dari input dan buat versi URL-friendly
        $slugInput = $this->request->getPost('post_title');
        $slug = url_title($slugInput, '-', true);

        $postImage = $this->request->getFile('post_image');

        // Validasi input
        $validationRules = [
            'post_title' => 'required|max_length[120]',
            'post_content' => 'required'
        ];

        if ($postImage && $postImage->isValid() && !$postImage->hasMoved()) {
            $validationRules['post_image'] = [
                'uploaded[post_image]',
                'is_image[post_image]',
                'max_size[post_image,2048]',
                'mime_in[post_image,image/jpg,image/jpeg,image/png]'
            ];
        }

        if (!$this->validate($validationRules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $this->validator->getErrors()
            ]);
        }

        // Ambil data
        $data = [
            'post_title' => $this->request->getPost('post_title'),
            'post_slug' => $slug,
            'post_content' => $this->request->getPost('post_content'),
            'post_categories' => $this->request->getPost('post_categories'),
            'post_status' => $this->request->getPost('post_status'),
            'post_visibility' => $this->request->getPost('post_visibility'),
            'post_comment_status' => $this->request->getPost('post_comment_status'),
            'post_type' => 'video',
            'post_author' => session('user_id'),
        ];

        // Upload dan resize image
        if ($postImage && $postImage->isValid() && !$postImage->hasMoved()) {
            $newName = $slug . '.' . $postImage->getExtension();
            $data['post_image'] = $newName;

            $originalPath = FCPATH . 'media_library/posts/original/';
            $thumbPath = FCPATH . 'media_library/posts/thumbs/';
            $headerPath = FCPATH . 'media_library/posts/headers/';

            helper('filesystem');
            foreach ([$originalPath, $thumbPath, $headerPath] as $dir) {
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }
            }

            $postImage->move($originalPath, $newName, true);

            // Resize thumbnail
            \Config\Services::image()
                ->withFile($originalPath . $newName)
                ->resize(session('post_image_thumbnail_width'), session('post_image_thumbnail_height'), false)
                ->save($thumbPath . $newName);

            // Resize header
            \Config\Services::image()
                ->withFile($originalPath . $newName)
                ->resize(1200, 400, true)
                ->save($headerPath . $newName);
        }

        // Cek slug jika duplikat (kecuali sedang edit dirinya sendiri)

        $cekin = $this->m_videos->getIdBySlug($slug);
        if ($cekin) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Slug sudah digunakan oleh post lain.'
            ]);
        }

        $success = $this->m_videos->insert($data);
        $action = 'ditambahkan';
        return $this->response->setJSON([
            'status' => $success ? 'success' : 'error',
            'message' => $success ? "Post berhasil $action." : "Post gagal $action.",
        ]);
    }

    public function postUpdate($id)
    {
        helper(['form', 'text']);
        $album = $this->m_videos->find($id);
        if (!$album) {
            return $this->failNotFound('Album tidak ditemukan');
        }

        $data = [
            'album_title'       => $this->request->getPost('album_title'),
            'album_description' => $this->request->getPost('album_description'),
            'album_slug'        => url_title($this->request->getPost('album_title'), '-', true),
            'updated_at'        => date('Y-m-d H:i:s'),
            'updated_by'        => session('user_id'),
        ];

        $cover = $this->request->getFile('image_cover');
        if ($cover && $cover->isValid() && !$cover->hasMoved()) {
            $newName = $cover->getRandomName();
            $cover->move(FCPATH . 'media_library/images', $newName);
            $data['image_cover'] = $newName;

            // Hapus cover lama jika ada
            if ($album['image_cover'] && file_exists(FCPATH . 'media_library/images/' . $album['image_cover'])) {
                unlink(FCPATH . 'media_library/images/' . $album['image_cover']);
            }
        }

        $this->m_videos->update($id, $data);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Album berhasil diperbarui.'
        ]);
    }

    public function postUploadImage($id)
    {
        $album = $this->m_videos->find($id);
        if (!$album) {
            return $this->failNotFound('Album tidak ditemukan');
        }

        $files = $this->request->getFiles();
        if (!$files || !isset($files['photos'])) {
            return $this->failValidationErrors(['photos' => 'Foto tidak ditemukan']);
        }

        $photos = $files['photos'];
        foreach ($photos as $photo) {
            if ($photo->isValid() && !$photo->hasMoved()) {
                $filename = $photo->getRandomName();
                $photo->move('media_library/images/', $filename);

                $this->photoModel->insert([
                    'photo_album_id' => $id,
                    'photo_name'     => $filename,
                    'created_at'     => date('Y-m-d H:i:s'),
                    'created_by'     => session('user_id'),
                    'is_deleted'     => 'false'
                ]);
            }
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Foto berhasil diunggah.'
        ]);
    }

    // Helper
    private function failValidationErrors($errors)
    {
        return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
            ->setJSON([
                'status' => 'error',
                'message' => $errors
            ]);
    }
    private function failNotFound()
    {
        return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)->setJSON([
            'status' => 'error',
            'message' => 'Data tidak ditemukan.'
        ]);
    }
}
