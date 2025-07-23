<div x-data="importDataFormRef(config)" x-init="loadAcademicYears()" class='w-full md:w-3/4 mx-auto'>
    <form
        @submit.prevent="submitForm"
        enctype="multipart/form-data"
        class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">

        <!-- Header -->
        <div class="border-b border-stroke px-6.5 py-4 dark:border-strokedark">
            <h2 class="text-xl font-semibold mb-4">Import Data Siswa</h2>
        </div>

        <!-- Pilihan Tahun Pelajaran -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 px-6.5 py-4">
            <div>
                <div class="w-full">
                    <label class="mb-3 block text-sm font-semibold text-black dark:text-white">
                        Pilih Tahun Pelajaran:
                    </label>
                    <select
                        x-model="selectedYear"
                        class="w-full rounded-lg border-[1.5px] border-stroke bg-white px-4 py-2 text-black outline-none dark:border-form-strokedark dark:bg-form-input dark:text-white">
                        <option value="" disabled selected>Pilih Tahun Pelajaran</option>
                        <template x-for="year in academicYears" :key="year.id">
                            <option :value="year.id" x-text="year.academic_year"></option>
                        </template>
                    </select>
                </div>
            </div>
            <div class="" x-show="selectedYear" x-cloak>
                <!-- Tombol Download Template -->
                <div class="col-span-6 sm:col-span-3 items-center justify-center text-center space-y-3">
                    <span class="text-3xl">
                        <i class="bi bi-filetype-xlsx flex mx-auto h-10 w-10 items-center justify-center rounded-full border border-stroke bg-white dark:border-strokedark dark:bg-boxdark"></i>
                    </span>
                    <a
                        :href="_BASEURL + 'references/import_data_siswa/download_template?academic_year_id=' + selectedYear"
                        class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
                        Download Template
                    </a>
                    <p class="mt-1.5 text-sm font-medium">Format yang didukung: <strong>.xlsx, .csv</strong></p>
                </div>
            </div>
            <div class="" x-show="selectedYear" x-cloak>
                <label class="mb-3 block text-sm font-semibold text-black dark:text-white">
                    Pilih file untuk diimpor:
                </label>
                <input
                    type="file"
                    name="file"
                    id="file"
                    @change="handleFileUpload"
                    class="w-full cursor-pointer rounded-lg border-[1.5px] border-stroke bg-transparent font-normal outline-none transition file:mr-5 file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-stroke file:bg-whiter file:px-5 file:py-3 file:hover:bg-primary file:hover:bg-opacity-10 focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-form-strokedark dark:file:bg-white/30 dark:file:text-white dark:focus:border-primary">
            </div>
        </div>
        <!-- Tombol Submit -->
        <div class="border-t border-stroke px-6.5 py-4 dark:border-strokedark">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                Import Data
            </button>
        </div>
    </form>
</div>
<script>
    const config = {
        formUrl: 'references/import_data_siswa/process',
    }
</script>