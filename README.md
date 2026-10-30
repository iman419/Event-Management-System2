# Event Management System

## Project Description

Event Management System is a web application for managing events, venues, categories, and user registrations. Users will be able to discover events and manage their registrations, while administrators will manage event-related information.

## User Roles

- **User:** Browse events and manage event registrations.
- **Admin:** Manage events, categories, and venues.

## Planned Entities

The database contains the following entities:

- Users
- Events
- Categories
- Venues
- Registrations
- Reviews

See [docs/ERD.md](docs/ERD.md) for the entity-relationship diagram.

## Technology Stack

- **Frontend:** HTML, CSS, JavaScript, Bootstrap 5
- **Backend:** PHP and FlightPHP
- **Database:** MySQL
- **Database Access:** PHP PDO and DAO classes
- **API Documentation:** OpenAPI and Swagger (planned)
- **Authentication:** JWT (planned)
- **Local Development:** XAMPP

## Project Structure

- `frontend/` — frontend files, styles, scripts, views, and assets
- `backend/` — API routes, services, data access, middleware, configuration, and logs
- `database/` — SQL database schema and sample data
- `docs/` — project documentation, ERD, and AI usage log
- `.github/agents/` — custom AI agent instructions
- `.agents/skills/` — project-specific AI skills

## Project Status

### Milestone 1 — Setup, Static Frontend, and ERD

The initial repository structure, project documentation, static frontend prototype, and draft ERD have been created. The frontend uses separate view fragments and client-side navigation.

### Milestone 2 — Database and DAO Layer

The MySQL schema has been created in `database/event_management.sql`. It defines six relational tables with primary keys, foreign keys, constraints, indexes, and sample data.

The backend includes a reusable `BaseDao` and entity-specific DAO classes for users, categories, venues, events, registrations, and reviews. Database access is configured through `backend/config/Database.php`.

**Local database setup:**

1. Start MySQL using XAMPP.
2. Open [phpMyAdmin](http://localhost/phpmyadmin).
3. Import `database/event_management.sql`.
4. Copy `backend/config/config.example.php` to `backend/config/config.php`.
5. Update the database credentials in `backend/config/config.php` for your local environment.

The local `backend/config/config.php` file contains environment-specific credentials and must not be committed to Git.

The DAO layer has been checked for PHP syntax errors. The database connection and CRUD operations for `UserDao` have been tested locally.

## Running the Frontend Locally

1. Install and start Apache using XAMPP.
2. Place or clone the project inside the XAMPP `htdocs` directory.
3. Open the following URL in a browser:

   `http://localhost/Event-Management-System2/frontend/views/index.html`

The frontend is a static prototype. Backend API routing, services, authentication, and frontend-backend integration will be implemented in subsequent milestones.

## External API

A weather API is planned as a potential feature for displaying weather information for an event's location and date. The specific API and integration will be determined during implementation.
