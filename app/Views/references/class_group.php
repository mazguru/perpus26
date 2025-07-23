<div x-data="
    DM(config)"
    x-init="loadDataTable(); loadAcademicYears(); loadOptions()">
    <div class="p-4 bg-white dark:bg-boxdark shadow-md md:flex items-center md:justify-between border-b border-gray-200 lg:mt-1.5">
        <div class="mb-1">
            <h1 class="text-xl sm:text-2xl font-semibold"><?= $title ?></h1>
            <div x-show="selectedAcademicYear" class="mt-2 text-lg text-gray-600">
                Tahun Pelajaran: <span x-text="academicYears.find(year => year.id === selectedAcademicYear)?.academic_year || 'Belum dipilih'"></span>
            </div>
        </div>

        <!-- Tombol-tombol yang responsif -->
        <div class="md:flex items-center space-x-2 sm:space-x-3">
            <!-- Dropdown Tahun Pelajaran -->
            <div class="relative">
                <label for="academic_year" class="sr-only">Tahun Pelajaran</label>
                <select
                    x-model="selectedAcademicYear"
                    @change="loadDataTable()"
                    class="border p-2 rounded w-full">
                    <option>Pilih Tahun Pelajaran</option>
                    <template x-for="year in academicYears" :key="year.id">
                        <option :value="year.id" x-text="year.academic_year"></option>
                    </template>
                </select>
            </div>

            <!-- Tombol Tambah Kelas -->
            <button @click="openModal('create')" class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center sm:w-auto">
                <i class="bi bi-plus-lg font-bold text-[14pt] mr-2"></i>
                Tambah Kelas
            </button>
        </div>
    </div>

    <?php $this->load->view('references/table_references') ?>

    <!-- Modal -->
    <div x-show="isModalOpen" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" x-transition>
        <div class="bg-white rounded-lg p-8 w-1/2">
            <h2 class="text-xl font-bold mb-4" x-text="modalType === 'create' ? 'Tambah Kelas' : 'Edit Kelas'"></h2>
            <form @submit.prevent="submitForm">
                <div class="mb-4">
                    <label for="academic_year_id" class="block font-bold">Tahun Pelajaran</label>
                    <select
                        id="academic_year_id"
                        x-model="form.academic_year_id"
                        required
                        class="w-full px-3 py-2 border rounded">
                        <option>Pilih Tahun Pelajaran</option>
                        <template x-for="year in academicYears" :key="year.id">
                            <option :value="year.id" x-text="year.academic_year"></option>
                        </template>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="class_name" class="block font-bold">Kelas</label>
                    <input
                        id="class_name"
                        x-model="form.class_name"
                        required
                        class="w-full px-3 py-2 border rounded"
                        :value="form.class_name" />
                </div>
                <div class="mb-4">
                    <label for="employee_id" class="block font-bold">Wali Kelas</label>
                    <select
                        id="employee_id"
                        x-model="form.employee_id"
                        required
                        class="w-full px-3 py-2 border rounded">
                        <option>Pilih Wali Kelas</option>
                        <template x-for="employee in optionsData.employee" :key="employee.id">
                            <option :value="employee.id" x-text="employee.nama_ptk"></option>
                        </template>
                    </select>
                </div>
                <div class="text-right">
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded">Simpan</button>
                    <button type="button" @click="closeModal" class="ml-2 bg-gray-500 text-white p-2 rounded">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const config = {
        sYear: true,
        ayUrl: _BASEURL + 'references/academic_year/list',
        controller: 'references/class_group',
        columns: [{
                label: 'Tahun Pelajaran',
                key: 'academic_year',
                render: (data, type, row) => `${data} - Semester ${row.semester === 'odd' ? '1' : '2'}`,
            },
            {
                label: 'Nama Kelas',
                key: 'class_name'
            },
            {
                label: 'Wali Kelas',
                key: 'wali_kelas'
            },
        ]
    };
</script>