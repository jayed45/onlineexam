<?php

include '../lib/Session.php';
  include 'session.php'; 

include '../lib/Database.php';
include '../class/Format.php';

Session::checkSession();

if (isset($_GET['action']) && isset($_GET['action']) == 'logout') {
    Session::destroy();
    header("Location:index.php");
    exit();
}


include '../class/Exam.php';

$exam = new Exam();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $exam_title = $_POST['exam_title'];
    $total_qsns = $_POST['total_qsns'];
    $facultyId =  Session::get('id');
    $exam_duration = $_POST['exam_duration'];
    $total_marks = $_POST['total_marks'];
    $exam_declaration_datetime = $_POST['exam_declaration_datetime'];
    $exam_status = $_POST['exam_status'];
    $solution = $_POST['solution'];

    $message = $exam->examRegistration($exam_title, $facultyId, $total_qsns, $exam_duration, $total_marks, $exam_declaration_datetime, $exam_status, $solution);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Exam</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <!--Navigation part starts-->
<?php include 'navbar.php'; ?>
    <!--Navigation part ends-->

    <div class="container">
        <div class="card">

            <div class="card-header">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <h3 class="panel-title">Add Exam</h3>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-10 offset-md-1">

                        <?php
                        if (isset($message)) {
                            echo $message;
                            unset($message);
                        }
                        ?>

                        <form class="row g-3 form-group" action="" method="POST" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <label for="exam_title" class="form-label">Exam Title</label>
                                <input type="text" name="exam_title" class="form-control" id="exam_title">
                            </div>
                            <div class="col-12">
                                <label for="exam_duration" class="form-label">Exam Duration (Minute)</label>
                                <input type="number" name="exam_duration" class="form-control" id="exam_duration">
                            </div>
                            <div class="col-12">
                                <label for="total_marks" class="form-label">Exam Marks</label>
                                <input type="number" name="total_marks" class="form-control" id="total_marks">
                            </div>
                            <div class="col-12">
                                <label for="exam_declaration_datetime" class="form-label">Exam Declaration Date</label>
                                <input type="datetime-local" name="exam_declaration_datetime" class="form-control" id="exam_declaration_datetime">
                            </div>
                            <div class="col-12">
                                <label for="exam_status" class="form-label">Exam Status</label>
                                <select class="form-select" name="exam_status" aria-label="Default select example">
                                    <option selected>--select--</option>
                                    <option value="0">Enable</option>
                                    <option value="1">Disable</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="total_qsns" class="form-label">Question</label>
                                <textarea name="total_qsns" id="" cols="30" rows="5" class="form-control" id="total_qsns"></textarea>
                            </div>
                            <div class="col-12">
                                <label for="solution" class="form-label">Solution</label>
                                <textarea name="solution" id="" cols="30" rows="5" class="form-control" id="solution"></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save Question</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>

</body>

</html>