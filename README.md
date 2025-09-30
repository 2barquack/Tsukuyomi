# Tsukuyomi
# Project Tsukuyomi

Project Tsukuyomi is a custom WordPress WP-CLI tool that creates and manages a `form_submits` database table.  
It validates required fields, stores metadata (IP, API IDs, JSON), and provides commands for inserting, listing, and configuring entries.  
Built for flexible form handling, API integration, and security extensions.

---

## Features
- Creates `form_submits` table if it doesn’t exist
- Required fields: `email`, `first_name`, `last_name`, `lead_source`, `type`
- Optional fields: `form_json`, `api_return_id`, `ip_address`
- Automatic `created_at` timestamps
- Email validation before insertion
- WP-CLI commands:
  - `wp pci_form_submits create_table`
  - `wp pci_form_submits insert --email=... --first_name=... --last_name=... --lead_source=... --type=...`
  - `wp pci_form_submits list`
  - `wp pci_form_submits config --endpoint=https://api.example.com`

---

## Installation
1. Place `pci_form_submits.php` into your theme’s `functions.php` or `wp-content/mu-plugins/`
2. Run the following in WP-CLI:
   ```bash
   wp pci_form_submits create_table
