<?php
/**
 * ONE-TIME: Set staff password to Admin@123 for site/login
 * Open: http://aparna-school/setstaffpassword
 * After login works, DELETE this file: application/controllers/Setstaffpassword.php
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Setstaffpassword extends CI_Controller {

    public function index()
    {
        $this->load->database();
        $this->load->library('Enc_lib');
        $password_plain = 'Admin@123';
        $hash = $this->enc_lib->passHashEnc($password_plain);
        echo $hash;
        exit();
        // Update staff id=1 (first/admin staff). Change id if needed.
        $this->db->where('id', 1);
        $this->db->update('staff', array(
            'password' => $hash,
            'is_active' => 1
        ));

        $affected = $this->db->affected_rows();
        $this->db->select('id, name, email');
        $row = $this->db->get_where('staff', array('id' => 1))->row();

        header('Content-Type: text/html; charset=utf-8');
        echo '<!DOCTYPE html><html><head><meta charset="utf-8"><title>Set Password</title></head><body style="font-family:sans-serif;padding:20px;">';
        if ($affected >= 0 && $row) {
            echo '<h2>Password set successfully</h2>';
            echo '<p><strong>Login URL:</strong> <a href="' . base_url() . 'site/login">' . base_url() . 'site/login</a></p>';
            echo '<p><strong>Username (enter this in "username" field):</strong> <code>' . htmlspecialchars($row->email) . '</code></p>';
            echo '<p><strong>Password:</strong> <code>Admin@123</code></p>';
            echo '<p style="color:red;"><strong>Important:</strong> Delete file <code>application/controllers/Setstaffpassword.php</code> after login.</p>';
        } else {
            echo '<p>No staff with id=1 found. Run in phpMyAdmin:</p>';
            echo '<pre>UPDATE staff SET password = \'' . $hash . '\', is_active = 1 WHERE id = 1;</pre>';
            echo '<p>Then login with that staff\'s <strong>email</strong> as username and <strong>Admin@123</strong> as password.</p>';
        }
        echo '</body></html>';
    }
}
