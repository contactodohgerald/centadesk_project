<?php

namespace App\Http\Controllers\LiveStream;

use Exception;
use App\Traits\Generics;
use App\Model\live_stream_model;
use App\Traits\appFunction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class live_stream_controller extends Controller
{
    use Generics;
    use appFunction;

    public function __construct(live_stream_model $live_stream)
    {
        $this->middleware('auth',  ['except' => []]);
        $this->live_stream = $live_stream;
    }

    /**
     * Display form for creating live stream.
     *
     * @return array
     */
    public function create_live()
    {
        $user = auth()->user();
        $view = [
            'user' => $user,
        ];
        return view('dashboard.create_live_stream', $view);
    }

    /**
     *  Show the page for viewing live stream details.
     *
     * @return \Illuminate\Http\Response
     */
    public function live_stream_details($id)
    {
        $stream = live_stream_model::find($id);
        $condition = [
            ['deleted_at', null],
            ['status', 'live'],
        ];
        $live_streams = $this->live_stream->get_all($condition);
        $view = [
            'stream' => $stream,
            'live_streams' => $live_streams,
        ];
        // return $view;
        return view('dashboard.live_stream_details', $view);
    }

    /**
     * Display form for editing live stream.
     *
     * @param string $id
     * @return array
     */
    public function update_page($id)
    {
        $live_stream = live_stream_model::find($id);
        $view = [
            'live_stream' => $live_stream,
        ];

        return view('dashboard.edit_live_stream', $view);
    }

    /**
     * Function for showing live streams created by tecaher to the teacher or admin.
     *
     * @return array
     */
    public function show()
    {
        $user = auth()->user();
        if ($user->user_type === 'admin' || $user->user_type === 'super_admin') {

            $condition = [
                ['deleted_at', null]
            ];
            $live_streams = $this->live_stream->get_all($condition);
        } else {

            $condition = [
                ['user_id', $user->unique_id]
            ];
            $live_streams = $this->live_stream->get_all($condition);
        }
        $view = [
            'live_streams' => $live_streams,
            'user' => $user,
        ];

        return view('dashboard.view_live_streams', $view);
    }

    /**
     * Page for displaying all active live streams to users.
     *
     * @return array
     */
    public function explore_live_streams()
    {
        $user = auth()->user();
        $condition = [
            ['deleted_at', null],
            ['status', 'live'],
        ];
        $live_streams = $this->live_stream->get_all($condition);
        $view = [
            'live_streams' => $live_streams,
            'user' => $user,
        ];

        return view('dashboard.all_active_live_streams', $view);
    }

    /**
     * Post method for creating live streams.
     *
     * @param Request $request
     * @return array
     */
    public function create(Request $request)
    {
        $user = $request->user();
        try {
            if (!$request->isMethod('POST')) {
                throw new Exception('This is not a valid request.');
            }
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:40|unique:live_streams_tb,title',
                'meeting_url' => 'required|string',
                'status' => 'required|string',
                'description' => 'required|string',
                'passcode' => 'string',
                'privacy' => 'required|string',
                'software' => 'required|string',
                'date_to_start' => 'required',
                'time_to_start' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status' => false]);
            }

            $unique_id = $this->createUniqueId('live_streams_tb', 'unique_id');
            $title = $request->input('title');
            $meeting_url = $request->input('meeting_url');
            $status = $request->input('status');
            $description = $request->input('description');
            $passcode = $request->input('passcode');
            $privacy = $request->input('privacy');
            $software = $request->input('software');
            $date_to_start = $request->input('date_to_start');
            $time_to_start = $request->input('time_to_start');
            $user_id = $user['unique_id'];


            $live_stream = live_stream_model::create([
                'unique_id' => $unique_id,
                'user_id' => $user_id,
                'title' => $title,
                'status' => $status,
                'meeting_url' => $meeting_url,
                'description' => $description,
                'passcode' => $passcode,
                'privacy' => $privacy,
                'software' => $software,
                'date_to_start' => $date_to_start,
                'time_to_start' => $time_to_start,
            ]);

            if (!$live_stream->unique_id) {
                throw new Exception($this->errorMsgs(14)['msg']);
            } else {
                $error = 'Live Stream Created!';
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

    /**
     * Post method for updating live streams.
     *
     * @param Request $request
     * @param string $id
     * @return array
     */
    public function update(Request $request)
    {
        try {
            if (!$request->isMethod('POST')) {
                throw new Exception('This is not a valid request.');
            }
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:40',
                'meeting_url' => 'required|string',
                'status' => 'required|string',
                'description' => 'required|string',
                'passcode' => 'string',
                'privacy' => 'required|string',
                'software' => 'required|string',
                'date_to_start' => 'required',
                'time_to_start' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status' => false]);
            }

            $id = $request->input('id');
            $title = $request->input('title');
            $meeting_url = $request->input('meeting_url');
            $status = $request->input('status');
            $description = $request->input('description');
            $passcode = $request->input('passcode');
            $privacy = $request->input('privacy');
            $software = $request->input('software');
            $date_to_start = $request->input('date_to_start');
            $time_to_start = $request->input('time_to_start');


            $live_stream = live_stream_model::find($id);
            $live_stream->title = $title;
            $live_stream->meeting_url = $meeting_url;
            $live_stream->status = $status;
            $live_stream->description = $description;
            $live_stream->passcode = $passcode;
            $live_stream->privacy = $privacy;
            $live_stream->software = $software;
            $live_stream->date_to_start = $date_to_start;
            $live_stream->time_to_start = $time_to_start;
            $updated = $live_stream->save();


            if (!$updated) {
                throw new Exception($this->errorMsgs(14)['msg']);
            } else {
                $error = 'Live Stream Updated!';
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
    /**
     * Function to soft delete live stream.
     *
     * @param Request $request
     * @param string $id
     * @return void
     */
    public function soft_delete(Request $request, $id)
    {
        try {
            if (!$id) {
                throw new Exception($this->errorMsgs(15)['msg']);
            }
            $deleted = live_stream_model::find($id)->delete();

            if (!$deleted) {
                throw new Exception($this->errorMsgs(14)['msg']);
            } else {
                $error = 'Live Stream Deleted Successfully!';
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
}
