    <?php
    require_once 'config/config.php';
    class Teacher extends Database
    {
        public function insertTeacher($data)
        {
            $name = $data['name'];
            $email = $data['email'];
            $mobile = $data['mobile'];
            $subject = $data['subject'];
            $experience = $data['experience'];
            $salary = $data['salary'];
            $joining_date = $data['joining_date'];

            // 🔹 Check email
            $checkteacher = "SELECT * FROM teachers WHERE email = ?";
            $stmt = $this->conn->prepare($checkteacher);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return 'exists';
            }

            // 🔹 Insert
            $sql = "INSERT INTO teachers(name, email, mobile, subject, experience, salary, joining_date) VALUES (?,?,?,?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssids", $name, $email, $mobile, $subject, $experience, $salary, $joining_date);

            if ($stmt->execute()) {
                return 'success';
            } else {
                return 'error';
            }
        }

        public function updateTeacher($id, $data)
        {
            $name = $data['name'];
            $email = $data['email'];
            $mobile = $data['mobile'];
            $subject = $data['subject'];
            $experience = $data['experience'];
            $salary = $data['salary'];
            $joining_date = $data['joining_date'];

            // 🔹 Email check (exclude current id)
            $checkteacher = "SELECT * FROM teachers WHERE email = ? AND id != ?";
            $stmt = $this->conn->prepare($checkteacher);
            $stmt->bind_param("si", $email, $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return 'exists';
            }

            // 🔹 Update
            $sql = "UPDATE teachers SET name=?, email=?, mobile=?, subject=?, experience=?, salary=?, joining_date=? WHERE id=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssidsi", $name, $email, $mobile, $subject, $experience, $salary, $joining_date, $id);

            return $stmt->execute() ? 'updated' : 'error';
        }

        public function deleteTeacher($id)
        {

            $deleteTeacher = "DELETE FROM teachers WHERE id = ?";
            $stmt = $this->conn->prepare($deleteTeacher);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                return 'deleted';
            } else {
                return 'error';
            }
        }

        public function getTeacher()
        {

            $getTeach = "SELECT * FROM teachers";
            $stmt = $this->conn->prepare($getTeach);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_all(MYSQLI_ASSOC);
            } else {
                return [];
            }
        }
    }
