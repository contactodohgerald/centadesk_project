<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //
    function __construct(User $user)
    {
        $this->middleware('auth');
        $this->user = $user;
    }

    public function showAllStudents()
    {

        $condition = [
            ['is_blocked', 'no'],
            ['user_type', 'student'],
        ];
        $all_students = $this->user->getAllUsers($condition);

        $condition = [
            ['is_blocked', 'no'],
            ['user_type', 'student'],
            ['status', 'active'],
        ];
        $active_students = $this->user->getAllUsers($condition);

        $condition = [
            ['is_blocked', 'no'],
            ['user_type', 'student'],
            ['status', 'in-active'],
        ];
        $inactive_students = $this->user->getAllUsers($condition);

        $data = ['all_students' => $all_students, 'active_students' => $active_students, 'inactive_students' => $inactive_students];

        return view('dashboard.all_students', $data);
    }

    public function showAllInstructor()
    {

        $condition = [
            ['is_blocked', 'no'],
            ['user_type', 'teacher'],
        ];
        $all_teacher = $this->user->getAllUsers($condition);

        $condition = [
            ['is_blocked', 'no'],
            ['user_type', 'teacher'],
            ['status', 'active'],
        ];
        $active_teacher = $this->user->getAllUsers($condition);

        $condition = [
            ['is_blocked', 'no'],
            ['user_type', 'teacher'],
            ['status', 'in-active'],
        ];
        $inactive_teacher = $this->user->getAllUsers($condition);

        $data = [
            'all_teacher' => $all_teacher,
            'active_teacher' => $active_teacher,
            'inactive_teacher' => $inactive_teacher
        ];

        return view('dashboard.all_instructors', $data);
    }

    /**
     * Function to show all users.
     *
     * @return array
     */
    public function show_all_users()
    {

        $all =  User::orderBy('id', 'desc')->paginate(5);
        // $all = $this->user->getAllUsers([]);
        $condition = [
            ['user_type', 'teacher']
        ];
        $teacher =  User::where($condition)->orderBy('id', 'desc')->paginate(5);
        // $teacher = $this->user->getAllUsers($condition);
        $condition2 = [
            ['user_type', 'student']
        ];
        $student =  User::where($condition2)->orderBy('id', 'desc')->paginate(5);
        // $student = $this->user->getAllUsers($condition);
        $condition3 = [
            ['user_type', 'super_admin']
        ];
        $admin =  User::where($condition3)->orderBy('id', 'desc')->paginate(5);
        // $admin = $this->user->getAllUsers($condition);

        $view = [
            'all' => $all,
            'teacher' => $teacher,
            'student' => $student,
            'admin' => $admin,
        ];

        return view('dashboard.all_users', $view);
    }

    public function set_user_verify_badge($id)
    {

        try {
            if (!$id) {
                throw new Exception($this->errorMsgs(15)['msg']);
            }
            $User = User::find($id);
            if ($User->verified_badge == 'yes') {
                $User->verified_badge = 'no';
                $error = 'User Verification Badge Removed!';
            } elseif ($User->verified_badge == 'no') {
                $User->verified_badge = 'yes';
                $error = 'User Verification Badge Set!';
            }

            $updated = $User->save();
            if (!$updated) {
                throw new Exception($this->errorMsgs(14)['msg']);
            } else {
                return response()->json(["message" => $error, 'status' => true]);
            }
        } catch (Exception $e) {

            $error = $e->getMessage();
            $error = [
                'errors' => [$error],
            ];
            return response()->json(["errors" => $error, 'status' => false]);
        }
    }

    public function switch_user_role($id, $new_role)
    {
        try {
            $condition = [
                ['unique_id', $id]
            ];
            $user = $this->user->getSingleUser($condition);

            if (count($user) < 1) {
                $error = 'Error! User does not exist';
                throw new Exception($error);
            }

            $user->user_type = $new_role;
            if ($user->save()) {
                $message = 'User role changed successfully!';
                return response()->json(["message" => $message, 'status' => true]);
            }
        } catch (Exception $e) {

            $error = $e->getMessage();
            $error = [
                'errors' => [$error],
            ];
            return response()->json(["errors" => $error, 'status' => false]);
        }
    }
}
