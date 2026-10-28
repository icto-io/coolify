---
name: Coolify (icto-ui "Appliance")
description: Upstream Coolify v4.5.0 reskinned as a Braun appliance; warm grey, charcoal keys, colour only as function.
colors:
  primary-key: "oklch(23% 0.006 70)"
  primary-key-hover: "oklch(31% 0.006 70)"
  primary-key-dark: "oklch(93% 0.005 80)"
  primary-key-dark-hover: "oklch(99% 0.002 85)"
  signal-orange: "oklch(57% 0.18 44)"
  signal-orange-dark: "oklch(70% 0.16 50)"
  link-orange: "oklch(50% 0.16 44)"
  link-orange-dark: "oklch(76% 0.13 55)"
  lamp-green: "oklch(60% 0.14 148)"
  lamp-amber: "oklch(79% 0.15 78)"
  lamp-red: "oklch(56% 0.2 27)"
  warm-grey-canvas: "oklch(96.4% 0.004 80)"
  off-white-surface: "oklch(99.3% 0.002 85)"
  surface-sunk: "oklch(97.6% 0.003 82)"
  control-hover: "oklch(93.8% 0.005 80)"
  control-press: "oklch(89.6% 0.006 78)"
  ink: "oklch(19% 0.005 70)"
  ink-dim: "oklch(44% 0.008 70)"
  ink-faint: "oklch(52.5% 0.008 72)"
  rule: "oklch(19% 0.005 70 / 0.1)"
  rule-strong: "oklch(19% 0.005 70 / 0.17)"
  graphite-canvas: "oklch(21% 0.004 70)"
  graphite-surface: "oklch(24.5% 0.004 70)"
  graphite-raised: "oklch(27.5% 0.005 70)"
  graphite-selected: "oklch(31% 0.005 70)"
  graphite-log: "oklch(18% 0.003 70)"
  graphite-fg: "oklch(95% 0.004 80)"
  graphite-fg-dim: "oklch(80% 0.005 80)"
  graphite-fg-faint: "oklch(66% 0.006 78)"
  graphite-rule: "oklch(95% 0.004 80 / 0.09)"
  graphite-rule-strong: "oklch(95% 0.004 80 / 0.15)"
typography:
  headline:
    fontFamily: "Hanken Grotesk, Helvetica Neue, Arial, sans-serif"
    fontSize: "22px"
    fontWeight: 600
    lineHeight: "28px"
    letterSpacing: "-0.015em"
  title:
    fontFamily: "Hanken Grotesk, Helvetica Neue, Arial, sans-serif"
    fontSize: "14px"
    fontWeight: 600
    letterSpacing: "-0.005em"
  body:
    fontFamily: "Hanken Grotesk, Helvetica Neue, Arial, sans-serif"
    fontSize: "14px"
    fontWeight: 400
  status:
    fontFamily: "Hanken Grotesk, Helvetica Neue, Arial, sans-serif"
    fontSize: "13px"
    fontWeight: 500
  label:
    fontFamily: "Hanken Grotesk, Helvetica Neue, Arial, sans-serif"
    fontSize: "12px"
    fontWeight: 600
    fontFeature: "tnum"
  nav-group:
    fontFamily: "Hanken Grotesk, Helvetica Neue, Arial, sans-serif"
    fontSize: "10.5px"
    fontWeight: 600
    letterSpacing: "0.06em"
  mono:
    fontFamily: "Geist Mono, SFMono-Regular, Consolas, Liberation Mono, Menlo, monospace"
rounded:
  control: "6px"
  well: "8px"
  dialog: "10px"
  lamp: "999px"
spacing:
  section-head: "10px"
  dialog-head: "12px"
  dialog-head-inline: "16px"
  lamp-gap: "8px"
components:
  button:
    backgroundColor: "{colors.off-white-surface}"
    textColor: "{colors.ink}"
    rounded: "{rounded.control}"
    height: "32px"
  button-hover:
    backgroundColor: "{colors.control-hover}"
  button-active:
    backgroundColor: "{colors.control-press}"
  button-dark:
    backgroundColor: "{colors.graphite-raised}"
    textColor: "{colors.graphite-fg}"
  button-dark-hover:
    backgroundColor: "{colors.graphite-selected}"
  button-primary:
    backgroundColor: "{colors.primary-key}"
    textColor: "{colors.off-white-surface}"
    rounded: "{rounded.control}"
    height: "32px"
  button-primary-hover:
    backgroundColor: "{colors.primary-key-hover}"
  button-primary-dark:
    backgroundColor: "{colors.primary-key-dark}"
    textColor: "{colors.ink}"
  input:
    backgroundColor: "{colors.off-white-surface}"
    textColor: "{colors.ink}"
    rounded: "{rounded.control}"
    height: "32px"
  input-dark:
    backgroundColor: "{colors.graphite-raised}"
    textColor: "{colors.graphite-fg}"
  input-readonly:
    backgroundColor: "{colors.surface-sunk}"
    textColor: "{colors.ink-dim}"
  section-well:
    backgroundColor: "{colors.off-white-surface}"
    rounded: "{rounded.well}"
  section-well-dark:
    backgroundColor: "{colors.graphite-surface}"
  dialog:
    backgroundColor: "{colors.off-white-surface}"
    rounded: "{rounded.dialog}"
  status-lamp:
    size: "8px"
    rounded: "{rounded.lamp}"
  status-lamp-running:
    backgroundColor: "{colors.lamp-green}"
  status-lamp-building:
    backgroundColor: "{colors.lamp-amber}"
  status-lamp-failed:
    backgroundColor: "{colors.lamp-red}"
  table-header:
    textColor: "{colors.ink-faint}"
    typography: "{typography.label}"
---

# Design System: Coolify (icto-ui "Appliance")

> **This fork layers a visual skin over upstream Coolify.** `resources/css/appliance.css` (imported from `resources/css/app.css`) re-points upstream's tokens and restyles upstream's shared classes. Upstream markup, Tailwind classes and `resources/css/app.css` / `utilities.css` stay as upstream ships them.
>
> - **Make visual changes in `resources/css/appliance.css`**, not in upstream Blade views or upstream CSS, so upstream merges stay clean. The only view edits are `components/status-badge.blade.php` (status lamps) and `layouts/base.blade.php` (flat nav items by default); keep any further view edit that small.
> - **On an upstream merge conflict in this file, the fork's version wins.** Upstream's design doc (purple `#6b16ed`, tactile 3D buttons, card-in-well) no longer describes this UI. For upstream's structural conventions (page shells, Livewire dropdown state, table controls), read it with `git show v4.5.0:DESIGN.md`, and ignore its visual values.
>
> **How appliance.css wins without touching upstream:** tokens sit on `html:root` / `html.dark` (beats upstream `:root` / `.dark` and the Tailwind theme layer); component rules nest under `html:not(#icto-ui)` (ID-level specificity beats upstream chains such as `.button:not(:disabled)` with no `!important`). Upstream `!important` rules inside `@layer utilities` can only be answered from the same layer, so those overrides live in the `@layer utilities` block at the end of the file. Tailwind inlines `shadow-*` values at build time, so the file re-points `--tw-shadow` on those classes instead of the theme. Follow the same three patterns for new overrides.

## Overview

**Creative North Star: "The Appliance"**

Coolify as a Braun appliance (Dieter Rams): as little design as possible, every control obviously what it is. A warm light-grey body carries off-white working surfaces and charcoal type; dark mode is a graphite body, not black. Surfaces are flat colour, separated by hairline rules rather than nested boxes. The primary action is a charcoal key (an off-white key in dark mode). Colour appears only where it does a job: status lamps, focus, links, selection.

Density is upstream's: 14px UI text, 32px controls, compact rows. The skin changes how the screen looks, never what it does or says. It rejects the purple admin look of stacked card-in-well boxes and the near-black dev dashboard with one neon accent.

**Key Characteristics:**
- Warm grey, never beige (chroma under 0.01 on every neutral, hue 70 to 85).
- Charcoal primary key; orange is a signal, never a control fill.
- One hairline surface per section; a section inside a section is a group on the same surface.
- No gradients, glows, blur or soft shadows; overlays get a 1px hairline ring.
- Status as indicator lamps: lit only when live.

## Colors

A warm-grey neutral ramp with one functional orange and three lamp colours.

### Primary
- **Charcoal Key** (primary-key; hover primary-key-hover): the primary action (`.button-highlighted`, the Deploy split action), checked checkboxes, selected view-toggle and `.control-selected`. In dark mode it inverts to the **Off-White Key** (primary-key-dark) with ink text.

### Secondary
- **Braun Signal Orange** (signal-orange; signal-orange-dark in dark mode): the focus outline, caret colour, and selection tint (22% light, 30% dark). It is the token behind upstream's `coollabs` / `brand` / `accent` names, so anything upstream colours "brand" now resolves to orange.
- **Link Orange** (link-orange / link-orange-dark): link and `.text-helper` text, one step darker (light) or lighter (dark) than the signal for reading contrast.

### Tertiary (status lamps)
- **Running Green** (lamp-green), **In-Progress Amber** (lamp-amber), **Failed Red** (lamp-red): only on status lamps, error buttons and error focus. A stopped or unknown resource gets no colour: the unlit lamp housing.

### Neutral
- **Warm Grey Canvas** (warm-grey-canvas): page body, sidebar, top bar, auth shell; one flat canvas behind all chrome.
- **Off-White Surface** (off-white-surface): section wells, dialogs, popovers, buttons and inputs.
- **Sunk Surface** (surface-sunk): read-only inputs.
- **Control Hover / Press** (control-hover, control-press): secondary button hover and active fills.
- **Ink / Ink Dim / Ink Faint** (ink, ink-dim, ink-faint): body and headings; secondary text and nav items; table headers, placeholders, nav glyphs.
- **Rule / Rule Strong** (rule, rule-strong): ink at 10% and 17%. Rule separates sections and rows; Rule Strong outlines controls and overlays.
- **Graphite** (graphite-canvas, -surface, -raised, -selected): the dark-mode steps for canvas, wells, controls, hover/selected. Dark body text is graphite-fg-dim; headings and active items graphite-fg. Logs sit on graphite-log.

### Named Rules
**The Signal Rule.** Orange marks attention (focus, links, selection, caret) and never fills a control. Beta and "Try it" badges become a hairline outline in dim ink, not an orange chip.

**The Lit-Only-When-Live Rule.** Green, amber and red appear only as lamp states. Navigation chevrons, sidebar badges and the Coolify logo stay in ink (the logo is greyscale: `brightness(0.3)` light, `brightness(2.4)` dark).

## Typography

**Body Font:** Hanken Grotesk, self-hosted variable WOFF2 (`resources/fonts`, latin and latin-ext), with Helvetica Neue, Arial fallback. It also replaces upstream's Geist Sans through `--font-geist-sans`.
**Mono Font:** upstream's `--font-mono` stack, unchanged, for logs, commits and paths.

**Character:** a plain Helvetica-family grotesk at small sizes, with weight (600) rather than size carrying hierarchy. Figures are tabular in tables, `time`, `.tabular`, `.tabular-nums` and `.font-mono`.

### Hierarchy
- **Headline** (600, 22px / 28px, -0.015em): page `h1`.
- **Title** (600, 14px, -0.005em): section headings above a well; `h2`/`h3` take ink and the slight negative tracking.
- **Body** (400, 14px): upstream's `text-sm` body.
- **Status** (500, 13px): the text beside a status lamp.
- **Label** (600, 12px, ink-faint, sentence case): data-table column headers.
- **Nav group** (600, 10.5px, 0.06em, uppercase): sidebar section group names only (e.g. "Infrastructure", "Manage").

### Named Rules
**The Sentence-Case Rule.** Buttons and table headers are sentence case (`text-transform: none` on `.button`). Uppercase tracking is reserved for the sidebar's navigation group names.

## Layout

Layout, navigation and page structure are upstream's and unchanged: sidebar plus top bar shell, centered content, upstream breakpoints and mobile sheet. The skin flattens the shell: sidebar, top bar, brand cell and the mobile sticky header all paint the canvas colour, with no blur, no gradient and no shadow when scrolled; the scrolled top bar gains only a hairline bottom rule. Section headers sit 10px above their well; dialog headers pad 12px (16px leading edge) above a hairline.

## Elevation & Depth

Flat. Depth is tonal (canvas, surface, raised) plus hairlines; there are no drop shadows anywhere.

### Shadow Vocabulary
- **Hairline ring** (`box-shadow: 0 0 0 1px var(--appliance-rule-strong)`): dropdowns, modals, popovers, tooltips, dark toasts, the command palette, and every Tailwind `shadow-*` utility (re-pointed through `--tw-shadow`).
- **Focus ring on inputs** (`box-shadow: 0 0 0 1px var(--appliance-focus)`) with the border also turning orange.
- **Lamp housing** (`inset 0 0 0 1px` ink at 18% light / white at 12% dark; `1.5px` neutral-400 / coolgray-500 when unlit).

### Named Rules
**The Hairline Rule.** Anything that floats gets a 1px ring at Rule Strong, never a blur shadow. Buttons have no raised edge, lift or press translation.

## Shapes

Small, consistent corners: 6px on buttons, inputs and selects; 8px on section wells; 10px on dialogs; full round only on lamps. Outer section wrappers have no border, padding or radius: the heading sits directly on the canvas above one hairline well. Inner wells and row cards inside a well lose their border and fill and become hairline-separated groups.

## Components

### Buttons
Flat keys.
- **Shape:** gently squared (6px), 32px tall, 1px Rule Strong border.
- **Secondary (default):** off-white surface, ink text; hover Control Hover, active Control Press. Dark: graphite-raised, hover graphite-selected, icons at 80% opacity.
- **Primary:** Charcoal Key with off-white text, hover one step lighter; dark mode Off-White Key with ink text. The Deploy split action is the same key, with a 22% foreground divider before the caret.
- **Error:** upstream's red button; its focus outline is red instead of orange.
- **Focus:** 2px solid orange outline, 2px offset, no box-shadow. Shared by buttons, icon buttons, tabs, menu items, links and `[role="button"]`.

### Inputs / Fields
- **Style:** off-white (dark: graphite-raised), 1px Rule Strong border, 6px radius.
- **Focus:** border and a 1px ring in the focus orange.
- **Read-only:** Sunk Surface with dim ink.
- **Checkboxes:** checked fill is the primary key (`accent-color` too), with a primary-fg check mark.

### Cards / Containers (settings sections)
- **Structure:** a 14px/600 heading on the canvas, then one well.
- **Well:** off-white (dark: graphite-surface), 1px Rule border, 8px radius, no shadow.
- **Nesting:** a section body inside a section body is transparent and borderless.
- **Dialogs** (`.application-settings-form`): one surface, 10px radius, Rule Strong border and hairline ring, header ruled off from the body.

### Navigation
- **Sidebar:** canvas background, Rule right edge; items in ink-dim, hover a 4.5% ink wash, active an 8% ink wash with ink text at 600. Flat nav items are the default (`navItems: 'flat'`).
- **Tabs:** active tab takes the 8% ink wash, no ring.
- **View toggle:** selected segment is the primary key.
- **Search / palette (dark):** graphite-raised with an inset hairline.

### Tables
Header row 12px/600 in ink-faint, sentence case; rows hover with the 4.5% ink wash; figures tabular.

### Status Lamp (signature)
An 8px round lamp beside 13px status text, replacing upstream's pill badge (`<x-status-badge>`, classes `status-lamp status-lamp-{success|warning|error|neutral}`).
- **Running:** steady green. **In progress:** amber with a slow pulse (opacity 1 to 0.35, 1.6s, `cubic-bezier(0.45, 0, 0.55, 1)`). **Failed:** red. **Stopped / unknown:** unlit housing, no fill.
- **Reduced motion:** the pulse stops; every lamp holds steady.
- The badge itself has no pill: no border, fill or padding, 8px gap.

## Do's and Don'ts

### Do:
- **Do** put every visual change in `resources/css/appliance.css`, using `html:root` / `html.dark` for tokens, `html:not(#icto-ui)` for components, and the `@layer utilities` block only to answer upstream `!important`.
- **Do** re-point upstream tokens (`--color-coollabs*`, `--coollabs-*`, `--color-nav-*`, `--shadow-*`) rather than introducing parallel ones; use the `--appliance-*` semantic tokens in new rules.
- **Do** give every overlay the hairline ring and every focusable element the 2px orange outline at 2px offset.
- **Do** show status with the lamp, keeping colour for live states and leaving stopped resources unlit.
- **Do** check both themes; dark is graphite (canvas oklch 21%), never black.

### Don't:
- **Don't** edit upstream Blade views or upstream CSS for a visual change when an override in appliance.css can do it.
- **Don't** fill a control, badge or chip with orange; checked and selected states use the primary key.
- **Don't** use gradients, glows, backdrop blur, soft or offset drop shadows, or hover lift on buttons.
- **Don't** box a box: no well inside a well, no bordered row card inside a section body.
- **Don't** reintroduce upstream purple (`#6b16ed`) or a brand-coloured logo.
