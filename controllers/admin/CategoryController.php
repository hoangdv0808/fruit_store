<?php
require_once '../../model/Category.php';

class CategoryController {
    private $model;

    public function __construct() {
        $this->model = new Category();
    }

    public function index() {
        $categories = $this->model->getAllCategories();
        require_once '../../view/admin/page/category.php';
    }

    // Thêm mới danh mục
    public function create($name, $status) {
        $this->model->createCategory($name, $status);
        header("Location: category.php");
    }

    // Sửa danh mục
    public function update($id, $name, $status) {
        $this->model->updateCategory($id, $name, $status);
        header("Location: category.php");
    }

    // Xóa danh mục
    public function delete($id) {
        $this->model->deleteCategory($id);
        header("Location: category.php");
    }
}

$controller = new CategoryController();
$action = $_GET['action'] ?? 'index';

if ($action == 'create' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller->create($_POST['name'], $_POST['status']);
} elseif ($action == 'update' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller->update($_POST['id'], $_POST['name'], $_POST['status']);
} elseif ($action == 'delete') {
    $controller->delete($_GET['id']);
} else {
    $controller->index();
}
?>
