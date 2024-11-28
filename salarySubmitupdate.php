<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $basic = $_POST['basic'];
    $bra = $_POST['bra'];
    $amount1 = $_POST['amount1'];
    $amount2 = $_POST['amount2'];
    $amount3 = $_POST['amount3'];
    $amount4 = $_POST['amount4'];
    $amount5 = $_POST['amount5'];
    $amount6 = $_POST['amount6'];
    $amount7 = $_POST['amount7'];
    $amount8 = $_POST['amount8'];
    $amount9 = $_POST['amount9'];
    $amount10 = $_POST['amount10'];
    $amount11 = $_POST['amount11'];
    $amount12 = $_POST['amount12'];
    $amount13 = $_POST['amount13'];
    $amount14 = $_POST['amount14'];
    $amount15 = $_POST['amount15'];
    $amount16 = $_POST['amount16'];
    $payment = $_POST['payment'];
    $account = $_POST['account'];
    $bank = $_POST['bank'];
    $branch = $_POST['branch'];

   
    mysqli_query($con, "UPDATE `salary` SET  
            `basic` = '$basic',
            `bra` = '$bra',
            `fa_travelling_amount` = '$amount1',
            `fa_budget_amount` = '$amount2',
            `fa_retravel_amount` = '$amount3',
            `fa_vehicle_amount` = '$amount4',
            `fa_fual_amount` = '$amount5',
            `fa_logging_amount` = '$amount6',
            `fa_attendance_amount` = '$amount7',
            `fa_travel_exp_amount` = '$amount8',
            `fa_pettah_amount` = '$amount9',
            `fa_bakery_amount` = '$amount10',
            `fa_insentive_amount` = '$amount11',
            `fd_welfare_amount` = '$amount12',
            `fd_medical_amount` = '$amount13',
            `fd_other1` = '$amount14',
            `fd_other2` = '$amount15',
            `fd_other3` = '$amount16',
            `payemnt` = '$payment',
            `account_num` = '$account',
            `bank_name` = '$bank',
            `branch_name` = '$branch'
        WHERE `id` = '$user_id'");

    header("Location: salarySearch.php");
    exit();
    ?>
<?php
}
?>
