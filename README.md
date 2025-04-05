# RoadBuddy 🚗

A web-based platform that connects drivers with passengers for shared road trips.

![RoadBuddy Logo](https://via.placeholder.com/150)

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [Project Structure](#project-structure)
- [Database Schema](#database-schema)
- [API Documentation](#api-documentation)
- [User Flows](#user-flows)
- [Screenshots](#screenshots)
- [Contributing](#contributing)
- [License](#license)

## Overview

RoadBuddy is a carpool platform that allows travelers to find and share rides between cities. Users can search for available trips by specifying departure city, destination city, and travel date. The platform facilitates connections between drivers and passengers while ensuring security through user authentication and verification.

### Core Functionality
- Search and filter available road trips
- User authentication and profile management
- Trip booking and management system
- Driver ratings and reviews
- Real-time trip status updates

## Features

### For Passengers
- Search trips by departure location, destination, and date
- Filter search results by price, departure time, and driver rating
- View trip details and driver information
- Request to join trips
- Track request status (pending, accepted, declined)
- Manage personal profile and contact information

### For Drivers
- Create and manage trip listings
- Set pricing and available seats
- Review and accept/decline passenger requests
- Cancel trips when necessary
- Manage driver profile and vehicle information
- View passenger details for approved trips

### General Features
- User registration and authentication
- Profile management
- Rating system for drivers
- Responsive design for mobile and desktop
- Secure communication between users

## Tech Stack

### Frontend
- HTML5
- CSS3 (with responsive design)
- JavaScript
- Bootstrap 5 (for responsive UI components)
- jQuery (for DOM manipulation and AJAX requests)

### Backend
- PHP 8.0+
- MySQL 8.0+ (database)
- PDO (PHP Data Objects for database connections)
- Session management for authentication

### Security
- Password hashing using bcrypt
- Prepared statements to prevent SQL injection
- CSRF token protection for forms
- Input validation and sanitization

## Installation

### Prerequisites
- PHP 8.0 or higher
- MySQL 8.0 or higher
- Apache/Nginx web server
- Composer (for dependency management)

### Setup Instructions

1. Clone the repository
```bash
git clone https://github.com/yourusername/roadbuddy.git
cd roadbuddy
```

2. Create and configure the database
```bash
mysql -u root -p
CREATE DATABASE roadbuddy;
USE roadbuddy;
SOURCE database/schema.sql;
```

3. Configure database connection
```bash
cp config/config.example.php config/config.php
```
Edit `config/config.php` with your database credentials.

4. Set up virtual host (optional)
```apache
<VirtualHost *:80>
    DocumentRoot "/path/to/roadbuddy/public"
    ServerName roadbuddy.local
    
    <Directory "/path/to/roadbuddy/public">
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

5. Add the hostname to your hosts file (optional)
```
127.0.0.1 roadbuddy.local
```

6. Restart your web server and navigate to `http://roadbuddy.local` or `http://localhost/roadbuddy`

## Project Structure

```
roadbuddy/
├── config/                  # Configuration files
│   ├── config.php           # Database and app configuration
│   └── constants.php        # Application constants
├── public/                  # Publicly accessible files
│   ├── index.php            # Main entry point
│   ├── assets/              # Static assets
│   │   ├── css/             # CSS stylesheets
│   │   ├── js/              # JavaScript files
│   │   └── images/          # Image files
│   └── uploads/             # User uploaded content
├── src/                     # Application source code
│   ├── controllers/         # Controller classes
│   ├── models/              # Model classes for database interaction
│   ├── views/               # View templates
│   │   ├── layouts/         # Layout templates
│   │   ├── users/           # User-related views
│   │   ├── trips/           # Trip-related views
│   │   └── auth/            # Authentication views
│   ├── helpers/             # Helper functions
│   └── middlewares/         # Middleware classes
├── database/                # Database scripts
│   └── schema.sql           # Database schema
└── README.md                # Project documentation
```

## Database Schema

### Users Table
```sql
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    user_type ENUM('passenger', 'driver') NOT NULL,
    profile_picture VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### Driver Profiles Table
```sql
CREATE TABLE driver_profiles (
    driver_id INT PRIMARY KEY,
    user_id INT NOT NULL,
    license_number VARCHAR(50) NOT NULL,
    vehicle_model VARCHAR(100) NOT NULL,
    vehicle_color VARCHAR(50) NOT NULL,
    vehicle_plate VARCHAR(20) NOT NULL,
    avg_rating DECIMAL(3,2) DEFAULT 0,
    total_reviews INT DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);
```

### Trips Table
```sql
CREATE TABLE trips (
    trip_id INT AUTO_INCREMENT PRIMARY KEY,
    driver_id INT NOT NULL,
    departure_city VARCHAR(100) NOT NULL,
    destination_city VARCHAR(100) NOT NULL,
    departure_date DATE NOT NULL,
    departure_time TIME NOT NULL,
    estimated_arrival_time TIME,
    price DECIMAL(10,2) NOT NULL,
    available_seats INT NOT NULL,
    description TEXT,
    status ENUM('active', 'completed', 'cancelled') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (driver_id) REFERENCES driver_profiles(driver_id)
);
```

### Trip Requests Table
```sql
CREATE TABLE trip_requests (
    request_id INT AUTO_INCREMENT PRIMARY KEY,
    trip_id INT NOT NULL,
    passenger_id INT NOT NULL,
    status ENUM('pending', 'accepted', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (trip_id) REFERENCES trips(trip_id),
    FOREIGN KEY (passenger_id) REFERENCES users(user_id)
);
```

### Ratings Table
```sql
CREATE TABLE ratings (
    rating_id INT AUTO_INCREMENT PRIMARY KEY,
    trip_id INT NOT NULL,
    passenger_id INT NOT NULL,
    driver_id INT NOT NULL,
    rating INT NOT NULL CHECK (rating BETWEEN 1 AND 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (trip_id) REFERENCES trips(trip_id),
    FOREIGN KEY (passenger_id) REFERENCES users(user_id),
    FOREIGN KEY (driver_id) REFERENCES driver_profiles(driver_id)
);
```

## API Documentation

### Authentication Endpoints

#### Register User
- **URL**: `/api/auth/register.php`
- **Method**: `POST`
- **Data Params**:
  ```json
  {
    "username": "johndoe",
    "email": "john@example.com",
    "password": "securepassword",
    "first_name": "John",
    "last_name": "Doe",
    "phone_number": "1234567890",
    "user_type": "passenger"
  }
  ```
- **Success Response**: `{ "status": "success", "message": "User registered successfully" }`

#### Login
- **URL**: `/api/auth/login.php`
- **Method**: `POST`
- **Data Params**:
  ```json
  {
    "email": "john@example.com",
    "password": "securepassword"
  }
  ```
- **Success Response**: `{ "status": "success", "message": "Login successful", "user_data": {...} }`

### Trip Endpoints

#### Search Trips
- **URL**: `/api/trips/search.php`
- **Method**: `GET`
- **URL Params**: `departure_city=[string]&destination_city=[string]&date=[date]`
- **Success Response**: `{ "status": "success", "trips": [...] }`

#### Create Trip (Driver only)
- **URL**: `/api/trips/create.php`
- **Method**: `POST`
- **Data Params**:
  ```json
  {
    "departure_city": "New York",
    "destination_city": "Boston",
    "departure_date": "2023-05-15",
    "departure_time": "09:00:00",
    "estimated_arrival_time": "12:00:00",
    "price": 25.00,
    "available_seats": 3,
    "description": "Direct route via I-95"
  }
  ```
- **Success Response**: `{ "status": "success", "message": "Trip created successfully", "trip_id": 123 }`

#### Request to Join Trip
- **URL**: `/api/trips/request.php`
- **Method**: `POST`
- **Data Params**:
  ```json
  {
    "trip_id": 123
  }
  ```
- **Success Response**: `{ "status": "success", "message": "Request submitted successfully" }`

#### Update Request Status (Driver only)
- **URL**: `/api/trips/update_request.php`
- **Method**: `PUT`
- **Data Params**:
  ```json
  {
    "request_id": 456,
    "status": "accepted"
  }
  ```
- **Success Response**: `{ "status": "success", "message": "Request status updated" }`

## User Flows

### Passenger Flow
1. User registers/logs in to the platform
2. Searches for trips by entering departure city, destination city, and date
3. Views search results and filters by price or other criteria
4. Selects a trip to view details and driver information
5. Requests to join the selected trip
6. Waits for driver approval (viewable in user profile)
7. If approved, receives driver contact information
8. After trip completion, can rate and review the driver

### Driver Flow
1. User registers/logs in with driver account
2. Creates a new trip listing with route details and available seats
3. Receives notifications of passenger requests
4. Reviews passenger profiles and accepts/rejects requests
5. Manages trips through driver dashboard
6. Updates trip status as needed (active, completed, cancelled)
7. Receives ratings and reviews from passengers

## Screenshots

### Home Page
![Home Page](https://via.placeholder.com/800x400)

### Search Results
![Search Results](https://via.placeholder.com/800x400)

### Trip Details
![Trip Details](https://via.placeholder.com/800x400)

### User Profile
![User Profile](https://via.placeholder.com/800x400)

### Driver Dashboard
![Driver Dashboard](https://via.placeholder.com/800x400)

## Contributing

We welcome contributions to RoadBuddy! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

Please make sure your code adheres to our coding standards and includes appropriate tests.

## License

This project is licensed under the MIT License - see the LICENSE file for details.

---

Built with ❤️ by The RoadBuddy Team
