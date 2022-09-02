<?php
if ($nbPage <= 10) {
    $start = 1;
    $end   = $nbPage;
} else {
$start = max(1, ($currentPage - 4));
$end   = min($nbPage, ($currentPage + 5));}
if ($start === 1) {
    $end = 11;
} elseif ($end === $nbPage) {
    $start = ($nbPage - 9);
}
?>
<div>
    <ul class="pagination">
        <li class="page-item">
             <a class="page-link <?= $activePrev ? "disabled" : "" ?>" href="<?= '?currentPage=prev,' . $currentPage ?>">&laquo;</a>
        </li>
    <?php  for ($i=$start ; $i < $end; $i++) : ?>
        <li class="page-item active">
             <a class="page-link <?= $i === $activePage ? "disabled" : ""  ?>" href="<?= '?currentPage=' . $i ?>"><?= $i?></a>
        </li>
    <?php endfor ?>

        <li class="page-item">
            <a class="page-link <?= $activeNext ? "disabled" : "" ?>" href="<?= '?currentPage=next,' . $currentPage ?>">&raquo;</a>
        </li>
    </ul>
</div>