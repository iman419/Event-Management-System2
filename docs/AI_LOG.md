
# AI Log

## Milestone 1

### Tools and Tasks

- **Tool:** ChatGPT.
- **Tasks:** Project planning, repository setup, preparation of AI documentation, static frontend development, SPA navigation, responsive design checks, and ERD planning.
- **What was done:** Prepared `AGENTS.md`, three custom agent instruction files, the `update-ai-log` skill, the initial project structure, the static EventHub frontend, and the draft ERD.
- **Review:** The frontend was opened locally through XAMPP. SPA navigation, the mobile menu, the Login and Register views, the Administration view, and the event preview form were manually checked.

### Case 1: Incorrect AI Log File Location

- **What went wrong:** The AI initially guided the setup in a way that left `AI_LOG.md` in the project root instead of the required `docs/AI_LOG.md` location.
- **How the problem was noticed:** The project requirements and folder structure were checked against the required documentation location.
- **How it was corrected:** The file was moved to `docs/AI_LOG.md`, and the change was committed and pushed to the `milestone1` branch.

### Case 2: Incorrect Guidance About Creating the Skill

- **What went wrong:** The AI initially gave confusing guidance about where to create the `update-ai-log` skill, leading to uncertainty about its required location.
- **How the problem was noticed:** The folder structure was reviewed against the intended skill path.
- **How it was corrected:** The skill was placed at `.agents/skills/update-ai-log/SKILL.md`.

### Outstanding Checks

- Verify that all required folders and documentation files are tracked by Git.
- Verify the complete README content against the M1 requirements.
- Review the final Git status and push any remaining changes.
- Confirm the ERD renders correctly on GitHub.


## Milestone 2

### Tools and Tasks

- **Tool:** ChatGPT and XAMPP (PHP CLI, MySQL, phpMyAdmin).
- **Tasks:** MySQL schema creation, database configuration, reusable Base DAO implementation, and DAO classes for users, categories, venues, events, registrations, and reviews.
- **What was done:** Added `database/event_management.sql` with six relational tables, primary and foreign keys, and sample records. Added `backend/config/Database.php`, `backend/config/config.example.php`, `backend/dao/BaseDao.php`, and six entity-specific DAO classes.
- **Configuration and security:** Created a local `backend/config/config.php` for database credentials. It is excluded from Git; only `config.example.php` is intended to be committed.
- **Verification:** Imported the SQL file through phpMyAdmin and confirmed that the database contains six tables and sample users. Verified the PDO MySQL connection, tested `UserDao` read operations, and tested create, update, and delete operations on a temporary user record. The temporary test user was deleted successfully. PHP syntax checks passed for all seven DAO PHP files.

### AI Assistance and Review

- ChatGPT assisted with preparing the SQL schema, database configuration, reusable DAO methods, and entity-specific DAO classes.
- The generated code was checked using PHP syntax checks and local MySQL tests. The database connection and `UserDao` operations were tested in XAMPP.

### Outstanding Checks

- Review the DAO implementation and SQL schema against all Milestone 2 requirements.
- Verify that the README and `AGENTS.md` accurately describe the current project.
- Check the final staged changes and confirm that local credentials are not included.
- Commit and push the Milestone 2 changes on the `milestone2` branch, then open a pull request.

