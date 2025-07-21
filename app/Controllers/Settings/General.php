<?php
namespace App\Controllers\Settings;

use App\Controllers\AdminController;
use App\Models\SettingsModel;

class General extends AdminController
{
    protected $settingsModel;

    public function __construct()
    {
        $this->settingsModel = new SettingsModel();
    }

    public function index()
    {
        return view('admin/settings/general', [
            'title' => 'Pengaturan Umum',
            'settings' => true,
            'general_settings' => true
        ]);
    }

    public function getSettings()
    {
        $settings = $this->settingsModel->getSettingGroupValues('general');
        $results = [];
        foreach ($settings as $key => $value) {
            $description = $this->settingsModel->getSetting($key);
            $results[] = [
                'id' => $description['id'],
                'setting_variable' => $key,
                'setting_description' => $description['setting_description'],
                'setting_value' => $value
            ];
        }
        return $this->response->setJSON($results);
    }

    public function save()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Request bukan AJAX.']);
        }

        $data = $this->request->getJSON(true);
        $id = $data['id'] ?? null;

        if (!$id || !$this->validate(['setting_value' => 'required'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Periksa form kembali',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $updated = $this->settingsModel->update($id, [
            'setting_value' => $data['setting_value'],
            'updated_by' => session('user_id')
        ]);

        return $this->response->setJSON([
            'status' => $updated ? 'success' : 'error',
            'message' => $updated ? 'Data Anda berhasil disimpan.' : 'Terjadi kesalahan dalam menyimpan data'
        ]);
    }

    public function upload()
    {
        if (!$this->request->isAJAX()) return;

        $id = (int)$this->request->getPost('id');
        $setting = $this->settingsModel->find($id);
        $oldFile = $setting['setting_value'] ?? '';

        $file = $this->request->getFile('file');
        if (!$file->isValid()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $file->getErrorString()
            ]);
        }

        $newName = $file->getRandomName();
        $file->move('upload/image/', $newName);

        if ($oldFile && is_file(FCPATH . 'upload/image/' . $oldFile)) {
            @unlink(FCPATH . 'upload/image/' . $oldFile);
        }

        $this->settingModel->update($id, ['setting_value' => $newName]);

        if ($setting['setting_variable'] != 'headmaster_photo') {
            $this->imageResize(FCPATH . 'upload/image/', $newName, $setting['setting_variable']);
        }

        return $this->response->setJSON(['status' => 'success', 'message' => 'uploaded']);
    }

    private function imageResize($path, $fileName, $key)
    {
        $settings = [
            'headmaster_photo_width' => session('headmaster_photo_width') ?? 252,
            'headmaster_photo_height' => session('headmaster_photo_height') ?? 344,
            'logo_width' => session('logo_width') ?? 120,
            'logo_height' => session('logo_height') ?? 120,
            'favicon_width' => session('favicon_width') ?? 50,
            'favicon_height' => session('favicon_height') ?? 50
        ];

        $service = \Config\Services::image()
            ->withFile($path . $fileName)
            ->resize(
                (int)($settings[$key . '_width'] ?? 120),
                (int)($settings[$key . '_height'] ?? 120),
                true
            )
            ->save($path . $fileName);
    }
}
