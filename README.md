# WP Content Connector

A WordPress plugin demonstrating modern full-stack development with FSE templates, React Gutenberg blocks, custom REST APIs, and production-grade SCSS architecture.

**Repository:** [github.com/t-huerne/wp-content-connector](https://github.com/t-huerne/wp-content-connector)

---

## 📋 Assignment Requirements

This plugin addresses four specific technical requirements with interconnected, production-ready code:

### ✅ 1. FSE HTML Template with Dynamic Date

**What it does:**

A custom single-post template that displays the current date dynamically (updates automatically) and shows related content to keep readers engaged. Think of it as a modern blog post layout that combines WordPress's native blocks with custom functionality.

**Why this approach:**

I chose Full Site Editing over traditional PHP templates because it's where WordPress is heading. FSE templates are HTML-based, which presents an interesting challenge: how do you add server-side dynamic content (like today's date) to what's essentially a static HTML file? The answer: shortcodes. This demonstrates understanding of how to bridge FSE's static nature with PHP's dynamic capabilities.

**The problem it solves:**

FSE templates can't execute PHP directly. By creating a custom shortcode that WordPress parses at render time, I can inject dynamic, server-generated content into FSE templates. This pattern is crucial for anyone working with modern WordPress.

**Technical implementation:**
- **File:** `templates/single-wcc-sample.html` - Block markup using HTML comments
- **Registration:** `includes/fse-integration.php` - Uses `get_block_templates` and `default_template_types` filters
- **Dynamic content:** `includes/shortcodes.php` - Custom `[current_date]` shortcode
- **Features:** Responsive two-column header, native WordPress blocks, custom styling

---

### ✅ 2. Advanced SCSS with Animations & Responsive Design

**What it demonstrates:**

Production-ready CSS architecture with multiple animations, mobile-first responsive design, and a maintainable structure that scales for team environments.

**Why modular SCSS:**

I've worked on projects where CSS becomes an unmaintainable mess. Splitting styles into logical modules (_variables, _mixins, _grid, _card, _post-header) means when you need to change the color scheme or spacing system, you edit one file. When multiple developers work on the same project, this separation prevents conflicts and makes code review easier.

**Advanced features implemented:**

**Animations & Transitions:**
- Card hover: Lifts 4px with shadow transition (0.3s ease)
- Image zoom: Scales to 1.05x on hover with smooth 0.5s transition
- Link color transitions: Subtle color change (0.2s)
- Featured image hover: translateY with shadow depth change

**Responsive Layout:**
- Mobile-first CSS Grid: 1 column → 2 columns (tablet) → 3 columns (desktop)
- Breakpoints at 768px and 1024px using SCSS variables
- Fluid typography with `clamp()` for scalable font sizes
- Column reordering on mobile (image-first for better UX)

**Architecture highlights:**
- Design tokens in `_variables.scss` (colors, spacing, breakpoints)
- Reusable mixins (`card-shadow`, `text-clamp`, `respond-to`)
- BEM naming for component clarity
- WCAG AA compliant color contrast ratios

**Why this matters:** This isn't just "CSS that works" - it's CSS built for collaboration, maintenance, and accessibility.

**Files:** `src/scss/` directory (compiles to `build/style-style.css`)

---

### ✅ 3. Custom React Gutenberg Block (No ACF)

**What it does:**

A "Related Posts" block built entirely in React (no ACF) that fetches posts from the same categories and displays them in a responsive grid. Editors can configure the number of posts (1-6) and date format directly in the block inspector, with live preview.

**Why custom React instead of ACF:**

The assignment required React without ACF, but this choice also demonstrates comfort with modern WordPress development patterns. While ACF would be faster for simple content blocks, custom React blocks offer advantages for complex, interactive components:

- **Full control:** Complete customization of editor experience and UI
- **Asynchronous capabilities:** Native support for API calls and state management
- **Modern patterns:** Uses WordPress's official Block Editor APIs
- **Marketplace ready:** React blocks can be distributed in the WordPress.org repository

For this specific use case (related posts), ACF would work fine. I chose React to show proficiency with the Block Editor's component library and demonstrate understanding of modern JavaScript patterns in WordPress development.
**The complexity here:**

1. **Dual rendering:** Different code paths for editor vs. frontend
   - Editor (`edit.js`): Shows preview with inspector controls
   - Frontend (`view.js`): Hydrates with React, fetches real data via AJAX

2. **Asynchronous data fetching:**
   - Uses `apiFetch` to call custom REST endpoint
   - Implements loading states, error handling
   - React hooks: `useState` for data/loading/error, `useEffect` for fetching

3. **WordPress integration:**
   - Inspector controls with `RangeControl` for post count
   - `TextControl` for date format customization
   - Proper block registration with `block.json` (API v3)

4. **User experience:**
   - Live preview as editors adjust settings
   - Graceful fallback for posts without images
   - Conditional rendering (only shows author if available)

**Why this approach:** Moving from ACF blocks to React Gutenberg blocks represents modern WordPress development. This shows I can work with WordPress's component library and understand the separation between editor UI and frontend rendering.

**Technical skills demonstrated:**
- React fundamentals (hooks, component lifecycle, state management)
- WordPress Block Editor APIs (`@wordpress/blocks`, `@wordpress/block-editor`, `@wordpress/components`)
- Asynchronous JavaScript with error handling
- Build tooling with `@wordpress/scripts` and Webpack

**Files:**
- `blocks/related-posts/block.json` - Block metadata
- `src/js/edit.js` - Editor component
- `src/js/view.js` - Frontend React with data fetching
- `src/js/index.js` - Block registration

---

### ✅ 4. Custom PHP Functions that Modify WordPress

**What it does:**

Three interconnected PHP functions that extend WordPress core functionality through proper APIs - no core file modifications, everything done through hooks and filters.

#### A. Custom REST API Endpoint

**Endpoint:** `/wp-json/wcc/v1/related-posts?post_id=123&limit=6`

**Purpose:** Powers the React block by providing related posts data via AJAX.

**Why REST API instead of direct queries?**
- **Decoupling:** Frontend doesn't need to know about database structure
- **Security:** Built-in WordPress authentication and permission handling
- **Flexibility:** Same endpoint can serve React blocks, mobile apps, or headless frontends
- **Standards:** WordPress REST API is the modern way to expose data

**Features implemented:**
- Finds posts sharing the same categories
- Full input validation (`post_id` must be numeric, `limit` between 1-12)
- Proper sanitization (security)
- Error handling with appropriate HTTP status codes (404, 400)
- Structured JSON responses
- Returns author avatar URLs (Gravatar integration)

**File:** `includes/related_posts_rest_api.php`

#### B. Excerpt Length Filter

**Hook:** `excerpt_length` filter

**What it does:** Changes WordPress default excerpt from 55 words to 25 words globally.

**Why this matters:** This demonstrates understanding of WordPress's hook system - the ability to modify core behavior without touching WordPress core files. It's a small change, but it shows I know how to properly extend WordPress using filters rather than hacking core or theme files.

**Pattern demonstrated:** Using `add_filter()` to intercept and modify WordPress output at the right moment in the rendering pipeline.

**File:** `includes/filters.php`

#### C. Dynamic Date Shortcode

**Shortcode:** `[current_date format="F jS, Y"]`

**Purpose:** Bridges the gap between FSE's static HTML templates and PHP's dynamic capabilities.

**Why shortcodes for FSE?** FSE templates are HTML files that can't execute PHP. Shortcodes are WordPress's way of allowing dynamic content in otherwise static contexts. This is essential knowledge for working with modern WordPress templating.

**Features:**
- Custom date format support (defaults to site setting)
- Uses `wp_date()` for proper internationalization
- Security: output escaped with `esc_html()`
- Follows WordPress shortcode best practices (`shortcode_atts()`)

**File:** `includes/shortcodes.php`

**Overall technical skills demonstrated:**
- WordPress REST API (registration, validation, error handling)
- Hook system (`add_filter`, `add_shortcode`, `add_action`)
- Security (sanitization, escaping, validation)
- WordPress Coding Standards
- Understanding of WordPress extensibility and rendering pipeline

---

## 🔗 How It All Connects

This isn't four isolated code samples - it's an integrated system:

1. **FSE Template** (`single-wcc-sample.html`) uses the **Dynamic Date Shortcode** and embeds the **Related Posts Block**
2. **Related Posts Block** (React) fetches data from the **REST API Endpoint** (PHP)
3. **REST API** queries WordPress database and returns formatted JSON
4. **SCSS** styles both the template layout and the block components
5. **PHP Functions** provide the data layer and extend WordPress functionality

This demonstrates full-stack WordPress development: templating, styling, JavaScript components, REST APIs, and WordPress core extensibility.

---

## 🛠️ Installation

```bash
# Clone into your WordPress plugins directory
cd wp-content/plugins/
git clone https://github.com/t-huerne/wp-content-connector.git

# Install dependencies and build
cd wp-content-connector
npm install
npm run build
```

Activate **WP Content Connector** in WordPress Admin (Plugins → Installed Plugins).

---

## 🧪 How to Test

1. **FSE Template:**
   - Edit any post
   - Click the Template button (top right)
   - Select "WCC Single Post"
   - Publish and view the post

2. **Related Posts Block:**
   - Create/edit a post
   - Add the "Related Posts" block
   - Configure settings in the block inspector (sidebar)
   - Assign categories to see related posts

3. **REST API:**
   - Visit: `/wp-json/wcc/v1/related-posts?post_id=1`
   - Should return JSON with related posts data

---

## 📝 Technical Decisions & Assumptions

**Why a plugin instead of a theme?**

Portability. Plugins can work with any theme, making the code more reusable and demonstrating understanding of WordPress's separation of concerns (functionality in plugins, presentation in themes).

**Build process:**

Uses `@wordpress/scripts` (WordPress's official build tool) with Webpack. This ensures compatibility with WordPress's JavaScript dependencies and follows recommended build practices.

**Assumptions:**
- WordPress 6.0+ with a Block Theme (FSE enabled)
- Modern browser support (ES6+, CSS Grid)
- Node.js 16+ for development

**Design philosophy:**
- Mobile-first responsive design
- Accessibility (WCAG AA color contrast)
- Performance (lazy loading, efficient queries)
- Security (sanitization, validation, escaping)
- Maintainability (modular code, clear naming)

---

## 🚀 Future Improvements

With more time, I would add:

1. **Server-Side Rendering (SSR):** Render initial HTML in PHP for better SEO and faster first paint, then hydrate with React for interactivity

2. **Query Caching:** Use WordPress Transients API to cache related posts queries, reducing database load

3. **Unit Tests:** Add Jest tests for React components and PHPUnit tests for REST API endpoints

4. **Enhanced Algorithm:** Use tags in addition to categories, or implement a scoring system for better "related" matches

5. **Admin Settings Page:** Let site admins configure default behavior (excerpt length, posts per page, etc.) via WordPress admin

---

## 📁 Project Structure

```
wp-content-connector/
├── wp-content-connector.php   # Main plugin file
├── blocks/
│   └── related-posts/
│       └── block.json          # Block metadata (API v3)
├── includes/
│   ├── fse-integration.php     # Template registration
│   ├── related_posts_rest_api.php  # REST API endpoint
│   ├── shortcodes.php          # Dynamic date shortcode
│   ├── filters.php             # WordPress hooks
│   └── block-registration.php  # Block PHP callback
├── templates/
│   └── single-wcc-sample.html  # FSE template
├── src/
│   ├── js/
│   │   ├── index.js           # Block registration
│   │   ├── edit.js            # Editor component
│   │   └── view.js            # Frontend React
│   └── scss/
│       ├── _variables.scss     # Design tokens
│       ├── _mixins.scss        # Reusable SCSS
│       ├── _grid.scss          # Grid layout
│       ├── _card.scss          # Card components
│       ├── _post-header.scss   # Template styling
│       └── style.scss          # Main SCSS file
└── build/                      # Compiled assets (git-ignored)
```

---

## 📚 Code Quality

- ✅ WordPress Coding Standards compliant
- ✅ PHPDoc documentation
- ✅ React best practices (hooks, functional components)
- ✅ SCSS architecture (BEM methodology, modular structure)
- ✅ Security (escaping, sanitization, validation)
- ✅ Accessibility (WCAG AA contrast ratios)
- ✅ Performance (lazy loading, efficient queries)
- ✅ i18n ready (translation functions, text domains)

---

**Author:** Timothée Huerne  
**License:** GPLv2 or later  
**WordPress Version:** 6.0+  
**PHP Version:** 7.4+
