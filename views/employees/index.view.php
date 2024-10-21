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
            <form>
                <label for="pageSize">Items per page:</label>
                <!-- Dropdown for Page Size -->
                <select id="pageSize" name="pageSize" onchange="changePageSize(this.value)">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>

                <script>
                    // Function to change the page size and preserve other query parameters
                    function changePageSize(pageSize) {
                        // Get current URL parameters
                        const urlParams = new URLSearchParams(window.location.search);

                        // Set the 'pageSize' parameter with the new selected value
                        urlParams.set('pageSize', pageSize);

                        // Optionally, reset the page number to 1 when the page size changes
                        urlParams.set('page', 1);

                        // Construct the new URL with all existing parameters
                        const newUrl = `${window.location.pathname}?${urlParams.toString()}`;

                        // Redirect to the new URL
                        window.location.href = newUrl;
                    }

                    // Function to select the correct page size on page load
                    function setSelectedPageSize() {
                        // Get current URL parameters
                        const urlParams = new URLSearchParams(window.location.search);

                        // Get the current 'pageSize' from the URL
                        const currentPageSize = urlParams.get('pageSize') || '10'; // Default to 10 if not set

                        // Select the option in the dropdown based on the current 'pageSize'
                        const pageSizeSelect = document.getElementById('pageSize');
                        pageSizeSelect.value = currentPageSize;
                    }

                    // Call the function to set the selected option on page load
                    setSelectedPageSize();
                </script>


                <table class="mt-10">
                    <thead>
                    <tr>
                        <th>
                            Id
                            <a href="?page=<?= $currentPage ?>&pageSize=<?= $limit ?>&&sort=id&direction=asc&filter_id=<?= $filters['id'] ?? '' ?>&filter-name=<?= $filters['name'] ?? '' ?>&filter-gender=<?= $filters['gender'] ?? '' ?>&filter-department=<?= $filters['department'] ?? '' ?>" class="text-blue-500">▲</a>
                            <a href="?page=<?= $currentPage ?>&pageSize=<?= $limit ?>&&sort=id&direction=desc&filter_id=<?= $filters['id'] ?? '' ?>&filter-name=<?= $filters['name'] ?? '' ?>&filter-gender=<?= $filters['gender'] ?? '' ?>&filter-department=<?= $filters['department'] ?? '' ?>" class="text-blue-500">▼</a>
                            <input type="text" id="filter-id" name="filter_id" placeholder="Search by ID"
                                   class="text-xs p-1 border rounded">

                        </th>
                        <th>
                            Name
                            <a href="?page=<?= $currentPage ?>&pageSize=<?= $limit ?>&&sort=name&direction=asc&filter_id=<?= $filters['id'] ?? '' ?>&filter-name=<?= $filters['name'] ?? '' ?>&filter-gender=<?= $filters['gender'] ?? '' ?>&filter-department=<?= $filters['department'] ?? '' ?>" class="text-blue-500">▲</a>
                            <a href="?page=<?= $currentPage ?>&pageSize=<?= $limit ?>&&sort=name&direction=desc&filter_id=<?= $filters['id'] ?? '' ?>&filter-name=<?= $filters['name'] ?? '' ?>&filter-gender=<?= $filters['gender'] ?? '' ?>&filter-department=<?= $filters['department'] ?? '' ?>" class="text-blue-500">▼</a>
                            <input type="text" id="filter-name" name="filter-name" placeholder="Search by Name"
                                   class="text-xs p-1 border rounded">
                        </th>
                        <th>
                            Gender
                            <a href="?page=<?= $currentPage ?>&pageSize=<?= $limit ?>&&sort=gender&direction=asc&filter_id=<?= $filters['id'] ?? '' ?>&filter-name=<?= $filters['name'] ?? '' ?>&filter-gender=<?= $filters['gender'] ?? '' ?>&filter-department=<?= $filters['department'] ?? '' ?>" class="text-blue-500">▲</a>
                            <a href="?page=<?= $currentPage ?>&pageSize=<?= $limit ?>&&sort=gender&direction=desc&filter_id=<?= $filters['id'] ?? '' ?>&filter-name=<?= $filters['name'] ?? '' ?>&filter-gender=<?= $filters['gender'] ?? '' ?>&filter-department=<?= $filters['department'] ?? '' ?>" class="text-blue-500">▼</a>
                            <input type="text" id="filter-gender" name="filter-gender" placeholder="Search by Gender"
                                   class="text-xs p-1 border rounded">
                        </th>
                        <th>
                            Department
                            <a href="?page=<?= $currentPage ?>&pageSize=<?= $limit ?>&sort=department&direction=asc&filter_id=<?= $filters['id'] ?? '' ?>&filter-name=<?= $filters['name'] ?? '' ?>&filter-gender=<?= $filters['gender'] ?? '' ?>&filter-department=<?= $filters['department'] ?? '' ?>" class="text-blue-500">▲</a>
                            <a href="?page=<?= $currentPage ?>&pageSize=<?= $limit ?>&sort=department&direction=desc&filter_id=<?= $filters['id'] ?? '' ?>&filter-name=<?= $filters['name'] ?? '' ?>&filter-gender=<?= $filters['gender'] ?? '' ?>&filter-department=<?= $filters['department'] ?? '' ?>" class="text-blue-500">▼</a>
                            <input type="text" id="filter-department" name="filter-department"
                                   placeholder="Search by Department" class="text-xs p-1 border rounded">
                        </th>
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
                <button type="submit">Submit</button>
            </form>
            <div class="mt-4">
                <ul class="flex space-x-2">
                    <li>
                        <a href="?page=1&pageSize=<?= $limit ?>&filter_id=<?= $filters['id'] ?? '' ?>&filter-name=<?= $filters['name'] ?? '' ?>&filter-gender=<?= $filters['gender'] ?? '' ?>&filter-department=<?= $filters['department'] ?? '' ?>"
                           class="text-blue-500 underline <?= $currentPage == 1 ? 'font-bold' : '' ?>">1</a>
                    </li>

                    <!-- Show dots if current page is far from the first few pages -->
                    <?php if ($currentPage > 4): ?>
                        <li><span>...</span></li>
                    <?php endif; ?>

                    <!-- Show links around the current page -->
                    <?php for ($i = max(2, $currentPage - 2); $i <= min($currentPage + 2, $pagesCount - 1); $i++): ?>
                        <li>
                            <a href="?page=<?= $i ?>&pageSize=<?= $limit ?>&filter_id=<?= $filters['id'] ?? '' ?>&filter-name=<?= $filters['name'] ?? '' ?>&filter-gender=<?= $filters['gender'] ?? '' ?>&filter-department=<?= $filters['department'] ?? '' ?>"
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
                        <a href="?page=<?= $pagesCount ?>&pageSize=<?= $limit ?>&filter_id=<?= $filters['id'] ?? '' ?>&filter-name=<?= $filters['name'] ?? '' ?>&filter-gender=<?= $filters['gender'] ?? '' ?>&filter-department=<?= $filters['department'] ?? '' ?>"
                           class="text-blue-500 underline <?= $currentPage == $pagesCount ? 'font-bold' : '' ?>">
                            <?= $pagesCount ?>
                        </a>
                    </li>
                </ul>

            </div>
        </div>


    </main>
<?php require base_path('views/partials/footer.php') ?>