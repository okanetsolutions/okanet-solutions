---
paths:
  - 'resources/views/**'
---

# Views

## Internal page links use wire:navigate (Livewire SPA navigation)
Livewire is installed only for SPA navigation; there are no Livewire components. `layouts/site` and `layouts/admin` load `@livewireStyles`/`@livewireScripts`; `account` and `legal` extend `site`, so they already have both. A layout that doesn't load Livewire won't do SPA navigation.
Every `<a>` pointing to an internal page (`route(...)`) must carry `wire:navigate`. `tests/Feature/MarketingPagesTest.php` parses the public pages and fails if one doesn't.
Don't add it to: file downloads (e.g. `*.assessments.download` PDFs), `target="_blank"` links, `data-cookie-settings` links (JS opens the cookie `<dialog>` instead), `#anchor`/mailto/tel/external links, or form submits. Scripts in `<head>` don't re-run on navigation, so don't put page-specific inline `<script>` tags in views. Put the behaviour in `resources/js/app.js` instead (see the JS rule).
