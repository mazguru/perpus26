<div class="bg-white dark:bg-boxdark shadow-md rounded-b border-b p-4 table-striped table-hover">
    <table id="table-data" class="table-auto w-full border-collapse border">
    </table>
    <div class="mb-4">
        <p class="text-gray-600">
            <strong x-text="selectedId.length"></strong> data dipilih
        </p>
    </div>
    <?php if (session('user_role') == 'administrator' || session('user_role') == 'super_user'): ?>
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
    <?php endif; ?>
</div>