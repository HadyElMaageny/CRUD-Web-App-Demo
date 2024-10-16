<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<?php require base_path('views/partials/banner.php') ?>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <ul class="mt-10 text-blue-500 hover:underline font:bold">
                <a href="/employees/create">Add Employee</a>
            </ul>
            <style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                }

                table, th, td {
                    border: 1px solid black;
                }

                th, td {
                    padding: 8px;
                    text-align: left;
                }

                th {
                    background-color: #f2f2f2;
                }
            </style>
            <table class="mt-10">
                <thead>
                <tr>
                    <th>
                        Id
                        <a href="?page=<?= $currentPage ?>&sort=id&direction=asc" class="text-blue-500">▲</a>
                        <a href="?page=<?= $currentPage ?>&sort=id&direction=desc" class="text-blue-500">▼</a>
                    </th>
                    <th>
                        Name
                        <a href="?page=<?= $currentPage ?>&sort=name&direction=asc" class="text-blue-500">▲</a>
                        <a href="?page=<?= $currentPage ?>&sort=name&direction=desc" class="text-blue-500">▼</a>
                    </th>
                    <th>
                        Gender
                        <a href="?page=<?= $currentPage ?>&sort=gender&direction=asc" class="text-blue-500">▲</a>
                        <a href="?page=<?= $currentPage ?>&sort=gender&direction=desc" class="text-blue-500">▼</a>
                    </th>
                    <th>
                        Department
                        <a href="?page=<?= $currentPage ?>&sort=department&direction=asc" class="text-blue-500">▲</a>
                        <a href="?page=<?= $currentPage ?>&sort=department&direction=desc" class="text-blue-500">▼</a>
                    </th>
                    <th>Show</th>
                </tr>
                </thead>
                <!--                <thead>-->
                <!--                <tr>-->
                <!--                    <th>-->
                <!--                        Id-->
                <!--                        <a href="?page=--><?php //= $currentPage ?><!--&sort=id&direction=-->
                <?php //= $sortDirection == 'asc' ? 'desc' : 'asc' ?><!--"-->
                <!--                           class="ml-2 text-blue-500">Sort</a>-->
                <!--                    </th>-->
                <!--                    <th>-->
                <!--                        Name-->
                <!--                        <a href="?page=--><?php //= $currentPage ?><!--&sort=name&direction=-->
                <?php //= $sortDirection == 'asc' ? 'desc' : 'asc' ?><!--"-->
                <!--                           class="ml-2 text-blue-500">Sort</a>-->
                <!--                    </th>-->
                <!--                    <th>-->
                <!--                        Gender-->
                <!--                        <a href="?page=--><?php //= $currentPage ?><!--&sort=gender&direction=-->
                <?php //= $sortDirection == 'asc' ? 'desc' : 'asc' ?><!--"-->
                <!--                           class="ml-2 text-blue-500">Sort</a>-->
                <!--                    </th>-->
                <!--                    <th>-->
                <!--                        Department-->
                <!--                        <a href="?page=-->
                <?php //= $currentPage ?><!--&sort=department&direction=-->
                <?php //= $sortDirection == 'asc' ? 'desc' : 'asc' ?><!--"-->
                <!--                           class="ml-2 text-blue-500">Sort</a>-->
                <!--                    </th>-->
                <!--                    <th>Show</th>-->
                <!--                </tr>-->
                <!--                </thead>-->
                <tbody>
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td><?= htmlspecialchars($employee['id']) ?></td>
                        <td><?= htmlspecialchars($employee['name']) ?></td>
                        <td><?= htmlspecialchars($employee['gender']) ?></td>
                        <td><?= htmlspecialchars($employee['department']) ?></td>
                        <td>
                            <a href="employee?id=<?= $employee['id'] ?>" class="text-blue-500 underline">Show</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="mt-4">
                <ul class="flex space-x-2">
                    <li>
                        <a href="?page=1"
                           class="text-blue-500 underline <?= $currentPage == 1 ? 'font-bold' : '' ?>">1</a>
                    </li>

                    <!-- Show dots if current page is far from the first few pages -->
                    <?php if ($currentPage > 4): ?>
                        <li><span>...</span></li>
                    <?php endif; ?>

                    <!-- Show links around the current page -->
                    <?php for ($i = max(2, $currentPage - 2); $i <= min($currentPage + 2, $pagesCount - 1); $i++): ?>
                        <li>
                            <a href="?page=<?= $i ?>"
                               class="text-blue-500 underline <?= $i == $currentPage ? 'font-bold' : '' ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <!-- Show dots if current page is far from the last pages -->
                    <?php if ($currentPage < $pagesCount - 3): ?>
                        <li><span>...</span></li>
                    <?php endif; ?>

                    <!-- Always show the last page link -->
                    <li>
                        <a href="?page=<?= $pagesCount ?>"
                           class="text-blue-500 underline <?= $currentPage == $pagesCount ? 'font-bold' : '' ?>">
                            <?= $pagesCount ?>
                        </a>
                    </li>
                </ul>

            </div>
        </div>


    </main>
<?php require base_path('views/partials/footer.php') ?>