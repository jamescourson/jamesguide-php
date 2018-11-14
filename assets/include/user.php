<?php
    class User {
        public $id;
        public $username;
        public $password;
        public $email;
        public $avatar;
        public $title;
        public $userRank;
        public $joinDate;
        public $score;
        public $bits;

        public function User($user) {
            $this->username = $user;

            $this->update();
        }

        public function update() {
            $conn = new mysqli('localhost', 'hplaserj_James', 'Furgus', 'hplaserj_users');
            
            if (!isset($this->userID)) {
                $query = "SELECT userID FROM user_info WHERE user='$this->username'";
                $this->userID = mysqli_fetch_array(mysqli_query($conn, $query), MYSQLI_NUM)[0];
            }

            $query = "SELECT * FROM user_info WHERE userID='$this->userID'";
            $results = mysqli_fetch_array(mysqli_query($conn, $query), MYSQLI_ASSOC);

            $this->id = $results['userID'];
            $this->username = $results['user'];
            $this->password = $results['pass'];
            $this->email = $results['email'];
            $this->avatar = $results['avatar'];
            $this->title = $results['title'];
            $this->userRank = $results['userRank'];
            $this->joinDate = $results['joinDate'];
            $this->score = $results['score'];
            $this->bits = $results['bits'];

            mysqli_close($conn);
        }
    }
?>