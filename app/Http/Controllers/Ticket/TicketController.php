<?php

namespace App\Http\Controllers\Ticket;

use Exception;
use App\Model\Ticket;
use App\Traits\Generics;
use App\Traits\appFunction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    use Generics;
    use appFunction;

    public function __construct(Ticket $ticket)
    {
        $this->middleware('auth',  ['except' => []]);
        $this->ticket = $ticket;
    }

    /**
     * Display form for creating ticket.
     *
     * @return array
     */
    public function create_ticket()
    {
        $user = auth()->user();
        $condition = [
            ['user_id', $user->unique_id],
            ['main', 1],
        ];
        $ticket = $this->ticket->get_all($condition);
        // return $user->unique_id;
        $view = [
            'user' => $user,
            'tickets' => $ticket
        ];
        return view('dashboard.create_ticket', $view);
    }
    /**
     * Display all main tickets for admin.
     *
     * @return array
     */
    public function view_all()
    {
        $user = auth()->user();
        $condition = [
            ['main', 1],
        ];
        $ticket = $this->ticket->get_all($condition);

        $view = [
            'user' => $user,
            'tickets' => $ticket
        ];
        return view('dashboard.view_tickets', $view);
    }

    /**
     * Display form for replying ticket.
     *
     * @return array
     */
    public function reply_ticket($id)
    {
        $user = auth()->user();
        //get single ticket details

        if ($user['user_type'] == 'super_admin') {
            $condition = [
                ['unique_id', $id],
            ];
            $ticket_creator_id = $this->ticket->get_single($condition)['user_id'];
            $ticket_creator = User::find($ticket_creator_id);
            $condition = [
                ['main', 1],
                ['user_id', $ticket_creator_id],
            ];
            $prev_tickets = $this->ticket->get_all($condition);
        }

        if ($user['user_type'] == 'teacher' || $user['user_type'] == 'student') {
            $ticket_creator_id = $user['unique_id'];
            $ticket_creator = User::find($ticket_creator_id);
            $condition = [
                ['main', 1],
                ['user_id', $ticket_creator_id],
            ];
            $prev_tickets = $this->ticket->get_all($condition);
        }

        $condition = [
            ['main_id', $id]
        ];
        $messages = $this->ticket->get_all($condition, 'id', 'asc');
        // print_r(json_encode($messages[0]['title']));return;
        $view = [
            'user' => $user,
            'prev_tickets' => $prev_tickets,
            'messages' => $messages,
            'ticket_creator' => $ticket_creator
        ];
        return view('dashboard.reply_ticket', $view);
    }

    /**
     * Method for creating new ticket.
     *
     * @param Request $request
     * @return array
     */
    public function create(Request $request)
    {
        $user = auth()->user();
        try {
            if (!$request->isMethod('POST')) {
                throw new Exception('This is not a valid request.');
            }
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:35',
                'message' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status' => false]);
            }

            $unique_id = $this->createUniqueId('live_streams_tb', 'unique_id');
            $title = $request->input('title');
            $message = $request->input('message');
            $user_id = $user['unique_id'];


            $ticket = Ticket::create([
                'unique_id' => $unique_id,
                'main_id' => $unique_id,
                'user_id' => $user_id,
                'title' => $title,
                'message' => $message,
                'main' => '1',
            ]);

            if (!$ticket->unique_id) {
                throw new Exception($this->errorMsgs(14)['msg']);
            } else {
                $error = 'Ticket Created!';
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
     * Method for replying a ticket. $id => unique id for the main ticket.
     *
     * @param Request $request
     * @return array
     */
    public function reply(Request $request, $id)
    {
        $user = auth()->user();
        try {
            if (!$request->isMethod('POST')) {
                throw new Exception('This is not a valid request.');
            }
            $validator = Validator::make($request->all(), [
                'message' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status' => false]);
            }
            $main_ticket = Ticket::find($id);
            $main_id = $main_ticket['unique_id'];

            $unique_id = $this->createUniqueId('live_streams_tb', 'unique_id');
            $title = $main_ticket['title'];
            $message = $request->input('message');
            $user_id = $user['unique_id'];


            $ticket = Ticket::create([
                'unique_id' => $unique_id,
                'main_id' => $main_id,
                'user_id' => $user_id,
                'title' => $title,
                'message' => $message,
                'main' => '0',
            ]);

            if (!$ticket->unique_id) {
                throw new Exception($this->errorMsgs(14)['msg']);
            } else {
                $error = 'Ticket Replied!';
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

    public function count_pending_ticket()
    {
        $pending_tickets = 0;

        // get all main tickets without their replies
        $condition = [
            ['main', '1']
        ];
        // $main_tickets = $this->ticket->get_all($condition);
        $main_tickets = Ticket::where('main', 1)
               ->orderBy('id')
               ->get();
        if ($main_tickets->count() < 1) {
            return $pending_tickets;
        }
        // print_r($main_tickets->all());
        // check if each main ticket has been replied to, by an admin
        foreach ($main_tickets as $e) {
            // print_r($e->toArray());die();
            $condition = [
                ['main_id', $e->unique_id],
                [$e->user->user_type, 'super_admin']
            ];
            $replies = $this->ticket->get_all($condition);
            if (count($replies) > 0) {
                $pending_tickets++;
            }
        }

        // return $pending_tickets;
    }
}
