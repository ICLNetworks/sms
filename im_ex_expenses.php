<?php

$today = date('Y-m-d');
$activeTab = 'import_export';
$response = "";

// ---------------- CSV IMPORT ----------------
if (isset($_POST['import_csv'])) {
    if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == 0) {
        $fileName = $_FILES['csv_file']['tmp_name'];
        $handle = fopen($fileName, "r");
        if ($handle !== FALSE) {
            $rowCount = 0;
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $rowCount++;
                if ($rowCount == 1) continue; // skip header

                $expense_date = $data[0];
                $description = $data[1];
                $amount = $data[2];
                $billtype = $data[3] ?? 'Credit';
                $payment_type = $data[4] ?? 'Cash';

                if ($billtype === "ToSabai") $description = "Amount given to Sabai";
                if ($expense_date > $today) continue;

                // Generate bill number
                $result = $conn->query("SELECT bill_no FROM school_expenses ORDER BY created_at DESC LIMIT 1");
                $lastNo = $result && $row = $result->fetch_assoc() ? (int)substr($row['bill_no'], 7) : 0;
                $bill_no = "SMSBill" . str_pad($lastNo + 1, 4, "0", STR_PAD_LEFT);

                $stmt = $conn->prepare("INSERT INTO school_expenses (bill_no, expense_date, description, amount, billtype, payment_type) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssdss", $bill_no, $expense_date, $description, $amount, $billtype, $payment_type);
                $stmt->execute();
                $stmt->close();
            }
            fclose($handle);
            $response = "<div class='alert alert-success'>CSV imported successfully!</div>";
        } else {
            $response = "<div class='alert alert-danger'>Could not open CSV file.</div>";
        }
    } else {
        $response = "<div class='alert alert-danger'>Please upload a valid CSV file.</div>";
    }
}

// ---------------- CSV EXPORT ----------------
if (isset($_POST['export_csv'])) {
    $from = $_POST['from_date'] ?? '';
    $to = $_POST['to_date'] ?? '';
    $where = "1=1";
    if (!empty($from) && !empty($to)) $where = "expense_date BETWEEN '$from' AND '$to'";

    $res_export = $conn->query("SELECT * FROM school_expenses WHERE $where ORDER BY CAST(SUBSTRING(bill_no,8) AS UNSIGNED) DESC");

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="expenses_export.csv"');
    $out = fopen("php://output", "w");
    fputcsv($out, ['bill_no', 'expense_date', 'description', 'amount', 'billtype', 'payment_type', 'created_at']);
    while ($row = $res_export->fetch_assoc()) {
        fputcsv($out, [$row['bill_no'], $row['expense_date'], $row['description'], $row['amount'], $row['billtype'], $row['payment_type'], $row['created_at']]);
    }
    fclose($out);
    exit;
}
?>

<div class="tab-pane fade show active" id="import_export">
    <?= $response ?>
    <h4>Export Expenses</h4>
    <form method="POST" class="row g-3 mb-3">
        <input type="hidden" name="active_tab" value="import_export">
        <div class="col-md-3">
            <label>From</label>
            <input type="date" name="from_date" class="form-control" max="<?= $today ?>">
        </div>
        <div class="col-md-3">
            <label>To</label>
            <input type="date" name="to_date" class="form-control" max="<?= $today ?>">
        </div>
        <div class="col-md-6 align-self-end">
            <button type="submit" name="export_csv" class="btn btn-success">Export CSV</button>
        </div>
    </form>

    <h4>Import Expenses</h4>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="active_tab" value="import_export">
        <div class="row mb-3">
            <div class="col-md-6">
                <input type="file" name="csv_file" accept=".csv" class="form-control" required>
            </div>
            <div class="col-md-6">
                <button type="submit" name="import_csv" class="btn btn-primary">Import CSV</button>
            </div>
        </div>
    </form>
</div>
