# Sirah – Modules

## Profile Module ✨

**Model:** `App\Models\Profile`  
**Resource:** `App\Filament\Resources\ProfileResource`  

The Profile module handles personal branding and hero section content. It is fully **multi-language**, allowing a unique profile per active language.

- **Hero Section**: `title`, `hero_title`, `hero_subtitle`, `profile_photo`.
- **About Section**: `about_title`, `about_me`, `about_photo`.
- **Stats**: A JSON repeater for key metrics (e.g. "Projects: 50+", "Experience: 10 yrs").

---

## Works Module

**Model:** `App\Models\Work`  
**Resource:** `App\Filament\Resources\WorkResource`  
**Routes:** `/{locale}/works`, `/{locale}/works/{slug}`

The Works module uses a **Dynamic Content Builder** (JSON) instead of a simple text area, allowing for professional case studies.

### Dynamic Blocks:
1. **Rich Text**: Standard HTML content for narrative.
2. **Feature Grid**: A grid of icons, titles, and descriptions for key project highlights.
3. **Challenge & Solution**: Specific layout for presenting problem-solving facets of a project.

**Media & Links:**
- Supports a single **Cover Image**.
- **Gallery**: Multiple images with captions and ordering.
- **Video**: URL for embeddable project videos (YouTube/Vimeo).
- **External Links**: Dynamic list of project-related URLs (GitHub, Live Demo, etc.).

---

## Resume Module

**Model:** `App\Models\Resume`  
**Resource:** `App\Filament\Resources\ResumeResource`  
**Route:** `/{locale}/resume`

- **One resume per language** (UNIQUE constraint).
- **Structured Data (JSON)**:
  - **Experience**: Title, Company, Period, Description.
  - **Education**: Degree, Institution, Period.
  - **Skills**: Name, Level (Percentage/Rating).
  - **Certifications**: Name, Issuer, Year.
- **Toggle**: `is_active` to hidden/show specific language resumes.

---

## Pages Module

**Model:** `App\Models\Page`  
**Resource:** `App\Filament\Resources\PageResource`  
**Route:** `/{locale}/{slug}`

- **Navigation Support**: `display_position` allows placing page links in the `navbar`, `footer`, or `none`.
- **Link Customization**: `link_title` allows a different name in the menu than the page title.

---

## Categories Module

**Model:** `App\Models\Category`  
**Resource:** `App\Filament\Resources\CategoryResource`

Sirah uses a **Polymorphic Category System** managed via a `type` column.
- Current types: `work`, `page`.
- Each category is language-specific.

---

## Settings Module ⚙️

**Page:** `App\Filament\Resources\Settings\SettingResource` (Custom Edit-only Resource)  
**Model:** `App\Models\Setting`

Managed as a **Single Record** (ID: 1).
- **Identity**: Site name, Owner name, Site Logo, Favicon.
- **Maintenance**: `site_active` toggle and `maintenance_message`.
- **Global**: `contact_email`, `default_language`.

---

## Social Links

**Model:** `App\Models\SocialLink`  
**Resource:** `App\Filament\Resources\SocialLinkResource`

Dynamic, reorderable list of social presence. Icons are stored as string classes (e.g. FontAwesome or Heroicons classes).

---

## Contact System

**Controller:** `App\Http\Controllers\ContactController`  
**Service:** `App\Services\ContactMailService`  
**Mail:** `App\Mail\ContactMail`

- Form validates inputs and sends directly to the `contact_email` setting.
- Uses `ContactMail` for clean, responsive email templates.
