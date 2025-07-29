<div x-data="loginHandler()" class="w-full p-4 sm:p-12.5 xl:p-17.5">
    <h2 class="mb-9 text-2xl font-bold text-black dark:text-white sm:text-title-xl2">
        Sign In to App
    </h2>
    <p x-text="login_info" :class="ip_banned ? 'text-red-500 italic bg-red-100 p-4' : 'text-black'"></p>

    <form @submit.prevent="login">
        <div class="mb-4">
            <p x-show="errorMessage" x-text="errorMessage" class="text-red-500 text-sm"></p>
        </div>

        <div class="mb-4">
            <label class="mb-2.5 block font-medium text-black dark:text-white">Username</label>
            <div class="relative">
                <input type="text" x-model="form.user_name" placeholder="Enter your username" class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" required>
            </div>
        </div>

        <div class="mb-6">
            <label class="mb-2.5 block font-medium text-black dark:text-white">Password</label>
            <div class="relative">
                <input type="password" x-model="form.password" placeholder="6+ Characters, 1 Capital letter" class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" required>
            </div>
        </div>

        <div class="flex items-start mb-5">
            <a href="<?= base_url('lost_password') ?>" class="text-sm font-bold text-primary hover:underline ml-auto">Lost Password?</a>
        </div>

        <button type="submit" :disabled="isLoading" class="w-full bg-indigo-600 text-white py-2 rounded-md shadow-md hover:bg-indigo-700 flex items-center justify-center">
            <span x-show="!isLoading">Login</span>
            <div x-show="isLoading" class="text-center">
                <svg aria-hidden="true" class="inline w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                </svg>
            </div>
        </button>
    </form>
</div>
