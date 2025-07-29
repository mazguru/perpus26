<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CommentModel;

class Comment extends BaseController
{
    protected $commentModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
    }

    public function getList($postId)
    {
        $page = (int) $this->request->getGet('page') ?? 1;
        $limit = 5;
        $offset = ($page - 1) * $limit;

        $comments = $this->commentModel->getTopLevelComments($postId, $limit, $offset);
        $replies  = $this->commentModel->getReplies($postId);

        $totalTopLevel = $this->commentModel
            ->where('comment_post_id', $postId)
            ->where('comment_parent_id', null)
            ->where('is_deleted', 0)
            ->where('comment_status', 1)
            ->countAllResults();

        return $this->response->setJSON([
            'comments' => $comments,
            'replies'  => $replies,
            'more'     => ($offset + $limit) < $totalTopLevel
        ]);
    }

    public function postSave()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['status' => 'error', 'message' => 'Akses tidak diizinkan']);
        }

        $data = $this->request->getJSON(true);
        $data['comment_status'] = 'unapproved';
        $data['comment_agent'] = $this->request->getUserAgent();
        $data['comment_ip_address'] = $this->request->getIPAddress();
        $data['is_deleted'] = 'false';

        if (! isset($data['comment_author'], $data['comment_content'], $data['comment_email'])) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data tidak lengkap']);
        }

        $this->commentModel->insert($data);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Komentar berhasil dikirim']);
    }
}
