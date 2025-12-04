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

## 1. Clone the Repository
```bash
git clone <repository-url>
cd news-aggregator
