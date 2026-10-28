---
version: 1
slug: "resources-views-layouts-app-blade-php"
primary_target: "resources/views/layouts/app.blade.php"
related_targets: ["resources/css/app.css","resources/css/utilities.css","resources/views/components"]
---

# App shell (all authenticated screens)

Scope: the whole Coolify app UI: theme tokens, utilities, shared Blade
components, the app layout, and the templates of screens that need a new
structure. Mode: Operate. Audience: a single operator checking status,
following deployments, debugging failures from logs, and editing config.
Full redesign (revised 2026-10-27): layouts and templates may change,
behaviour may not. Pinned by the user: new design, not a recolour; sidebar
clearly collapsible; keep density; nothing flashy; logs must get better.
The rejected "Appliance" recolour is an anti-reference.

## Direction contract

THESIS: Coolify as a graphite working surface of persistent panels: the
layout stays put and navigation changes what the panels hold. Refuses the
purple stacked-card admin look and the single scrolling settings page.

OWN-WORLD: Dark-first graphite ground (#17181B) with panels one step up
(#1D1F23), divided by 1px seams, never shadows. Text #E8E9EC, dim #9DA1AA.
Editor-syntax accents carry state only: green running, yellow building, red
failed, blue links, focus and the one primary key. Manrope UI at 13px,
small-caps 11px panel headers, JetBrains Mono for logs, SHAs and figures.
Destructive actions stay outlined and stand apart. Light theme is a
translation of the same structure on warm paper-grey.

STORY: The operator sees every resource's state in a left column, the
selected one in the centre, and its log on the right without leaving the
page; fixes config in the centre while the log keeps running.

FIRST VIEWPORT: Collapsible sidebar (220px, 56px rail, toggle beside the
wordmark, Cmd/Ctrl+B) and top bar (breadcrumbs, Cmd+K search, one blue
primary). Main area tiled: resources list, resource detail, log panel;
status bar along the bottom with server health.

FORM: Graphite Panels (dark-first developer console), challenger
digital-design-canon-dark-first-developer-console, chosen over assigned
position 4 (Container Yard). seed:9a5332ed3fc99567. Signature move: the
persistent log panel, always open beside the resource and following the
live deployment.

FINISH: unreviewed and undocumented is unfinished; this build ends with the finish review, the verdict, DESIGN.md, and every shipping raster carrying its provenance
