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
                        <thead>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-bold bg-gray-200">Setting Name</td>
                                <td class="px-4 py-2 font-bold bg-gray-200">Setting Value</td>
                                <td class="px-4 py-2 font-bold bg-gray-200">Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(item, index) in data" :key="index">
                                <tr class="border-b">
                                    <td class="px-4 py-2 ">
                                        <span x-text="item.setting_description"></span>
                                    </td>
                                    <td class="px-4 py-2 ">
                                        <template x-if="item.setting_value && item.setting_value.match(/\.(jpeg|jpg|gif|png)$/)">
                                            <img :src="_BASEURL + 'assets/images/' + item.setting_value" alt="Image" class="h-20 object-cover rounded">
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
                        <template x-if="isUploadField(editItem.setting_variable)">
                            <div class="mb-4">
                                <label class="block text-xs font-semibold mb-1">Logo</label>
                                <input name="link_image" type="file" @change="handleFileChange" accept="image/*"
                                    class="w-full border rounded px-3 py-2">
                                <template x-if="previewFile">
                                    <img :src="previewFile" class="mt-2 w-32 h-32 object-cover rounded">
                                </template>
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
                                    <option>Pilih Opsi</option>
                                    <template x-for="(label, value) in getOptions(editItem.setting_variable)" :key="value">
                                        <option :value="value" x-text="label"></option>
                                    </template>

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