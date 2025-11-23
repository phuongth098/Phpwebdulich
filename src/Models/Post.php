<?php
class Post {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll($search = '', $category = 'All', $sort = 'DESC') {
        $sql = "SELECT p.*, c.name AS category_name 
                FROM posts p 
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE 1=1";
        if ($search) $sql .= " AND p.title LIKE ?";
        if ($category !== 'All') $sql .= " AND c.name = ?";
        $sql .= " ORDER BY p.rating " . ($sort === 'DESC' ? 'DESC' : 'ASC');

        $stmt = $this->db->prepare($sql);
        if ($search && $category !== 'All') {
            $searchTerm = "%$search%";
            $stmt->bind_param("ss", $searchTerm, $category);
        } elseif ($search) {
            $searchTerm = "%$search%";
            $stmt->bind_param("s", $searchTerm);
        } elseif ($category !== 'All') {
            $stmt->bind_param("s", $category);
        }
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getComments($post_id) {
        $stmt = $this->db->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY id DESC");
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function addComment($post_id, $user, $comment) {
        $stmt = $this->db->prepare("INSERT INTO comments (post_id, user, comment) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $post_id, $user, $comment);
        return $stmt->execute();
    }
}
