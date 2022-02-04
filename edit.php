<?php include_once 'config/init.php'; ?>

<?php
// now we want to create the job object here'
$job = new Job;

//so here we want to get the id from the url 
$job_id = isset($_GET['id']) ? $_GET['id'] : null;

// config will hold database parameter
// template
$template = new Template('template/job-edit.php');

if(isset($_POST['submit'])){
	//Create Data Array
	$data = array();
	$data['job_title'] = $_POST['job_title'];
	$data['company'] = $_POST['company'];
	$data['category_id'] = $_POST['category'];
	$data['description'] = $_POST['description'];
	$data['location'] = $_POST['location'];
	$data['salary'] = $_POST['salary'];
	$data['contact_user'] = $_POST['contact_user'];
	$data['contact_email'] = $_POST['contact_email'];


	if($job->update($job_id, $data)){
		redirect('index.php', 'Your job has been updated', 'success');
	} else {
		redirect('index.php', 'Something went wrong', 'error');
	}
}

$template->categories = $job->getCategories();

$template->job = $job->getJob($job_id);

echo $template;