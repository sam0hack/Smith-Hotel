<?php

    namespace App\Http\Controllers;

    use App\Models\User;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Validation\ValidationException;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use Tymon\JWTAuth\Exceptions\TokenExpiredException;
    use Tymon\JWTAuth\Exceptions\TokenInvalidException;
    use Tymon\JWTAuth\JWTAuth;

    class UserController extends Controller
    {

        /**
         * @var JWTAuth
         */
        protected $jwt;

        /**
         * UserController constructor.
         * @param JWTAuth $jwt
         */
        public function __construct(JWTAuth $jwt)
        {
            $this->jwt = $jwt;
        }

        /**
         * @param Request $request
         * @param array $errors
         * @return array|JsonResponse
         */
        protected function buildFailedValidationResponse(Request $request, array $errors)
        {
            return ["status" => 'error', "errors" => $errors];
        }


        /**
         * Get a JWT via given credentials.
         *
         * @param Request $request
         * @return JsonResponse
         * @throws ValidationException
         */
        public function doLogin(Request $request)
        {
            $this->validate($request, [
                'email' => 'required|email|max:55',
                'password' => 'required',
            ]);


            try {

                if (!$token = $this->jwt->attempt($request->only('email', 'password'))) {
                    return response()->json(['user_not_found'], 404);
                }

            } catch (TokenExpiredException $e) {

                return response()->json(['token_expired'], 500);

            } catch (TokenInvalidException $e) {

                return response()->json(['token_invalid'], 500);

            } catch (JWTException $e) {

                return response()->json(['token_absent' => $e->getMessage()], 500);

            }
            return response()->json(compact('token'), 200);

        }

        public function doSignup(Request $request)
        {

            $this->validate($request, [
                'email' => 'required|email|max:55|unique:users',
                'name' => 'required|max:55',
                'password' => 'required',
            ]);

            $password = (Hash::make($request->input('password')));

            User::firstOrcreate(['email' => $request->input('email')], ['name' => $request->input('name'), 'password' => $password]);
            return response()->json(['status' => 'ok', 'data' => 'User has been created']);
        }

    }
