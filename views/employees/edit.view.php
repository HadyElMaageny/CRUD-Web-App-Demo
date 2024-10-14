<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<?php require base_path('views/partials/banner.php') ?>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <form method="POST", action="/employee">
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="id" value="<?= $employee['id'] ?>">
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Employee Information</h2>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                                <div class="mt-2">
                                    <input type="text" name="name" id="name" autocomplete="given-name"
                                           value="<?= $employee['name'] ?>"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <?php if (isset($errors['name'])): ?>
                                    <p class="text-red-500 text-xs mt-2"><?= $errors['name'] ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="gender">Select Gender:</label>
                                <select id="gender" name="gender">
                                    <option value="" <?= (strtolower($employee['gender']) == '') ? 'selected' : '' ?>>Select
                                    </option>
                                    <option value="male" <?= (strtolower($employee['gender']) == 'male') ? 'selected' : '' ?>>Male
                                    </option>
                                    <option value="female" <?= (strtolower($employee['gender']) == 'female') ? 'selected' : '' ?>>
                                        Female
                                    </option>
                                    <option value="other" <?= (strtolower($employee['gender']) == 'other') ? 'selected' : '' ?>>
                                        Other
                                    </option>
                                </select>
                            </div>

                            <?php if (isset($errors['gender'])): ?>
                                <p class="text-red-500 text-xs mt-2"><?= $errors['gender'] ?></p>
                            <?php endif; ?>
                            <div class="sm:col-span-3">
                                <label for="department" class="block text-sm font-medium leading-6 text-gray-900">Department</label>
                                <div class="mt-2">
                                    <input type="text" name="department" id="department" autocomplete="given-name"
                                           value="<?= $employee['department'] ?? "" ?>"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <?php if (isset($errors['department'])): ?>
                                    <p class="text-red-500 text-xs mt-2"><?= $errors['department'] ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <a href="/employees" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                    <button type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Update
                    </button>
                </div>
            </form>
        </div>

    </main>
<?php require base_path('views/partials/footer.php') ?>