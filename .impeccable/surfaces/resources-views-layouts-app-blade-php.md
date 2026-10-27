---
version: 1
slug: "resources-views-layouts-app-blade-php"
primary_target: "resources/views/layouts/app.blade.php"
related_targets: ["resources/css/app.css","resources/css/utilities.css","resources/views/components"]
---

# App shell (all authenticated screens)

Scope: the whole Coolify app UI through its shared layers (theme tokens,
utilities, shared Blade components, app layout). Mode: Operate.
Audience: a single operator checking status, following deployments, debugging
failures from logs, and editing config. Visual-only redesign: same screens,
flows and copy as upstream. Brief pinned by the user: beautiful, minimalist,
modern; keep density; nothing flashy or decorative; logs must get better.

## Direction contract

THESIS: Coolify as a Braun appliance: as little design as possible, every
control obviously what it is. Refuses the purple admin look of stacked
card-in-well boxes and the near-black-plus-one-neon dev dashboard.

OWN-WORLD: Warm light-grey body with off-white working surfaces and charcoal
type; graphite body in dark. Flat colour, no gradients, glows or soft
shadows; hairline rules instead of nested boxes. Charcoal is the primary
action. Colour exists only as function: Braun green running, orange in
progress, red failed, grey stopped. Helvetica-family grotesk, small tracked
labels, tabular figures; mono only for logs.

STORY: The operator sees at once what is up, what is building, and what
failed; knows the one next action on each screen; reads logs without
fighting them.

FIRST VIEWPORT: Standard side navigation on the graphite or warm-grey rail.
Main area: the resource list as rows (lamp, name, type, last deploy as
elapsed time, commit, domain) on one surface separated by hairlines; failed
rows first; one primary action at the top right.

FORM: Appliance (Braun product design), position 1 of 7 on the grounded list,
taken as the pick card over the dealt direction. seed:a14c8ff89987788b.
Signature move: status as indicator lamps, a small round lamp that is lit
only when live: steady for running, slow pulse for building, red for failed,
unlit for stopped; reduced motion holds every lamp steady.

FINISH: unreviewed and undocumented is unfinished; this build ends with the finish review, the verdict, DESIGN.md, and every shipping raster carrying its provenance
