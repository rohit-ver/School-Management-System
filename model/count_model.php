    <?php
    require_once 'config/config.php';

    class Count extends Database
    {

        public function getTeacherCount()
        {
            $sql = "SELECT COUNT(*) as total FROM teachers";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_assoc()['total'];
        }

        public function getStuCount()
        {

            $sql = "SELECT COUNT(*) as total FROM students";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_assoc()['total'];
        }

        public function getTotalFee(){

        $totalFee = "SELECT SUM(fees) as total FROM students";
        $stmt = $this->conn->prepare($totalFee);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc()['total'] ?? 0 ;
        }
    }
