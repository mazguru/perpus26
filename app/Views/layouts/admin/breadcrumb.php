<?php if (!empty($breadcrumbs) && count($breadcrumbs) > 1): ?>
    <div x-data="{ crumbs: <?= htmlspecialchars(json_encode($breadcrumbs), ENT_QUOTES, 'UTF-8') ?>}">
        <div class="flex flex-wrap items-center justify-between gap-3 pb-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white/90"><?= isset($title) ? $title : '' ?></h2>
            <nav>
                <ol class="flex items-center gap-1.5">
                    <template x-for="(crumb, index) in crumbs" :key="index">
                        <li class="flex items-center">
                            <template x-if="crumb.url && index !== crumbs.length - 1">
                                <a :href="crumb.url" class="text-blue-600 hover:underline" x-text="crumb.title"></a>
                            </template>
                            <template x-if="!crumb.url || index === crumbs.length - 1">
                                <span class="text-gray-700 font-semibold" x-text="crumb.title"></span>
                            </template>
                            <template x-if="index < crumbs.length - 1">
                                <svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M7.05 4.05a1 1 0 011.414 0L13.414 9l-4.95 4.95a1 1 0 01-1.414-1.414L10.586 9 7.05 5.464a1 1 0 010-1.414z" />
                                </svg>
                            </template>
                        </li>
                    </template>

                </ol>
            </nav>
        </div>

    </div>
<?php endif; ?>