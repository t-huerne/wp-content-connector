# WP Content Connector

A robust WordPress plugin demonstrating advanced development techniques including Custom REST API endpoints, React-based Gutenberg blocks, modular SCSS architecture, and Full Site Editing (FSE) integration.

---

## 🎯 Code Samples Guide (Assignment Checklist)

This plugin serves as a cohesive portfolio answering the specific technical requirements:

### 1. FSE HTML Template
> *"A full-site editing .html template with a dynamic string showing the current date"*
*   **File:** `templates/single-wcc-sample.html`
*   **Implementation:** A custom Block Template for single posts. It integrates the custom Shortcode (`[current_date]`) for dynamic data and pre-loads the Related Posts block.
*   **Registration:** Registered via `includes/fse-integration.php` using the `get_block_templates` filter.

### 2. Advanced Styling (SCSS)
> *".scss or PostCSS .css file with advanced styling"*
*   **Files:** `src/scss/` (Modular Architecture)
*   **Implementation:**
    *   `_grid.scss`: Responsive CSS Grid layout using mixins.
    *   `_card.scss`: Component-based styling with nesting and BEM naming.
    *   `_variables.scss` & `_mixins.scss`: Design tokens and reusable logic for maintainability.

### 3. Custom React Block (No ACF)
> *"A custom block written in React (no ACF), including block.json and edit.js"*
*   **Files:**
    *   `blocks/related-posts/block.json`: V3 Block metadata.
    *   `src/js/edit.js`: React-based editor interface using `@wordpress/components` (InspectorControls).
    *   `src/js/view.js`: Client-side React hydration. It fetches data from the custom REST API using `apiFetch` and `useState`/`useEffect` hooks.

### 4. Custom PHP Function
> *"A custom PHP function that modifies WordPress behavior"*
*   **Files:**
    *   `includes/related_posts_rest_api.php`: Extends the WP REST API with a custom endpoint (`/wcc/v1/related-posts`).
    *   `includes/filters.php`: Modifies default excerpt length via hooks.
    *   `includes/shortcodes.php`: Implements the dynamic date functionality.

---

## 📝 Technical Decisions & Assumptions

**Architecture:**
I chose to build a standalone plugin rather than a theme to ensure portability. The project uses a modern build stack (`@wordpress/scripts`, Webpack) to compile React and SCSS assets.

**Assumptions:**
*   The environment runs WordPress 6.0+ with a Block Theme (FSE) enabled.
*   Performance is a priority, hence the use of `viewScript` to load frontend JS only when the block is present.

**Future Improvements:**
With more time, I would implement:
1.  **Server-Side Rendering (PHP):** For better SEO and initial paint, while keeping React for interactivity.
2.  **Query Caching:** Implement Transients API for the related posts queries to reduce database load.
3.  **Unit Tests:** Add Jest (JS) and PHPUnit tests for critical logic.

---

## 🛠️ Installation

1.  Clone this repository into `wp-content/plugins/`:
    ```bash
    git clone https://github.com/yourusername/wp-content-connector.git
    ```
2.  Activate **WP Content Connector** in WordPress Admin.
3.  **Build:** `npm install && npm run build` (if editing source files).

## 🧪 How to Test

1.  **Block:** Create a post and insert the "Related Posts" block.
2.  **Template:** In the Post Editor, swap the template to **"WCC Single Post"**.
3.  **API:** Visit `/wp-json/wcc/v1/related-posts?post_id=[ID]`.

---

**Author:** Timothée Huerne
**License:** GPLv2 or later
