<?php
class User extends Model {
    private $userid;
    private $password;
    private $name;
    private $email;
    private $wewenang;
    private $last_login;
    private $last_modify;
    private $created;
    private $status;
    private $user;
    private $users = [];

    function __construct($userid = null) {
        $classname = DB_ENGINE;
        $this->_db = new $classname;
        $this->tbname = 'users';
        $this->_db->setTable('users');
        if ($userid) {
            $result = $this->_db->exec('SELECT * FROM ' . $this->tbname . ' WHERE userid ="' . $userid . '"');
            $user = $result[0];
            $this->userid = $user->userid;
            $this->password = $user->password;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->wewenang = $user->wewenang;
            $this->last_login = $user->last_login;
            $this->last_modify = $user->modified;
            $this->created = $user->created;
            $this->status = $user->status;

            $this->user = (Object) [
                'userid' => $this->userid,
                'name' => $this->name,
                'email' => $this->email,
                'status' => $this->status,
            ];
        }
    }

    public function getuserid() {return $this->userid;}
    public function getpassword() {return $this->password;}
    public function getname() {return $this->name;}
    public function getemail() {return $this->email;}
    public function getwewenang() {
        $result = $this->_db->Exec("select * from user_group where idgroup = $this->wewenang");
        return $result[0];
    }
    public function getwewenangs() {
        return $result = $this->_db->Exec("select * from user_group");
    }
    public function getlast_login() {return $this->last_login;}
    public function getlast_modify() {return $this->last_modify;}
    public function getcreated() {return $this->created;}
    public function getstatus() {return $this->status;}

    public function getUser($userid) {
        return new User($userid);
    }
    public function getDepartemen($userid) {
        $result = $this->_db->Exec("select departemen.* from departemen inner join user_departemen on departemen.iddepartemen = user_departemen.iddepartemen where userid = '$userid'");
        if (empty($result)) {
            return;
        }
        return $result[0];
    }
    public function getUsers($condition = []) {
        $return = $this->_db->Exec('SELECT * FROM users');
        foreach ($return as $user) {
            $this->users[] = new self($user->userid);
        }
        return $this->users;
    }

    public function addUser($values = []) {
        return $this->_db->create($values);

    }

    public function editUser($userid, $values = []) {
        return $this->_db->update($values, $userid, 'userid');
    }

    public function removeUser($userid) {

    }

    public function getCredential($userid, $password) {

    }

}
