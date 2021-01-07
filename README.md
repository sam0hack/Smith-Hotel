# Smith Hotel

A simple Hotel booking system for the myskillsme.com
It's build on the Lumen 8 Framework more about [Lumen](https://lumen.laravel.com/)

**Features**

- [✔]  API to check categories of rooms and available number of rooms in each category.

- [✔]  API to let user see the room availability by date (e.g. single room may be unavailable from 4th June to 9th June)

- [✔]  API to let user check the number of room available in each date or a selected frame of date

- [✔]  API to let user Signup and Login



**Server Requirements**

* PHP >= 7.3
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Sqlite driver (optional Only for phpunit testing)


**Authentication Dependency**

Jwt-Auth

More at [JWT-Auth](https://jwt-auth.readthedocs.io/en/develop/ ) 



### Installation


+ `git clone https://github.com/sam0hack/Smith-Hotel.git`

+ `cd into directory`

+ ` Composer install `

+ `Edit .env with your DB Credentials `

+ `php artisan jwt:secret`




----

### API's

Postman Collection  [Smith-Hotel-Postman-Collection](https://raw.githubusercontent.com/sam0hack/Smith-Hotel/master/Smith%20Hotel.postman_collection.json ) 

**Get Categories**

  
  Returns json data with categories and available rooms.

* **URL**

  /get-categories

* **Method:**

  `GET`
  
*  **URL Params**
  None

* **Success Response:**

  * **status:** 'ok' <br />
    **data:** `"data": [
        {
            "category": "simple",
            "available_number_rooms": 17,
            "rooms": {
                "current_page": 1,
                "data": [
                    {
                        "id": 1,
                        "category_id": "simple",
                        "room_number": 1,
                        "cost": 1410,
                        "number_of_beds": 4,
                        "title": "Tomato",
                        "description": "But there seemed to have no sort of idea that they must be on the OUTSIDE.' He unfolded the paper as he found it advisable--\"' 'Found WHAT?' said the Mock Turtle. 'Very much indeed,' said Alice.",
                        "created_at": "2021-01-06T16:33:08.000000Z",
                        "updated_at": "2021-01-06T16:33:08.000000Z"
                    },]`
 

----

**Get Available Rooms**

  
  Returns json data with available rooms on the current date.

* **URL**

  /get-available-rooms

* **Method:**

  `GET`
  
*  **URL Params**
  None

* **Success Response:**

  * **status:** 'ok' <br />
    **data:** `"data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "category_id": "simple",
                "room_number": 1,
                "cost": 1410,
                "number_of_beds": 4,
                "title": "Tomato",
                "description": "But there seemed to have no sort of idea that they must be on the OUTSIDE.' He unfolded the paper as he found it advisable--\"' 'Found WHAT?' said the Mock Turtle. 'Very much indeed,' said Alice.",
                "created_at": "2021-01-06T16:33:08.000000Z",
                "updated_at": "2021-01-06T16:33:08.000000Z"
            },,]`
 
----

**Check Availability **

  
  Returns json data with available rooms on the selected date and room number.

* **URL**

  /check-availability

* **Method:**

  `POST`
  
*  **URL Params**
   **Required:**
 
   `start_date`, `end_date` , `room_number`

* **Success Response:**

  * **status:** 'ok' <br />
    **data:** `    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 19,
                "category_id": "premium",
                "room_number": 19,
                "cost": 2487,
                "number_of_beds": 3,
                "title": "GoldenRod",
                "description": "While she was now about two feet high, and she could see, as they all crowded round it, panting, and asking, 'But who is Dinah, if I must, I must,' the King said to Alice, and her face like the.",
                "created_at": "2021-01-06T16:33:09.000000Z",
                "updated_at": "2021-01-06T16:33:09.000000Z"
            }
        ],
        "first_page_url": "http://127.0.0.1:8181/check-availability?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://127.0.0.1:8181/check-availability?page=1",
        "links": [
            {
                "url": null,
                "label": "pagination.previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8181/check-availability?page=1",
                "label": 1,
                "active": true
            },
            {
                "url": null,
                "label": "pagination.next",
                "active": false
            }
        ],
        "next_page_url": null,
        "path": "http://127.0.0.1:8181/check-availability",
        "per_page": 50,
        "prev_page_url": null,
        "to": 1,
        "total": 1
    }
}`
 
 
 ----

**Make Booking**

  
 Book a room if room available and Returns json data.
 @note this api works with and without Auth If user is not Authenticated it will use user_id as 0 and if user is Authenticated it will use authenticated user's id. 

* **URL**

  /make-booking

* **Method:**

  `POST`
  
*  **URL Params**
   **Required:**
 
   `start_date`, `end_date` , `room_number`
   
   
   *  **Authentication**
   *  Not Required 
   *  Type : Bearer
   

* **Success Response:**

  * **status:** 'ok' <br />
    **data:** `"Room has been booked`
 
 
 
  ----

**SignUp**

  Register a user. 

* **URL**

  /signup

* **Method:**

  `POST`
  
*  **URL Params**
   **Required:**
 
   `email`, `name` , `password`

   

* **Success Response:**

  * **status:** 'ok' <br />
    **data:** `"User has been created`
 
 
 
  ----

**Login**

  Authenticate user and return JWT Token. 

* **URL**

  /login
  
* **Method:**

  `POST`
  
*  **URL Params**
   **Required:**
 
   `email`, `password`
   

* **Success Response:**

  * **token:** 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODE4MVwvbG9naW4iLCJpYXQiOjE2MDk5OTE0NTMsImV4cCI6MTYwOTk5NTA1MywibmJmIjoxNjA5OTkxNDUzLCJqdGkiOiJPUWQ0ZDNpVEllYkVMU0NRIiwic3ViIjoxLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.KsPSUQ5M1XdvmxkTQrPa3PZTIdcQSYgdT7cBbeSAlHs' <br />
 
 
----
 
### TESTING

Why? because we love TDD

Run ` vendor/bin/phpunit ` 