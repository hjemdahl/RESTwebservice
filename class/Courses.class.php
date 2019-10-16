<?php
// Moment 5 - Webbutveckling III - REST-webbtjänst - Moa Hjemdahl 2019

class Courses {
    private $db;
    private $id;
    private $code;
    private $name;
    private $level;
    private $syllabus;

    // Connect to database
    public function __construct() {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
        if ($this->db->connect_errno > 0) {
        die ("Fel vid anslutning till databas: " . $this->db->connect_error);
        }
    }

    // Get courses
    public function getCourses() {
        $sql = "SELECT id, code, name, level, syllabus FROM courses";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Add course
    public function addCourse($code, $name, $level, $syllabus) {
        //If arguments are set
        if(!$this->setCode($code)) {
            return false;
        }
        if(!$this->setName($name)) {
            return false;
        }
        if(!$this->setLevel($level)) {
            return false;
        }
        if(!$this->setSyllabus($syllabus)) {
            return false;
        }

        $sql = "INSERT INTO courses (code, name, level, syllabus) VALUES ('$code', '$name', '$level', '$syllabus')";
        $reslut = $this->db->query($sql);
        return $reslut;
    }

    // Delete course
    public function deleteCourse($id) {
        $id = intval($id);

		$sql = "DELETE FROM courses WHERE id=$id";
        $result = $this->db->query($sql);
        return $result;
    }

    // Update course
    public function updateCourse($id, $code, $name, $level, $syllabus) {
        //If arguments are set
        if(!$this->setCode($code)) {
            return false;
        }
        if(!$this->setName($name)) {
            return false;
        }
        if(!$this->setLevel($level)) {
            return false;
        }
        if(!$this->setSyllabus($syllabus)) {
            return false;
        }

        $id = intval($id);

        $sql = "UPDATE courses SET code='" . $this->code . "', name='" . $this->name . "', level='" . $this->level . "', syllabus='" . $this->syllabus . "' WHERE id=$id";
        $reslut = $this->db->query($sql);
        return $reslut;
    }

    // Set code
    public function setCode($code) {
		if($code != "") {
			$this->code = $this->db->real_escape_string(strip_tags($code));
			return true;
		} else {
			return false;
		}
    }
    
    // Set name
    public function setName($name) {
		if($name != "") {
			$this->name = $this->db->real_escape_string(strip_tags($name));
			return true;
		} else {
			return false;
        }
    }

    // Set level
    public function setLevel($level) {
		if($level != "") {
			$this->level = $this->db->real_escape_string(strip_tags($level));
			return true;
		} else {
			return false;
		}
    }

    // Set syllabus
    public function setSyllabus($syllabus) {
		if($syllabus != "") {
			$this->syllabus = $this->db->real_escape_string(strip_tags($syllabus));
			return true;
		} else {
			return false;
        }
    }
}