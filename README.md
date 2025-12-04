✅ Setup Steps (1 to 7)
## 🧩 Setup Instructions (Step 1 to Step 7)

### **Step 1 — Clone the Repository**
Download the project to your system:
```bash
git clone <repository-url>
cd news-aggregator

Step 2 — Install Composer Dependencies

Install all Laravel and package dependencies:

composer install

Step 3 — Create & Configure .env File

Create your environment configuration file:

cp .env.example .env


Update the .env file with:

APP_NAME=NewsAggregator
APP_ENV=local
APP_KEY=
APP_DEBUG=true

DB_DATABASE=news
DB_USERNAME=root
DB_PASSWORD=

NEWSAPI_KEY=your_newsapi_key
GUARDIAN_KEY=your_guardian_key
NYT_KEY=your_nyt_key

QUEUE_CONNECTION=database


⚠ API Keys are shared privately via email and must be inserted manually into the .env file.

Step 4 — Generate Application Key

Required for Laravel encryption:

php artisan key:generate

Step 5 — Run Migrations

This will create all required database tables:

php artisan migrate


This includes:

articles table

jobs table

failed_jobs table

Step 6 — Start Queue Worker

Queue is used to fetch news asynchronously.

Start the worker:

php artisan queue:work


Leave this terminal running.

Step 7 — Fetch News from All Sources

Manually trigger the fetch job dispatch:

php artisan news:fetch-all