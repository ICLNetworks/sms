<?php
session_start();
if (!isset($_SESSION['login_user'])) {
    header("Location: index.php");
    exit();
}
include("includes/db.conn.php");

$response = "";

// ---------------- TRACK ACTIVE TAB ----------------
$activeTab = $_POST['active_tab'] ?? 'scl'; // default School Fee

// ---------------- SCHOOL FEE ----------------
$editScl = null;
if (isset($_POST['add_scl'])) {
    $activeTab = 'scl';
    $standard = $_POST['standard'];
    $study_year = $_POST['study_year'];
    $total_fee = $_POST['total_fee'];
    $discount_fee = $_POST['discount_fee'];

    $check = $conn->prepare("SELECT id FROM sclfeedetails WHERE standard=? AND study_year=?");
    $check->bind_param("ss", $standard, $study_year);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $response = "<div class='alert alert-danger'>Record already exists for $standard in $study_year!</div>";
    } else {
        $stmt = $conn->prepare("INSERT INTO sclfeedetails (standard, study_year, total_fee, discount_fee) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssdd", $standard, $study_year, $total_fee, $discount_fee);
        $stmt->execute();
        $response = "<div class='alert alert-success'>School Fee added successfully!</div>";
        $stmt->close();
        $standard = $study_year = $total_fee = $discount_fee = '';
    }
    $check->close();
}

if (isset($_POST['update_scl'])) {
    $activeTab = 'scl';
    $id = $_POST['id'];
    $standard = $_POST['standard'];
    $study_year = $_POST['study_year'];
    $total_fee = $_POST['total_fee'];
    $discount_fee = $_POST['discount_fee'];

    $stmt = $conn->prepare("UPDATE sclfeedetails SET standard=?, study_year=?, total_fee=?, discount_fee=? WHERE id=?");
    $stmt->bind_param("ssddi", $standard, $study_year, $total_fee, $discount_fee, $id);
    $stmt->execute();
    $response = "<div class='alert alert-info'>School Fee updated successfully!</div>";
    $stmt->close();
    $editScl = null;
}

// ---------------- VAN FEE ----------------
$editVan = null;
if (isset($_POST['add_van'])) {
    $activeTab = 'van';
    $city = $_POST['city'];
    $study_year = $_POST['study_year'];
    $amount = $_POST['amount'];

    $check = $conn->prepare("SELECT id FROM vanfeedetails WHERE city=? AND study_year=?");
    $check->bind_param("ss", $city, $study_year);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $response = "<div class='alert alert-danger'>Record already exists for $city in $study_year!</div>";
    } else {
        $stmt = $conn->prepare("INSERT INTO vanfeedetails (city, study_year, amount) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $city, $study_year, $amount);
        $stmt->execute();
        $response = "<div class='alert alert-success'>Van Fee added successfully!</div>";
        $stmt->close();
        $city = $study_year = $amount = '';
    }
    $check->close();
}

if (isset($_POST['update_van'])) {
    $activeTab = 'van';
    $id = $_POST['id'];
    $city = $_POST['city'];
    $study_year = $_POST['study_year'];
    $amount = $_POST['amount'];

    $stmt = $conn->prepare("UPDATE vanfeedetails SET city=?, study_year=?, amount=? WHERE id=?");
    $stmt->bind_param("ssdi", $city, $study_year, $amount, $id);
    $stmt->execute();
    $response = "<div class='alert alert-info'>Van Fee updated successfully!</div>";
    $stmt->close();
    $editVan = null;
}

// ---------------- DELETE ----------------
if (isset($_GET['delete_scl'])) {
    $id = intval($_GET['delete_scl']);
    $conn->query("DELETE FROM sclfeedetails WHERE id=$id");
    $response = "<div class='alert alert-warning'>School Fee record deleted!</div>";
    $activeTab = 'view';
}
if (isset($_GET['delete_van'])) {
    $id = intval($_GET['delete_van']);
    $conn->query("DELETE FROM vanfeedetails WHERE id=$id");
    $response = "<div class='alert alert-warning'>Van Fee record deleted!</div>";
    $activeTab = 'view';
}

// ---------------- FETCH FOR EDIT ----------------
if (isset($_GET['edit_scl'])) {
    $activeTab = 'scl';
    $id = intval($_GET['edit_scl']);
    $res = $conn->query("SELECT * FROM sclfeedetails WHERE id=$id");
    $editScl = $res->fetch_assoc();
}

if (isset($_GET['edit_van'])) {
    $activeTab = 'van';
    $id = intval($_GET['edit_van']);
    $res = $conn->query("SELECT * FROM vanfeedetails WHERE id=$id");
    $editVan = $res->fetch_assoc();
}

// ---------------- FETCH LISTS ----------------
$sclList = $conn->query("SELECT * FROM sclfeedetails ORDER BY id DESC");
$vanList = $conn->query("SELECT * FROM vanfeedetails ORDER BY id DESC");

// ---------------- VIEW TAB ----------------
$viewType = $_POST['view_type'] ?? '';
$viewYear = $_POST['view_year'] ?? '';
$viewRecords = [];

if (isset($_POST['view_records']) || isset($_POST['view_type']) || isset($_POST['view_year'])) {
    $activeTab = 'view';
    if ($viewType === 'scl') {
        $stmt = $conn->prepare("SELECT * FROM sclfeedetails WHERE study_year=? ORDER BY id DESC");
        $stmt->bind_param("s", $viewYear);
    } elseif ($viewType === 'van') {
        $stmt = $conn->prepare("SELECT * FROM vanfeedetails WHERE study_year=? ORDER BY id DESC");
        $stmt->bind_param("s", $viewYear);
    }
    if (!empty($stmt)) {
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $viewRecords[] = $row;
        }
        $stmt->close();
    }
}

$sclYears = $conn->query("SELECT DISTINCT study_year FROM sclfeedetails ORDER BY study_year DESC");
$vanYears = $conn->query("SELECT DISTINCT study_year FROM vanfeedetails ORDER BY study_year DESC");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Fee Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>

    <!-- HEADER (College Info) -->
    <?php include("header.php"); ?>

    <div class="container">
        <!-- Blue Box Wrapper -->
        <div class="blue-box">
            <div class="blue-box-header">
                <span>Fee Management</span>
                <div>
                    <a href="home.php" class="btn-home">Home</a>
                    <a href="logout.php" class="btn-logout">Logout</a>
                </div>
            </div>
            <div class="blue-box-body">

                <?= $response; ?>

                <!-- Navigation Tabs -->
                <ul class="nav nav-tabs" id="feeTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?= $activeTab == 'view' ? 'active' : '' ?>" id="view-tab"
                            data-bs-toggle="tab" data-bs-target="#view" type="button" role="tab">View Records</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?= $activeTab == 'scl' ? 'active' : '' ?>" id="scl-tab"
                            data-bs-toggle="tab" data-bs-target="#sclfee" type="button" role="tab">School Fee</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?= $activeTab == 'van' ? 'active' : '' ?>" id="van-tab"
                            data-bs-toggle="tab" data-bs-target="#vanfee" type="button" role="tab">Van Fee</button>
                    </li>
                </ul>

                <div class="tab-content mt-3" id="feeTabContent">
                    <!-- View Records Tab -->
                    <div class="tab-pane fade <?= $activeTab == 'view' ? 'show active' : '' ?>" id="view"
                        role="tabpanel" aria-labelledby="view-tab">
                        <h3>View Records</h3>
                        <form method="POST" class="row g-3 mb-3">
                            <input type="hidden" name="active_tab" value="view">
                            <div class="col-md-4">
                                <label>Type</label>
                                <select name="view_type" class="form-select" onchange="this.form.submit()">
                                    <option value="">--Select Type--</option>
                                    <option value="scl" <?= ($viewType == 'scl') ? 'selected' : '' ?>>School Fee</option>
                                    <option value="van" <?= ($viewType == 'van') ? 'selected' : '' ?>>Van Fee</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Year</label>
                                <select name="view_year" class="form-select" onchange="this.form.submit()">
                                    <option value="">--Select Year--</option>
                                    <?php
                                    if ($viewType == 'scl') {
                                        $sclYears->data_seek(0);
                                        while ($row = $sclYears->fetch_assoc()) {
                                            $selected = ($viewYear == $row['study_year']) ? 'selected' : '';
                                            echo "<option value='{$row['study_year']}' $selected>{$row['study_year']}</option>";
                                        }
                                    } elseif ($viewType == 'van') {
                                        $vanYears->data_seek(0);
                                        while ($row = $vanYears->fetch_assoc()) {
                                            $selected = ($viewYear == $row['study_year']) ? 'selected' : '';
                                            echo "<option value='{$row['study_year']}' $selected>{$row['study_year']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4 align-self-end">
                                <button type="submit" name="view_records" class="btn btn-primary">View</button>
                            </div>
                        </form>

                        <?php if (!empty($viewRecords)): ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <?php if ($viewType == 'scl'): ?>
                                            <th>ID</th>
                                            <th>Standard</th>
                                            <th>Year</th>
                                            <th>Total Fee</< /th>
                                            <th>Discount</th>
                                            <th>Action</th>
                                        <?php elseif ($viewType == 'van'): ?>
                                            <th>ID</th>
                                            <th>City</th>
                                            <th>Year</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($viewRecords as $row): ?>
                                        <tr>
                                            <?php if ($viewType == 'scl'): ?>
                                                <td><?= $row['id']; ?></td>
                                                <td><?= $row['standard']; ?></td>
                                                <td><?= $row['study_year']; ?></td>
                                                <td><?= $row['total_fee']; ?></td>
                                                <td><?= $row['discount_fee']; ?></td>
                                                <td>
                                                    <a href="?edit_scl=<?= $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                                    <a href="?delete_scl=<?= $row['id']; ?>" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Delete this record?')">Delete</a>
                                                </td>
                                            <?php elseif ($viewType == 'van'): ?>
                                                <td><?= $row['id']; ?></td>
                                                <td><?= $row['city']; ?></td>
                                                <td><?= $row['study_year']; ?></td>
                                                <td><?= $row['amount']; ?></td>
                                                <td>
                                                    <a href="?edit_van=<?= $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                                    <a href="?delete_van=<?= $row['id']; ?>" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Delete this record?')">Delete</a>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>

                    <!-- School Fee Form -->
                    <div class="tab-pane fade <?= $activeTab == 'scl' ? 'show active' : '' ?>" id="sclfee"
                        role="tabpanel" aria-labelledby="scl-tab">
                        <h3>School Fee</h3>
                        <form method="POST">
                            <div class="mb-3">
                                <label>Standard</label>
                                <select name="standard" id="standard" class="form-control">
                                    <option>Select</option>
                                    <option>LKG</option>
                                    <option>UKG</option>
                                    <option>I Std</option>
                                    <option>II Std</option>
                                    <option>III Std</option>
                                    <option>IV Std</option>
                                    <option>V Std</option>
                                    <option>VI Std</option>
                                    <option>VII Std</option>
                                    <option>VIII Std</option>
                                    <option>IX Std</option>
                                    <option>X Std</option>


                                </select>

                                <!-- <input type="text" name="standard" class="form-control" required
                                    value="<?= $editScl['standard'] ?? ($standard ?? ''); ?>"> -->
                            </div>

                            <div class="mb-3">
                                <label>Study Year (e.g., 2025-2026)</label>
                                <select name="study_year" class="form-control" required>
                                    <option value="">-- Select Study Year --</option>
                                    <?php
                                    $startYear = 2020; // first year you want
                                    $currentYear = date("Y");
                                    $endYear = $currentYear + 1; // stop at next year
                                    
                                    for ($y = $startYear; $y < $endYear; $y++) {
                                        $next = $y + 1;
                                        $val = "$y-$next";
                                        $selected = (isset($editScl['study_year']) && $editScl['study_year'] == $val) ? "selected" : "";
                                        echo "<option value='$val' $selected>$val</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- <div class="mb-3">
                                <label>Study Year (e.g., 2025-2026)</label>
                                <input type="text" name="study_year" class="form-control" required
                                    value="<?= $editScl['study_year'] ?? ($study_year ?? ''); ?>"
                                    placeholder="2025-2026">
                            </div> -->
                            <div class="mb-3">
                                <label>Total Fee</label>
                                <input type="number" step="0.01" name="total_fee" class="form-control" required
                                    value="<?= $editScl['total_fee'] ?? ($total_fee ?? ''); ?>">
                            </div>
                            <div class="mb-3">
                                <label>Discount Fee</label>
                                <input type="number" step="0.01" name="discount_fee" class="form-control" required
                                    value="<?= $editScl['discount_fee'] ?? ($discount_fee ?? ''); ?>">
                            </div>
                            <button type="submit" name="add_scl" class="btn btn-success">Add</button>
                            <button type="submit" name="update_scl" class="btn btn-primary">Update</button>
                        </form>
                    </div>

                    <!-- Van Fee Form -->
                    <div class="tab-pane fade <?= $activeTab == 'van' ? 'show active' : '' ?>" id="vanfee"
                        role="tabpanel" aria-labelledby="van-tab">
                        <h3>Van Fee</h3>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?= $editVan['id'] ?? ''; ?>">
                            <div class="mb-3">
                                <label>City</label>
                                <select name="city" id="city" class="form-control">
                                    <option>Select</option>
                                    <option>Nainar Kovil</option>
                                    <option>Andakudi</option>
                                    <option>Puthunagar</option>
                                    <option>Kelayakudi</option>
                                    <option>Nadukudi</option>
                                    <option>Kannadevan</option>
                                    <option>Elamanur Stop</option>
                                    <option>Elamanur Inside</option>
                                    <option>Gunapanendhal</option>
                                    <option>Subhas Nagar</option>
                                    <option>Mahalakshmi Nagar</option>
                                    <option>Perumbhachery</option>
                                    <option>Naganathapuram</option>
                                    <option>Ganapathi Nagar</option>
                                    <option>Barma Colony</option>
                                    <option>Varatharaja Perumal V.P Colony</option>
                                    <option>Malayan Gudiruppu</option>
                                    <option>Jeeva Nagar</option>
                                    <option>Puthu Nagar</option>
                                    <option>Vaigai Nagar</option>
                                    <option>Gandhi Nagar</option>
                                    <option>Emaneswaram</option>
                                    <option>Adhikarai</option>
                                    <option>Thalaiyaadi Kottai</option>
                                    <option>Pappar Kuttam</option>
                                </select>
                                <!-- <input type="text" name="city" class="form-control" required
                                    value="<?= $editVan['city'] ?? ($city ?? ''); ?>"> -->
                            </div>
                            <div class="mb-3">
                                <label>Study Year (e.g., 2025-2026)</label>
                                <select name="study_year" class="form-control" required>
                                    <option value="">-- Select Study Year --</option>
                                    <?php
                                    $startYear = 2020; // first year you want
                                    $currentYear = date("Y");
                                    $endYear = $currentYear + 1; // stop at next year
                                    
                                    for ($y = $startYear; $y < $endYear; $y++) {
                                        $next = $y + 1;
                                        $val = "$y-$next";
                                        $selected = (isset($editScl['study_year']) && $editScl['study_year'] == $val) ? "selected" : "";
                                        echo "<option value='$val' $selected>$val</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- <div class="mb-3">
                                <label>Study Year (e.g., 2025-2026)</label>
                                <input type="text" name="study_year" class="form-control" required
                                    value="<?= $editVan['study_year'] ?? ($study_year ?? ''); ?>"
                                    placeholder="2025-2026">
                            </div> -->
                            <div class="mb-3">
                                <label>Amount</label>
                                <input type="number" step="0.01" name="amount" class="form-control" required
                                    value="<?= $editVan['amount'] ?? ($amount ?? ''); ?>">
                            </div>
                            <button type="submit" name="add_van" class="btn btn-success">Add</button>
                            <button type="submit" name="update_van" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>