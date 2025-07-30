<?php
/** @var CodeIgniter\Pager\PagerRenderer $pager */
$pager->setSurroundCount(0);
?>
<nav class="mt-4 flex items-center justify-between" aria-label="Pagination">
  <!-- Prev -->
  <div>
    <?php if ($pager->hasPrevious()) : ?>
      <a href="<?= $pager->getPrevious() ?>"
         class="inline-flex items-center rounded-md border px-3 py-2 text-sm font-medium
                text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-800">
        ‹ Prev
      </a>
    <?php else: ?>
      <span class="inline-flex items-center rounded-md border px-3 py-2 text-sm font-medium
                   text-gray-400 opacity-60 dark:border-gray-700 dark:text-gray-500 cursor-not-allowed">‹ Prev</span>
    <?php endif ?>
  </div>

  <!-- Current page info -->
  <div class="text-sm text-gray-600 dark:text-gray-400">
    Halaman <span class="font-medium text-gray-900 dark:text-gray-100"><?= $pager->getCurrentPage() ?></span>
    dari <span class="font-medium text-gray-900 dark:text-gray-100"><?= $pager->getPageCount() ?></span>
  </div>

  <!-- Next -->
  <div>
    <?php if ($pager->hasNext()) : ?>
      <a href="<?= $pager->getNext() ?>"
         class="inline-flex items-center rounded-md border px-3 py-2 text-sm font-medium
                text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-800">
        Next ›
      </a>
    <?php else: ?>
      <span class="inline-flex items-center rounded-md border px-3 py-2 text-sm font-medium
                   text-gray-400 opacity-60 dark:border-gray-700 dark:text-gray-500 cursor-not-allowed">Next ›</span>
    <?php endif ?>
  </div>
</nav>
