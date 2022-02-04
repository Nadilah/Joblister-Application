<?php include_once 'config/init.php'; ?>

<?php
// now we want to create the job object here'
$job = new Job;

// config will hold database parameter
// template
$template = new Template('template/frontpage.php');

//if there is a category in url, we gonna set this variable (get) to it. if it is not, then we gonna set it as a null
$category = isset($_GET['category']) ? $_GET['category'] : null;

if($category){
    $template->jobs = $job->getByCategory($category);
    $template->title = 'Jobs In '.$job->getCategory($category)->name;

} else{
    $template->title = 'Latest Jobs';
    $template->jobs = $job->getAllJobs();
}

$template->categories = $job->getCategories();

echo $template;