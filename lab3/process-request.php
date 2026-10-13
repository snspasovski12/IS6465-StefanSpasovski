
<?php

// Check that the form was submitted using POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Method not allowed");
}

// Retrieve submitted form values
$course = trim($_POST["course"] ?? "");
$topic = trim($_POST["topic"] ?? "");
$preferredDate = $_POST["preferreddate"] ?? "";
$preferredTime = $_POST["preferredtime"] ?? "";

// Create validation arrays
$errors = [];
$allowedCourses = ["IS 6465", "IS 6495", "IS 6570"];
$allowedTimes = ["Morning", "Afternoon", "Evening"];

// Validate the course
if (!in_array($course, $allowedCourses, true)) {
    $errors["course"] = "Select a valid course.";
}

// Validate the preferred time
if (!in_array($preferredTime, $allowedTimes, true)) {
    $errors["preferred_time"] = "Select a valid preferred time.";
}

// Validate the topic
if ($topic === "" || mb_strlen($topic) > 120) {
    $errors["topic"] = "Enter a topic of 1 to 120 characters.";
}

// Validate the preferred date
date_default_timezone_set("America/Denver");

$date = DateTime::createFromFormat("!Y-m-d", $preferredDate);
$validDate = $date && $date->format("Y-m-d") === $preferredDate;

if (!$validDate) {
    $errors["preferred_date"] = "Enter a valid preferred date.";
} elseif ($date->format("Y-m-d") < date("Y-m-d")) {
    $errors["preferred_date"] = "Preferred date cannot be in the past.";
}

// Display confirmation or validation errors
if (!$errors) {
    echo "<h1>Request received</h1>";
    echo "<p>Course: " . htmlspecialchars($course, ENT_QUOTES, "UTF-8") . "</p>";
    echo "<p>Topic: " . htmlspecialchars($topic, ENT_QUOTES, "UTF-8") . "</p>";
    echo "<p>Preferred date: " . htmlspecialchars($preferredDate, ENT_QUOTES, "UTF-8") . "</p>";
    echo "<p>Preferred time: " . htmlspecialchars($preferredTime, ENT_QUOTES, "UTF-8") . "</p>";
    echo "<p>Status: Pending review</p>";
} else {
    echo "<h1>Request errors</h1>";

    foreach ($errors as $error) {
        echo "<p>" . htmlspecialchars($error, ENT_QUOTES, "UTF-8") . "</p>";
    }
}

?>
