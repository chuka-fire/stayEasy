# StayEasy — Build Plan

Internal hotel management tool for the staff of one hotel. Staff log in; managers get extra powers. Full scope is in the submitted proposal (StayEasy_App_Proposal). Build that scope and nothing more.

---

## How to use this plan

- Work top to bottom, **one unchecked step at a time**.
- **Claude Code:** before building a step, explain what you'll do, why, and which files it touches. Build only that step, then stop. Don't commit; I do that.
- **🧑 MANUAL** steps are mine (Herd, browser, GitHub Desktop, DB Browser). Afterwards, Claude Code runs the **✅ VERIFY** check and tells me if it's right.
- After each step: I review the diff, commit with the **💾** message, and tick the box.
- **🎓 DEFENSE** checks close each phase: I explain it back in my own words, and Claude Code corrects me.

---

## Design decisions

- **Guest is a separate model.** Guests never log in; staff create their records at the desk. The course rule "use User for different kinds of people" is about people who log in. Merging would mean unused password fields, an extra flag to tell a guest from a deactivated staff member, and two foreign keys from Booking to the same table.
- **Roles are two booleans on User** (`is_staff`, `is_manager`), as Nico recommended. There's no Role model.
- **Permissions follow the course pattern:** `auth` middleware on routes, `isManager()` checked in controllers (403) and in views (hide buttons).
- **Login uses the Livewire starter kit**, the same as the demo project. Public registration is removed; managers create staff accounts.
- **Total price is calculated by the app**, never typed into a form.

## Conventions (match the course)

- Explicit named routes, one line per action, no `Route::resource`.
- Controllers: receive `$id` and use `find()`, inline validation, `compact()` for view data, and a redirect to a named route after every POST/PUT/PATCH/DELETE.
- Models: `$guarded = []`, relations with return types and an explicit foreign key, defined in both directions. belongsTo is singular; hasMany is plural.
- Naming: singular capitalised models, lowercase properties, `modelname_id` keys, no shortnames, no model name inside a property name.
- Views: one folder per model, `<x-site-layout>`, forms keep old input and show errors, Tailwind via CDN.
- Commits: `TYPE :emoji: Message` using FEATURE :sparkles:, BUGFIX :bug:, REFACTOR :hammer:, DESIGN :art:, CLEANUP :broom:, CONTENT :pencil:.
- The course targets Laravel 12. Use that version's docs and syntax.

---

## Phase 0 — Getting ready

- [x] **0.1 🧑 Create the project in Herd** — new Laravel project `stayeasy` with the Livewire starter kit, Laravel's built-in auth, Pest, and SQLite.
  ✅ VERIFY: Livewire kit installed, `DB_CONNECTION=sqlite`, Laravel version reported (course uses 12).
- [x] **0.2 🧑 Open `stayeasy.test`** — the default welcome page loads, with login and register links.
- [x] **0.3 🧑 Start Git and connect a public GitHub repo** (GitHub Desktop).
  ✅ VERIFY: working tree clean, remote points to GitHub. 💾 `Initial commit`
- [x] **0.4 Add this plan to the repo** — so the build history starts from the plan. 💾 `CONTENT :pencil: Add build plan`

## Phase 1 — Data: models, migrations, factories, seeding

- [x] **1.1 Add role flags to users** — `is_staff` and `is_manager` booleans (default false) in the existing users migration, cast as booleans on User. 💾 `FEATURE :sparkles: Add is_staff and is_manager flags to users`
- [x] **1.2 Update the User factory** — fake users are staff by default and not managers. 💾 `FEATURE :sparkles: Make factory users staff by default`
- [x] **1.3 Room model** — model, migration, and factory: `number`, `type` (single/double/suite), `price_per_night`. 💾 `FEATURE :sparkles: Add the Room model`
- [x] **1.4 Guest model** — model, migration, and factory: `name`, `email`, `phone`. 💾 `FEATURE :sparkles: Add the Guest model`
- [x] **1.5 Booking model** — model, migration, and factory: `user_id`, `room_id`, `guest_id`, `check_in`, `check_out`, `total_price`, `status` (default `booked`). 💾 `FEATURE :sparkles: Add the Booking model`
- [ ] **1.6 Relation: User ↔ Booking** — a booking belongs to the staff member who created it; a user has many bookings. 💾 `FEATURE :sparkles: Relate bookings to the staff member who created them`
- [ ] **1.7 Relation: Room ↔ Booking** — a booking belongs to a room; a room has many bookings. 💾 `FEATURE :sparkles: Relate bookings to rooms`
- [ ] **1.8 Relation: Guest ↔ Booking** — a booking belongs to a guest; a guest has many bookings. 💾 `FEATURE :sparkles: Relate bookings to guests`
- [ ] **1.9 Seed the admin manager** — `admin@admin.com` / `password`, both flags true, created first in DatabaseSeeder. 💾 `FEATURE :sparkles: Seed admin manager`
- [ ] **1.10 Seed test data** — staff users, rooms, guests, then bookings. Factory foreign-key ranges must match the seeded counts. 💾 `FEATURE :sparkles: Seed staff, rooms, guests and bookings`
- [ ] **1.11 🧑 Run `php artisan migrate:fresh --seed`** and inspect the tables in DB Browser.
  ✅ VERIFY: no errors, every table has rows, every booking points to an existing user, room and guest.
- [ ] **1.12 🎓 DEFENSE** — explain the three one-to-many relations, which table holds each foreign key, and why.

## Phase 2 — Showing data: layout, index and show views

- [ ] **2.1 Site layout component** — `SiteLayout` with header, main and footer, a title property, and Tailwind via CDN. 💾 `FEATURE :sparkles: Add the SiteLayout template`
- [ ] **2.2 Welcome route through a controller** — replace the starter kit's view-only route with a WelcomeController. 💾 `REFACTOR :hammer: Move welcome route to a controller`
- [ ] **2.3 StayEasy welcome page** — replace the default Laravel page with a short app intro and a login link. 💾 `DESIGN :art: Replace default welcome page with StayEasy landing`
- [ ] **2.4 Rooms index** — list all rooms (`rooms.index`). 💾 `FEATURE :sparkles: Add the list of rooms (index)`
- [ ] **2.5 Room show** — details of one room, linked from the index (`rooms.show`). 💾 `FEATURE :sparkles: Add the details of one room (show)`
- [ ] **2.6 Guests index** — list all guests. 💾 `FEATURE :sparkles: Add the list of guests (index)`
- [ ] **2.7 Guest show** — guest details plus their booking history. 💾 `FEATURE :sparkles: Show guest details with booking history`
- [ ] **2.8 Bookings index** — list bookings with room number, guest name and dates. 💾 `FEATURE :sparkles: Add the list of bookings (index)`
- [ ] **2.9 Booking show** — one booking with room, guest, staff member, price and status. 💾 `FEATURE :sparkles: Add the details of one booking (show)`
- [ ] **2.10 Navigation** — header links to Rooms, Guests and Bookings. 💾 `DESIGN :art: Add navigation to the header`
- [ ] **2.11 🧑 Click through every page** in the browser.
  ✅ VERIFY: no errors, and relation data (names, room numbers) shows correctly.
- [ ] **2.12 🎓 DEFENSE** — explain the request flow for `/rooms/3`: route → controller → model → view → response.

## Phase 3 — Input: CRUD

- [ ] **3.1 Create a room** — form and store, then redirect to the new room. 💾 `FEATURE :sparkles: Add the create new room functionality`
- [ ] **3.2 Edit a room** — edit form and update. 💾 `FEATURE :sparkles: Add the edit room functionality`
- [ ] **3.3 Delete a room** — delete button on room show. Room now has all 7 resource actions. 💾 `FEATURE :sparkles: Add the delete room functionality`
- [ ] **3.4 Add a guest** — form and store. 💾 `FEATURE :sparkles: Add the create new guest functionality`
- [ ] **3.5 🧑 Create, edit and delete a room; add a guest** in the browser.
  ✅ VERIFY: changes appear in the database, and every route maps to a controller function (`php artisan route:list`).
- [ ] **3.6 🎓 DEFENSE** — name the 7 resource actions, their HTTP methods, and why PUT/DELETE forms need `@method`.

## Phase 4 — Trusting the user: validation and authentication

- [ ] **4.1 Validate room input** — required fields, unique room number, allowed types, positive price. 💾 `FEATURE :sparkles: Validate room form contents`
- [ ] **4.2 Keep old input and show errors** on the room forms. 💾 `FEATURE :sparkles: Don't lose old form content on room forms`
- [ ] **4.3 Validate guest input** with old input and errors. 💾 `FEATURE :sparkles: Validate guest form contents`
- [ ] **4.4 Success messages** — MessageBlock component shows a flashed message after saving or deleting. 💾 `FEATURE :sparkles: Implement success messages`
- [ ] **4.5 Protect staff routes** — everything except welcome and login sits in an `auth` group. 💾 `FEATURE :sparkles: Protect all staff routes with auth`
- [ ] **4.6 Remove public registration** — drop the register route and its link. 💾 `CLEANUP :broom: Remove public registration`
- [ ] **4.7 Dashboard through a controller** — replace the starter kit's dashboard route with DashboardController (simple page for now); login still lands here. 💾 `REFACTOR :hammer: Move dashboard route to a controller`
- [ ] **4.8 Remove unused starter-kit pages** — settings pages and their routes and tests; `php artisan test` must still pass. 💾 `CLEANUP :broom: Remove unused starter kit pages`
- [ ] **4.9 Auth info in the header** — logged-in user's name and a logout button. 💾 `DESIGN :art: Add auth info to the header`
- [ ] **4.10 🧑 Test auth** — log in as admin, log out, open `/rooms` while logged out, open `/register`, submit an invalid room form.
  ✅ VERIFY: redirected to login, `/register` gives 404, errors show and input is kept.
- [ ] **4.11 🎓 DEFENSE** — explain authentication vs authorisation, and what the `auth` middleware does.

## Phase 5 — What a user can do: bookings and business logic

- [ ] **5.1 Role helpers** — `isStaff()` and `isManager()` on User. 💾 `FEATURE :sparkles: Add role helper methods to User`
- [ ] **5.2 Create a booking** — pick room, guest and dates; `user_id` comes from the logged-in user. Validate that rooms and guests exist and check-out is after check-in. 💾 `FEATURE :sparkles: Add the create new booking functionality`
- [ ] **5.3 Calculate the total price** — nights × the room's price per night, in the controller. 💾 `FEATURE :sparkles: Calculate booking total price`
- [ ] **5.4 Prevent double-booking** — reject dates that overlap another non-cancelled booking of the same room, with an error on the form. 💾 `FEATURE :sparkles: Prevent double-booking a room`
- [ ] **5.5 Check in / check out** — status buttons on booking show, using a validated status value. 💾 `FEATURE :sparkles: Allow checking guests in and out`
- [ ] **5.6 Managers only can cancel** — the controller refuses `cancelled` for non-managers (403), and the cancel button shows for managers only. 💾 `FEATURE :sparkles: Business logic - only managers can cancel bookings`
- [ ] **5.7 Managers only manage rooms** — create, edit and delete return 403 for staff, and their buttons are hidden. 💾 `FEATURE :sparkles: Business logic - only managers manage rooms`
- [ ] **5.8 Staff accounts: list and add** — manager-only UserController index, create and store, setting both flags. 💾 `FEATURE :sparkles: Managers can list and add staff`
- [ ] **5.9 Staff accounts: edit and remove** — manager-only edit, update and destroy. 💾 `FEATURE :sparkles: Managers can edit and remove staff`
- [ ] **5.10 Staff link for managers only** in the header. 💾 `DESIGN :art: Show staff link to managers only`
- [ ] **5.11 Dashboard content** — today's check-ins and check-outs. 💾 `FEATURE :sparkles: Show today's check-ins and check-outs on dashboard`
- [ ] **5.12 (Optional — decide first) Block deactivated staff** — small middleware that turns away users with `is_staff` false. Skip it to keep the flag as stored data only. 💾 `FEATURE :sparkles: Block deactivated staff accounts`
- [ ] **5.13 🧑 Test both roles** — as admin (manager) and as a seeded staff user: try a double booking, cancel as staff, and open manager URLs directly as staff.
  ✅ VERIFY: overlap rejected, price correct, staff get 403 and see no manager buttons.
- [ ] **5.14 🎓 DEFENSE** — explain the double-booking check, the price calculation, and where each permission is enforced (route, controller, view).

## Phase 6 — Review and submit

- [ ] **6.1 Business logic in plain text** — "a staff member can…, a manager can also…", added to the README. 💾 `CONTENT :pencil: Describe business logic`
- [ ] **6.2 LLM review, one area at a time** — use the course's review prompts for models, routes, controllers, views, then business logic. Apply each fix as its own commit. 💾 `REFACTOR :hammer: <fix> based on LLM feedback`
- [ ] **6.3 README** — what StayEasy is, how to run it (`migrate:fresh --seed`), and the admin login. 💾 `CONTENT :pencil: Add README`
- [ ] **6.4 🧑 Final run like the examiner** — `migrate:fresh --seed`, open the welcome page, log in as admin, click every route.
  ✅ VERIFY: no errors, `php artisan test` passes, every route maps to a controller.
- [ ] **6.5 🧑 Push to GitHub, submit the form, book the assessment slot.**
- [ ] **6.6 🎓 DEFENSE** — explain why Guest is separate from User, out loud, in under a minute.
