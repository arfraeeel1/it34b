<?php
    function logActivity($pdo, $userId, $email, $action, $status='success',) {
        try {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'Unknown';

            if(strpos($ip,',') !==false) {
                $ip = trim(explode(',', $ip)[0]);
            }

            // Get user agent (brower)
            $user_agent = substr($_SERVER['HTTP_USER_AGENT'] ?? 'Unknown', 0, 255);

            // Application Query #1
            $stmt = $pdo->prepare("INSERT INTO activity_logs(
            user_id,
            user_email,
            activity_log_action,
            activity_log_status,
            activity_log_ip_address,
            activity_log_user_agent
            ) VALUES (?, ?, ?, ?, ?, ?,)
            ");

        } catch (PDOException $e) {
            // Handle the exception (e.g., log it, display an error message, etc.)
            error_log("Activity Log Error: " . $e->getMessage());
            return false;
        }
    }

?>    