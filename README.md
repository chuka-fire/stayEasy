# StayEasy

An internal hotel management tool for the staff of a single hotel. Staff log in to
manage guests and bookings at the front desk; managers get extra powers on top.

Guests never log in. Their records are created by staff at the desk, which is why
`Guest` is a separate model from `User` rather than another kind of user.

## What a user can do

A **staff member** can:

- See the dashboard with today's arrivals and departures
- See the list of rooms and the details of any room
- See the list of guests, add a new guest, and see a guest's booking history
- See the list of bookings and the details of any booking
- Create a booking for a room and a guest over a range of dates
- Check a guest in, and check them out again

A **manager** can do everything a staff member can, and also:

- Add, edit and delete rooms
- Cancel a booking
- See the list of staff accounts, and create, edit or remove them

A user whose account has been marked inactive cannot use the app at all, even
with the right password. This is how a former employee is turned off without
deleting their record, which would also take their bookings with it.

## Business rules

- **A room cannot be double-booked.** A new booking is refused if its dates
  overlap an existing, non-cancelled booking of the same room. Same-day
  turnover is fine: one guest can check out and another check in on the same day.
- **The total price is calculated by the app**, never typed in. It is the number
  of nights multiplied by the room's price per night, worked out in the controller
  when the booking is created.
- **A booking moves through its statuses in order**: booked, then checked in,
  then checked out. Only a manager can cancel, and only before checkout.
- **A staff member who has created bookings cannot be removed**, since their
  bookings record who took them.

## Running it

Requires PHP 8.4+ and Composer. The database is SQLite, so there is nothing to
configure.

```bash
composer install
```

```bash
cp .env.example .env
```

```bash
php artisan key:generate
```

```bash
php artisan migrate:fresh --seed
```

```bash
php artisan serve
```

The seeder creates a manager account, five staff accounts, ten rooms, ten guests
and fifteen bookings.

**Log in as the manager:** `admin@admin.com` with the password `password`.

Seeded staff accounts also use `password`; their email addresses are visible on
the Staff page once you are logged in as the manager.

## Running the tests

```bash
php artisan test
```

## How it is built

- **Models:** `User`, `Room`, `Guest`, `Booking`
- **Relations:** three one-to-many — a booking belongs to the staff member who
  created it, to a room, and to a guest
- **Roles:** two booleans on `User` (`is_staff`, `is_manager`); there is no Role model
- **Permissions:** `auth` and `staff` middleware on the routes, `isManager()`
  checked in controllers to return 403, and checked again in views to hide
  buttons the user cannot use
