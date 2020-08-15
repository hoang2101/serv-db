<h1 align="center">Server Inventory Management</h1>

Requirements
----
* PHP 7.4
* [Composer](https://getcomposer.org/download/)
* [Symfony](https://symfony.com/download)

Installation
----
1. `cd my-project/`
2. Install Composer: `composer install`
3. Create SQLite DB: `php bin/console doctrine:database:create`
4. Add table to DB: `php bin/console doctrine:migrations:migrate`
3. Run the server: `symfony server:start`

Show list of server API
----
Returns JSON data for list of server

* **URL**

  localhost:8000/api

* **Method:**

  `GET`
  
* **URL Params**
 
  None
    
* **Data Params**

  None

* **Sample Success Response:**

  * **Code:** 200 <br />
  * **Content:** 
    ```
    [ 
      {
          "id": 13,
          "name": "Berlin-Reuben Lester",
          "type": "Linux",
          "description": "i3 RAM-16GB HDD 100GB",
          "locationId": {
              "id": 33,
              "name": "Berlin",
              "rackId": 25,
              "position": "391"
          },
          "ownerId": {
              "id": 29,
              "name": "Reuben Lester",
              "address": "874 Stillwater Drive Powhatan, VA 23139"
          }
      },
    ]
    ```
Show info of one server API
----
Returns JSON data for a server with given id

* **URL**

  localhost:8000/api/{id}

* **Method:**

  `GET`
  
* **URL Params**
 
  None
    
* **Data Params**

  None

* **Sample Success Response:**

  * **Code:** 200 <br />
  * **Content:** 
    ```
    [
      {
          "id": 14,
          "name": "London-Sage Browning",
          "type": "Linux",
          "description": "i7 RAM-32GB HDD 500GB",
          "locationId": {
              "id": 38,
              "name": "London",
              "rackId": 98,
              "position": "774"
          },
          "ownerId": {
              "id": 21,
              "name": "Sage Browning",
              "address": "8229 Birch Hill Court Midlothian, VA 23112"
          }
      }
    ]
    ```
Delete server API
----
Delete a server with given id

* **URL**

  localhost:8000/api/{id}

* **Method:**

  `DELETE`
  
* **URL Params**
 
  None
    
* **Data Params**

  None

* **Sample Success Response:**

  * **Code:** 200 <br />
  * **Content:** 
    ```
    Deleted server 12
    ```
Add new server API
----
Add a new server with given JSON data

* **URL**

  localhost:8000/api

* **Method:**

  `POST`
  
* **URL Params**
 
  None
    
* **Data Params**
  JSON
  ```
  {
    "name": "EE-John",
    "type": "Premium",
    "description": "i7 RAM-64GB HDD-500GB",
    "location_id": "35",
    "owner_id": "25"
  }
  ```
 
* **Sample Success Response:**

  * **Code:** 200 <br />
  * **Content:** 
    ```
    Added server 34
    ```
Update server API
----
Update the server with given id and JSON data

* **URL**

  localhost:8000/api/{id}

* **Method:**

  `PUT`
  
* **URL Params**
 
  None
    
* **Data Params**
  JSON
  ```
  {
    "name": "EE-John",
    "type": "Premium",
    "description": "i7 RAM-64GB HDD-500GB",
    "location_id": "35",
    "owner_id": "25"
  }
  ```
 
* **Sample Success Response:**

  * **Code:** 200 <br />
  * **Content:** 
    ```
    Updated server 15
    ```
