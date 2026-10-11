# StayEasy — CLAUDE.md

## What this is
Internal hotel management tool for one hotel. University course project (Software Development Basics). Full spec in `StayEasy_App_Proposal.docx`, build sequence in `plan.md`.

## How to work
- Follow `plan.md` top-to-bottom, one unchecked step at a time.
- Before building: explain what, why, and which files. Build only that step, then stop.
- Never commit. I review diffs and commit myself.
- MANUAL steps are mine. Run the VERIFY check after and report.
- DEFENSE steps: I explain; correct me if wrong.
- Don't re-read plan.md or the proposal each prompt — reference steps by number.

## Conventions (match the course)
- Explicit named routes, one per line, no Route::resource.
- Controllers: $id + find(), inline validation, compact(), redirect to named route after writes.
- Models: $guarded = [], relations with return types + explicit FK, both directions.
- Naming: singular capitalized models, lowercase props, modelname_id keys.
- Views: one folder per model, <x-site-layout>, old input + errors, Tailwind via CDN.
- Commits: `TYPE :emoji: Message` — FEATURE :sparkles:, BUGFIX :bug:, REFACTOR :hammer:, DESIGN :art:, CLEANUP :broom:, CONTENT :pencil:.
- Laravel 12 syntax. Livewire starter kit for auth.
