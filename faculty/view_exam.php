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

$examId = $_GET['viewExam'];

if (isset($_GET['viewExam'])) {
    $result = $exam->getExamById($examId);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Exam</title>

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
                        <h3 class="panel-title">Exam Details</h3>
                    </div>
                    <div class="col-md-1">
                        <a class="btn btn-outline-info" href="update_exam.php?udpateExam=<?php echo $examId; ?>">Edit</a>
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
                            <?php
                            if ($result) {
                                foreach ($result as $value) {
                            ?>

                                    <div class="col-md-12">
                                        <label for="exam_title" class="form-label">Exam Title</label>
                                        <input type="text" name="exam_title" disabled value="<?php echo $value['exam_title']; ?>" class="form-control" id="exam_title">
                                    </div>
                                    <div class="col-12">
                                        <label for="exam_duration" class="form-label">Exam Duration (Minute)</label>
                                        <input type="number" name="exam_duration" disabled value="<?php echo $value['exam_duration']; ?>" class="form-control" id="exam_duration">
                                    </div>
                                    <div class="col-12">
                                        <label for="total_marks" class="form-label">Exam Marks</label>
                                        <input type="number" name="total_marks" disabled value="<?php echo $value['total_marks']; ?>" class="form-control" id="total_marks">
                                    </div>
                                    <div class="col-12">
                                        <label for="exam_declaration_datetime" class="form-label">Exam Declaration Date</label>
                                        <?php
                                        $date = date("Y-m-d\TH:i:s", strtotime($value['exam_declaration_datetime']));
                                        ?>
                                        <input type="datetime-local" disabled name="exam_declaration_datetime" value="<?php echo $date; ?>" class="form-control" id="exam_declaration_datetime">
                                    </div>
                                    <div class="col-12">
                                        <label for="exam_status" class="form-label">Exam Status</label>
                                        <select class="form-select" disabled name="exam_status" aria-label="Default select example">
                                            <?php
                                            if ($value['exam_status'] == 0) {
                                            ?>
                                                <option selected value="0">Enabal</option>
                                                <option value="1">Disable</option>
                                            <?php
                                            } else {
                                            ?>

                                                <option selected value="1">Disable</option>
                                                <option value="0">Enabal</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="total_qsns" class="form-label">Question</label>
                                        <textarea name="total_qsns" disabled id="" cols="30" rows="5" class="form-control" id="total_qsns"><?php echo $value['total_qsns']; ?></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="solution" class="form-label">Solution</label>
                                        <textarea name="solution" disabled id="" cols="30" rows="5" class="form-control" id="solution"><?php echo $value['solution']; ?></textarea>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>

</body>

</html>