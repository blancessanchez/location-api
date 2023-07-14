
## Location Search Demo

This is a single restful API endpoint which should return Location points for a region on a map.

## Tech Stack

- Laravel 10
- PHP 8

## Software needed

Postman: https://www.postman.com/downloads/
## Run Locally

- Clone the project

```bash
  git clone git@github.com:blancessanchez/location-api.git
```

- Create database named **locations**.

- Go to the project directory

```bash
  cd location-api
```

- Execute the necessary setup

```bash
  php artisan migrate --path=database/migrations/api
  php artisan db:seed
```

- Go to the .env file, change the following according to the credentials

```bash
  DB_HOST=127.0.0.1
  DB_DATABASE=locations
  DB_USERNAME=root
  DB_PASSWORD=
```
- Go to the .env file, change the value for the api key

```bash
  LOCATION_API_KEY=abcd
```

- Start the server

```bash
  php artisan serve
```

## Execute API

**Method**: GET

**URL**: http://127.0.0.1:8000/api/v1/locations

**Parameters**:
  - latitude: required and numeric
  - longitude: required and numeric
  - radius: required and numeric

**Add in the headers**:
X-API-Key: <api-key-value>

## Sample Input

http://127.0.0.1:8000/api/v1/locations?latitude=51.475603934275675&longitude=-2.380716714519811&radius=6

## Sample Return

200 Success

```bash
  [
    {
        "id": 1,
        "name": "Toyota Taunton",
        "latitude": "51.475603934275675",
        "longitude": "-2.380716714519811",
        "distance": 0
    },
    {
        "id": 194,
        "name": "Balnellan Road Car Park",
        "latitude": "51.491571618028780",
        "longitude": "-2.459211246136401",
        "distance": 5.718032351573878
    }
]
```

422 Unprocessable Content

```bash
{
    "message": "The latitude field is required.",
    "errors": {
        "latitude": [
            "The latitude field is required."
        ]
    }
}
```
