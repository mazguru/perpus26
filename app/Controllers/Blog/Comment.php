<?php

namespace App\Controllers\Blog;

use App\Controllers\AdminController;
use App\Models\CommentModel;
use CodeIgniter\HTTP\ResponseInterface;

class Comment extends AdminController
{
    protected $m_comment;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->m_comment = new CommentModel();
        // 🔑 Inisialisasi Primary Key & Table
        $this->pk = 'id';            // Ganti dengan nama kolom PK sebenarnya
        $this->table = 'comments';      // Nama tabel
        $this->model = new \App\Models\GenericModel($this->table, $this->pk);
        helper(['form', 'url']);
    }

    public function getIndex(): string
    {
        $data = [
            'title' => 'Komentar',
            'media' => true,
            'content' => 'admin/comments/index',
        ];
        return view('layouts/master_admin', $data);
    }

    public function getList()
    {
        $data = [
            'data' => $this->m_comment
                ->get_where('', 'rows'),
            'alldata' => $this->m_comment
                ->get_where('', 'rows')
        ];

        return $this->response->setJSON($data);
    }

    public function postUpdate($id)
    {
        helper(['form', 'text']);

        // 1) ID valid?
        if ($id <= 0) {
            return $this->response->setStatusCode(422)->setJSON([
                'status'  => 'error',
                'message' => 'ID tidak valid.',
            ]);
        }

        // 2) Ambil payload (dukung JSON atau form-urlencoded)
        $payload = $this->request->getPost();

        // 3) Cek apakah data ada
        $existing = $this->m_comment->find($id);
        if (!$existing) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Komentar tidak ditemukan.',
            ]);
        }

        // Opsional: blok update jika data soft-deleted
        if (isset($existing['is_deleted']) && $existing['is_deleted'] === 'true') {
            return $this->response->setStatusCode(422)->setJSON([
                'status'  => 'error',
                'message' => 'Komentar sudah dihapus.',
            ]);
        }

        // 4) Validasi (partial update tetap aman)
        $rules = [
            'comment_reply'   => 'permit_empty|string',
            'comment_status'  => 'permit_empty|in_list[approved,pending,spam,rejected]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setStatusCode(422)->setJSON([
                'status'  => 'error',
                'message' => 'Validasi gagal.',
                'errors'  => $this->validator->getErrors(),
            ]);
        }

        // 5) Whitelist field yang boleh diupdate
        $allowed = $this->m_comment->allowedFields ?? [
            'comment_author',
            'comment_email',
            'comment_content',
            'comment_reply',
            'comment_status',
        ];
        $data = array_intersect_key($payload, array_flip($allowed));

        // Tidak ada field yang boleh diupdate?
        if (empty($data)) {
            return $this->response->setStatusCode(422)->setJSON([
                'status'  => 'error',
                'message' => 'Tidak ada field yang dapat diperbarui.',
            ]);
        }

        // 6) Audit
        if (in_array('updated_by', $allowed, true)) {
            $data['updated_by'] = session('user_id');
        }

        // 7) Eksekusi update
        $ok = $this->m_comment->update($id, $data);

        if ($ok === false) {
            // Ambil error dari model jika ada
            return $this->response->setStatusCode(500)->setJSON([
                'status'  => 'error',
                'message' => 'Gagal memperbarui komentar.',
                'errors'  => $this->m_comment->errors() ?? null,
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Komentar berhasil diperbarui.',
        ]);
    }

    
}
