# Architecture SCSS - Guide de développement

## 📁 Structure des fichiers

```
src/
├── style.scss              ← Fichier principal (imports tous les autres)
└── scss/
    ├── _variables.scss     ← Variables globales
    ├── _mixins.scss        ← Fonctions réutilisables
    ├── _grid.scss          ← Layout grid responsive
    ├── _card.scss          ← Styles des cartes
    └── _responsive.scss    ← Ajustements additionnels
```

## 🔄 Workflow de compilation

1. **Éditer les fichiers SCSS** dans `src/scss/`
2. **Compiler** : `npm run build`
3. **Résultat** : `build/style-style.css` (chargé automatiquement par WordPress)

## ✅ Ordre de développement recommandé

### 1. Variables (`_variables.scss`)
Commence par définir :
- Couleurs (text, links, backgrounds)
- Spacing (xs, sm, md, lg, xl)
- Typography (fonts, sizes)
- Breakpoints (mobile, tablet, desktop)
- Grid settings

### 2. Mixins (`_mixins.scss`)
Crée des fonctions réutilisables :
- Shadows
- Transitions
- Responsive breakpoints
- Text truncation

### 3. Grid (`_grid.scss`)
Layout principal :
- Container
- CSS Grid responsive
- Gap management

### 4. Card (`_card.scss`)
Styles des composants :
- Image container + hover
- Title + link styles
- Meta info (author + date)
- Excerpt

### 5. Responsive (`_responsive.scss`)
Ajustements finaux pour différentes tailles d'écran

## 📝 Classes HTML disponibles

```html
<div class="related-posts-container">
    <h3 class="related-posts-title">Related Posts</h3>
    <div class="related-posts-grid">
        <article class="related-post-card">
            <div class="related-post-image">
                <img class="placeholder?" />
            </div>
            <div class="related-post-content">
                <h4 class="related-post-title">...</h4>
                <div class="related-post-meta">
                    <span class="related-post-author">...</span>
                    <span class="meta-separator">•</span>
                    <time class="related-post-date">...</time>
                </div>
                <div class="related-post-excerpt">...</div>
            </div>
        </article>
    </div>
</div>
```

## 🎨 Objectif visuel

Créer des cartes élégantes avec :
- Image en haut (ou placeholder)
- Titre visible et cliquable
- Meta info discrète (auteur + date)
- Excerpt court
- Hover effects subtils
- Grid responsive (1 col mobile → 2 cols tablet → 3 cols desktop)

## ⚙️ Commandes

```bash
# Mode développement (watch)
npm run start

# Build production
npm run build
```

## ⚠️ Note sur @import

Les warnings `@import is deprecated` sont normaux. SCSS moderne utilise `@use` mais @import fonctionne encore. Tu peux les ignorer pour l'instant.

