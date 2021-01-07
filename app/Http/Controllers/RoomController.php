<?php

    namespace App\Http\Controllers;

    use App\Repositories\Room\RoomInterface;
    use Carbon\Carbon;
    use Carbon\Exceptions\InvalidFormatException;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Validation\ValidationException;

    class RoomController extends Controller
    {
        /**
         * @var RoomInterface
         */
        private $roomRepository;

        /**
         * Create a new controller instance.
         *
         * @param RoomInterface $roomRepository
         */
        public function __construct(RoomInterface $roomRepository)
        {
            $this->roomRepository = $roomRepository;
        }

        /**
         * @param $start_date
         * @param $end_date
         * @return bool
         * @throws InvalidFormatException
         */
        protected function dateValidator($start_date, $end_date)
        {
            $start_date = Carbon::parse($start_date);
            $end_date = Carbon::parse($end_date);

            if ($end_date->lt($start_date)) {
                return false;
            }
            return true;
        }

        /**
         * @param Request $request
         * @return JsonResponse
         */
        public function getAvailableRooms(Request $request)
        {

            $category_id = !empty($request->input('category_id')) ? $request->input('category_id') : '';

            $rooms = $this->roomRepository->checkAvailability($category_id, '', '', '');


            return response()->json(['status' => 'ok', 'data' => $rooms], 200);

        }

        /**
         * @param Request $request
         * @return JsonResponse
         */
        public function checkAvailability(Request $request)
        {
            $this->validate($request,
                [
                    'room_number' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                ],);


            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $room_number = $request->input('room_number');


            if (!$this->dateValidator($start_date, $end_date)) {
                return response()->json(['status' => 'error', 'data' => 'End date should be greater than Start date']);
            }

            $rooms = $this->roomRepository->checkAvailability('', $start_date, $end_date, $room_number);
            return response()->json(['status' => 'ok', 'data' => $rooms], 200);
        }


        /**
         * @return JsonResponse
         */
        public function getCategories()
        {
            return response()->json(['status' => 'ok', 'data' => $this->roomRepository->getCategories()], 200);
        }

        /**
         * @param Request $request
         * @return JsonResponse
         * @throws InvalidFormatException
         * @throws ValidationException
         */
        public function makeBooking(Request $request)
        {


            $this->validate($request,
                [
                    'room_number' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                ],);


            if (!$this->dateValidator($request->input('start_date'), $request->input('end_date'))) {
                return response()->json(['status' => 'error', 'data' => 'End date should be greater than Start date']);
            }
            $user_id = 0; //@NOTE Sure about using auth because there wasn't anything about that in the requirement doc.


            $booking = $this->roomRepository->bookRoom(['user_id' => $user_id, 'room_number' => $request->input('room_number')
                , 'start_date' => $request->input('start_date'), 'end_date' => $request->input('end_date')
            ]);

            if ($booking) {
                return response()->json(['status' => 'ok', 'data' => 'Room has been booked'], 200);
            }

            return response()->json(['status' => 'error', 'error' => 'Room not available']);

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

    }
