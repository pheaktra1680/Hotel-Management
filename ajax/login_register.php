<?php
    require('../admin/inc/db_config.php');
    require('../admin/inc/essentials.php');

    if(isset($_POST['register']))
    {
        $data = filteration($_POST);

        //match password and confirm password field

        if($data['pass'] != $data['cpass']){
            echo 'pass_missmatch!';
            exit;
        }

        //check user exists or not
        $u_exist = select("SELECT * FROM `user_cred` WHERE `email` =? AND `phonenum` =? LIMIT 1",
        [$data['email'], $data['phonenum']],'ss');

        if(mysqli_num_rows($u_exist)!=0){
            $u_exist_fetch = mysqli_fetch_assoc($u_exist);
            echo ($u_exist_fetch['email']==$data['email']) ? 'email_already!' : 'phone_already!';
            exit;
        }

        //upload user image to server
        $img = uploadUserImage($_FILES['profile']);

        if($img == 'inv_img'){
            echo 'inv_img';
            exit;
        }else if($img == 'upd_failed'){
            echo 'upd_failed';
            exit;
        }

        //send confirmation link to user's email
        
    }

?>