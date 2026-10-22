# Event Management System

## Project Description

Event Management System is a web application for managing events, venues, categories, and user registrations. The application will allow users to discover events and manage their registrations, while administrators will manage event-related information.

## User Roles

- **User:** Browse events and manage event registrations.
- **Admin:** Manage events, categories, and venues.

## Planned Entities

The initial database design includes:

- Users
- Events
- Categories
- Venues
- Registrations
- Reviews

See [`docs/ERD.md`](docs/ERD.md) for the draft entity-relationship diagram.

## Technology Stack

- **Frontend:** HTML, CSS, JavaScript, Bootstrap 5
- **Backend:** PHP and FlightPHP
- **Database:** MySQL
- **API Documentation:** OpenAPI and Swagger
- **Authentication:** JWT
- **Local Development:** XAMPP

## Project Structure

- `frontend/` — frontend files, styles, scripts, views, and assets
- `backend/` — API routes, services, data access, middleware, configuration, and logs
- `docs/` — project documentation, ERD, and AI usage log
- `.github/agents/` — custom AI agent instructions
- `.agents/skills/` — project-specific AI skills

## Project Status

**Milestone 1 — Setup, Static Frontend, and ERD**

The project repository, initial documentation, folder structure, static frontend prototype, and draft ERD are being prepared.

## External API

A weather API is planned as a potential feature for displaying weather information for an event's location and date. The specific API and integration will be determined during implementation.

## Running the Frontend Locally

1. Install and start Apache using XAMPP.
2. Place or clone the project inside the XAMPP `htdocs` directory.
3. Open the following URL in a browser:

   `http://localhost/Event-Management-System2/frontend/views/index.html`

The current frontend is a static prototype. Backend integration, database functionality, and authentication will be implemented in later milestones.
