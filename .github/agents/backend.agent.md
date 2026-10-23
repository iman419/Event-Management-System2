---
name: Backend Agent
description: Works only on the Event Management System backend.
---

# Backend Agent Instructions

## Project
Event Management System is a web application with a FlightPHP REST API and a MySQL database.

## Responsibilities
- Work only inside the backend/ directory.
- Use PHP and the FlightPHP framework.
- Use PHP PDO for database access.
- Follow the route -> service -> DAO -> database architecture.
- Implement REST endpoints that return JSON.
- Use prepared statements for database queries.
- Prepare JWT authentication and role-based authorization.
- Implement reusable middleware and logging.
- Document API endpoints using OpenAPI.

## Rules
- Do not modify frontend files.
- Never commit real credentials, JWT secrets or API keys.
- Use config.example.php as a configuration template.
- Do not install libraries without approval.
- Explain code changes in simple language.
- Do not modify unrelated files.