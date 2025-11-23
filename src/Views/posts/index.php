<?php require '../layouts/header.php'; ?>

<h2 class="text-3xl font-bold mb-6">Bài viết</h2>

<!-- Filter Form -->
<form method="GET" action="/posts" class="mb-8 bg-white p-4 rounded shadow flex flex-wrap gap-4">
    <select name="category" class="p-2 border rounded">
        <option value="All">All</option>
        <?php foreach ($categories as $cat): ?>
            <option <?= ($category ?? 'All') === $cat ? 'selected' : '' ?>><?= htmlspecialchars($cat) ?></option>
        <?php endforeach; ?>
    </select>
    <input type="text" name="search" value="<?= htmlspecialchars($search ?? '') ?>" placeholder="Tìm kiếm..." class="p-2 border rounded">
    <select name="sort" class="p-2 border rounded">
        <option value="DESC" <?= ($sort ?? 'DESC') === 'DESC' ? 'selected' : '' ?>>Highest First</option>
        <option value="ASC" <?= ($sort ?? 'DESC') === 'ASC' ? 'selected' : '' ?>>Lowest First</option>
    </select>
    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Lọc</button>
</form>

<div class="grid gap-8">
    <?php while ($row = $posts->fetch_assoc()): ?>
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover-card">
            <img src="<?= htmlspecialchars($row['image']) ?>" class="w-full h-64 object-cover">
            <div class="p-6">
                <h3 class="text-2xl font-bold mb-2"><?= htmlspecialchars($row['title']) ?></h3>
                <p class="text-gray-600 text-sm mb-3">By <?= htmlspecialchars($row['author']) ?> • <?= $row['date'] ?> • <?= $row['views'] ?> views</p>
                <p class="text-gray-700 mb-4"><?= htmlspecialchars(substr($row['content'], 0, 200)) ?>...</p>
                
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <span class="text-yellow-500"><?= str_repeat('★', round($row['rating'])) . str_repeat('☆', 5 - round($row['rating'])) ?></span>
                        <span class="text-gray-600 ml-2">(<?= $row['rating'] ?>/5)</span>
                    </div>
                    <a href="#" class="text-blue-600 font-semibold">Đọc thêm →</a>
                </div>

                <!-- Comments -->
                <div class="border-t pt-4">
                    <h4 class="font-semibold mb-3">Bình luận</h4>
                    <?php $comments = $this->postModel->getComments($row['id']); ?>
                    <?php while ($c = $comments->fetch_assoc()): ?>
                        <div class="bg-gray-50 p-3 rounded mb-2 text-sm">
                            <strong><?= htmlspecialchars($c['user']) ?>:</strong> <?= htmlspecialchars($c['comment']) ?>
                        </div>
                    <?php endwhile; ?>

                    <form method="POST" action="/posts" class="mt-4">
                        <input type="hidden" name="post_id" value="<?= $row['id'] ?>">
                        <textarea name="comment" required placeholder="Viết bình luận..." class="w-full p-3 border rounded"></textarea>
                        <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Gửi</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<?php require '../layouts/footer.php'; ?>