# Candoor Backend

Laravel REST API powering the Candoor platform — a mentorship app connecting advisees with advisors.

## What I Fixed

I tracked down and fixed a timezone bug that was causing meeting times to display incorrectly for users in different timezones. The problem was that times were being stored in whatever local timezone the user happened to be in, so when someone in Toronto booked a slot and someone in Nairobi viewed it, the times were completely off.

I reworked the storage layer to convert all times to UTC before saving to the database, then on the way out I convert them back to each user's own timezone based on what they selected at signup. I also added a dual-timezone display on the confirmed meeting page so both the advisor and advisee can see the time in their own timezone as well as the other person's — no more confusion about when the meeting actually is.

## Stack

- PHP / Laravel 8
- MySQL
- JWT Auth
- Carbon for timezone handling

## Getting Started

```bash
git clone https://github.com/ANDREWABU/CANDOOR-BACK-END-.git
cd candoor-backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```
