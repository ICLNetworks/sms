<?php 
$response = "";
$today = date('Y-m-d');

// ---------------- GENERATE BILL NO ----------------
function generateBillNo($conn)
{
    $result = $conn->query("SELECT bill_no FROM school_expenses ORDER BY created_at DESC LIMIT 1");
    if (!$result) die("Query failed: " . $conn->error);

    if ($row = $result->fetch_assoc()) {
        $lastNo = (int) substr($row['bill_no'], 7);
        $nextNo = $lastNo + 1;
    } else {
        $nextNo = 1;
    }
    return "SMSBill" . str_pad($nextNo, 4, "0", STR_PAD_LEFT);
}

// ---------------- FETCH EDIT DATA ----------------
$edit_expense = null;
if (isset($_GET['edit_bill'])) {
    $bill_no = $_GET['edit_bill'];
    $stmt = $conn->prepare("SELECT * FROM school_expenses WHERE bill_no=?");
    $stmt->bind_param("s", $bill_no);
    $stmt->execute();
    $result_edit = $stmt->get_result();
    $edit_expense = $result_edit->fetch_assoc();
    $stmt->close();
    // SECURITY CHECK
    if ($edit_expense && stripos($edit_expense['description'], 'Student Fee') !== false) {
        // Set a session flash message
        session_start();
        $_SESSION['error_msg'] = "Currently, edit support is not available for Student Fee bills.";

        // Redirect to View Expenses tab
        header("Location: expenses.php?active_tab=view");
        exit;
    }
}

// ---------------- ADD / EDIT EXPENSE ----------------
if (isset($_POST['add_expense'])) {
    $expense_date = $_POST['expense_date'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $billtype = $_POST['billtype'] ?? 'Credit';
    $payment_type = $_POST['payment_type'] ?? 'Cash';
    $bill_no = $_POST['bill_no'] ?? generateBillNo($conn);

    if ($billtype === "ToSabai") {
        $description = "Amount given to Sabai";
        $billtype = "Debit";
    }

    if ($expense_date <= $today) {
        if (isset($_POST['bill_no'])) {
            $stmt = $conn->prepare("UPDATE school_expenses SET expense_date=?, description=?, amount=?, billtype=?, payment_type=? WHERE bill_no=?");
            $stmt->bind_param("ssdsss", $expense_date, $description, $amount, $billtype, $payment_type, $bill_no);
            $stmt->execute();
            $stmt->close();
            $response = "<div class='alert alert-success'>Expense updated successfully!</div>";
        } else {
            $stmt = $conn->prepare("INSERT INTO school_expenses (bill_no, expense_date, description, amount, billtype, payment_type) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssdss", $bill_no, $expense_date, $description, $amount, $billtype, $payment_type);
            $stmt->execute();
            $stmt->close();
            $response = "<div class='alert alert-success'>Expense added successfully!</div>";
        }
    } else {
        $response = "<div class='alert alert-danger'>Future dates are not allowed!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add / Edit Expense</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

<h2 class="mb-4"><?= $edit_expense ? 'Edit Expense' : 'Add Expense' ?></h2>

<?= $response ?>

<form method="POST">
    <?php if ($edit_expense): ?>
        <input type="hidden" name="bill_no" value="<?= $edit_expense['bill_no'] ?>">
    <?php endif; ?>
    <div class="row mb-3">
        <div class="col-md-6">
            <label>Expense Date</label>
            <input type="date" name="expense_date" class="form-control" value="<?= $edit_expense['expense_date'] ?? '' ?>" max="<?= $today ?>" required>
        </div>
        <div class="col-md-6">
            <label>Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" value="<?= $edit_expense['amount'] ?? '' ?>" required>
        </div>
        <div class="col-md-6">
            <label>Bill Type</label>
            <select name="billtype" id="billtype_add" class="form-control" required>
                <option value="Credit" <?= ($edit_expense['billtype']??'')=='Credit'?'selected':'' ?>>Credit</option>
                <option value="Debit" <?= ($edit_expense['billtype']??'')=='Debit'?'selected':'' ?>>Debit</option>
                <option value="ToSabai" <?= ($edit_expense['description']??'')=='Amount given to Sabai'?'selected':'' ?>>To Sabai</option>
            </select>
        </div>
        <div class="col-md-6">
            <label>Payment Type</label>
            <select name="payment_type" class="form-control" required>
                <option value="Cash" <?= ($edit_expense['payment_type']??'')=='Cash'?'selected':'' ?>>Cash</option>
                <option value="GPay" <?= ($edit_expense['payment_type']??'')=='GPay'?'selected':'' ?>>GPay</option>
            </select>
        </div>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" id="description_add" class="form-control"><?= $edit_expense['description'] ?? '' ?></textarea>
    </div>

    <button type="submit" name="add_expense" class="btn btn-success"><?= $edit_expense ? 'Update' : 'Submit' ?></button>
    <?php if ($edit_expense): ?>
        <a href="expenses.php?active_tab=add" class="btn btn-secondary">Cancel</a>
    <?php else: ?>
        <button type="reset" class="btn btn-secondary">Reset</button>
    <?php endif; ?>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function toggleDescription(selectElem, textareaId){
    const textarea=document.getElementById(textareaId);
    if(selectElem.value==='ToSabai'){
        textarea.value='Amount given to Sabai';
        textarea.readOnly=true;
    } else {
        textarea.readOnly=false;
        <?php if(!$edit_expense): ?>textarea.value='';<?php endif; ?>
    }
}
document.getElementById('billtype_add').addEventListener('change', function(){ toggleDescription(this,'description_add'); });
<?php if($edit_expense): ?> toggleDescription(document.getElementById('billtype_add'),'description_add'); <?php endif; ?>
</script>

</body>
</html>
