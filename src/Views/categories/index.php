<?php require '../layouts/header.php'; ?>

<h2 class="text-4xl font-bold text-center mb-12 text-blue-700">Danh mục du lịch</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
    <?php while ($row = $categories->fetch_assoc()): ?>
        <div class="category-card bg-white rounded-xl shadow-lg overflow-hidden hover-card cursor-pointer transform transition">
            <img src="<?= htmlspecialchars($row['image']) ?>" 
                 alt="<?= htmlspecialchars($row['name']) ?>" 
                 class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-3">
                    <?= htmlspecialchars($row['name']) ?>
                </h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    <?= htmlspecialchars($row['description']) ?>
                </p>
                <div class="mt-5">
                    <a href="/posts?category=<?= urlencode($row['name']) ?>" 
                       class="inline-block bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition font-medium">
                        Xem bài viết →
                    </a>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<?php require '../layouts/footer.php'; ?>