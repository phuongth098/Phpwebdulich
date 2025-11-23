<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoReview</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: Arial, sans-serif; }
        .hover-card { transition: transform 0.3s; }
        .hover-card:hover { transform: scale(1.02); }
    </style>
</head>
<body class="bg-gray-100">
<header class="bg-blue-600 text-white p-4 sticky top-0 z-10 shadow-md">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="flex items-center space-x-4">
            <img src="https://cdn-icons-png.flaticon.com/512/854/854878.png" alt="Logo" class="h-10">
            <h1 class="text-2xl font-bold">GoReview</h1>
        </div>
        <nav class="space-x-6">
            <a href="/" class="hover:underline">Trang chủ</a>
            <a href="/categories" class="hover:underline">Danh mục</a>
            <a href="/posts" class="hover:underline">Bài viết</a>
            <a href="/about" class="hover:underline">About</a>
        </nav>
    </div>
</header>
<main class="container mx-auto p-6"></main>