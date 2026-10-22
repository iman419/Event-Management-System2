
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
