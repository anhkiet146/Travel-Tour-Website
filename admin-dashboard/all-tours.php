<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tour_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Truy vấn lấy dữ liệu từ bảng `tour`
    $stmt = $conn->prepare("SELECT TourID, TourName, MoTa, GiaVeTreEm, GiaVeNguoiLon, ThoiGianTour, NgayThem, NgayBatDau, NgayKetThuc, SoCho, MaLoai, MaKM, MaDXP, MaLT FROM tour");
    $stmt->execute();

    // Lấy dữ liệu
    $tours = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Kết nối thất bại: " . $e->getMessage();
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto me-md-4 mb-2 mb-lg-0">
                    <li class="nav-item dropdown d-flex text-light">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-regular fa-user"></i> Admin
                        </a>
                        <ul class="dropdown-menu border-0 bg-light ms-auto">
                            <li><a class="dropdown-item" href="#">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
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
                    <li class="nav-link bordered px-3">
                        <a href="index.php" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link bordered px-3">
                        <a class="nav-link px-3 sidebar-link active" data-bs-toggle="collapse" href="#collapseExample"
                            role="button" aria-expanded="false" aria-controls="collapseExample">
                            <span class="me-2">
                                <i class="bi bi-people-fill"></i>
                            </span>
                            <span>Tours</span>
                            <span class="right-icon ms-auto">
                                <i class="bi bi-chevron-down"></i>
                            </span>
                        </a>
                        <div class="collapse show" id="collapseExample">
                            <div>
                                <ul class="navbar-nav ps-3">
                                    <li>
                                        <a href="add-tour.php" class="nav-link px-3">
                                            <span class="me-2"><i class="bi bi-1-circle"></i></span>
                                            <span>Add Tour</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="all-tours.php" class="nav-link px-3 active">
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
                <div style="font-weight: 500;" class="fs-3">All Tours</div>
            </div>
            <nav class="mt-2 mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Tours</li>
                </ol>
            </nav>
            <div class="all-tours mt-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="page-title fs-5 fw-bold mb-4">
                            All Tours
                        </div>
                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>TourID</th>
                                    <th>TourName</th>
                                    <th>Mota</th>
                                    <th>GiaVeTreEm</th>
                                    <th>GiaVeNguoiLon</th>
                                    <th>ThoiGianTour</th>
                                    <th>NgayThem</th>
                                    <th>NgayBatDau</th>
                                    <th>NgayKetThuc</th>
                                    <th>SoCho</th>
                                    <th>MaLoai</th>
                                    <th>MaKM</th>
                                    <th>MaDXP</th>
                                    <th>MaLT</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tours as $tour): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($tour['TourID']); ?></td>
                                        <td><?php echo htmlspecialchars($tour['TourName']); ?></td>
                                        <td>
                                            <?php
                                            $description = htmlspecialchars($tour['MoTa']);
                                            echo (strlen($description) > 10) ? substr($description, 0, 5) . '...' : $description;
                                            ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($tour['GiaVeTreEm']); ?></td>
                                        <td><?php echo htmlspecialchars($tour['GiaVeNguoiLon']); ?></td>
                                        <td><?php echo htmlspecialchars($tour['ThoiGianTour']); ?></td>
                                        <td><?php echo htmlspecialchars($tour['NgayThem']); ?></td>
                                        <td><?php echo htmlspecialchars($tour['NgayBatDau']); ?></td>
                                        <td><?php echo htmlspecialchars($tour['NgayKetThuc']); ?></td>
                                        <td><?php echo htmlspecialchars($tour['SoCho']); ?></td>
                                        <td><?php echo htmlspecialchars($tour['MaLoai']); ?></td>
                                        <td><?php echo htmlspecialchars($tour['MaKM']); ?></td>
                                        <td><?php echo htmlspecialchars($tour['MaDXP']); ?></td>
                                        <td><?php echo htmlspecialchars($tour['MaLT']); ?></td>
                                        <td>
                                            <a href="show-tours.php?id=<?php echo htmlspecialchars($tour['TourID']); ?>"
                                                class="btn btn-sm btn-info mb-1">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="edit-tours.php?id=<?php echo htmlspecialchars($tour['TourID']); ?>"
                                                class="btn btn-sm btn-warning mb-1">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="delete-tours.php?id=<?php echo htmlspecialchars($tour['TourID']); ?>"
                                                class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
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
        $('#datatable').DataTable({
            scrollX: true,
            columns: [
                { title: "TourID" },
                { title: "TourName" },
                { title: "MoTa" },
                { title: "GiaVeTreEm" },
                { title: "GiaVeNguoiLon" },
                { title: "ThoiGianTour" },
                { title: "NgayThem" },
                { title: "NgayBatDau" },
                { title: "NgayKetThuc" },
                { title: "SoCho" },
                { title: "MaLoai" },
                { title: "MaKM" },
                { title: "MaDXP" },
                { title: "MaLT" },
                { title: "Action" }
            ]
        });



    </script>
</body>

</html>