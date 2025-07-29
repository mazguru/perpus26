<div class="w-full p-4 sm:p-12.5 xl:p-17.5">
    <h2 class="mb-3 text-2xl font-bold text-black dark:text-white sm:text-title-xl2">
        Reset Password
    </h2>
    <p class="mb-7.5 font-medium">
        Enter your email address to receive a password reset link.
    </p>

    <form method="POST" action="">
        <div class="mb-6">
            <label class="mb-2.5 block font-medium text-black dark:text-white">Email</label>
            <div class="relative">
                <input name='email' type="email" placeholder="Enter your email" class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" value="<?= set_value('email') ?>">

                <span class="absolute right-4 top-4">
                    <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g opacity="0.5">
                            <path d="M19.2516 3.30005H2.75156C1.58281 3.30005 0.585938 4.26255 0.585938 5.46567V16.6032C0.585938 17.7719 1.54844 18.7688 2.75156 18.7688H19.2516C20.4203 18.7688 21.4172 17.8063 21.4172 16.6032V5.4313C21.4172 4.26255 20.4203 3.30005 19.2516 3.30005ZM19.2516 4.84692C19.2859 4.84692 19.3203 4.84692 19.3547 4.84692L11.0016 10.2094L2.64844 4.84692C2.68281 4.84692 2.71719 4.84692 2.75156 4.84692H19.2516ZM19.2516 17.1532H2.75156C2.40781 17.1532 2.13281 16.8782 2.13281 16.5344V6.35942L10.1766 11.5157C10.4172 11.6875 10.6922 11.7563 10.9672 11.7563C11.2422 11.7563 11.5172 11.6875 11.7578 11.5157L19.8016 6.35942V16.5688C19.8703 16.9125 19.5953 17.1532 19.2516 17.1532Z" fill=""></path>
                        </g>
                    </svg>
                </span>

            </div>
            <small class="text-red-500"><?= form_error('email') ?></small>
        </div>

        <div class='mb-2'>
            <input type="submit" value="Send Password Reset Link" class="w-full cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90">
        </div>

        <div class="mt-6 text-center">
            <p class="font-medium">
                Already have an account?
                <a href="<?= base_url('login') ?>" class="text-primary">Sign in</a>
            </p>
        </div>
    </form>
    <?php if ($this->session->flashdata('success')): ?>
        <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700">
            <?= $this->session->flashdata('success') ?>
        </div>
    <?php endif; ?>
</div>