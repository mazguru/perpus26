<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\Auth;
use App\Models\SettingsModel;
use App\Models\OptionsModel;

class Trigger implements FilterInterface
{
    protected $auth;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->auth = new Auth();
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        $settingAccessGroup = $this->auth->has_login() ? 'private' : 'public';

        $settingsModel = new SettingsModel();
        $optionsModel = new OptionsModel();

        $sessionData = [];
        $settings = $settingsModel->getSettingValues($settingAccessGroup);

        foreach ($settings as $setting_variable => $setting_value) {
            $session_value = $setting_value;

            if ($setting_variable == 'school_level') {
                $options = $optionsModel->where('id', $setting_value)->first();
                if ($options && isset($options['option_name'])) {
                    $session_value = substr($options['option_name'], 0, 1);
                }
            }

            $sessionData[$setting_variable] = $session_value;
        }

        $session->set($sessionData);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Kosong
    }
}
