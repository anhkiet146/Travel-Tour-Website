<?php
  session_start(); // Bắt đầu phiên làm việc

  // Kiểm tra xem người dùng đã đăng nhập chưa
  if (!isset($_SESSION['username'])) {
      // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
      header('Location: .login_form.php'); // Thay đổi đường dẫn nếu cần
      exit(); // Ngăn không cho mã tiếp tục chạy
  }
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css">
</head>

<body>
  <!-- navbar -->
  <nav class="navbar navbar-expand-lg navbar-light shadow-sm bg-light">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
        aria-controls="offcanvasExample">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand fw-bold" href="index.php">E-Tour</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto me-md-4 mb-2 mb-lg-0">
          <li class="nav-item dropdown d-flex text-light">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-regular fa-user"></i> Admin
            </a>
            <ul class="dropdown-menu border-0 bg-light ms-auto">
              <li><a class="dropdown-item" href="profile.php">Edit Profile</a></li>
              <li><a class="dropdown-item" href="../login_form.php">Logout</a></li>
            </ul>
        </ul>
        </li>
      </div>
    </div>
  </nav>
  <!-- navbar end -->

  <!-- sidebar -->
  <div class="offcanvas offcanvas-start bg-purple text-white sidebar-nav" tabindex="-1" id="offcanvasExample"
    aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header shadow-sm d-block text-center">
      <div class="offcanvas-title" id="offcanvasExampleLabel">
        <a class="navbar-brand fw-bold" href="index.php">E-Tour</a>
      </div>
    </div>
    <div class="offcanvas-body pt-3 p-0">
      <nav class="navbar-dark">
        <ul class="navbar-nav sidenav">
          <li class="nav-link bordered px-3 active">
            <a href="index.php" class="nav-link px-3 active">
              <span class="me-2"><i class="bi bi-speedometer2"></i></span>
              <span>Dashboard</span>
            </a>
          </li>
          <li class="nav-link bordered px-3">
            <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#collapseExample" role="button"
              aria-expanded="false" aria-controls="collapseExample">
              <span class="me-2">
                <i class="bi bi-people-fill"></i>
              </span>
              <span>Tours</span>
              <span class="right-icon ms-auto">
                <i class="bi bi-chevron-down"></i>
              </span>
            </a>
            <div class="collapse" id="collapseExample">
              <div>
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="moreinfo.php" class="nav-link px-3">
                      <span class="me-2"><i class="bi bi-1-circle"></i></span>
                      <span>Add Tour</span>
                    </a>
                  </li>
                  <li>
                    <a href="all-tours.php" class="nav-link px-3">
                      <span class="me-2"><i class="bi bi-2-circle"></i></span>
                      <span>All Tours</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </li>
          <li class="nav-link bordered px-3">
            <a href="departments.php" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-intersect"></i></span>
              <span>Departments</span>
            </a>
          </li>

          <li class="nav-link bordered px-3">
            <a href="programs.php" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-journal-text"></i></span>
              <span>Program</span>
            </a>
          </li>
          <li class="nav-link bordered px-3">
            <a href="profile.php" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-person"></i></span>
              <span>Profile</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
  <!-- sidebar end -->

  <!-- main content -->
  <main class="mt-3 p-2">
    <div class="container">
      <div class="page-title">
        <div style="font-weight: 500;" class="fs-3">Dashboard</div>
      </div>
      <nav class="mt-2 mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../home.php">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
      </nav>

      <div class="dashboard">
        <div class="row">
          <div class="col-md-4">
            <div class="card px-4 border-0 shadow-sm">
              <div class="card-body">
                <div class="fs-5 text-end">
                  100
                </div>
                <div style="margin-top: -10px;" class="fs-3 text-start text-info">
                  <i class="bi bi-people-fill"></i>
                </div>
                <div style="margin-top: -40px;" class="fs-5 pt-4 text-end">
                  Tours
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card px-4 border-0 shadow-sm">
              <div class="card-body">
                <div class="fs-5 text-end">
                  100
                </div>
                <div style="margin-top: -10px;" class="fs-3 text-start text-warning">
                  <i class="bi bi-intersect"></i>
                </div>
                <div style="margin-top: -40px;" class="fs-5 pt-4 text-end">
                  Departments
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card px-4 border-0 shadow-sm">
              <div class="card-body">
                <div class="fs-5 text-end">
                  100
                </div>
                <div style="margin-top: -10px;" class="fs-3 text-start text-danger">
                  <i class="bi bi-journal-text"></i>
                </div>
                <div style="margin-top: -40px;" class="fs-5 pt-4 text-end">
                  Programs
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="latest-added mt-5">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <div class="page-title fs-5 fw-bold mb-4">
              Latest Added
            </div>
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Department</th>
                  <th>Program</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>201901002</td>
                  <td>Arafat</td>
                  <td>CSE</td>
                  <td>BSc</td>
                  <td>
                    <a href="#" class="btn btn-sm btn-warning">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-danger">
                      <i class="bi bi-trash-fill"></i>
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>201901002</td>
                  <td>Arafat</td>
                  <td>CSE</td>
                  <td>BSc</td>
                  <td>
                    <a href="#" class="btn btn-sm btn-warning">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-danger">
                      <i class="bi bi-trash-fill"></i>
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>201901002</td>
                  <td>Arafat</td>
                  <td>CSE</td>
                  <td>BSc</td>
                  <td>
                    <a href="#" class="btn btn-sm btn-warning">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-danger">
                      <i class="bi bi-trash-fill"></i>
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>201901002</td>
                  <td>Arafat</td>
                  <td>CSE</td>
                  <td>BSc</td>
                  <td>
                    <a href="#" class="btn btn-sm btn-warning">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-danger">
                      <i class="bi bi-trash-fill"></i>
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>201901002</td>
                  <td>Arafat</td>
                  <td>CSE</td>
                  <td>BSc</td>
                  <td>
                    <a href="#" class="btn btn-sm btn-warning">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-danger">
                      <i class="bi bi-trash-fill"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- main content end-->

  <script src="js/jquery-3.5.1.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap5.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>

  <script>
    $(document).ready(function () {
      $('#datatable').DataTable({
        paging: false,
        info: true,
        dom: 'Bfrtip',
        select: true,
        pageLength: 5,
        recordsTotal: 10,
      });
    });
  </script>
</body>

</html>