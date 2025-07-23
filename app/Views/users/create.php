<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Tambah Pengguna</h1>
    <form id="userForm" class="space-y-4">
        <!-- Username -->
        <div>
            <label for="user_name" class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" id="user_name" name="user_name"
                class="mt-1 block w-full rounded-md p-2 border shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <p id="error_user_name" class="text-sm text-red-500 mt-1 hidden"></p>
        </div>
        <!-- User_full_name -->
        <div>
            <label for="user_full_name" class="block text-sm font-medium text-gray-700">User Full Name</label>
            <input type="text" id="user_full_name" name="user_full_name"
                class="mt-1 block w-full rounded-md p-2 border shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <p id="error_user_full_name" class="text-sm text-red-500 mt-1 hidden"></p>
        </div>

        <!-- Email -->
        <div>
            <label for="user_email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="user_email" name="user_email"
                class="mt-1 block w-full rounded-md p-2 border shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <p id="error_user_email" class="text-sm text-red-500 mt-1 hidden"></p>
        </div>

        <!-- Password -->
        <div>
            <label for="user_password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="user_password" name="user_password"
                class="mt-1 block w-full rounded-md p-2 border shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <p id="error_user_password" class="text-sm text-red-500 mt-1 hidden"></p>
        </div>

        <!-- Password Confirmation -->
        <div>
            <label for="user_password2" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
            <input type="password" id="user_password2" name="user_password2"
                class="mt-1 block w-full rounded-md p-2 border shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <p id="error_user_password2" class="text-sm text-red-500 mt-1 hidden"></p>
        </div>

        <!-- Role -->
        <div>
            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
            <select id="role" name="role"
                class="mt-1 block w-full rounded-md p-2 border shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">Pilih Role</option>
                <option value="administrator">Administrator</option>
                <option value="waka">Waka</option>
                <option value="student">Student</option>
                <option value="guru">Guru</option>
                <option value="batalyon">Batalyon</option>
                <option value="danton">Danton</option>
            </select>
            <p id="error_role" class="text-sm text-red-500 mt-1 hidden"></p>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Tambah Pengguna
            </button>
        </div>
    </form>
</div>
<script>
    document.getElementById('userForm').addEventListener('submit', async function(e) {
        e.preventDefault(); // Prevent form submission

        // Form data
        const formData = new FormData(this);

        try {
            // Send AJAX request
            const response = await fetch('<?= base_url("users/user/store") ?>', {
                method: 'POST',
                body: formData,
            });
            const result = await response.json();

            // Reset error messages
            document.querySelectorAll('p[id^="error_"]').forEach((el) => el.classList.add('hidden'));

            if (result.status === 'error') {
                // Display validation errors
                if (result.errors) {
                    for (const [field, error] of Object.entries(result.errors)) {
                        const errorElement = document.getElementById(`error_${field}`);
                        if (errorElement) {
                            errorElement.textContent = error;
                            errorElement.classList.remove('hidden');
                        }
                    }
                }

                // Display general error
                if (result.message) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: result.message,
                        timer: 3000,
                        timerProgressBar: true
                    });
                }
            } else if (result.status === 'success') {
                // Jika sukses
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message,
                    timer: 2000,
                    timerProgressBar: true
                }).then(() => {
                    window.location.href = '<?= base_url("users/user") ?>';
                });
            }
        } catch (err) {
            console.error('Error submitting form:', err);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan saat mengirim data.',
            });
        }
    });
</script>