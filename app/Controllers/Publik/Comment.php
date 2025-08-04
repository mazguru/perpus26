<?php

namespace App\Controllers\Publik;

use App\Controllers\PublicController;
use App\Models\CommentModel;

class Comment extends PublicController
{
    protected $commentModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
    }

    public function list($postId)
    {
        $page = (int) $this->request->getGet('page') ?? 1;
        $limit = 5;
        $offset = ($page - 1) * $limit;

        $comments = $this->commentModel->getTopLevelComments($postId, $limit, $offset);

        $totalTopLevel = $this->commentModel
            ->where('comment_post_id', $postId)
            ->where('comment_parent_id', null)
            ->where('is_deleted', 'false')
            ->whereIn('comment_status', ['approved', 'unapproved'])
            ->countAllResults();

        return $this->response->setJSON([
            'comments' => $comments,
            'more'     => ($offset + $limit) < $totalTopLevel
        ]);
    }
    public function replies($postId)
    {
        $replies  = $this->commentModel->getReplies($postId);

        return $this->response->setJSON([
            'replies'  => $replies,
        ]);
    }

    public function save()
    {
        helper(['form', 'text']);

        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Request bukan AJAX.']);
        }

        // Ambil data (mendukung JSON dan form)
        $payload = $this->request->getJSON(true);

        // Validasi
        $rules = [
            'comment_id'      => 'permit_empty|is_natural_no_zero', // dipakai untuk update comment_reply
            'comment_author'  => 'required|string|max_length[100]',
            'comment_email'   => 'required|valid_email|max_length[150]',
            'comment_url'     => 'permit_empty|valid_url_strict|max_length[255]',
            'comment_content' => 'required|string|min_length[15]',
            'comment_reply'   => 'permit_empty|string',
            'comment_status'  => 'permit_empty|in_list[approved,unapproved,spam,rejected]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setStatusCode(422)->setJSON([
                'status'  => 'error',
                'message' => 'Validasi gagal.',
                'errors'  => $this->validator->getErrors(),
            ]);
        }

        $commentId = (int) ($payload['comment_id'] ?? 0);

        if ($commentId > 0 && isset($payload['comment_reply'])) {
            // ❗ Update comment_reply admin
            $ok = $this->commentModel->update($commentId, [
                'comment_reply' => esc($payload['comment_reply']),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);

            if (! $ok) {
                return $this->response->setStatusCode(500)->setJSON([
                    'status'  => 'error',
                    'message' => 'Gagal menyimpan balasan admin.',
                    'errors'  => $this->commentModel->errors() ?? null,
                ]);
            }

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Balasan admin berhasil disimpan.',
            ]);
        } else {
            // 🔁 Komentar biasa
            unset($payload['comment_id']); // Pastikan tidak dikira update

            $payload['comment_status']     = 'unapproved';
            $payload['comment_agent']     = $this->request->getUserAgent()->getAgentString();
            $payload['comment_ip_address'] = $this->request->getIPAddress();
            $payload['created_at']         = date('Y-m-d H:i:s');

            $ok = $this->commentModel->insert($payload);

            if (! $ok) {
                return $this->response->setStatusCode(500)->setJSON([
                    'status'  => 'error',
                    'message' => 'Gagal menyimpan komentar.',
                    'errors'  => $this->commentModel->errors() ?? null,
                ]);
            }

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Komentar berhasil disimpan.',
            ]);
        }
    }
    public function sendmessage()
    {
        helper(['form', 'text']);

        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Request bukan AJAX.']);
        }

        // Ambil data (mendukung JSON dan form)
        $payload = $this->request->getJSON(true);

        // Validasi
        $rules = [
            'comment_author'  => 'required|string|max_length[100]',
            'comment_email'   => 'required|valid_email|max_length[150]',
            'comment_url'     => 'permit_empty|valid_url_strict|max_length[255]',
            'comment_subject' => 'permit_empty|string|max_length[255]',
            'comment_content' => 'required|string|min_length[25]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setStatusCode(422)->setJSON([
                'status'  => 'error',
                'message' => 'Validasi gagal.',
                'errors'  => $this->validator->getErrors(),
            ]);
        }

        $payload['comment_status']     = 'unapproved';
        $payload['comment_type']     = 'message';
        $payload['comment_agent']     = $this->request->getUserAgent()->getAgentString();
        $payload['comment_ip_address'] = $this->request->getIPAddress();
        $payload['created_at']         = date('Y-m-d H:i:s');

        $ok = $this->commentModel->insert($payload);

        if (! $ok) {
            return $this->response->setStatusCode(500)->setJSON([
                'status'  => 'error',
                'message' => 'Gagal menyimpan komentar.',
                'errors'  => $this->commentModel->errors() ?? null,
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Komentar berhasil disimpan.',
        ]);
    }
}
