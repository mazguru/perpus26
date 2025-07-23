function settingsApp(config) {
    return {
        baseUrl: _BASEURL + config.dirUpload,
        data: '',
        isModalOpen: false,
        editIndex: null,
        editItem: {
            setting_description: '',
            setting_variable: '',
            setting_value: ''
        },
        selectedFile: null,
        errorData: '',
        async fetchData(url, method = 'GET', body = null) {
            try {
                const headers = {
                    'X-Requested-With': 'XMLHttpRequest'
                };
                const isFormData = body instanceof FormData;

                if (!isFormData) headers['Content-Type'] = 'application/json';

                const response = await fetch(url, {
                    method,
                    headers,
                    body: body ? (isFormData ? body : JSON.stringify(body)) : null
                });

                // Handle status error
                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('HTTP Error', response.status, errorText);
                    return null; // fetchData akan return null => tangani di pemanggil
                }

                return await response.json();
            } catch (error) {
                console.error('Fetch error:', error);
                return null;
            }
        },
        async loadSettings() {
            const response = await this.fetchData(_BASEURL + `${config.controller}/get_settings`);
            if (response) {
                this.data = response;
            } else {
                Swal.fire('Error', 'Gagal memuat data.', 'error');
            }
        },
        getFieldType(variable) {
            if (this.isDateField(variable)) return "date";
            if (this.isNumberField(variable)) return "number";
            return "text";
        },
        isDateField(variable) {
            return ["site_maintenance_end_date", "decree_operating_permit_date", "date_of_birth"].includes(variable);
        },
        isNumberField(variable) {
            return ["age", "price", "quantity"].includes(variable);
        },
        isUploadField(settingVariable) {
            return ['favicon', 'logo', 'header'].includes(settingVariable);
        },
        isTextArea(settingVariable) {
            return ['meta_description', 'meta_keywords'].includes(settingVariable);
        },
        isOptions(settingVariable) {
            return ['site_maintenance', 'cooming_soon', 'timezone', 'recaptcha_status', 'site_cache'].includes(settingVariable);
        },
        optionSources: {
            site_maintenance: { true: 'Ya', false: 'Tidak' },
            site_cache: { true: 'Ya', false: 'Tidak' },
            timezone: {
                'Asia/Jakarta': 'Asia/Jakarta',
                'Asia/Makassar': 'Asia/Makassar',
                'Asia/Jayapura': 'Asia/Jayapura'
            },
            recaptcha_status: {
                'enable': 'Enable',
                'disable': 'Disable'
            }
        },
        getOptions(key) {
            return this.optionSources[key] || {};
        },
        openEditModal(index) {
            this.editIndex = index;
            this.editItem = {
                ...this.data[index]
            };
            this.isModalOpen = true;
        },
        closeModal() {
            this.isModalOpen = false;
            this.editItem = {
                setting_description: '',
                setting_variable: '',
                setting_value: ''
            };
            this.errorData = '';
            this.selectedFile = null;
        },
        async saveEdit() {

            if (this.isUploadField(this.editItem.setting_variable) && !this.selectedFile) {
                Swal.fire('Error', 'File harus diunggah untuk pengaturan ini.', 'error');
                return;
            }
            this.updateSettingValue();
            if (this.selectedFile) await this.uploadFile();
        },
        async updateSettingValue() {
            const url = _BASEURL + `${config.controller}/save`;
            const response = await this.fetchData(url, 'POST', this.editItem);
            console.log(response);
            if (response.status == 'success') {
                Notifier.show('Berhasil', response.message, response.status);
                this.loadSettings();
                this.closeModal();
            } else {
                this.errorData = response.errors;
                Notifier.show('Gagal', response.message, response.status);
            }

        },
        handleFileChange(event) {
            const file = event.target.files[0];
            const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (file && allowedExtensions.includes(file.name.split('.').pop().toLowerCase())) {
                this.selectedFile = file; // Simpan file jika valid
            } else {
                this.selectedFile = null; // Reset jika file tidak valid
                Swal.fire('Error', 'File harus berupa JPG, JPEG, PNG, atau GIF.', 'error');
            }
        },
        async uploadFile() {
            const formData = new FormData();
            formData.append('file', this.selectedFile);
            formData.append('setting_variable', this.editItem.setting_variable);
            formData.append('id', this.editItem.id);

            const response = await this.fetchData(_BASEURL + `${config.controller}/upload`, 'POST', formData);
            if (response && response.status) {
                Notifier.show('Berhasil', response.message, response.status);
                this.loadSettings();
                this.closeModal();
            } else {
                Notifier.show('Gagal', response.message, response.status);
            }
        },

    };
}