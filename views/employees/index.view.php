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
                    <th>Id</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Department</th>
                    <th>Show</th>
                </tr>
                </thead>
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
            <!--    --><?php //foreach ($employees as $employee): ?>
            <!--        <li>-->
            <!--            <a href="employee?id=-->
            <?php //= $employee['id'] ?><!--" class="text-blue-500 hover:underline">-->
            <!--                --><?php //= htmlspecialchars($employee['name']) ?>
            <!--            </a>-->
            <!--        </li>-->
            <!--    --><?php //endforeach; ?>

        </div>


    </main>
<?php require base_path('views/partials/footer.php') ?>