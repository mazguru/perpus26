<?php
/** @var CodeIgniter\Pager\PagerRenderer $pager */
$pager->setSurroundCount(1);
?>
<nav class="mt-4 flex items-center justify-center" aria-label="Pagination">
  <ul class="inline-flex items-center gap-1">

    <?php if ($pager->hasPrevious()) : ?>
      <li>
        <a href="<?= $pager->getFirst() ?>"
           class="inline-flex items-center rounded-md border px-3 py-2 text-sm font-medium
                  text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-800"
           aria-label="Halaman pertama">«</a>
      </li>
      <li>
        <a href="<?= $pager->getPrevious() ?>"
           class="inline-flex items-center rounded-md border px-3 py-2 text-sm font-medium
                  text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-800"
           aria-label="Sebelumnya">‹</a>
      </li>
    <?php else: ?>
      <li><span class="inline-flex items-center rounded-md border px-3 py-2 text-sm font-medium
                     text-gray-400 opacity-60 dark:border-gray-700 dark:text-gray-500 cursor-not-allowed"
                 aria-hidden="true">«</span></li>
      <li><span class="inline-flex items-center rounded-md border px-3 py-2 text-sm font-medium
                     text-gray-400 opacity-60 dark:border-gray-700 dark:text-gray-500 cursor-not-allowed"
                 aria-hidden="true">‹</span></li>
    <?php endif ?>

    <?php foreach ($pager->links() as $link) : ?>
      <li>
        <?php if ($link['active']) : ?>
          <span aria-current="page"
                class="inline-flex items-center rounded-md border px-3 py-2 text-sm font-semibold
                       border-gray-900 bg-gray-900 text-white
                       dark:border-white dark:bg-white dark:text-gray-900 cursor-default">
            <?= esc($link['title']) ?>
          </span>
        <?php else : ?>
          <a href="<?= $link['uri'] ?>"
             class="inline-flex items-center rounded-md border px-3 py-2 text-sm font-medium
                    text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-800">
            <?= esc($link['title']) ?>
          </a>
        <?php endif ?>
      </li>
    <?php endforeach ?>

    <?php if ($pager->hasNext()) : ?>
      <li>
        <a href="<?= $pager->getNext() ?>"
           class="inline-flex items-center rounded-md border px-3 py-2 text-sm font-medium
                  text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-800"
           aria-label="Berikutnya">›</a>
      </li>
      <li>
        <a href="<?= $pager->getLast() ?>"
           class="inline-flex items-center rounded-md border px-3 py-2 text-sm font-medium
                  text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-800"
           aria-label="Halaman terakhir">»</a>
      </li>
    <?php else: ?>
      <li><span class="inline-flex items-center rounded-md border px-3 py-2 text-sm font-medium
                     text-gray-400 opacity-60 dark:border-gray-700 dark:text-gray-500 cursor-not-allowed"
                 aria-hidden="true">›</span></li>
      <li><span class="inline-flex items-center rounded-md border px-3 py-2 text-sm font-medium
                     text-gray-400 opacity-60 dark:border-gray-700 dark:text-gray-500 cursor-not-allowed"
                 aria-hidden="true">»</span></li>
    <?php endif ?>

  </ul>
</nav>
