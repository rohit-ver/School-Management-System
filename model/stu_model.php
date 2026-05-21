<?php
require_once 'config/config.php';

class Student extends Database
{

    public function insertStu($data)
    {
        $name = $data['name'];
        $email = $data['email'];
        $mobile = $data['mobile'];
        $cource = $data['cource'];
        $fees = $data['fees'];
        $address = $data['address'];

        $check = "SELECT * FROM students WHERE email = ?";
        $stmt = $this->conn->prepare($check);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo " Email Exist";
            exit();
        }

        $sql = "INSERT INTO students(name, email, mobile, cource, fees, address)VALUES(?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssis', $name, $email, $mobile, $cource, $fees, $address);

        if ($stmt->execute()) {
            // return "success";
            header('Location: students.php');
        } else {
            return "error";
        }
    }

    public function updateStudent($id, $data)
    {

        $name = $data['name'];
        $email = $data['email'];
        $mobile = $data['mobile'];
        $cource = $data['cource'];
        $fees = $data['fees'];
        $address = $data['address'];

        $checkStu = "SELECT * FROM students WHERE email = ? AND id != ?";
        $stmt = $this->conn->prepare($checkStu);
        $stmt->bind_param("ssssis", $name, $email, $mobile, $cource, $fees, $address);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return 'exists';
        }

        $updateStu = "UPDATE students SET name = ?, email = ?, mobile = ?, cource = ?, fees = ?, address = ? WHERE id = ?";
        $stmt = $this->conn->prepare($updateStu);
        $stmt->bind_param("ssssisi", $name, $email, $mobile, $cource, $fees, $address, $id);

        return $stmt->execute() ? 'updated' : 'error';
    }

    public function deleteStu($id)
    {

        $deleteStu = "DELETE FROM students WHERE id = ? ";
        $stmt = $this->conn->prepare($deleteStu);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return 'deleted';
        } else {
            return 'error';
        }
    }

    public function getStu()
    {

        $sql = "SELECT * FROM students";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
}
