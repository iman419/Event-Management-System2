
# Event Management System — ERD Draft

## Entities and Relationships

```mermaid
erDiagram
    USERS ||--o{ REGISTRATIONS : makes
    EVENTS ||--o{ REGISTRATIONS : receives
    CATEGORIES ||--o{ EVENTS : classifies
    VENUES ||--o{ EVENTS : hosts
    USERS ||--o{ REVIEWS : writes
    EVENTS ||--o{ REVIEWS : receives

    USERS {
        int user_id PK
        string full_name
        string email
        string password_hash
        string role
    }

    EVENTS {
        int event_id PK
        int category_id FK
        int venue_id FK
        string title
        string description
        datetime event_date
    }

    CATEGORIES {
        int category_id PK
        string name
        string description
    }

    VENUES {
        int venue_id PK
        string name
        string address
        string city
    }

    REGISTRATIONS {
        int registration_id PK
        int user_id FK
        int event_id FK
        datetime registration_date
        string status
    }

    REVIEWS {
        int review_id PK
        int user_id FK
        int event_id FK
        int rating
        string comment
    }
```

## Notes

- `PK` means Primary Key.
- `FK` means Foreign Key.
- One event belongs to one category and one venue.
- Users can register for multiple events.
- An event can have multiple registrations and reviews.
- This is a preliminary design for Milestone 1. The schema may be refined before database implementation.
