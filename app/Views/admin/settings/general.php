<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <!-- begin: grid -->
    <div class="flex flex-col gap-5 lg:gap-7.5">
        <div x-data="settingsApp(config)" x-init="loadSettings()">
            <!-- Card -->
            <div class="card bg-white shadow-lg rounded-lg min-w-full">
                <div class="card-header mb-4">
                    <h3 class="text-xl font-bold"><?= $title ?> </h3>
                </div>
                <div class="card-body overflow-x-auto pb-3">
                    <table class="table w-full table-striped table-hover text-sm md:text-md">
                        <tbody>
                            <template x-for="(item, index) in data" :key="index">
                                <tr class="border-b">
                                    <td class="px-4 py-2 ">
                                        <span x-text="item.setting_description"></span>
                                    </td>
                                    <td class="px-4 py-2 ">
                                        <template x-if="item.setting_value && item.setting_value.match(/\.(jpeg|jpg|gif|png)$/)">
                                            <img :src="baseUrl + item.setting_value" alt="Image" class="w-20 h-20 object-cover rounded">
                                        </template>
                                        <template x-if="item.setting_value && !item.setting_value.match(/\.(jpeg|jpg|gif|png)$/)">
                                            <span x-text="item.setting_value"></span>
                                        </template>
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        <button class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600"
                                            @click="openEditModal(index)">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Edit -->
            <div x-show="isModalOpen" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
                <div class="card w-full md:w-1/2 mx-2 p-6">

                    <h2 class="text-lg font-semibold mb-4" x-text="editItem.setting_description">Edit Info</h2>
                    <form @submit.prevent="saveEdit" novalidate>
                        <!-- Field Name (Read-Only) -->
                        <div class="mb-4">
                            <input hidden type="text" id="editLabel" class="w-full border rounded px-3 py-2 mt-1 bg-gray-100"
                                x-model="editItem.setting_description" readonly>
                        </div>

                        <!-- Non-Upload Field: Text Input for Setting Value -->
                        <div class="mb-4" x-show="!isUploadField(editItem.setting_variable) && !isTextArea(editItem.setting_variable) && !isOptions(editItem.setting_variable)">
                            <label class="block text-sm font-medium text-gray-600" for="editsetting_value">Setting Value</label>
                            <input :type="getFieldType(editItem.setting_variable)" id="editsetting_value" class="w-full border rounded px-3 py-2 mt-1"
                                x-model="editItem.setting_value" required>
                        </div>

                        <!-- Upload Field: Display Upload Input for Image or File -->
                        <template x-if="isUploadField(editItem.setting_variable)">
                            <div class="mb-4">
                                <div class="mb-2">
                                    <label class="block text-sm font-medium text-gray-600">Gambar Aktif:</label>
                                    <img :src="baseUrl + editItem.setting_value" alt="Current Image" class="w-20 h-20 object-cover rounded border">
                                </div>
                                <label class="block text-sm font-medium text-gray-600" for="editFile">Upload File</label>
                                <input type="file" id="editFile" class="w-full border rounded px-3 py-2 mt-1"
                                    @change="handleFileChange($event)">
                                <span class="text-sm text-gray-500" x-show="selectedFile">
                                    Selected File: <span x-text="selectedFile ? selectedFile.name : ''"></span>
                                </span>
                            </div>
                        </template>

                        <!-- Textarea Field -->
                        <template x-if="isTextArea(editItem.setting_variable)">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600" for="editTextarea">Setting Value</label>
                                <textarea rows="5" id="editTextarea" class="w-full border rounded px-3 py-2 mt-1"
                                    x-model="editItem.setting_value"></textarea>
                            </div>
                        </template>

                        <!-- Select Field -->
                        <template x-if="isOptions(editItem.setting_variable)">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600" for="editSelect">Pilih Opsi</label>
                                <select id="editSelect" class="w-full border rounded px-3 py-2 mt-1" x-model="editItem.setting_value">

                                    <option value="true">True</option>
                                    <option value="false">False</option>

                                </select>
                            </div>
                        </template>
                        <p class='text-xs text-red-500 italic' x-html='errorData'></p>

                        <!-- Action Buttons -->
                        <div class="flex justify-end">
                            <button type="button" @click="closeModal()" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500 mr-2">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Save
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const config = {
        controller: 'settings/general',
        dirUpload: 'upload/image/'
    }

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
                    const response = await fetch(url, {
                        method,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        body: body ? JSON.stringify(body) : null,
                    });
                    if (!response.ok) throw new Error('Network response was not ok');
                    data = await response.json();
                    
                    return data;

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
                return ['favicon', 'logo'].includes(settingVariable);
            },
            isTextArea(settingVariable) {
                return ['meta_description', 'meta_keywords'].includes(settingVariable);
            },
            isOptions(settingVariable) {
                return ['site_maintenance', 'cooming_soon'].includes(settingVariable);
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
                const response = await fetchData(_BASEURL + `${config.controller}/upload`, 'POST', formData);
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
</script>


<?= $this->endSection() ?>