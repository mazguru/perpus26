<div x-data="importDataFormRef(config)">
    <form @submit.prevent="submitForm" enctype="multipart/form-data" class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
        <div class="border-b border-stroke px-6.5 py-4 dark:border-strokedark">
            <h2 class="text-xl font-semibold mb-4">Import Data Guru</h2>
        </div>
        <div class="grid grid-cols-6 gap-2 px-6.5 py-4">
            <div class='col-span-6 sm:col-span-3'>
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

            <div class="col-span-6 sm:col-span-3 items-center justify-center text-center space-y-3">
                <span class="flex mx-auto h-10 w-10 items-center justify-center rounded-full border border-stroke bg-white dark:border-strokedark dark:bg-boxdark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="h-10 w-10" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM7.86 14.841a1.13 1.13 0 0 0 .401.823q.195.162.479.252.284.091.665.091.507 0 .858-.158.355-.158.54-.44a1.17 1.17 0 0 0 .187-.656q0-.336-.135-.56a1 1 0 0 0-.375-.357 2 2 0 0 0-.565-.21l-.621-.144a1 1 0 0 1-.405-.176.37.37 0 0 1-.143-.299q0-.234.184-.384.188-.152.513-.152.214 0 .37.068a.6.6 0 0 1 .245.181.56.56 0 0 1 .12.258h.75a1.1 1.1 0 0 0-.199-.566 1.2 1.2 0 0 0-.5-.41 1.8 1.8 0 0 0-.78-.152q-.44 0-.777.15-.336.149-.527.421-.19.273-.19.639 0 .302.123.524t.351.367q.229.143.54.213l.618.144q.31.073.462.193a.39.39 0 0 1 .153.326.5.5 0 0 1-.085.29.56.56 0 0 1-.255.193q-.168.07-.413.07-.176 0-.32-.04a.8.8 0 0 1-.249-.115.58.58 0 0 1-.255-.384zm-3.726-2.909h.893l-1.274 2.007 1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415H1.5l1.24-2.016-1.228-1.983h.931l.832 1.438h.036zm1.923 3.325h1.697v.674H5.266v-3.999h.791zm7.636-3.325h.893l-1.274 2.007 1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415h-.861l1.24-2.016-1.228-1.983h.931l.832 1.438h.036z" />
                    </svg>
                </span>
                <a :href="_BASEURL + 'references/import_data_guru/download_template'" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
                    Download Template
                </a>
                <p class="mt-1.5 text-sm font-medium">Format yang didukung: <strong>.xlsx, xls, .csv</strong></p>
            </div>
        </div>
        <div class="border-t border-stroke px-6.5 py-4 dark:border-strokedark">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                Import Data
            </button>
        </div>
    </form>
</div>
<script>
    const config = {
        formUrl: 'references/import_data_guru/process',
    }
</script>