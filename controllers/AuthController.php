<?php
require_once '../models/User.php';


class AuthController
{
    private $userModel;

    public function __construct($db)
    {
        $this->userModel = new User($db);
    }

    /**
     * Registrasi pengguna baru.
     * 
     * @param string $username
     * @param string $password
     * @param string $role ('dokter' atau 'pasien')
     */
    public function register($username, $password)
    {
        $role = 'pasien';
        $existingUser = $this->userModel->login($username, $password);
        if ($existingUser) {
            throw new Exception("Username sudah terdaftar.");
        }
        $this->userModel->create($username, $password, $role);
    }

    /**
     * Proses login pengguna.
     * 
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function login($username, $password)
    {
        $user = $this->userModel->login($username, $password);

        if ($user) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            return true;
        }

        return false;
    }

    /**
     * Logout pengguna.
     */
    public function logout()
    {
        unset($_SESSION['username']);
        unset($_SESSION['user_id']);
        session_destroy();
    }

    /**
     * Cek apakah pengguna sedang login.
     * 
     * @return bool
     */
    public function isAuthenticated()
    {
        return isset($_SESSION['username']);
    }

    /**
     * Dapatkan data pengguna yang sedang login.
     * 
     * @return array|null
     */
    public function getUser()
    {
        return $_SESSION['username'] ?? null;
    }

    public function getUserId() {
        return $_SESSION['user_id'] ?? null;
    }

    /**
     * Dapatkan pengguna berdasarkan ID.
     * 
     * @param int $id
     * @return array|null
     */
    public function getUserById($id)
    {
        return $this->userModel->getUserById($id);
    }

    public function getAllUsernames() {
        return $this->userModel->getAllUsernames();
    }
}
?>
