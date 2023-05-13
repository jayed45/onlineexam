<?php

include 'lib/Session.php';

include 'studentsession.php';

include 'lib/Database.php';
include 'class/Format.php';

Session::stdCheckSession();

if (isset($_GET['action']) && isset($_GET['action']) == 'logout') {
    Session::destroy();
    header("Location:index.php");
    exit();
}


include 'class/Student.php';
 
$student = new Student();
 
$studentId =  Session::get('id');

$question = "0";
if (isset($_GET['id'])) {
    $examId = $_GET['id'];
    if(isset($_POST['submit'])){
        $std_ans = $_POST['std_ans'];
         $student->preSubmitEnrolledExamCheck($studentId,$examId,1,$std_ans);
    }
     $results  = $student->getExamById($examId);
   $queryCount =   $student->startEnrolledExam($studentId,$examId);
   $preSubmitEnrolledExamCheck =   $student->preSubmitEnrolledExamCheck($studentId,$examId,0,0);
 
//    var_dump($preSubmitEnrolledExamCheck);
   foreach($results as $value){
      
       $question = $value['total_qsns'];
   }
     

  $success =  $preSubmitEnrolledExamCheck['success'];
  if($success ==1){
    $got_marks =  $preSubmitEnrolledExamCheck['data']['got_marks'];
    $std_solution =  $preSubmitEnrolledExamCheck['data']['solution'];
    $std_ans =  $preSubmitEnrolledExamCheck['data']['std_ans'];
    $message = "You Have Got Mark " .$got_marks;
  }
 
}



 

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Question</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!--Navigation part starts-->
    <?php include 'navbarstudent.php' ; ?>
    <!--Navigation part ends-->


    <!-- Exam list part Starts -->


    <div class="container">
        <div class="card">

            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="panel-title">View Question</h3>
                    </div>                    
                </div>
            </div>


            <div class="card-body">

            <div class="alert alert-warning" role="alert">
   <p id="display"  style="color:#FF0000; text-align:center;font-size:20px">
   <?php
                        if (isset($message)) {
                            echo $message;
                            unset($message);
                        }
                        ?>

</p></div>

                <h1 class="text-center"><?php echo  $question; ?></h1>
                <div class="row">
                    <div class="col-md-10 offset-md-1">

                <?php 
                
                if($success == 1){
?>
  <h1 class="text-center">Your Answer Is : <?php echo  $std_ans; ?></h1>
  <h1 class="text-center">Correct Answer Is : <?php echo  $std_solution; ?></h1>
<?php 
                }else{
                ?>
  <form class="row g-3 form-group" action="" method="POST" enctype="multipart/form-data">
                           <div class="col-12">
                                <label for="solution" class="form-label">Solution</label>
                                <textarea name="std_ans" id="" cols="30" rows="5" class="form-control" id="solution"></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" id="button" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                        <?php 
}

?>
                    </div>
                </div>
                
    </div>


        </div>
    </div>

    <!-- Exam list part Ends -->


    <script>
 
             var div = document.getElementById('display');
              var check =   document.getElementById('test');
             var submitted = document.getElementById('submitted');
 
               function CountDown(duration, display,check) {
 
                         var timer = duration, minutes, seconds;
 
                       var interVal=  setInterval(function () {
                             minutes = parseInt(timer / 60, 10);
                             seconds = parseInt(timer % 60, 10);
//  Exucution  code 
                              minutes = minutes < 10 ? "0" + minutes : minutes;
                             seconds = seconds < 10 ? "0" + seconds : seconds;
                     display.innerHTML ="<b>" + minutes + "m : " + seconds + "s" + "</b>";
                     document.title = minutes + ":" + seconds;
                             if (timer > 0) {
                                --timer;
                             }else{
                        clearInterval(interVal)
                                 SubmitFunction();
                              }
 
                        },1000);
 
                 }
 
               function SubmitFunction(){
    
      document.getElementById("button").click();
 }
 

 var success = '<?php echo $preSubmitEnrolledExamCheck['success']; ?>';
 console.log(success);
 if(success == 0){
    CountDown( '<?php echo $preSubmitEnrolledExamCheck['lefttime']; ?>',div,check); 
 }else{
 
 }

 
 
  
             </script>
</body>

</html>