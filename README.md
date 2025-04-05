# Carpool 🚗

A web-based platform that connects drivers with passengers for shared road trips.

![Carpool Logo](https://via.placeholder.com/150)

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

Carpool is a ride-sharing platform that allows travelers to find and share rides between cities. Users can search for available trips by specifying departure city, destination city, and travel date. The platform facilitates connections between drivers and passengers while ensuring security through user authentication and verification.

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
- Track request status (pending, accepted, rejected)
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
git clone https://github.com/OuissemBrs/carpool.git
cd carpool
```

2. Create and configure the database
```bash
mysql -u root -p
CREATE DATABASE carpool;
USE carpool;
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
    DocumentRoot "/path/to/carpool/public"
    ServerName carpool.local
    
    <Directory "/path/to/carpool/public">
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

5. Add the hostname to your hosts file (optional)
```
127.0.0.1 carpool.local
```

6. Restart your web server and navigate to `http://carpool.local` or `http://localhost/carpool`

## Project Structure

```
carpool/
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

### Personne Table
```sql
CREATE TABLE `personne` (
  `Name` varchar(30) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `Gmail` varchar(40) NOT NULL,
  `Sex` enum('male','female') NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Adress` varchar(40) NOT NULL,
  `BirthDate` date NOT NULL,
  PRIMARY KEY (`Phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```

### Driver Table
```sql
CREATE TABLE `driver` (
  `Phone` varchar(10) NOT NULL,
  `Evaluation` int NOT NULL,
  `Category` enum('car','bus') NOT NULL,
  `Delay` int NOT NULL,
  `Certified` enum('yes','no') NOT NULL,
  `LicenceDate` date NOT NULL,
  `NbrTrajetA` int NOT NULL,
  `NbrTrajetT` int NOT NULL,
  PRIMARY KEY (`Phone`),
  CONSTRAINT `driver_ibfk_1` FOREIGN KEY (`Phone`) REFERENCES `personne` (`Phone`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```

### Journey Table
```sql
CREATE TABLE `journey` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Departure` enum('Annaba','Batna','Constantine','Guelma','Jijel','Skikda','Taref','Om Bwaqi') NOT NULL,
  `Destination` enum('Annaba','Batna','Constantine','Guelma','Jijel','Skikda','Taref','Om Bwaqi') NOT NULL,
  `Stop1` enum('Annaba','Batna','Constantine','Guelma','Jijel','Skikda','Taref','Om Bwaqi') DEFAULT NULL,
  `Stop2` enum('Annaba','Batna','Constantine','Guelma','Jijel','Skikda','Taref','Om Bwaqi') DEFAULT NULL,
  `Places` int NOT NULL,
  `DepH` time NOT NULL,
  `DesH` time NOT NULL,
  `Date` date NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `Smoking` enum('yes','no') NOT NULL,
  `Prix` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `journey_ibfk_1` (`Phone`),
  CONSTRAINT `journey_ibfk_1` FOREIGN KEY (`Phone`) REFERENCES `driver` (`Phone`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```

### PasJourney Table
```sql
CREATE TABLE `pasjourney` (
  `Phone` varchar(10) NOT NULL,
  `ID` int NOT NULL,
  `Statu` enum('pending','accepted','rejected') NOT NULL,
  PRIMARY KEY (`Phone`,`ID`),
  KEY `pasjourney_ibfk_1` (`ID`),
  CONSTRAINT `pasjourney_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `journey` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pasjourney_ibfk_2` FOREIGN KEY (`Phone`) REFERENCES `personne` (`Phone`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```

## API Documentation

### Authentication Endpoints

#### Register User
- **URL**: `/api/auth/register.php`
- **Method**: `POST`
- **Data Params**:
  ```json
  {
    "Name": "John Doe",
    "Phone": "1234567890",
    "Gmail": "john@example.com",
    "Sex": "male",
    "Password": "securepassword",
    "Adress": "123 Main St, City",
    "BirthDate": "1990-01-01"
  }
  ```
- **Success Response**: `{ "status": "success", "message": "User registered successfully" }`

#### Login
- **URL**: `/api/auth/login.php`
- **Method**: `POST`
- **Data Params**:
  ```json
  {
    "Phone": "1234567890",
    "Password": "securepassword"
  }
  ```
- **Success Response**: `{ "status": "success", "message": "Login successful", "user_data": {...} }`

### Trip Endpoints

#### Search Trips
- **URL**: `/api/trips/search.php`
- **Method**: `GET`
- **URL Params**: `Departure=[string]&Destination=[string]&Date=[date]`
- **Success Response**: `{ "status": "success", "trips": [...] }`

#### Create Trip (Driver only)
- **URL**: `/api/trips/create.php`
- **Method**: `POST`
- **Data Params**:
  ```json
  {
    "Departure": "Constantine",
    "Destination": "Annaba",
    "Stop1": "Guelma",
    "Stop2": null,
    "Places": 3,
    "DepH": "09:00:00",
    "DesH": "12:00:00",
    "Date": "2023-05-15",
    "Smoking": "no",
    "Prix": 1200
  }
  ```
- **Success Response**: `{ "status": "success", "message": "Trip created successfully", "ID": 123 }`

#### Request to Join Trip
- **URL**: `/api/trips/request.php`
- **Method**: `POST`
- **Data Params**:
  ```json
  {
    "ID": 123
  }
  ```
- **Success Response**: `{ "status": "success", "message": "Request submitted successfully" }`

#### Update Request Status (Driver only)
- **URL**: `/api/trips/update_request.php`
- **Method**: `PUT`
- **Data Params**:
  ```json
  {
    "Phone": "0987654321",
    "ID": 123,
    "Statu": "accepted"
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
2. Completes driver profile with vehicle and license information
3. Creates a new trip listing with route details and available seats
4. Receives notifications of passenger requests
5. Reviews passenger profiles and accepts/rejects requests
6. Manages trips through driver dashboard
7. Updates trip status as needed
8. Receives ratings from passengers

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

We welcome contributions to Carpool! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

Please make sure your code adheres to our coding standards and includes appropriate tests.

## License

This project is licensed under the MIT License - see the LICENSE file for details.

---

Built with ❤️ by The Carpool Team
