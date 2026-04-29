# Sirah – Database Schema

## Core Tables

### `settings`
The settings table is a **single-record** table that stores global site configuration.
| Column | Type | Description |
|--------|------|-------------|
| id | bigint PK | Always ID 1 |
| owner_name | string | Name of the site owner |
| contact_email | string | Target email for contact form |
| default_language | string | Fallback locale (e.g. `en`) |
| site_active | boolean | Maintenance mode toggle |
| maintenance_message | text | Message shown when site is inactive |
| site_logo | string | Path to custom logo |
| site_favicon | string | Path to custom favicon |
| show_site_name | boolean | Toggle Visibility of site name next to logo |

---

### `profiles`
Stores biographical information for each language.
| Column | Type | Description |
|--------|------|-------------|
| id | bigint PK | |
| language | string(10) | **UNIQUE** (ar, en, etc.) |
| title | string | Name/Identity shown in hero |
| hero_title | string | Main heading (e.g. Developer) |
| hero_subtitle | string | Tagline |
| about_title | string | Title for About Section |
| about_me | text | Biographical content |
| profile_photo | string | Path to hero image |
| about_photo | string | Path to secondary profile image |
| stats | json | `[{"label": "Title", "value": "20+"}]` |

---

### `categories`
Categorization system for various modules.
| Column | Type | Description |
|--------|------|-------------|
| id | bigint PK | |
| type | string | **INDEX** (`work`, `page`, etc.) |
| name | string | Display name |
| slug | string | URL identifier |
| language | string(10) | |
| options | json | Optional metadata |

**Unique Key:** `(slug, language)`

---

## Content Tables

### `works`
Portfolio projects.
| Column | Type | Description |
|--------|------|-------------|
| id | bigint PK | |
| title | string | |
| slug | string | |
| description | json | **Content Builder Blocks** (Rich Text, Features, etc.) |
| cover_image | string | Primary card image |
| video_url | string | Embeddable video link |
| links | json | `[{"label": "Source", "url": "..."}]` |
| language | string(10) | |
| category_id | FK | → `categories.id` |
| sort_order | int | |
| published_at | timestamp | Nullable |

**Unique Key:** `(slug, language)`

### `work_images`
Gallery for works.
| Column | Type | Description |
|--------|------|-------------|
| work_id | FK | → `works.id` (cascade) |
| path | string | |
| caption | string | Optional text |
| sort_order | int | |

---

### `resumes`
Professional experience and education.
| Column | Type | Description |
|--------|------|-------------|
| id | bigint PK | |
| language | string | **UNIQUE** |
| is_active | boolean | |
| summary | text | Professional summary |
| experience | json | `[{title, company, period, description}]` |
| education | json | `[{degree, institution, period}]` |
| skills | json | `[{name, level}]` |
| certifications | json | `[{name, issuer, year}]` |
| pdf_path | string | Downloadable CV |

---

### `pages`
Static content pages.
| Column | Type | Description |
|--------|------|-------------|
| id | bigint PK | |
| title | string | |
| link_title | string | Text for navigation link |
| slug | string | |
| content | longtext | Rich text body |
| language | string(10) | |
| category_id | FK | Optional |
| is_published | boolean | |
| display_position | string | `none`, `navbar`, `footer` |

**Unique Key:** `(slug, language)`

---

### `social_links`
External social media presence.
| Column | Type | Description |
|--------|------|-------------|
| id | bigint PK | |
| platform | string | e.g. `github`, `linkedin` |
| url | string | |
| icon | string | Icon class or name |
| sort_order | int | |
