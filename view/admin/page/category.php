<?php include 'layour/header.php'?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <?php include 'layour/navbar.php'?>
    <div class="container-fluid py-2">
      <div class="row">
        <div class="col-12">
          <button><a href="index.php?action=create">Thêm mới</a></button>
          <div class="card my-4">
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tên Sản Phẩm </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Trạng Thái</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Hành Động</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><?= $category['id'] ?></td>
                            <td><?= $category['name'] ?></td>
                            <td><?= $category['status'] ? 'Hiển thị' : 'Ẩn' ?></td>
                            <td>
                                <a href="category-update.php?id=<?= $category['id'] ?>">Sửa</a> |
                                <a href="category.php?action=delete&id=<?= $category['id'] ?>" onclick="return confirm('Xóa danh mục?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php include 'layour/footer.php'?>