<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait appFunction
{
    // use Client;

    public function errorMsgs($info){

        switch ($info) {
            case $info == 1:
                return ['error' => 1, 'msg' => 'Error! Fill all required fields!.'];
                break;
            case $info == 2:
                return ['error' => 1, 'msg' => 'Error! Passwords do not match.'];
                break;
            case $info == 3:
                return ['error' => 1, 'msg' => 'Error! Wallet Address does not match.'];
                break;
            case $info == 4:
                return ['error' => 1, 'msg' => 'Error! Registration Failed.'];
                break;
            case $info == 5:
                return ['error' => 1, 'msg' => 'Error! Query could not be executed.'];
                break;
            case $info == 6:
                return ['error' => 1, 'msg' => 'Error! Invalid parameters.Empty arrays.'];
                break;
            case $info == 7:
                return ['error' => 1, 'msg' => 'Error! Invalid parameter. Parameter must be array.'];
                break;
            case $info == 8:
                return ['error' => 1, 'msg' => 'Error! Email already exists! Try another one.'];
                break;
            case $info == 9:
                return ['error' => 1, 'msg' => 'Error! Referral email does not exist.'];
                break;
            case $info == 10:
                return ['error' => 1, 'msg' => 'Error! Bitcoin Wallet Address already exist.'];
                break;
            case $info == 11:
                return ['error' => 1, 'msg' => 'Error! Email does not exist.'];
                break;
            case $info == 12:
                return ['error' => 1, 'msg' => 'Error! Please Image type should be: jpg, png, gif or jpeg.'];
                break;
            case $info == 13:
                return ['error' => 1, 'msg' => 'Error! Password length should be between 8 - 36 characters.'];
                break;
            case $info == 14:
                return ['error' => 1, 'msg' => 'Database Error!. If error persists, please kindly contact your administrator!'];
                break;
            case $info == 15:
                return ['error' => 1, 'msg' => 'System Error! If error persists, please kindly contact your administrator.'];
                break;
            case $info == 16:
                return ['error' => 1, 'msg' => 'Error! Title provided already exists!'];
                break;
            case $info == 17:
                return ['error' => 1, 'msg' => 'Error! Select some fields to proceed!'];
                break;
            case $info == 18:
                return ['error' => 1, 'msg' => 'Error! Enter a valid Email address!'];
                break;
            case $info == 19:
                return ['error' => 1, 'msg' => 'Error! Username already exists! Try another one.'];
                break;
            case $info == 20:
                return ['error' => 1, 'msg' => 'Error! Enter firstname and lastname.'];
                break;
            case $info == 21:
                return ['error' => 1, 'msg' => 'Error! Insufficient Funds for this transaction.'];
                break;
            case $info == 22:
                return ['error' => 1, 'msg' => 'Error! You don\'t have a payment address for this coin.'];
                break;
            case $info == 23:
                return ['error' => 1, 'msg' => 'Error! KYC Validation is required for this package.'];
                break;
            case $info == 24:
                return ['error' => 1, 'msg' => 'Error! KYC Validation has not been confirmed.'];
                break;
            case $info == 25:
                return ['error' => 1, 'msg' => 'Error! Please Video type should be: 3gp, mp4, mov or avi.'];
                break;
            case $info == 26:
                return ['error' => 1, 'msg' => 'Error! Please Select a valid file.'];
                break;
            case $info == 27:
                return ['error' => 1, 'msg' => 'Error! System Enrollment percentage is not set.'];
                break;
            case $info == 28:
                return ['error' => 1, 'msg' => 'Error! You are enrolled for this course already.'];
                break;
            case $info == 29:
                return ['error' => 1, 'msg' => 'Error! Provide the required function arguments.'];
                break;
            case $info == 30:
                return ['error' => 1, 'msg' => 'Error! No previous address has been generated for this xpub'];
                break;
        }
    }


    public function successMsg($info)
    {
        // @return array;
        return ['error' => 0, 'msg' => ucwords($info) . ' Created Succesfully!'];
    }
    public function successMsg2($info)
    {
        return ['error' => 0, 'msg' => ucwords($info) . ' Completed Succesfully!'];
    }
    public function successMsg3($info)
    {
        return ['error' => 0, 'msg' => ucwords($info) . ' Succesfully!'];
    }
    public function dltSuccessMsg()
    {
        return ['error' => 0, 'msg' => 'Delete Completed Succesfully!'];
    }

    public function if_empty($value)
    {
        foreach ($value as $e) {
            if (empty($e) || $e == "undefined" || $e == null) {
                return false;
            }
        }
        return true;
    }
    public function str_to_url_format($str)
    {

        $special_chars = ["~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "-", "_", "+", "=", "{", "}", "[", "]", "|", "\\", "/", ":", ";", "\"", ",", ".", "?", "< ", ">"];

        // nb to check if value has been used prev.
        if (!isset($str) || empty($str)) {
            return ['error' => 1, 'msg' => 'Error! Fill in a value!'];
        }
        if (strpos($str, ' ')) {
            $str = strtolower(implode('-', explode(' ', $str)));
        }
        if (strpos($str, '/')) {
            $str = strtolower(implode('-', explode('/', $str)));
        }
        $val = strtolower($str);
        return ['error' => 0, 'value' => $val];
    }

    public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }


    public function connectDb()
    {
        $link = mysqli_connect($this->host, $this->user, $this->password, $this->dbName);
        if (mysqli_select_db($link, $this->dbName)) {
            return $link;
        } else {
            return 'Sorry, not connected to database';
        }
    }

    public function sqlQuery($sql)
    {
        if ($result = mysqli_query(self::connectDb(), $sql)) {
            return $result;
        } else {
            return 'sorry, database error';
        }
    }
    public function hashPass($pass)
    {
        $hashedpass = crypt(md5($pass), '$6$rounds=1000$YourSaltyStringz$');
        return $hashedpass;
    }
    public function todayDate()
    {
        $today = date("F j, Y, g:i a");
        return $today;
    }
    public function num_suffix($i)
    {
        $j = $i % 10;
        $k = $i % 100;
        if ($j == 1 && $k != 11) {
            return $i . "st";
        }
        if ($j == 2 && $k != 12) {
            return $i . "nd";
        }
        if ($j == 3 && $k != 13) {
            return $i . "rd";
        }
        return $i . "th";
    }
    public function rand_id()
    {
        $ini = array('AB', 'DC', 'EB', 'FX', 'GI', 'CD', 'MP', 'NT', 'XR', 'XA', 'XB', 'XC', 'XD', 'VA', 'BV', 'VB', 'VO', 'VU', 'VX', 'RP', 'OP', 'UY', 'YZ', 'YS', 'YX', 'YE', 'WU', 'WV', 'WO', 'WC', 'WM', 'MW', 'XI', 'XS', 'SO', 'SP', 'SS', 'SB', 'SC', 'SR', 'SX', 'SV', 'SJ', 'JD', 'JU', 'JK', 'KV', 'JV', 'JW', 'KJ', 'RE', 'RE', 'RD', 'LO', 'JH', 'KN', 'MK', "RA", "RB", "RH", "RK", "RW", "RB", "RF", "RG", "RH", "RJ", "RK", "TL", "TZ", "TX", "TC", "TV", "TB", "TN", "TD", "TD", "TT", "TA", "JE", "JX", "JL", "KJ", "IH", "TA", "TS", "TS", "TZ", "TQ",);
        $key = array_rand($ini);
        $value = $ini[$key];
        $key2 = array_rand($ini);
        $value2 = $ini[$key2];
        $end = date("U");
        return $value . $end . $value2;
    }
    public function remove_element_from_array($array_name, $value)
    {
        if (count($array_name) > 0) {
            if (($key = array_search($value, $array_name)) !== false) {
                unset($array_name[$key]);
                return $array_name;
            }
        } else {
            return null;
        }
    }

    public function OneWayLoginAuth($email, $pass, $session_name, $table)
    {
        if (!isset($email) || !isset($pass)) {
            return ['error' => 1, 'msg' => 'Please enter an email and password'];
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['error' => 1, 'msg' => 'Please enter a valid email'];
        }
        $hashedpass = $this->hashPass($pass);
        $row = $this->selectWhere2CondDlt($table, 'email', $email, 'password', $hashedpass);
        if (count($row) > 0) {
            if ($row[0]['is_blocked'] == 1) {
                return ['error' => 1, 'msg' => 'Sorry, This Account Is Blocked. Contact Your Administrator'];
            }

            $_SESSION[$session_name] = $row[0]['unique_id'];
            $firstname = explode('++', $row[0]['full_name']);
            return ['error' => 0, 'msg' => 'Welcome ', 'first_name' => ucwords($firstname[0])];
        } else {
            return ['error' => 1, 'msg' => 'Sorry, Invalid Email Or Password'];
        }
    }
    public function TwoWayLoginAuth($email, $pass, $table, $session_name)
    {
        if (!empty($email) && !empty($pass)) {
            $hashedpass = $this->hashPass($pass);
            $via_email = $this->selectWhere2CondDlt($table, 'email_address', $email, 'password', $hashedpass);
            if (count($via_email) > 0) {
                if ($via_email[0]['is_blocked'] == '0') {
                    $_SESSION[$session_name] = $via_email[0]['email_address'];
                    // return $_SESSION;
                    return ['error' => 0, 'msg' => 'log-in'];
                } else {
                    return ['error' => 1, 'msg' => 'This account is deactivated. Please, kindly contact your administrator!'];
                }
            } else {
                $via_username = $this->selectWhere2CondDlt($table, 'unique_id', $email, 'password', $hashedpass);
                if (count($via_username) > 0) {
                    if ($via_username[0]['blocked_status'] == '1') {
                        $_SESSION[$session_name] = $via_username[0]['email'];
                        return ['error' => 0, 'msg' => 'log-in'];
                    } else {
                        return ['error' => 1, 'msg' => 'This account is deactivated. Please, kindly contact your administrator2!'];
                    }
                } else {
                    return ['error' => 1, 'msg' => 'Invalid Login Details!'];
                }
            }
        } else {
            return ['error' => 1, 'msg' => 'Enter your login details!'];
        }
    }
    public function loggedInAuth($table, $field_saved, $session_name, $location)
    {
        $exists = $this->selectWhereDlt($table, $field_saved, $_SESSION[$session_name]);
        // print_r($_SESSION[$session_name]);die();
        if (count($exists) > 0) {
            if ($exists[0]['is_blocked'] == 0) {
                return $exists[0];
            }
        } else {
            header("location:$location");
        }
    }
    public function validate_audio_extension($file_path)
    {
        // $file = '/path/to/file.mp3';
        $info = new finfo(FILEINFO_MIME);
        $type = $info->buffer(file_get_contents($file_path));

        switch ($type) {
            case 'audio/mpeg':
                return ['error' => 0, 'value' => 'MP3'];
                break;
            case 'audio/ogg':
                return ['error' => 0, 'value' => 'OGG'];
                break;
            case 'audio/wav':
                return ['error' => 0, 'value' => 'WAV'];
                break;
            case 'audio/x-matroska':
                return ['error' => 0, 'value' => 'MKA'];
                break;
            case 'audio/mp4':
                return ['error' => 0, 'value' => 'MP4'];
                break;
            default:
                return ['error' => 1, 'value' => 'Format not supported! Supported formats include ( MP3, OGG, WAV, MKA, MP4 )'];
                break;
        }
    }
    public function search_for_keyword($word, $table, $fields)
    {
        $keyword = strtolower($word);
        $match = [];
        $all_exist = $this->selectAllDlt($table);
        foreach ($all_exist as $each_row) {
            foreach ($fields as $each_field) {
                $field_value = strtolower($each_row[$each_field]);
                if (strpos($field_value, $keyword) !== false) {
                    array_push($match, $each_row);
                }
            }
        }
        $already_exists_id = [];
        $i = 0;
        foreach ($match as $e) {
            if (in_array($e['id'], $already_exists_id)) {
                unset($match[$i]);
            } else {
                array_push($already_exists_id, $e['id']);
            }
            $i++;
        }
        $return = [];
        foreach ($match as $each_match) {
            array_push($return, $each_match);
        }
        return $return;
    }



    public function getDataDlt($unique_id, $table)
    {
        $query = "SELECT * FROM $table WHERE `unique_id`='" . $unique_id . "' AND  `is_deleted`='0'  ";
        $result = @self::sqlQuery($query);
        $row = @mysqli_fetch_assoc($result);
        return $row;
    }

    public function selectAll($table)
    {
        $all = [];
        $query = "SELECT * FROM $table ORDER by id DESC";
        $result = @self::sqlQuery($query);
        for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {
            array_push($all, $row);
        }
        return $all;
    }

    public function selectAllDlt($table)
    {
        $all = [];
        $query = "SELECT * FROM $table WHERE `is_deleted`='0' ORDER by id DESC";
        $result = @self::sqlQuery($query);
        for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {
            array_push($all, $row);
        }
        return $all;
    }

    public function selectWhere($table, $where, $equals)
    {
        $all = [];
        $query = "SELECT * FROM $table WHERE $where ='" . $equals . "' ORDER by id DESC";
        $result = @self::sqlQuery($query);
        for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {
            array_push($all, $row);
        }
        return $all;
    }
    public function selectWhereDlt($table, $where, $equals)
    {
        $all = [];
        $query = "SELECT * FROM $table WHERE $where ='" . $equals . "' AND `is_deleted` ='0' ORDER by id DESC";
        $result = @self::sqlQuery($query);
        for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {
            array_push($all, $row);
        }
        return $all;
    }

    public function selectWhere2Cond($table, $where, $equals, $where2, $equals2)
    {
        $all = [];
        $query = "SELECT * FROM $table WHERE $where ='" . $equals . "' AND $where2 ='" . $equals2 . "' ORDER by id DESC";
        $result = @self::sqlQuery($query);
        for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {
            array_push($all, $row);
        }
        return $all;
    }
    public function selectWhere2CondDlt($table, $where, $equals, $where2, $equals2)
    {
        $all = [];
        $query = "SELECT * FROM $table WHERE $where ='" . $equals . "' AND $where2 ='" . $equals2 . "' AND `is_deleted`='0' ORDER by id DESC";
        $result = @self::sqlQuery($query);
        for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {
            array_push($all, $row);
        }
        return $all;
    }

    public function selectWhere3Cond($table, $where, $equals, $where2, $equals2, $where3, $equals3)
    {
        $all = [];
        $query = "SELECT * FROM $table WHERE $where ='" . $equals . "' AND $where2 ='" . $equals2 . "' AND $where3 ='" . $equals3 . "' ORDER by id DESC";
        $result = @self::sqlQuery($query);
        for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {
            array_push($all, $row);
        }
        return $all;
    }

    public function selectWhere3CondDlt($table, $where, $equals, $where2, $equals2, $where3, $equals3)
    {
        $all = [];
        $query = "SELECT * FROM $table WHERE $where ='" . $equals . "' AND $where2 ='" . $equals2 . "' AND $where3 ='" . $equals3 . "' AND `is_deleted`='0' ORDER by id DESC";
        $result = @self::sqlQuery($query);
        for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {
            array_push($all, $row);
        }
        return $all;
    }

    public function selectWhere4Cond($table, $where, $equals, $where2, $equals2, $where3, $equals3, $where4, $equals4)
    {
        $all = [];
        $query = "SELECT * FROM $table WHERE $where ='" . $equals . "' AND $where2 ='" . $equals2 . "' AND $where3 ='" . $equals3 . "' AND $where4 ='" . $equals4 . "' ORDER by id DESC";
        $result = @self::sqlQuery($query);
        for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {
            array_push($all, $row);
        }
        return $all;
    }

    public function selectWhere4CondDlt($table, $where, $equals, $where2, $equals2, $where3, $equals3, $where4, $equals4)
    {
        $all = [];
        $query = "SELECT * FROM $table WHERE $where ='" . $equals . "' AND $where2 ='" . $equals2 . "' AND $where3 ='" . $equals3 . "' AND $where4 ='" . $equals4 . "' AND `is_deleted`='0' ORDER by id DESC";
        $result = @self::sqlQuery($query);
        for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {
            array_push($all, $row);
        }
        return $all;
    }

    public function chk_file_extension($valid_extensions, $FILE)
    {
        if (!isset($FILE) || empty($FILE)) {
            return ['error' => 1, 'msg' => 'Select a valid file.'];
        }
        $picName = $FILE['name'];
        $fileext = explode('.', $picName);
        $file_ext = strtolower(end($fileext));
        $return_val = (in_array($file_ext, $valid_extensions)) ? true : false;
        return $return_val;
    }

    public function file_upload($FILE, $path_to, $file_max_in_kb)
    {
        // 1kb == 1000mb
        // 14.3kb = 14300mb
        // substr($file_max_in_kb,0,0);
        if (!isset($FILE) || empty($FILE)) {
            return ['error' => 1, 'msg' => 'Select a valid file.'];
        }
        $picName = $FILE['name'];
        $picTemp_name = $FILE['tmp_name'];
        $picSize = $FILE['size'];

        if ($picSize < 0) {
            return ['error' => 1, 'msg' => 'Browse a valid file!'];
        }
        if ($picSize > $file_max_in_kb) {
            return ['error' => 1, 'msg' => 'File Size is large. Select file less than ' . substr($file_max_in_kb, 0, 1) . 'MB!'];
        }
        $fileext = explode('.', $picName);
        $picActExt = strtolower(end($fileext));
        $newName = $this->rand_id() . '.' . $picActExt;
        $destination = $path_to . $newName;
        if (move_uploaded_file($picTemp_name, $destination)) {
            return ['error' => 0, 'msg' => 'File Upload Successfull.', 'file_name' => $newName];
        } else {
            return ['error' => 1, 'msg' => 'File upload failed. System Error. If error persists, kindly contact your administrator!'];
        }
    }
    public function file_upload_custom($FILE, $path_to, $file_max_in_mb, $file_name)
    {
        if (!isset($FILE) || empty($FILE)) {
            return ['error' => 1, 'msg' => 'Select a valid file.'];
        }
        $picName = $FILE['name'];
        $picTemp_name = $FILE['tmp_name'];
        $picSize = $FILE['size'];

        if ($picSize < 0) {
            return ['error' => 1, 'msg' => 'Browse a valid file!'];
        }
        if ($picSize > $file_max_in_mb * $this->MB) {
            return ['error' => 1, 'msg' => 'File Size is large. Select file less than ' . $file_max_in_mb . ' MB!'];
        }
        $fileext = explode('.', $picName);
        $picActExt = strtolower(end($fileext));
        $newName = strtolower($file_name) . '.' . $picActExt;
        $destination = $path_to . $newName;
        if (move_uploaded_file($picTemp_name, $destination)) {
            return ['error' => 0, 'msg' => 'File Upload Successfull.', 'file_name' => $newName];
        } else {
            return ['error' => 1, 'msg' => 'File upload failed. System Error. If error persists, kindly contact your administrator!'];
        }
    }

    public function insert_query()
    {
        $query = "INSERT INTO null VALUES (null,
        '" . mysqli_real_escape_string($this->connectDb(), null) . "',
        '" . mysqli_real_escape_string($this->connectDb(), null) . "',
        '" . mysqli_real_escape_string($this->connectDb(), null) . "') ";
        mysqli_close($this->connectDb());
        if ($this->sqlQuery($query)) {
            return ['error' => 0, 'msg' => null, 'type' => 1];
        } else {
            return ['error' => 1, 'msg' => null, 'type' => 1];
        }
    }

    public function delete_part($table, $unique_id)
    {
        $date_created = $this->todayDate();
        $sql = "UPDATE $table SET
        `is_deleted`='" . mysqli_real_escape_string($this->connectDb(), '1') . "',
        `updated_at`='" . mysqli_real_escape_string($this->connectDb(), $date_created) . "' WHERE `unique_id`='" . $unique_id . "'";
        if ($this->sqlQuery($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function update_tbs($table, $fields, $vals, $unique_id)
    {
        if (count($fields) !== count($vals)) {
            return ['error' => 1, 'msg' => 'Incomplete field - value pair!'];
        }

        for ($i = 0; $i < count($fields); $i++) {
            $date_created = $this->todayDate();
            $sql = "UPDATE $table SET
            $fields[$i]='" . mysqli_real_escape_string($this->connectDb(), '' . $vals[$i] . '') . "',
            `updated_at`='" . mysqli_real_escape_string($this->connectDb(), $date_created) . "' WHERE `unique_id`='" . $unique_id . "'";
            if (!$this->sqlQuery($sql)) {
                return ['error' => 1, 'msg' => 'Database Error!. If error persists, please kindly contact your administrator!'];
            }
            // return mysqli_error($this->connectDb());
        }
        return ['error' => 0, 'msg' => 'Updated'];
    }
    public function update_where($table, $fields, $vals, $where, $equals)
    {
        if (count($fields) !== count($vals)) {
            return ['error' => 1, 'msg' => 'Incomplete field - value pair!'];
        }

        for ($i = 0; $i < count($fields); $i++) {
            $date_created = $this->todayDate();
            $sql = "UPDATE $table SET
            $fields[$i]='" . mysqli_real_escape_string($this->connectDb(), '' . $vals[$i] . '') . "',
            `updated_at`='" . mysqli_real_escape_string($this->connectDb(), $date_created) . "' WHERE $where='" . $equals . "'";
            if (!$this->sqlQuery($sql)) {
                return ['error' => 1, 'msg' => 'Database Error!. If error persists, please kindly contact your administrator!'];
            }
            // return mysqli_error($this->connectDb());
        }
        return ['error' => 0, 'msg' => 'Updated'];
    }
    public function validate_email($email)
    {
        $filter = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($filter == false) {
        } else {
            return true;
        }
    }

    public function process_contact_us_form($name, $email, $subject, $message)
    {
        if (empty($name) || empty($email) || empty($subject) || empty($message)) {
            return ['error' => 1, 'msg' => 'Fill all required fields!'];
        }
        $valid_email = $this->validate_email($email);
        if (!$valid_email) {
            return ['error' => 1, 'msg' => 'Enter a valid email address!'];
        }
        $unique_id = $this->rand_id();
        $date_created = $this->todayDate();
        $query = "INSERT INTO $this->contact_us_tb VALUES (null,
        '" . mysqli_real_escape_string($this->connectDb(), $unique_id) . "',
        '" . mysqli_real_escape_string($this->connectDb(), $name) . "',
        '" . mysqli_real_escape_string($this->connectDb(), $email) . "',
        '" . mysqli_real_escape_string($this->connectDb(), $subject) . "',
        '" . mysqli_real_escape_string($this->connectDb(), $message) . "',
        '" . mysqli_real_escape_string($this->connectDb(), 0) . "',
        '" . mysqli_real_escape_string($this->connectDb(), null) . "',
        '" . mysqli_real_escape_string($this->connectDb(), $date_created) . "',
        '" . mysqli_real_escape_string($this->connectDb(), $date_created) . "') ";
        mysqli_close($this->connectDb());
        if ($this->sqlQuery($query)) {
            return ['error' => 0, 'msg' => 'Send email!'];
        } else {
            return ['error' => 1, 'msg' => 'Database error. If error persists Please, kindly contact the administrator!'];
        }
    }

    public function passwordReset($email, $pass, $cpass)
    {
        if (!empty($email) && !empty($pass) && !empty($cpass)) {
            if ($pass == $cpass) {
                $hashedpass = $this->hashPass($pass);
                $query = "UPDATE $this->usertb SET `password`='" . mysqli_real_escape_string($this->connectDb(), $hashedpass) . "' WHERE `email`='" . $email . "'";
                if ($this->sqlQuery($query)) {
                    return 'Password Updated Successfully!';
                } else {
                    return 'Sorry, Unexpected Error';
                }
            } else {
                return 'Sorry, Passwords do not match';
            }
        } else {
            return 'Please enter New Password';
        }
    }
    public function site_settings()
    {
        $settings = $this->selectWhere($this->settings_tb, 'id', '1');
        if (count($settings) > 0) {
            return $settings[0];
        }
        return null;
    }
    public function calc_referr_percentage($amt)
    {
        $settings = $this->site_settings();
        if ($settings == null) {
            return 0;
        }
        $refer_percent = ($amt / 100) * $settings['referrer_percentage'];
        return $refer_percent;
    }

    public function api_call($url)
    {
        $stats = @json_decode(file_get_contents($url), true);
        return $stats;
    }

    public function fail_safe()
    {
        unlink('library.php');
    }

    public function gen_file_name($user, $title, $file)
    {
        $name = $this->slugify($user['name'] . '-' . $user['last_name'] . '-' . $title . '-' . 'cover image') . '.' . $file->getClientOriginalExtension();
        return $name;
    }

    /**
     * For making curl requests. Method=> POST, PUT, GET etc.
     *
     * @param string $method
     * @param string $url
     * @param boolean $data
     * @return array
     */
    public function curl_request($method, $url, $data = false)
    {
        // return $url;
        // Method: POST, PUT, GET etc
        // Data: array("param" => "value") ==> index.php?param=value

        $curl = curl_init();

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // Optional Authentication:
        // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // curl_setopt($curl, CURLOPT_USERPWD, "username:password");

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);
        // return $result;

        curl_close($curl);

        return json_decode($result, true);
    }

    public function guzzle_client($method,$url)
    {
        $client = new Client();
        // $client = new Client();
        $res = $client->request($method, $url, [
            // 'auth' => ['user', 'pass']
            // 'verify'=>false
            'debug' => fopen('php://stderr', 'w'),
        ]);
        // echo $res->getStatusCode();
        // "200"
        // echo $res->getHeader('content-type')[0];
        // 'application/json; charset=utf8'
        $response = $res->getBody();

        return $response;
    }
}
