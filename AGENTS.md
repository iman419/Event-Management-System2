# AGENTS.md

## Project
Event Management System is a web application for discovering events and managing event registrations.
Roles: admin, user.
Entities: users, events, categories, venues, registrations, reviews.

## Technology Stack
- Frontend: HTML, CSS, JavaScript, Bootstrap 5, single-page application (SPA).
- Backend: PHP with FlightPHP REST API.
- Database: MySQL accessed through PHP PDO.
- API documentation: OpenAPI and Swagger.
- Authentication: JWT.
- Local development: XAMPP.

## Folder Structure
- frontend/: css/, js/, views/, assets/
- backend/: routes/, services/, dao/, middleware/, config/, logs/
- docs/: AI_LOG.md and project documentation.

## Frontend Rules
- Keep frontend code separate from backend code.
- Use HTML, CSS, JavaScript and Bootstrap 5.
- Make the application responsive and mobile-friendly.
- Each view should be organized in frontend/views/.
- Use AJAX to communicate with the backend when the API is implemented.

## Backend Rules
- Use FlightPHP for REST API routes.
- Follow the route -> service -> DAO -> database architecture.
- Only service classes may call DAO classes.
- Use PHP PDO prepared statements for database queries.
- Return JSON responses with appropriate HTTP status codes.
- Use reusable middleware for authentication, authorization, request logging and error handling.

## Database Rules
- Use MySQL with primary keys and foreign keys.
- Use snake_case for database tables and columns.
- Implement CRUD operations for at least five entities.
- Do not change the database schema without discussing the change first.

## Security Rules
- Hash passwords securely.
- Use JWT for authentication and authorization.
- Store credentials, JWT secrets and API keys in configuration files excluded from Git.
- Commit config.example.php instead of files containing real secrets.
- Never expose stack traces, SQL queries or secrets in API responses.

## AI Assistant Rules
- Explain changes in simple language.
- Work in small steps and list changed files.
- Do not add libraries or frameworks without approval.
- Do not modify unrelated files.
- Do not invent project requirements or AI log entries.
- Ensure the student understands the code before accepting it.
