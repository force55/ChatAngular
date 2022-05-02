<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Models\User;
    use Validator;

    class ProfileController extends Controller
    {
        //
        public function __construct()
        {
            $this->middleware('auth:api');
        }

        /**
         * Get the authenticated User.
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function show()
        {
            return response()->json(auth()->user());
        }

        public function edit(Request $request)
        {
            $userId = Auth::id();
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
                'email' => 'required|string|email|max:100|unique:users,email,' . $userId,
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }

            //If email not have used
            //debug

            //end debug
            $user = User::findOrFail($userId);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->location = $request->input('location') ?? '';

            if ($user->save()) {
                return response()->json([
                    'message' => 'User successfully updated',
                    'status' => true
                ], 201);
            } else {
                return response()->json([
                    'message' => 'User was not successfully registered',
                    'status' => false
                ], 500);
            }

        }
    }
