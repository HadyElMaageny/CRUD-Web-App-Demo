<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<?php require base_path('views/partials/banner.php') ?>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <?php foreach ($employees as $employee): ?>
                <li>
                    <a href="employee?id=<?= $employee['id'] ?>" class="text-blue-500 hover:underline">
                        <?= htmlspecialchars($employee['name']) ?>
                    </a>
                </li>
            <?php endforeach; ?>

            <ul class="mt-10 text-blue-500 hover:underline font:bold">
                <a href="/employees/create">Add Employee</a>
            </ul>
        </div>


    </main>
<?php require base_path('views/partials/footer.php') ?>