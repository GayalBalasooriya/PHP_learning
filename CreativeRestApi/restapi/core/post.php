<?php
    class Post {
        //db stuff
        private $conn;
        private $table = 'course';

        //post properties
        public $id;
        public $title;
        public $description;
        public $deadline;

        //constructor with db connection
        public function __construct($db) {
            $this->conn = $db;
        }

        //getting posts from our database
        public function create() {
            //create qurey
            $query = 'INSERT INTO ' . $this->table . ' SET title = :title, description = :description, 
            deadline = :deadline';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->deadline = htmlspecialchars(strip_tags($this->deadline));

            //binding of parameters
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":deadline", $this->deadline);

            //execute query
            if($stmt->execute()){
                return true;
            }

            //print error if something goes wrong
            printf('Error %s. \n', $stmt->error);
            return false;
        }

        //update post function
        public function update() {
            //create qurey
            $query = 'UPDATE ' . $this->table . ' SET description = :description,
            deadline = :deadline WHERE id = :id';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            //$this->title = htmlspecialchars(strip_tags($this->title));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->deadline = htmlspecialchars(strip_tags($this->deadline));
            $this->id = htmlspecialchars(strip_tags($this->id));

            //binding of parameters
            //$stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":deadline", $this->deadline);
            $stmt->bindParam(":id", $this->id);

            //execute query
            if($stmt->execute()){
                return true;
            }

            //print error if something goes wrong
            printf('Error %s. \n', $stmt->error);
            return false;
        }
    }
?>