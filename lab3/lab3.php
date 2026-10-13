
<?php

// Indexed arrays
$timeSlots = ["Morning", "Afternoon", "Evening"];

echo $timeSlots[0]; // Morning
echo $timeSlots[1]; // Afternoon
echo $timeSlots[2]; // Evening
echo '<br>';

// Associative arrays
$request = [
    "course" => "IS 6465",
    "topic" => "PHP arrays",
    "status" => "Pending review"
];

echo $request["topic"]; // PHP arrays
echo '<br>';

// Multidimensional arrays
$requests = [
    ["student" => "Amina", "course" => "IS 6465", "status" => "Pending review"],
    ["student" => "Diego", "course" => "IS 6495", "status" => "Matched"]
];

echo '<pre>';
print_r($requests);
echo '</pre>';

echo '<br>';

// Foreach loop
$courses = ["IS 6465", "IS 6495", "IS 6570"];

echo '<select name="course">';

foreach ($courses as $course) {
    echo '<option value="' . htmlspecialchars($course, ENT_QUOTES, "UTF-8") . '">';
    echo htmlspecialchars($course, ENT_QUOTES, "UTF-8") . '</option>';
}

echo '</select>';
echo '<br>';

?>
