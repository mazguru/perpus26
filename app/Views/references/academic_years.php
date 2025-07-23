<div class="container mx-auto mt-4"
    x-data="
    DM(config)"
    x-init="loadDataTable();">
    <div class="p-4 bg-white dark:bg-boxdark shadow-md md:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
        <div>
            <h1 class="text-xl sm:text-2xl font-semibold"><?= $title ?></h1>
        </div>
        <div class="md:flex items-center space-x-2">
            <button @click="openModal('create')" class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2">
                <svg class="-ml-1 mr-2 h-6 w-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                </svg>
                Tambah Tahun Pelajaran
            </button>
        </div>
    </div>

    <?php $this->load->view('references/table_references') ?>
    

    <div x-show="isModalOpen" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" x-transition>
        <div class="bg-white dark:bg-boxdark rounded-lg p-8 w-1/2">
            <h2 class="text-xl font-bold mb-4" x-text="modalType === 'create' ? 'Tambah Tahun Pelajaran' : 'Edit Tahun Pelajaran'"></h2>
            <form @submit.prevent="submitForm">
                
                <div class="mb-4">
                    <label for="academic_year" class="block font-bold">Tahun Pelajaran</label>
                    <input type="text" name="academic_year" id="academic_year" x-model="form.academic_year" :disabled="modalType === 'edit'" required class="w-full px-3 py-2 border rounded" />
                </div>
                <div class="mb-4">
                    <label for="current_year" class="block font-bold">Aktif</label>
                    <select name="current_year" id="current_year" x-model="form.current_year" required class="w-full px-3 py-2 border rounded">
                        <option value="" disabled>-- Pilih Status --</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>
                <div class="mb-4 text-right">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                    <button type="button" @click="closeModal" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const config = {
        controller: 'references/academic_year',
        columns: [{
                label: 'Tahun Pelajaran',
                key: 'academic_year'
            },
            {
                label: 'Is Aktif',
                key: 'current_year',
                render: (data) => (data === '1' ? 'Ya' : 'Tidak')
            }
        ]
    };
</script>