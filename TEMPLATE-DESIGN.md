# Kanopi Post Header Design

## Overview
Modern, responsive post header layout with a split-screen design featuring title/meta information on the left and a featured image on the right.

## Layout Structure

### Desktop (768px+)
```
┌─────────────────────────────────────────────────┐
│                                                 │
│  ┌──────────────────┬──────────────────┐       │
│  │                  │                  │       │
│  │  Post Title      │                  │       │
│  │  (58% width)     │  Featured Image  │       │
│  │                  │  (42% width)     │       │
│  │  ──────────────  │  16:9 Ratio      │       │
│  │  👤 Author       │                  │       │
│  │  📅 Date         │                  │       │
│  │  📅 Custom Date  │                  │       │
│  │                  │                  │       │
│  └──────────────────┴──────────────────┘       │
│                                                 │
└─────────────────────────────────────────────────┘
```

### Mobile (<768px)
```
┌─────────────────────────┐
│                         │
│  ┌───────────────────┐  │
│  │                   │  │
│  │ Featured Image    │  │
│  │ 16:9 Ratio        │  │
│  │                   │  │
│  └───────────────────┘  │
│                         │
│  Post Title             │
│                         │
│  ─────────────────────  │
│  👤 Author              │
│  📅 Date                │
│  📅 Custom Date         │
│                         │
└─────────────────────────┘
```

## Key Features

### Visual Design
- **Responsive Grid Layout**: 58/42 split on desktop, stacked on mobile
- **Fluid Typography**: Title scales between 2rem and 3.5rem using `clamp()`
- **16:9 Aspect Ratio**: Featured images maintain consistent proportions
- **Card Shadow Effects**: Subtle elevation with hover interactions
- **Border Radius**: 8px on images for modern aesthetics

### Typography
- **Title**: Bold, large, with negative letter-spacing for tightness
- **Meta Information**: Small (0.875rem), light color (#666)
- **Font Pairing**: Sans-serif for UI, consistent with Twenty Twenty-Four

### Spacing
- **Vertical Rhythm**: Consistent 3rem (48px) spacing between major sections
- **Internal Gaps**: 2rem between content and image
- **Meta Spacing**: 1.5rem between meta items with flex wrapping

### Interactive Elements
- **Image Hover**: Subtle lift (-2px) with enhanced shadow
- **Card Transitions**: Smooth 0.3s ease animations

## Custom Classes

### Block-Level
- `.kanopi-post-header` - Main container
- `.kanopi-post-header__grid` - Columns wrapper
- `.kanopi-post-header__content` - Left column (title/meta)
- `.kanopi-post-header__image-wrapper` - Right column (image)

### Component-Level
- `.kanopi-post-header__title` - Post title styling
- `.kanopi-post-header__meta` - Meta information container
- `.kanopi-post-author` - Author block with avatar
- `.kanopi-post-date` - Standard post date
- `.kanopi-post-custom-date` - Custom shortcode date display

## SCSS Architecture

### Files Modified/Created
- `_post-header.scss` - New component for post header
- `style.scss` - Updated to import post-header

### Variables Used
- Colors: `$color-text`, `$color-text-light`, `$color-border`
- Spacing: `$spacing-xs` through `$spacing-xl`
- Layout: `$card-border-radius`
- Breakpoints: `$breakpoint-md`, `$breakpoint-lg`

### Mixins Applied
- `@include card-shadow(1)` - Level 1 shadow
- `@include card-shadow(2)` - Level 2 shadow on hover

## WordPress Blocks Used

1. **Post Title** - Core block with level 1 heading
2. **Post Author** - Core block with avatar, byline
3. **Post Date** - Core block showing publish date
4. **Post Featured Image** - Core block with 16:9 aspect ratio
5. **Shortcode** - Custom `[current_date]` shortcode
6. **Columns** - Core block for grid layout
7. **Group** - Core blocks for semantic grouping

## Browser Compatibility
- CSS Grid
- Flexbox
- CSS Custom Properties (via build process)
- Object-fit for images
- Modern transforms and transitions

## Performance Considerations
- Single compiled CSS file (minified)
- No JavaScript for layout
- Optimized for Core Web Vitals
- Minimal specificity for easier overrides

