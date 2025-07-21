<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{
    protected $table            = 'settings';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'setting_variable',
        'setting_value',
        'setting_default_value',
        'setting_description',
        'setting_group',
        'setting_access_group',
        'is_deleted',
        'created_at',
        'updated_at'
    ];

    /**
     * Get data by keyword & group
     */
    public function getWhere(string $keyword = '', string $setting_group = 'general', string $return_type = 'count', int $limit = 0, int $offset = 0)
    {
        $builder = $this->select('id, setting_variable, COALESCE(setting_value, setting_default_value) AS setting_value, setting_description, is_deleted')
                        ->where('setting_group', $setting_group);

        if (!empty($keyword)) {
            $builder->groupStart()
                    ->like('setting_description', $keyword)
                    ->orLike('setting_value', $keyword)
                    ->groupEnd();
        }

        if ($return_type === 'count') {
            return $builder->countAllResults(false); // false agar tidak reset builder
        }

        if ($limit > 0) {
            $builder->limit($limit, $offset);
        }

        return $builder->get()->getResultArray();
    }

    /**
     * Get setting values (array key => value)
     */
    public function getSettingValues(string $access_group = 'public'): array
    {
        $builder = $this->select('setting_variable, COALESCE(setting_value, setting_default_value) AS setting_value');

        if ($access_group === 'public') {
            $builder->where('setting_access_group', 'public');
        }

        $result = $builder->get()->getResult();

        $settings = [];
        foreach ($result as $row) {
            $settings[$row->setting_variable] = $row->setting_value;
        }

        return $settings;
    }

    /**
     * Get setting values by group
     */
    public function getSettingGroupValues(string $group = 'school_profile', string $access_group = 'public'): array
    {
        $builder = $this->select('setting_variable, COALESCE(setting_value, setting_default_value) AS setting_value')
                        ->where('setting_group', $group);

        if ($access_group === 'public') {
            $builder->where('setting_access_group', 'public');
        }

        $result = $builder->get()->getResult();

        $settings = [];
        foreach ($result as $row) {
            $settings[$row->setting_variable] = $row->setting_value;
        }

        return $settings;
    }

    /**
     * Get all settings by group with options
     */
    public function getAllSettingsByGroup(string $group): array
    {
        return $this->db->table($this->table)
            ->select('settings.*, options.option_name')
            ->join('options', 'options.id = settings.setting_value AND options.option_group = settings.setting_variable', 'left')
            ->where('settings.setting_group', $group)
            ->get()
            ->getResultArray();
    }

    /**
     * Update setting by variable name
     */
    public function updateSetting(string $settingVariable, string $settingValue): bool
    {
        return $this->where('setting_variable', $settingVariable)
                    ->set([
                        'setting_value' => $settingValue,
                        'updated_at' => date('Y-m-d H:i:s')
                    ])
                    ->update();
    }
    // Mendapatkan semua pengaturan
    public function getAllSettings($group = null)
    {
        if ($group !== null) {
            return $this->where('setting_group', $group)->findAll();
        }

        return $this->findAll();
    }

    // Mendapatkan pengaturan berdasarkan nama
    public function getSetting($name)
    {
        return $this->where('setting_variable', $name)->first();
    }
}
