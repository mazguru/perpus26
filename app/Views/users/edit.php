<div class="max-w-4xl mx-auto p-4 bg-white rounded shadow-md">
    <h2 class="text-2xl font-semibold mb-6"><?= isset($title) ? $title : 'Edit Pengguna' ?></h2>

    <form id="editUserForm">
        <div class="mb-4">
            <label for="user_name" class="block text-sm font-medium text-gray-700">Username</label>
            <span id="user_name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-100"><?= $user['user_name'] ?></span>
            <span id="error_user_name" class="text-red-600 text-sm"></span>
        </div>

        <div class="mb-4">
            <label for="user_email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="user_email" name="user_email" value="<?= $user['user_email'] ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
            <span id="error_user_email" class="text-red-600 text-sm"></span>
        </div>

        <div class="mb-4">
            <label for="user_password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="user_password" name="user_password" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
            <span id="error_user_password" class="text-red-600 text-sm"></span>
        </div>

        <div class="mb-4">
            <label for="user_password2" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
            <input type="password" id="user_password2" name="user_password2" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
            <span id="error_user_password2" class="text-red-600 text-sm"></span>
        </div>

        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
            <select id="role" name="role" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                <option value="administrator" <?= ($user['role'] == 'administrator') ? 'selected' : '' ?>>Administrator</option>
                <option value="student" <?= ($user['role'] == 'student') ? 'selected' : '' ?>>Student</option>
                <option value="employee" <?= ($user['role'] == 'employee') ? 'selected' : '' ?>>Guru</option>
                <option value="batalyon" <?= ($user['role'] == 'batalyon') ? 'selected' : '' ?>>Batalyon</option>
                <option value="danton" <?= ($user['role'] == 'danton') ? 'selected' : '' ?>>Danton</option>
            </select>
            <span id="error_role" class="text-red-600 text-sm"></span>
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Update Pengguna</button>
    </form>
</div>

<script>
    document.getElementById('editUserForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Mencegah form default submit

        const formData = new FormData(this);
        const url = '<?= base_url("users/user/update/" . $user["id"]) ?>';

        fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'error') {
                    // Menampilkan error validasi
                    for (const [field, error] of Object.entries(data.errors)) {
                        document.getElementById('error_' + field).textContent = error;
                    }
                } else if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        timer: 2000,
                        timerProgressBar: true
                    }).then(() => {
                        window.location.href = '<?= base_url("users/user") ?>';
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan saat mengirim data.',
                });
            });
    });
</script>