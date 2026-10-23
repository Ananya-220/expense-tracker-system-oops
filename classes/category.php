<?php
require_once('db.php');
require_once('user.php');
class Category
{
    private $conn;
    public function __construct()
    {
        $db = new DB;
        $this->conn = $db->getConnection();
    }

    public function displayCategories($user_id)
    {
        $sql = "SELECT * FROM category WHERE user_id = $user_id";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function addCategory($name, $status)
    {
        $user_id = $_SESSION['id'];
        $sql = "INSERT INTO category (name , user_id , status ) VALUES ('$name' , $user_id , $status)";
        $result = $this->conn->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function addCategoryValidation($name, $status)
    {
        if (empty($name)) {
            return "Name is required !";
        }

        if ($status === "") {
            return "Status is required !";
        }

        $checkName = "SELECT * FROM category WHERE name = '$name'";
        $result = $this->conn->query($checkName);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['category_id'] = $row['id'];
            return "Category already exists!";
        }

        return true;
    }

    public function displayEditCategory($id)
    {
        $sql = "SELECT * FROM category WHERE id = $id";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function editCategoryValidation($id, $name, $status)
    {
        if (empty($name)) {
            return "Name is required !";
        }

        if ($status === "") {
            return "Status is required !";
        }

        $sql = "SELECT * FROM category WHERE name='$name' AND id != $id";

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return "Category already exists!";
        }

        return true;
    }

    public function editCategory($category_id, $name, $status)
    {
        $sql = "UPDATE category SET name = '$name' , status = $status WHERE id = $category_id";
        $result = $this->conn->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteCategory ($category_id)
    {
        $sql = "DELETE FROM category WHERE id = $category_id";
        $result = $this->conn->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
