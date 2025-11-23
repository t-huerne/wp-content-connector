# Readme

## Technical Decisions

**Architecture:** I built this as a standalone plugin rather than a theme to ensure portability across any WordPress site, following the principle that functionality belongs in plugins and presentation in themes.

**FSE Template:** I chose Full Site Editing over traditional PHP templates because it represents WordPress's modern direction. The challenge was adding dynamic content (current date) to FSE's HTML-based templates, which I solved using shortcodes - demonstrating how to bridge FSE's static nature with PHP's dynamic capabilities.

**React Block:** I built a custom React block instead of using ACF to show proficiency with WordPress's official Block Editor APIs and modern JavaScript patterns. While ACF would be faster for simple blocks, custom React offers full control over editor experience and is essential for complex, interactive components that agencies need.

**REST API:** I created a custom endpoint rather than direct database queries to decouple data fetching from rendering, enable headless possibilities, and follow WordPress's modern development standards.

**SCSS Architecture:** I used modular SCSS with separated partials (_variables, _mixins, _grid, _card) to enable scalability in team environments where multiple developers collaborate. This prevents CSS conflicts and makes maintenance easier.

**Build Process:** Uses `@wordpress/scripts` (WordPress's official build tool) to ensure compatibility and follow recommended practices.

## Assumptions

- WordPress 6.0+ with FSE-enabled Block Theme
- Modern browser support (ES6+, CSS Grid)
- Performance priority (viewScript for conditional loading)

## Future Improvements

With more time, I would add:

1. **Server-Side Rendering:** Render initial HTML in PHP for better SEO, then hydrate with React for interactivity
2. **Query Caching:** Implement Transients API to cache related posts queries and reduce database load
3. **Unit Tests:** Add Jest tests for React components and PHPUnit for REST API endpoints
4. **Enhanced Algorithm:** Use tags alongside categories with a scoring system for better relevance
5. **Admin Settings:** Add WordPress admin page for configuring defaults (excerpt length, posts per page)

---

**Word Count:** ~250 words
