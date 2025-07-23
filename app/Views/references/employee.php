<div x-data="
    DM(config)"
    x-init="loadDataTable()">
    <div class="p-4 bg-white dark:bg-boxdark shadow-md block sm:flex items-center justify-between border-b border-gray-200">
        <div class="mb-1 w-full">

            <div class="mb-4">
                <h1 class="text-xl sm:text-2xl font-semibold"><?= $title ?></h1>
            </div>

            <div class="sm:flex">
                <div class="sm:flex items-center sm:divide-x sm:divide-gray-100 mb-3 sm:mb-0">
                    <p>Menampilkan data Guru</p>
                </div>

                <div class="flex items-center space-x-2 sm:space-x-3 ml-auto">

                <button @click="openModal('create')" class="w-1/2 text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center sm:w-auto">
                        <i class="bi bi-plus-lg font-bold text-[14pt] mr-2"></i>
                        Tambah Guru
                    </button>

                    <a href="<?= base_url('references/import_data_guru') ?>" class="w-1/2  bg-white dark:bg-boxdark border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center sm:w-auto">
                        <i class="bi bi-file-earmark-excel-fill text-[14pt] mr-2"></i>
                        Import
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('references/table_references') ?>
    <div class="shadow-2 bg-white dark:bg-boxdark block rounded">
        <div
            x-show="isModalOpen"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
            x-cloak>
            <div class="bg-white rounded-lg shadow-lg w-full md:w-1/2 max-h-screen overflow-y-auto">
                <form @submit.prevent="submitForm" class="rounded shadow-2">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700 rounded-t">
                        <h2 class="text-xl font-semibold mb-4" x-text="modalType == 'edit' ? 'Edit Data Guru' : 'Tambah Data Guru'"></h2>
                    </div>

                    <div class="p-6 grid grid-cols-6 gap-6">
                        <!-- Nama PTK -->
                        <div class="col-span-6 sm:col-span-3">
                            <label class="block mb-2 font-medium">Nama PTK</label>
                            <input type="text" x-model="form.nama_ptk" class="w-full p-2 border rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                            <p class="text-red-500 text-sm" x-text="errors.nama_ptk"></p>
                        </div>

                        <!-- NIP -->
                        <div class="col-span-6 sm:col-span-3">
                            <label class="block mb-2 font-medium">NIP</label>
                            <input type="text" x-model="form.nip" class="w-full p-2 border rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                            <p class="text-red-500 text-sm" x-text="errors.nip"></p>
                        </div>

                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-3">
                            <label class="block mb-2 font-medium">Email</label>
                            <input type="email" x-model="form.email" class="w-full p-2 border rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                            <p class="text-red-500 text-sm" x-text="errors.email"></p>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="col-span-6 sm:col-span-3">
                            <label class="block mb-2 font-medium">Jenis Kelamin</label>
                            <select x-model="form.jk" class="w-full p-2 border rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            <p class="text-red-500 text-sm" x-text="errors.jk"></p>
                        </div>

                        <!-- Tempat Lahir -->
                        <div class="col-span-6 sm:col-span-3">
                            <label class="block mb-2 font-medium">Tempat Lahir</label>
                            <input type="text" x-model="form.tempat_lahir" class="w-full p-2 border rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                            <p class="text-red-500 text-sm" x-text="errors.tempat_lahir"></p>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="col-span-6 sm:col-span-3">
                            <label class="block mb-2 font-medium">Tanggal Lahir</label>
                            <input type="date" x-model="form.tanggal_lahir" class="w-full p-2 border rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                            <p class="text-red-500 text-sm" x-text="errors.tanggal_lahir"></p>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label class="block mb-2 font-medium">Telepon</label>
                            <input type="text" x-model="form.telepon" class="w-full p-2 border rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                            <p class="text-red-500 text-sm" x-text="errors.telepon"></p>
                        </div>

                        <!-- Alamat -->
                        <div class="col-span-6 sm:col-span-3">
                            <label class="block mb-2 font-medium">Jenis PTK</label>
                            <select x-model="form.jenis_ptk" class="w-full p-2 border rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                <option>--Jenis PTK--</option>
                                <option value='guru'>Guru</option>
                                <option value='tendik'>Tenaga Pendidik</option>
                            </select>
                            <p class="text-red-500 text-sm" x-text="errors.jenis_ptk"></p>
                        </div>
                        <div class="col-span-6">
                            <label class="block mb-2 font-medium">Alamat</label>
                            <textarea x-model="form.alamat" class="w-full p-2 border rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600"></textarea>
                            <p class="text-red-500 text-sm" x-text="errors.alamat"></p>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 rounded-b">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                            <span>Simpan</span>
                        </button>
                        <button type="button" @click="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>

<script>
    const config = {
        controller: 'references/employee',
        is_add_user:true,
        columns: [{
                label: 'Nama PTK',
                key: 'nama_ptk'
            },
            {
                label: 'NIP',
                key: 'nip'
            },
            {
                label: 'Jenis Kelamin',
                key: 'jk',
                render: (data) => (data === 'L' ? 'Laki-laki' : 'Perempuan')
            },
            {
                label: 'Tempat, Tanggal Lahir',
                key: 'tempat_lahir',
                render: (data, type, row) => {
                    if (!row.tanggal_lahir) return '-'; // Handle jika tanggal_lahir null/undefined

                    let [year, month, day] = row.tanggal_lahir.split('-');
                    let months = [
                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    ];

                    return `${data}, ${parseInt(day)} ${months[parseInt(month) - 1]} ${year}`;
                }
            },
            {
                label: 'Jenis PTK',
                key: 'jenis_ptk'
            },
            {
                label: 'Email',
                key: 'email'
            },
        ]
    };
</script>