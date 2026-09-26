---
paths:
  - 'resources/js/**'
---

# Js

## Page JS runs from initializePage on livewire:navigated
`app.js` is loaded once, and `wire:navigate` swaps the `<body>` without reloading it. All DOM wiring (mobile menu, cookie dialog, contact form) lives in `initializePage()`, which is bound only to `document.addEventListener('livewire:navigated', ...)`. Livewire also fires that event on the first full page load (via a setTimeout), so don't add a separate DOMContentLoaded call; it would bind the handlers twice.
Each run aborts the previous `pageAbortController` and creates a new one. Every `addEventListener` inside it, including ones on `document`/`window`/`matchMedia`, must pass `{ signal }`, or its listeners pile up with each navigation. Look up elements inside `initializePage`, never at module scope, because references from the old page go stale.
