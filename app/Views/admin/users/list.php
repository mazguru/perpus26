<div x-data="mgrData(config)" x-init="loadData">
    <div class="p-4 bg-white dark:bg-boxdark shadow-md block sm:flex items-center justify-between border-b border-gray-200">
        <div class="mb-1 w-full">

            <div class="mb-4">
                <h1 class="text-xl sm:text-2xl font-semibold"><?= $title ?></h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-6 gap-4 md:justify-between">
                <div class="sm:flex items-center sm:divide-x sm:divide-gray-100 mb-3 sm:mb-0 col-span-5">
                    <p>Menampilkan data siswa Tahun Pelajaran</p>
                </div>

                <div class="grid grid-cols-1 md:justify-end gap-4">
                    <button @click="openModal('create')" class="w-1/2 text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center sm:w-auto">
                        <i class="bi bi-plus-lg font-bold text-[14pt] mr-2"></i>
                        Tambah Siswa
                    </button>


                </div>
            </div>
        </div>
    </div>
    <div class="bg-white dark:bg-boxdark shadow-md rounded-b border-b p-4 table-striped table-hover">
        <table id="table-data" class="table-auto w-full border-collapse border">
        </table>
        <div class="mb-4">
            <p class="text-gray-600">
                <strong x-text="selectedId.length"></strong> data dipilih
            </p>
        </div>
        <div class="md:flex space-x-1 space-y-1 pl-0 sm:pl-2 mt-3 sm:mt-0 gap-4">
            <button @click="confirmDeleteMultiple()"
                :disabled="selectedId.length === 0" class="px-3 py-2 text-xs font-medium text-center focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 text-white hover:bg-red-600 rounded-md inline-flex justify-center bg-red-500"
                :class="{'opacity-50 cursor-not-allowed': selectedId.length === 0}">
                <i class="bi bi-trash3-fill mr-2"></i>
                Hapus
            </button>
            <button @click="confirmDeletepermanent()"
                :disabled="selectedId.length === 0" class="px-3 py-2 text-xs font-medium text-center focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 text-white hover:bg-red-600 rounded-md inline-flex justify-center bg-red-500"
                :class="{'opacity-50 cursor-not-allowed': selectedId.length === 0}">
                <i class="bi bi-trash3-fill mr-2"></i>
                Hapus Permanen
            </button>
            <button @click="confirmRestoreMultiple()"
                :disabled="selectedId.length === 0" class="px-3 py-2 text-xs font-medium text-center focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 text-white hover:bg-gray-600 rounded-md inline-flex justify-center bg-gray-500"
                :class="{'opacity-50 cursor-not-allowed': selectedId.length === 0}">
                <i class="bi bi-database-up mr-2"></i>
                Restore
            </button>
        </div>
    </div>
    <!-- Modal -->
    <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-999" x-transition>
        <div class="bg-white dark:bg-boxdark rounded-lg p-8 w-full md:w-1/2 max-h-screen overflow-y-auto">

            <!-- Judul Modal -->
            <h2 class="text-xl font-semibold mb-4" x-text="modalType == 'edit' ? 'Edit Siswa' : 'Tambah Siswa'"></h2>

            <!-- Form -->
            <form @submit.prevent="submitForm" class=''>
                <div class="mb-4">
                    <label for="user_name" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="user_name" name="user_name" x-model="form.user_name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" :disabled="modalType=='edit'">
                    <span id="error_user_name" class="text-red-600 text-sm" x-text="errors.user_name"></span>
                </div>

                <div class="mb-4">
                    <label for="user_email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="user_email" name="user_email" x-model="form.user_email" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    <span id="error_user_email" class="text-red-600 text-sm" x-text="errors.user_email"></span>
                </div>

                <div class="mb-4">
                    <label for="user_password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="user_password" name="user_password" x-model="form.user_password" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    <span id="error_user_password" class="text-red-600 text-sm" x-text="errors.user_password"></span>
                </div>

                <div class="mb-4">
                    <label for="user_password2" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input type="password" id="user_password2" na
                        me="user_password2" x-model="form.user_password2" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    <span id="error_user_password2" class="text-red-600 text-sm" x-text="errors.user_password2"></span>
                </div>

                <div class="mb-4">
                    <label for="user_type" class="block text-sm font-medium text-gray-700">Role</label>
                    <select id="user_type" name="user_type" x-model="form.user_type" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        <option value="super_user">Super Admin</option>
                        <option value="administrator">Administrator</option>
                        <option value="employee">Guru</option>
                        <option value="student">Student</option>
                    </select>
                    <span id="error_user_type" class="text-red-600 text-sm" x-text="errors.user_type"></span>
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
        controller: 'users/users',
        columns: [{
                key: 'user_name',
                label: 'Username'
            },
            {
                key: 'user_full_name',
                label: 'Nama'
            },
            {
                key: 'user_email',
                label: 'Email'
            },
            {
                key: 'user_type',
                label: 'Role'
            },
            {
                key: 'last_logged_in',
                label: 'Login terakhir'
            }
        ],
    }
</script>