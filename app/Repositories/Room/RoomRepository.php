<?php


    namespace App\Repositories\Room;


    use App\Models\Booking;
    use App\Models\Category;
    use App\Models\Room;
    use Carbon\Carbon;
    use Carbon\Exceptions\InvalidFormatException;

    class RoomRepository implements RoomInterface
    {

        /**
         * @var int
         */
        protected $paginate = 50;

        /**
         * @return array
         * @throws InvalidFormatException
         */
        public function getCategories()
        {

            $data = [];
            foreach (Category::get() as $category) {
                array_push($data, ['category' => $category->title, 'rooms' => $this->checkAvailability($category->id, '')]);
            }

            return $data;

        }

        /**
         * @param $category_id
         * @param $start_date
         * @param string $end_date
         * @param string $room_id
         * @return mixed
         * @throws InvalidFormatException
         */
        public function checkAvailability($category_id, $start_date, $end_date = '', $room_id = '')
        {

            $rooms = Room::whereNotIn('id', $this->getBookingIds(
                Carbon::parse($start_date)->format('Y-m-d'),
                Carbon::parse($end_date)->format('Y-m-d')
            ));

            if (!empty($category_id) and !empty($room_id)) {
                $paginator = $rooms->where('category_id', $category_id)->where('id', $room_id)->paginate($this->paginate);
            } elseif (!empty($category_id) and empty($room_id)) {
                $paginator = $rooms->where('category_id', $category_id)->paginate($this->paginate);
            } elseif (empty($category_id) and !empty($room_id)) {
                $paginator = $rooms->where('id', $room_id)->paginate($this->paginate);
            } else {
                $paginator = $rooms->paginate($this->paginate);
            }

            return $paginator->getCollection()->transform(function ($value) {
                $value->category_id = Category::find($value->category_id)->title;
                return $value;
            });

        }

        /**
         * @param string $start_date
         * @param string $end_date
         * @return array|string[]
         * @throws InvalidFormatException
         */
        protected function getBookingIds($start_date = '', $end_date = '')
        {

            if (!empty($start_date) and empty($end_date)) {
                $date = Carbon::parse($start_date)->format('Y-m-d');
                $bookings = Booking::whereDate('end_date', '>', $date)->get();
            } elseif (!empty($start_date) and !empty($end_date)) {
                $start_date = Carbon::parse($start_date)->format('Y-m-d');
                $end_date = Carbon::parse($end_date)->format('Y-m-d');
                $bookings = Booking::whereDate('start_date', '>=', $start_date)->where('end_date', '<=', $end_date)->get();
            } else {
                $bookings = Booking::whereDate('end_date', '>', Carbon::now()->format('Y-m-d'))->get();
            }


            if (!$bookings->isEmpty()) {
                $booking_ids = [];
                foreach ($bookings as $booking) {
                    array_push($booking_ids, $booking->room_id);
                }
                return $booking_ids;
            }
            return [''];
        }

        public function bookRoom($array)
        {
            $start_date = Carbon::parse($array['start_date'])->format('Y-m-d');
            //$end_date = Carbon::parse($array['end_date'])->format('Y-m-d');
            $room = Room::where('room_number', $array['room_number'])->first();
            $booking = Booking::where('room_id', $room->id)->whereDate('start_date', '=', $start_date)->OrwhereDate('end_date', '=', $start_date)->first();

            if (!empty($booking)) {
                return false;
            }

            Booking::create(['room_id' => $room->id, 'user_id' => $array['user_id'],
                'start_date' => $array['start_date'], 'end_date' => $array['end_date']]);
            return true;
        }

    }
