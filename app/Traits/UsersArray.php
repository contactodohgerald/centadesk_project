<?php
namespace App\Traits;

use App\Model\Like;
use App\Model\SavedCourses;
use App\Model\Subscribe;

trait UsersArray{

    function __construct(Subscribe $subscribe, SavedCourses $savedCourses, Like $like){
        $this->subscribe = $subscribe;
        $this->savedCourses = $savedCourses;
        $this->like = $like;
    }

    function returnArrayForSubscribeUsers($unique_id): array
    {
        $subscribe_query = [
            ['teacher_unique_id', $unique_id],
        ];
        $subscribe_users = [];
        $users_subscribe_array = $this->subscribe->getAllSubscribers($subscribe_query);
        foreach ($users_subscribe_array as $each_subscriber){
            array_push($subscribe_users, $each_subscriber->user_unique_id);
        }

        return $subscribe_users;
    }

    function returnUsersArrayForLikes($unique_id): array
    {
        $conditions = [
            ['course_unique_id', $unique_id],
            ['like_type', 'dislike']
        ];
        $dislike_array = [];
        $dislikesCount = $this->like->getAllLikes($conditions);
        foreach ($dislikesCount as $kk => $each_dislikesCount){
            array_push($dislike_array, $each_dislikesCount->user_unique_id);
        }

        $views = [
            'dislike_user_array'=>$dislike_array,
            'dislike_count'=>$dislikesCount->count()
        ];

        return $views;
    }

    function returnUserArrayForDislikes($unique_id): array
    {
        $condition = [
            ['course_unique_id', $unique_id],
            ['like_type', 'like']
        ];
        $likes_array = [];
        $likesCount = $this->like->getAllLikes($condition);
        foreach ($likesCount as $kk => $each_likesCount){
            array_push($likes_array, $each_likesCount->user_unique_id);
        }

        $views = [
            'like_user_array'=>$likes_array,
            'like_count'=>$likesCount->count(),
        ];

        return $views;
    }

    function returnArrayForUsersSavedCourse($unique_id): array
    {
        $query = [
            ['book_unique_id', $unique_id]
        ];
        $user_array_hold = [];
        $users_for_course = $this->savedCourses->getAllSaveCourse($query);
        foreach ($users_for_course as $k => $each_users_for_course){
            array_push($user_array_hold, $each_users_for_course->user_unique_id);
        }

        return $user_array_hold;
    }




}
