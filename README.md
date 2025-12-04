# 📰 Laravel News Aggregator (Backend Only)

This project is a **Laravel-based News Aggregator** that fetches news articles from multiple public news APIs,  
stores them locally, and exposes them through API & Blade UI with DataTables.

This challenge focuses on **backend development** using Laravel best practices (SOLID, DRY, KISS).

---

## 📌 Features

- Fetch news from **3 external sources**:
  - NewsAPI
  - The Guardian API
  - New York Times API
- Queue-based ingestion using Laravel Jobs
- Scheduled automatic updates using Cron
- Server-side DataTables for fast UI rendering
- Clean API endpoints for frontend consumption
- Filtering by category, source, and date
- Blade-based admin dashboard UI

---

# 🚀 Installation Guide

## 1. Follow Below Command
```bash
### **Step 1 — Clone the Repository**
git clone <repository-url>
cd newsaggregator

### **Step 2 — Install Dependencies**
composer install

### **Step 3 — Create & Configure .env File**
cp .env.example .env

### **Step 3 — Create & Configure .env File**
cp .env.example .env and replace with I shared .env file

### **Step 4 — Generate Laravel Application Key**
php artisan key:generate

### **Step 5 — Run Database Migrations**
1. First create table newsAggregator
2. Run this Command: "php artisan migrate"

### **Step 6 — Start the Queue Worker**
php artisan queue:work

### **Step 7 — Fetch News from All Sources**
php artisan news:fetch-all







