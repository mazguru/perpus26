<div x-data="
    DM(config)"
    x-init="loadDataTable(); loadAcademicYears(); loadOptions()">
    <div class="p-4 bg-white dark:bg-boxdark shadow-md block sm:flex items-center justify-between border-b border-gray-200">
        <div class="mb-1 w-full">

            <div class="mb-4">
                <h1 class="text-xl sm:text-2xl font-semibold"><?= $title ?></h1>
            </div>

            <div class="sm:flex">
                <div x-show="selectedAcademicYear" class="sm:flex items-center sm:divide-x sm:divide-gray-100 mb-3 sm:mb-0">
                    <p>Menampilkan data siswa Tahun Pelajaran <br> <span x-text="academicYears.find(year => year.id === selectedAcademicYear)?.academic_year || 'Belum dipilih'" class='font-semibold'> </span></p>
                </div>

                <div class="flex items-center space-x-2 sm:space-x-3 ml-auto">
                    <!-- Dropdown Tahun Pelajaran -->
                    <div class="relative">
                        <label for="academic_year" class="sr-only">Tahun Pelajaran</label>
                        <select
                            x-model="selectedAcademicYear"
                            @change="loadDataTable()"
                            class="border p-2 rounded w-full">
                            <option value="">Pilih Tahun Pelajaran</option>
                            <template x-for="year in academicYears" :key="year.id">
                                <option :value="year.id" x-text="year.academic_year"></option>
                            </template>
                        </select>
                    </div>
                    <button @click="openModal('create')" class="w-1/2 text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center sm:w-auto">
                        <i class="bi bi-plus-lg font-bold text-[14pt] mr-2"></i>
                        Tambah Siswa
                    </button>

                    <a :href="_BASEURL + 'references/import_data_siswa'" class="w-1/2  bg-white dark:bg-boxdark border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center sm:w-auto">
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
            x-show="isModalMoveStudents"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
            x-cloak>
            <div class="bg-white rounded-lg shadow-lg w-96">
                <div class="border-b p-4 flex justify-between items-center">
                    <h2 class="text-lg font-semibold">Pindahkan Siswa</h2>
                    <button @click="closeModalMoveStudents()" class="text-gray-500 hover:text-gray-700">&times;</button>
                </div>
                <div class="p-4">
                    <form @submit.prevent="submitMoveStudent">
                        <div class="mb-4">
                            <label for="academic_year" class="block text-sm font-medium">Tahun Ajaran</label>
                            <select
                                id="academic_year"
                                x-model="academicYearsMove"
                                @change="filterClasses()"
                                class="w-full mt-1 p-2 border rounded"
                                required>
                                <option value="" disabled>Pilih Tahun Ajaran</option>
                                <template x-for="year in academicYears" :key="year.id">
                                    <option :value="year.id" x-text="`${year.academic_year} - Semester ${year.semester}`"></option>
                                </template>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="class" class="block text-sm font-medium">Kelas</label>
                            <select
                                id="class"
                                x-model="classId"
                                class="w-full mt-1 p-2 border rounded"
                                required>
                                <option value="" disabled>Pilih Kelas</option>
                                <template x-for="cls in classes" :key="cls.id">
                                    <option :value="cls.id" x-text="cls.class_name"></option>
                                </template>
                            </select>
                        </div>
                    </form>


                </div>
                <div class="border-t p-4 flex justify-end">
                    <button
                        @click="closeModalMoveStudents()"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded mr-2">
                        Batal
                    </button>
                    <button
                        @click="submitMoveStudent"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Pindahkan
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah dan Edit -->
    <div x-show="isModalOpen" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-999" x-transition>
        <div class="bg-white rounded-lg p-8 w-full md:w-1/2 max-h-screen overflow-y-auto">

            <!-- Judul Modal -->
            <h2 class="text-xl font-semibold mb-4" x-text="modalType == 'edit' ? 'Edit Siswa' : 'Tambah Siswa'"></h2>

            <!-- Form -->
            <form @submit.prevent="submitForm" class=''>
                <input type="hidden" x-model="form.id">
                <div class="p-6 grid grid-cols-6 gap-6">

                    <!-- Absensi -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="abs" class="block text-sm font-semibold">Absensi</label>
                        <input type="text" id="abs" x-model="form.abs" class="mt-1 p-2 border border-gray-300 rounded w-full bg-gray-50 dark:bg-gray-700">
                        <p x-show="errors.abs" class="text-red-500 text-xs italic mt-1" x-text="errors.abs"></p>
                    </div>

                    <!-- Nama -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="nama" class="block text-sm font-semibold">Nama</label>
                        <input type="text" id="nama" x-model="form.nama" class="mt-1 p-2 border border-gray-300 rounded w-full bg-gray-50 dark:bg-gray-700">
                        <p x-show="errors.nama" class="text-red-500 text-xs italic mt-1" x-text="errors.nama"></p>
                    </div>

                    <!-- NIPD -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="nipd" class="block text-sm font-semibold">NIPD</label>
                        <input type="text" id="nipd" x-model="form.nipd" class="mt-1 p-2 border border-gray-300 rounded w-full bg-gray-50 dark:bg-gray-700">
                        <p x-show="errors.nipd" class="text-red-500 text-xs italic mt-1" x-text="errors.nipd"></p>
                    </div>

                    <!-- NISN -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="nisn" class="block text-sm font-semibold">NISN</label>
                        <input type="text" id="nisn" x-model="form.nisn" class="mt-1 p-2 border border-gray-300 rounded w-full bg-gray-50 dark:bg-gray-700">
                        <p x-show="errors.nisn" class="text-red-500 text-xs italic mt-1" x-text="errors.nisn"></p>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="jk" class="block text-sm font-semibold">Jenis Kelamin</label>
                        <select id="jk" x-model="form.jk" class="mt-1 p-2 border border-gray-300 rounded w-full bg-gray-50 dark:bg-gray-700">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <!-- Tempat Lahir -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="tempat_lahir" class="block text-sm font-semibold">Tempat Lahir</label>
                        <input type="text" id="tempat_lahir" x-model="form.tempat_lahir" class="mt-1 p-2 border border-gray-300 rounded w-full bg-gray-50 dark:bg-gray-700">
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="tanggal_lahir" class="block text-sm font-semibold">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" x-model="form.tanggal_lahir" class="mt-1 p-2 border border-gray-300 rounded w-full bg-gray-50 dark:bg-gray-700">
                    </div>

                    <!-- Agama -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="agama" class="block text-sm font-semibold">Agama</label>
                        <select id="agama" x-model="form.agama" class="shadow-sm bg-gray-50 dark:bg-gray-700 border border-gray-300 sm:text-sm rounded-lg block w-full p-2.5">
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katholik">Katholik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>

                    <!-- Tahun Pelajaran Masuk -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="academic_year_id" class="block text-sm font-semibold">Tahun Pelajaran Masuk</label>
                        <select id="academic_year_id" x-model="form.academic_year_id_in" class="shadow-sm bg-gray-50 dark:bg-gray-700 border border-gray-300 sm:text-sm rounded-lg block w-full p-2.5">
                            <option value="">--Pilih Tahun Pelajaran--</option>
                            <template x-for="year in academicYears" :key="year.id">
                                <option :value="year.id" x-text="year.academic_year"></option>
                            </template>
                        </select>
                    </div>
                    <!-- Kelas Masuk -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="kelas" class="block text-sm font-semibold">Kelas Masuk</label>
                        <select id="cls" x-model="form.class_id_in" class="shadow-sm bg-gray-50 dark:bg-gray-700 border border-gray-300 sm:text-sm rounded-lg block w-full p-2.5">
                            <option value="">--Pilih Kelas--</option>
                            <template x-for="cls in formClasses2" :key="cls.id">
                                <option :value="cls.id" x-text="cls.class_name"></option>
                            </template>
                        </select>
                    </div>
                    <!-- Tahun Pelajaran -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="academic_year_id" class="block text-sm font-semibold">Tahun Pelajaran</label>
                        <select id="academic_year_id" x-model="form.academic_year_id" class="shadow-sm bg-gray-50 dark:bg-gray-700 border border-gray-300 sm:text-sm rounded-lg block w-full p-2.5">
                            <option value="">--Pilih Tahun Pelajaran--</option>
                            <template x-for="year in academicYears" :key="year.id">
                                <option :value="year.id" x-text="year.academic_year"></option>
                            </template>
                        </select>
                    </div>
                    <!-- Kelas -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="kelas" class="block text-sm font-semibold">Kelas</label>
                        <select id="kelas" x-model="form.class_id" class="shadow-sm bg-gray-50 dark:bg-gray-700 border border-gray-300 sm:text-sm rounded-lg block w-full p-2.5">
                            <option value="">--Pilih Kelas--</option>
                            <template x-for="kelas in formClasses" :key="kelas.id">
                                <option :value="kelas.id" x-text="kelas.class_name"></option>
                            </template>
                        </select>
                    </div>

                    <!-- Alamat -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="address" class="block text-sm font-semibold">Alamat</label>
                        <textarea id="address" x-model="form.address" class="mt-1 p-2 border border-gray-300 rounded w-full bg-gray-50 dark:bg-gray-700"></textarea>
                    </div>

                    <!-- Telepon -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="phone" class="block text-sm font-semibold">Telepon</label>
                        <input type="text" id="phone" x-model="form.phone" class="mt-1 p-2 border border-gray-300 rounded w-full bg-gray-50 dark:bg-gray-700">
                        <p x-show="errors.phone" class="text-red-500 text-xs italic mt-1" x-text="errors.phone"></p>
                    </div>

                    <!-- HP -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="hp" class="block text-sm font-semibold">HP</label>
                        <input type="text" id="hp" x-model="form.hp" class="mt-1 p-2 border border-gray-300 rounded w-full bg-gray-50 dark:bg-gray-700">
                        <p x-show="errors.hp" class="text-red-500 text-xs italic mt-1" x-text="errors.hp"></p>
                    </div>

                    <!-- Email -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="email" class="block text-sm font-semibold">Email</label>
                        <input type="email" id="email" x-model="form.email" class="mt-1 p-2 border border-gray-300 rounded w-full bg-gray-50 dark:bg-gray-700">
                    </div>
                </div>

                <!-- Tombol Simpan & Batal -->
                <div class="flex justify-end">
                    <button type="button" @click="closeModal" class="px-4 py-2 bg-gray-400 text-white rounded mr-2">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>


</div>

<script>
    const config = {
        sYear: true,
        ayUrl: _BASEURL + 'references/academic_year/list',
        controller: 'references/students',
        is_move: true,
        is_add_user: true,
        columns: [{
                label: 'Nama Lengkap',
                key: 'nama'
            },
            {
                label: 'NIPD',
                key: 'nipd'
            },
            {
                label: 'NISN',
                key: 'nisn'
            },
            {
                label: 'Kelas',
                key: 'class_name'
            },
            {
                label: 'Jenis Kelamin',
                key: 'jk',
                render: (data) => (data === 'L' ? 'Laki-laki' : 'Perempuan')
            },
            {
                label: 'Tempat Lahir',
                key: 'tempat_lahir'
            },
            {
                label: 'Tanggal Lahir',
                key: 'tanggal_lahir',
                render: (data, type, row) => {
                    if (!row.tanggal_lahir) return '-'; // Handle jika tanggal_lahir null/undefined

                    let [year, month, day] = row.tanggal_lahir.split('-');
                    let months = [
                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    ];

                    return `${parseInt(day)} ${months[parseInt(month) - 1]} ${year}`;
                }
            },
        ]
    };
</script>