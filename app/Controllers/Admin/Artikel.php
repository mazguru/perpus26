<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\ArtikelModel;

class Artikel extends BaseController
{
    public function index()
    {
        $model = new ArtikelModel();
        $data['artikel'] = $model->findAll();
        $data = [
            'title'    => 'Artikel',
            'artikel' => $model->findAll(),
            'content'  => 'admin/artikel/index'
        ];

        return view('admin/artikel/index', $data);
    }

    public function tambah()
    {
        return view('admin/artikel/tambah');
    }

    public function simpan()
    {
        $model = new ArtikelModel();
        $slug = url_title($this->request->getPost('judul'), '-', true);

        $model->insert([
            'judul' => $this->request->getPost('judul'),
            'slug' => $slug,
            'isi' => $this->request->getPost('isi'),
            'penulis' => session()->get('nama')
        ]);

        return redirect()->to('/admin/artikel');
    }

    public function edit($id)
    {
        $model = new ArtikelModel();
        $data['artikel'] = $model->find($id);
        return view('admin/artikel/edit', $data);
    }

    public function update($id)
    {
        $model = new ArtikelModel();
        $slug = url_title($this->request->getPost('judul'), '-', true);

        $model->update($id, [
            'judul' => $this->request->getPost('judul'),
            'slug' => $slug,
            'isi' => $this->request->getPost('isi'),
        ]);

        return redirect()->to('/admin/artikel');
    }

    public function delete($id)
    {
        $model = new ArtikelModel();
        $model->delete($id);
        return redirect()->to('/admin/artikel');
    }
}