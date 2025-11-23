<?php
require_once '../Models/Post.php';
require_once '../Models/Category.php';

class PostController {
    private $postModel;
    private $categoryModel;

    public function __construct() {
        $this->postModel = new Post();
        $this->categoryModel = new Category();
    }

    public function index() {
        $search = $_GET['search'] ?? '';
        $category = $_GET['category'] ?? 'All';
        $sort = $_GET['sort'] ?? 'DESC';

        $posts = $this->postModel->getAll($search, $category, $sort);
        $categories = $this->categoryModel->getNames();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
            $this->postModel->addComment($_POST['post_id'], 'Anonymous', $_POST['comment']);
            header('Location: /posts');
            exit;
        }

        require '../src/Views/posts/index.php';
    }
}