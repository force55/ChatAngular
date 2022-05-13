<?php

    namespace App\Http\Controllers;

    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Redis\Connections\PredisConnection;
    use Illuminate\Support\Facades\Auth;
    use LRedis;
    use mysql_xdevapi\Exception;


    class ChatController extends Controller
    {

        public function __construct()
        {
            $this->middleware('auth:api');
        }

        public function sendMessage(Request $request)
        {
            $redis = new \Redis();
            $redis = $redis->connect('127.0.0.1',6379);


//        $data = ['message' => $request->input('messageContent'), 'user' => $request->input('user')];
            $data = ['message' => $request->input('messageContent') ?? '', 'user' => 'vlad'];


//            $redis->publish('message', json_encode($data));

            $redis->set('key', 'hello');
            $redis->get('key');
            return response()->json([
                'message' => 'Message was sented',
                'status' => true,
                'value' => print_r($redis->get('key'))
            ], 201);
        }
    }
