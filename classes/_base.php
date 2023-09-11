<?php

if (strpos($message, "/register") === 0 || strpos($message, "!register") === 0 || strpos($message, ".register") === 0) {
    sendaction($chatId, typing); 

    $link = mysqli_connect("containers-us-west-145.railway.app", "root", "84KWbt5bmJ9YfDEpKCu8", "railway");
    
    // استعلام SQL للبحث عن المستخدم
    $checkUserQuery = "SELECT * FROM persons WHERE userid = '$userId'";
    $result = mysqli_query($link, $checkUserQuery);

    // التحقق من وجود المستخدم
    if (mysqli_num_rows($result) > 0) {
        $resultMsg = "You Already Registered";
    } else {
        // إذا لم يتم العثور على المستخدم، قم بإجراء الإدراج
        $sql = "INSERT INTO persons (userid, role, username, credits) VALUES ('$userId', 'USER', '$username', '01')";
        if (mysqli_query($link, $sql)) {
            $resultMsg = "User Created Successfully";
        } else {
            $resultMsg = "Registration Failed";
        }
    }

    $response = urlencode("<b> $resultMsg</b>");
    reply_to($chatId, $message_id, $keyboard, $resultMsg);
}

?>
