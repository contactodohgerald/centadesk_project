<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Push extends Model
{
    //
    // push message title
    private $title;
    private $message;
    private $image;
    // push message payload
    private $data;
    // flag indicating whether to show the push
    // notification or not
    // this flag will be useful when perform some opertation
    // in background when push is recevied
    private $is_background;

    function __construct() {

    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function setImage($imageUrl) {
        $this->image = $imageUrl;
    }

    public function setPayload($data) {
        $this->data = $data;
    }

    public function setIsBackground($is_background) {
        $this->is_background = $is_background;
    }

    public function getPush() {
        $res = array();
        $res['title'] = empty($this->title) ? null : $this->title;
        $res['is_background'] = empty($this->is_background) ? null : $this->is_background;
        $res['message'] = empty($this->message) ? null : $this->message;
        $res['image'] = empty($this->image) ? null : $this->image;
        //$res['payload'] = $this->data;
        $res['timestamp'] = date('Y-m-d G:i:s');
        return $res;
    }
}
