<?php
/**
 * One-time script: Generate bcrypt hash for staff login (site/login)
 * Run once: http://aparna-school/generate_password_hash.php
 * Then update staff table with the hash and DELETE this file.
 */
$plain_password = 'Admin@123';
$hash = password_hash($plain_password, PASSWORD_BCRYPT);

header('Content-Type: text/plain; charset=utf-8');
echo "Password: " . $plain_password . "\n";
echo "Bcrypt hash:\n" . $hash . "\n\n";
echo "SQL (replace YOUR_STAFF_EMAIL with staff email):\n";
echo "UPDATE staff SET password = '" . $hash . "' WHERE email = 'YOUR_STAFF_EMAIL';\n\n";
echo "---\nDelete this file after use: generate_password_hash.php\n";
