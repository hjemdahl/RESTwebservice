<?php 
// Moment 5 - Webbutveckling III - REST-webbtjänst - Moa Hjemdahl 2019

include('includes/config.php');

//Header information and allowance
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE, PUT");

// Switch for different request methods
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);
$course = new Courses(); // New object

switch ($method) {
    case "GET":
        $response = $course->getCourses();
        if(sizeof($response)>0) { // If response is bigger than 0 = OK
            http_response_code(200);
        } else { // Else error message
            http_response_code(404);
            $response = array("message" => "No courses found.");
        }
        break;
    case "POST":
        if($course->addCourse($input['code'], $input['name'], $input['level'], $input['syllabus'])) {
            http_response_code(201); // If response is bigger than 0 = OK
            $response = array("message" => "Kursen är tillagd.");
        } else { // Else error message
            http_response_code(503);
            $response = array("message" => "Kunde inte lägga till kurs.");
        }
        break;
    case "DELETE":
        if($course->deleteCourse($input['id'])) { // If response is bigger than 0 = OK
            http_response_code(200);
            $response = array("message" => "Kursen är raderad.");
        } else { // Else error message
            http_response_code(500);
            $response = array("message" => "Kunde inte radera kurs.");
        }
        break;
    case "PUT":
        if($course->updateCourse($input['id'], $input['code'], $input['name'], $input['level'], $input['syllabus'])) {
            http_response_code(200); // If response is bigger than 0 = OK
            $response = array("message" => "Kursen är uppdaterad.");
        } else { // Else error message
            http_response_code(503);
            $response = array("message" => "Kunde inte uppdatera kurs.");
        }
        break;
}

// Write to response in JSON to console
echo json_encode($response);

