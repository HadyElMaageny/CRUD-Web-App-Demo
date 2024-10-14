<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<?php require base_path('views/partials/banner.php') ?>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <p class="mb-6">
                <a href="/employees" class="text-blue-500 underline">Go back...</a>
            </p>
            <table border="1" cellpadding="10">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Department</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?= htmlspecialchars($employee['id']) ?></td>
                    <td><?= htmlspecialchars($employee['name']) ?></td>
                    <td><?= htmlspecialchars($employee['gender']) ?></td>
                    <td><?= htmlspecialchars($employee['department']) ?></td>
                    <td><a href="/employee/edit?id=<?= $employee['id']?>" class="text-blue-500 underline">Edit</a></td>
                </tr>
                </tbody>
            </table>

            <form class="mt-6" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id" value="<?= $employee['id'] ?>">
                <button class="text-sm text-red-500">Delete</button>
            </form>


    </main>
<?php require base_path('views/partials/footer.php') ?>