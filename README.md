# Healthy Life Tracker

Healthy Life Tracker is a web application for tracking meals and sleep habits with built-in analytics and an admin dashboard.

The project is built using PHP (MVC pattern), MySQL, and basic frontend technologies.

---

## Features

### User functionality
- User registration and login system
- Role-based access (user/admin)
- Add, edit, and delete meals
- Track sleep duration
- View personal statistics:
  - Average sleep
  - Monthly sleep
  - Weekly sleep average

### Admin panel
- Overview dashboard with system statistics:
  - Total users
  - Total meals
  - Total calories
  - Total messages from contact form
- Sleep analytics:
  - Global average sleep
  - Total sleep entries
  - Top users by sleep
- Meal management (edit/delete meals)
- View user messages

---

## Analytics
- Average values (AVG SQL functions)
- Aggregations (SUM, COUNT)
- Time-based filtering (week/month)
- Ranking system (top users)

---

## Tech Stack
- PHP (MVC architecture)
- MySQL
- HTML/CSS (Bootstrap)
- JavaScript (minimal usage)

---

## Project Structure
- controllers/ – application logic
- models/ – database interaction
- views/ – UI templates
- config/ – database configuration
- helpers/ – authentication and utilities
- data/ – stored messages (contact form)

---

## How to run the project
1. Install XAMPP or similar local server
2. Place project in `htdocs`
3. Import database (if provided)
4. Start Apache + MySQL
5. Open in browser: http://localhost/healthylife/

---

## Notes
This project demonstrates:
- MVC architecture in PHP
- CRUD operations
- Role-based access control
- Data analytics and aggregation