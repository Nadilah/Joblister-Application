<?php include_once 'config/init.php'; ?>

<?php
// now we want to create the job object here'
$job = new Job;

if(isset($_POST['del_id'])){
    $del_id =$_POST['del_id'];
    if($job->delete($del_id)){
        redirect('index.php', 'Job Deleted', 'success');
    } else {
        redirect('index.php','Job Not Deleted', 'error');
    }
}

// config will hold database parameter
// template
$template = new Template('template/job-single.php');

//so here we want to get the id from the url 
$job_id = isset($_GET['id']) ? $_GET['id'] : null;


$template->job = $job->getJob($job_id);

echo $template;