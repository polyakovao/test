<?php
require_once 'connection.php';

class Users extends Connection
{
    public function loadUsers()
    {
        $dbh = $this->setConnection();

        $stmt = $dbh->query("SELECT id, firstname, lastname, position FROM users")->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($stmt);
    }

    public function deleteUser($id)
    {
        $dbh = $this->setConnection();

        $stmt = $dbh->query("DELETE FROM users WHERE id = ".$id);
    }

    public function editUser($data)
    {
        $dbh = $this->setConnection();

        $sql = sprintf("UPDATE users 
                SET firstname = '%s', 
                    lastname = '%s', 
                    position = '%s'
                WHERE id = '%d';",
            $data['firstName'],
            $data['lastName'],
            $data['position'],
            $data['editUserId']
        );

        $stmt = $dbh->query($sql);
    }

    public function createUser($data)
    {
        $dbh = $this->setConnection();

        $sql = sprintf("INSERT INTO users (firstname, lastname, position)
            VALUES ('%s', '%s', '%s')",
            $data['firstName'],
            $data['lastName'],
            $data['position']
        );

        $stmt = $dbh->query($sql);
    }
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $users = new Users();

    if ($action === 'load') {
        echo $users->loadUsers();
    } elseif ($action === 'delete') {
        $id = $_GET['id'];
        $users->deleteUser($id);
    } elseif ($action === 'edit') {
        $users->editUser($data);
    } elseif ($action === 'create') {
        $users->createUser($data);
    }
}