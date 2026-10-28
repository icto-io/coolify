---
name: Coolify (icto-ui "Graphite Panels")
description: Upstream Coolify v4.5.0 as a dark-first graphite console of persistent panels; seams instead of shadows, colour only for state.
colors:
  graphite-ground: "#17181b"
  graphite-panel: "#1d1f23"
  graphite-sunk: "#1a1c1f"
  graphite-raised: "#24262b"
  graphite-selected: "#2b2e34"
  graphite-log: "#141518"
  graphite-fg: "#e8e9ec"
  graphite-fg-dim: "#a3a7b0"
  graphite-fg-faint: "#8e939c"
  graphite-rule: "rgb(255 255 255 / 0.07)"
  graphite-rule-strong: "rgb(255 255 255 / 0.12)"
  graphite-hover: "rgb(255 255 255 / 0.04)"
  graphite-active: "rgb(255 255 255 / 0.07)"
  signal-blue-dark: "#61afef"
  signal-blue-dark-hover: "#7dbdf2"
  signal-blue-dark-ink: "#0f1420"
  run-green-dark: "#7ec699"
  build-yellow-dark: "#e6c07b"
  fail-red-dark: "#e06c75"
  paper-canvas: "#eeeeeb"
  paper-panel: "#fafaf8"
  paper-sunk: "#f3f3f0"
  paper-log: "#f6f6f3"
  paper-control-hover: "#eaeae6"
  paper-control-press: "#dcdcd8"
  ink: "#1b1d21"
  ink-dim: "#4f535b"
  ink-faint: "#6b7079"
  paper-rule: "rgb(20 22 26 / 0.09)"
  paper-rule-strong: "rgb(20 22 26 / 0.15)"
  paper-hover: "rgb(20 22 26 / 0.04)"
  paper-active: "rgb(20 22 26 / 0.07)"
  signal-blue: "#2463c4"
  signal-blue-hover: "#1f56ab"
  signal-blue-ink: "#ffffff"
  run-green: "#2e8a55"
  build-yellow: "#9a6b00"
  fail-red: "#c23b46"
typography:
  headline:
    fontFamily: "Manrope, ui-sans-serif, system-ui, sans-serif"
    fontSize: "22px"
    fontWeight: 600
    lineHeight: "28px"
    letterSpacing: "-0.015em"
  title:
    fontFamily: "Manrope, ui-sans-serif, system-ui, sans-serif"
    fontSize: "20px"
    fontWeight: 700
    lineHeight: "26px"
    letterSpacing: "-0.01em"
  body:
    fontFamily: "Manrope, ui-sans-serif, system-ui, sans-serif"
    fontSize: "14px"
    fontWeight: 400
    lineHeight: "20px"
  ui:
    fontFamily: "Manrope, ui-sans-serif, system-ui, sans-serif"
    fontSize: "13px"
    fontWeight: 500
  meta:
    fontFamily: "Manrope, ui-sans-serif, system-ui, sans-serif"
    fontSize: "12px"
    fontWeight: 400
  panel-label:
    fontFamily: "Manrope, ui-sans-serif, system-ui, sans-serif"
    fontSize: "11px"
    fontWeight: 700
    lineHeight: "16px"
    letterSpacing: "0.06em"
  nav-group:
    fontFamily: "Manrope, ui-sans-serif, system-ui, sans-serif"
    fontSize: "10.5px"
    fontWeight: 600
    letterSpacing: "0.06em"
  log:
    fontFamily: "JetBrains Mono, ui-monospace, SFMono-Regular, Menlo, monospace"
    fontSize: "12px"
    fontWeight: 400
    lineHeight: 1.6
  key-cap:
    fontFamily: "JetBrains Mono, ui-monospace, SFMono-Regular, Menlo, monospace"
    fontSize: "10.5px"
    fontWeight: 500
    lineHeight: 1
rounded:
  key-cap: "4px"
  chip: "5px"
  control: "6px"
  panel: "8px"
  dialog: "10px"
  lamp: "999px"
spacing:
  hairline: "1px"
  xs: "4px"
  sm: "8px"
  md: "12px"
  lg: "16px"
  xl: "24px"
  panel-header: "40px"
  status-bar: "28px"
  top-bar: "48px"
  resource-rail: "232px"
  sidebar: "224px"
  sidebar-rail: "64px"
components:
  button-primary:
    backgroundColor: "{colors.signal-blue-dark}"
    textColor: "{colors.signal-blue-dark-ink}"
    rounded: "{rounded.control}"
  button-primary-hover:
    backgroundColor: "{colors.signal-blue-dark-hover}"
  button-primary-light:
    backgroundColor: "{colors.signal-blue}"
    textColor: "{colors.signal-blue-ink}"
    rounded: "{rounded.control}"
  button-primary-light-hover:
    backgroundColor: "{colors.signal-blue-hover}"
  button-secondary:
    backgroundColor: "{colors.graphite-raised}"
    textColor: "{colors.graphite-fg}"
    rounded: "{rounded.control}"
  button-secondary-hover:
    backgroundColor: "{colors.graphite-selected}"
  button-secondary-light:
    backgroundColor: "{colors.paper-panel}"
    textColor: "{colors.ink}"
    rounded: "{rounded.control}"
  button-secondary-light-hover:
    backgroundColor: "{colors.paper-control-hover}"
  input:
    backgroundColor: "{colors.graphite-raised}"
    textColor: "{colors.graphite-fg}"
    rounded: "{rounded.control}"
  input-light:
    backgroundColor: "{colors.paper-panel}"
    textColor: "{colors.ink}"
    rounded: "{rounded.control}"
  panel:
    backgroundColor: "{colors.graphite-panel}"
    rounded: "{rounded.panel}"
  panel-header:
    backgroundColor: "{colors.graphite-sunk}"
    textColor: "{colors.graphite-fg-dim}"
    typography: "{typography.panel-label}"
    height: "40px"
    padding: "8px 10px 8px 16px"
  log-panel-body:
    backgroundColor: "{colors.graphite-log}"
    textColor: "{colors.graphite-fg}"
    typography: "{typography.log}"
  resource-rail-item:
    textColor: "{colors.graphite-fg}"
    padding: "10px 16px"
  resource-rail-item-active:
    backgroundColor: "{colors.graphite-panel}"
  summary-chip:
    textColor: "{colors.graphite-fg-dim}"
    rounded: "{rounded.chip}"
    padding: "1px 7px"
  topbar-search:
    backgroundColor: "{colors.graphite-panel}"
    textColor: "{colors.graphite-fg-faint}"
    rounded: "{rounded.control}"
    width: "240px"
    height: "30px"
  status-bar:
    backgroundColor: "{colors.graphite-ground}"
    textColor: "{colors.graphite-fg-dim}"
    typography: "{typography.meta}"
    height: "28px"
    padding: "0 16px"
---

# Design System: Coolify (icto-ui "Graphite Panels")

> **Fork note.** This is the `icto-ui` fork of upstream Coolify v4.5.0. The design is a layer, `resources/css/graphite.css`, imported by `resources/css/app.css` and winning over upstream by specificity: tokens on `html:root` (light) and `html.dark` (dark, the native world); component rules nested under `html:not(#icto-ui)`; an `@layer utilities` block only where upstream uses layered `!important` utilities. Templates edited by the fork: `layouts/app.blade.php`, `layouts/base.blade.php`, `components/navbar.blade.php`, `components/section-heading.blade.php`, `components/status-badge.blade.php`, `livewire/dashboard/active-deployments.blade.php`, `livewire/project/application/configuration.blade.php`, `livewire/project/application/general.blade.php`, `livewire/project/resource/index.blade.php`; new: `components/status-bar.blade.php`, `components/resource-rail.blade.php`, `livewire/project/application/log-panel.blade.php` (+ `app/Livewire/Project/Application/LogPanel.php`). Fonts are self-hosted woff2 in `resources/fonts` (OFL files alongside). **Prefer changes in `graphite.css` and the listed components**; edit other upstream templates only when structure must change. On an upstream merge conflict in this file, the fork's version wins.

## Overview

**Creative North Star: "The Graphite Console"**

Coolify reads as a working surface of persistent panels on a graphite ground. The layout stays put; navigation changes what the panels hold. On wide screens an application is a tiled workspace edge to edge between the top bar and the status bar: the environment's resources on the left, the selected application in the centre, and its deployment log docked on the right, following the live build. Density is upstream's: 13 to 14px interface type, 40px panel headers, 8px rows of rhythm.

Depth is structural, not atmospheric. Panels sit one tonal step above the ground and are divided by 1px seams; nothing floats, nothing glows, nothing lifts on hover. Colour is reserved for state, in an editor-syntax palette: green running, yellow building, red failed, blue for links, focus, checked controls and the one primary key. Dark is the native theme; light is the same structure translated onto paper-grey.

**Key Characteristics:**
- Dark-first graphite ground with panels one step up, divided by 1px seams.
- Every top-level section is a panel with a 40px header bar carrying its small uppercase title and its actions.
- Persistent deployment log panel docked beside the application (the signature).
- Colour carries state only; one blue primary key per view.
- Manrope for the interface, JetBrains Mono for anything a machine wrote.

## Colors

A near-neutral graphite (or paper-grey) structure with an editor-syntax signal set used only where something is live or actionable.

### Primary
- **Signal Blue** (dark `signal-blue-dark`, light `signal-blue`): the one primary key (Deploy split action, the highlighted button), links, focus rings, checked checkboxes and toggles, the selected segment of a view toggle, the active resource's 2px inset edge, and command lines in the log. Ink on the dark key is near-black `signal-blue-dark-ink`; on the light key, white.

### Secondary (state)
- **Run Green** (`run-green-dark` / `run-green`): running, healthy, finished, server online.
- **Build Yellow** (`build-yellow-dark` / `build-yellow`): queued, building, starting, restarting, degraded, unhealthy; warning lines in the log.
- **Fail Red** (`fail-red-dark` / `fail-red`): exited, failed, unreachable; stderr lines; the destructive focus ring.

### Neutral
- **Graphite Ground** (`graphite-ground`): page canvas, sidebar, top bar, status bar, resource column. One flat canvas behind all chrome.
- **Graphite Panel** (`graphite-panel`): panel bodies, the summary strip, the active rail item, the search field.
- **Graphite Sunk** (`graphite-sunk`): panel header bars; read-only inputs.
- **Graphite Raised / Selected** (`graphite-raised`, `graphite-selected`): secondary buttons, inputs, view toggles at rest / on hover.
- **Graphite Log** (`graphite-log`): the log body, one step below the ground.
- **Graphite Text** (`graphite-fg`, `graphite-fg-dim`, `graphite-fg-faint`): headings and values; body copy (dark body text is the dim step); timestamps, meta, placeholders.
- **Seams** (`graphite-rule`, `graphite-rule-strong`): panel borders and dividers; control borders and overlay edges.
- **Washes** (`graphite-hover`, `graphite-active`): row and menu hover; active nav item, active tab, active log filter.
- Light equivalents: `paper-canvas`, `paper-panel`, `paper-sunk`, `paper-log`, `ink`, `ink-dim`, `ink-faint`, `paper-rule`, `paper-rule-strong`, `paper-hover`, `paper-active`.

### Named Rules
**The State-Only Colour Rule.** Green, yellow and red appear only to report the live state of a resource, deployment, server or log line. They never decorate, never fill a control, never mark a category.

**The One Key Rule.** A view has one filled blue key. Everything else is a neutral key on the raised step. The Coolify logo is rendered greyscale so brand purple never competes with it.

## Typography

**Display Font:** none; the system has no display role.
**Body Font:** Manrope (with ui-sans-serif, system-ui)
**Label/Mono Font:** JetBrains Mono (with ui-monospace, SFMono-Regular, Menlo)

**Character:** A compact, slightly geometric grotesque for the interface against a programmer's mono for logs, SHAs, UUIDs and versions; the pairing reads as a developer console without costume.

### Hierarchy
- **Headline** (600, 22px/28px, -0.015em): page `h1`.
- **Title** (700, 20px/26px, -0.01em): the resource name in the workspace summary strip.
- **Body** (400, 14px/20px): default copy and form text. Manrope gets `word-spacing: 0.1em` on body; mono contexts reset it to normal.
- **UI** (500 to 600, 13px): nav items, rail names (600), status badges.
- **Meta** (400 to 600, 12px): table headers, facts, filters, status bar, log meta.
- **Panel label** (700, 11px/16px, 0.06em, uppercase, dim): the title in every panel header bar, the log panel title, the Resources column title.
- **Nav group** (600, 10.5px, 0.06em, uppercase, faint): sidebar group names.
- **Log** (JetBrains Mono 400, 12px/1.6): log lines; timestamps faint and tabular.
- **Key cap** (JetBrains Mono 500, 10.5px): `kbd` hints (Ctrl B, Ctrl K).

### Named Rules
**The Machine-Text Rule.** Anything a machine wrote (log lines, commit SHAs, UUIDs, repo paths, versions, counts, key caps) is JetBrains Mono. Labels and prose never are.

**The Tabular Rule.** Tables, times, counts and the status bar use tabular numerals.

## Layout

The shell is fixed chrome around a content area: a 48px top bar (brand cell tracks the sidebar width, then breadcrumbs, page toolbar slot, a 240px search field with Cmd/Ctrl+K hint, resource actions), a sidebar of 224px that collapses to a 64px rail (toggle beside the wordmark, Cmd/Ctrl+B, remembered), and from `lg` (1024px) a 28px status bar fixed along the bottom with up to four servers, their state and proxy, and the version at the right.

From `xl` (1280px) an application page becomes a tiled workspace with no outer padding: a 232px resources column, the centre pane, and, when the log is open, a log column of `minmax(340px, 34%)`. Rail and log columns are sticky and fill the height between top bar and status bar; columns meet at 1px seams. In the centre pane, panels stack edge to edge, separated by their bottom seam, with 24px side insets. Below 1280px the log opens as an overlay docked to the right edge (`min(440px, 90vw)`, Escape closes) and a vertical "Log" tab on the right edge reopens it. Open/closed state is remembered on wide screens.

Elsewhere content is panels in upstream's page grid. Rhythm: 4, 8, 12, 16, 24px; panel headers 40px tall; rows 10px by 16px; card grids inside a panel get 12px padding.

**The Panels Stay Put Rule.** Navigation changes what the panels contain, never where they are. The log panel stays docked while the operator edits configuration in the centre.

## Elevation & Depth

Flat by construction. Depth is one tonal step (ground, panel, raised, selected; the log one step below ground) plus 1px seams. Tailwind's shadow utilities are re-pointed to a hairline ring, buttons have no raised edge and no hover lift, and the top bar has no blur.

### Shadow Vocabulary
- **Hairline ring** (`box-shadow: 0 0 0 1px var(--gp-rule-strong)`): popovers, menus, the command palette, toasts, tooltips, dialogs; the only "shadow" in the system.
- **Inset edge** (`box-shadow: inset 0 0 0 1px var(--gp-rule-strong)`): the search field and outlined badges.
- **Active edge** (`box-shadow: inset 2px 0 0 var(--gp-primary)`): the selected resource in the Resources column.
- **Focus ring** (`outline: 2px solid var(--gp-focus); outline-offset: 2px`; inputs instead shift their border to blue plus `0 0 0 1px` blue).

### Named Rules
**The Seam Rule.** Panels are separated by 1px seams and one tonal step, never by drop shadows. If something needs to stand above the page, it gets the hairline ring.

## Shapes

Small, consistent radii: key caps 4px, chips and log filters 5px, buttons, inputs, search and menu items 6px, panels 8px, dialogs 10px, status lamps round. Inside the tiled workspace the radius goes to zero: the workspace is a grid of seams, not rounded cards. A box never sits inside another box: nested section bodies and rows inside a panel lose their frames and become hairline-divided groups.

## Components

### Buttons
- **Shape:** gently squared (6px), 1px `rule-strong` border, sentence case.
- **Primary:** Signal Blue fill and border, dark ink on dark / white on light; hover steps to the hover blue. The Deploy split action uses the same key, its caret divided by a 22% ink seam.
- **Secondary:** raised graphite (dark) or paper panel (light), text in full foreground, icons at 80% opacity; hover to the selected step / control-hover, press to control-press.
- **Hover / Focus:** no transform, no shadow. Focus is a 2px blue outline offset 2px; destructive buttons take a red ring.

### Status
- **Status lamp:** 8px round lamp lit in the state colour with a 1px inset rim; stopped or unknown is an empty housing (1.5px ring). In-progress states pulse at 1.6s (disabled under reduced motion). The badge around it is bare text at 13px, no pill.
- **Dots:** rail and log status use a 6 to 7px dot in `currentColor` beside a 12px 600 label tinted in the state colour.

### Cards / Containers (Panels)
- **Corner Style:** 8px; 0 inside the tiled workspace.
- **Background:** panel step; header bar on the sunk step.
- **Shadow Strategy:** none; see Elevation.
- **Border:** 1px `rule`; header separated by a 1px bottom seam.
- **Header:** 40px min height, title as Panel label on the left, actions on the right, padding 8px 10px 8px 16px (24px left in the workspace).
- Applies to settings sections, `section-heading` sections (dashboard, shared variables) and the environment resource list (toolbar as header bar, table or card grid as body, pagination behind a top seam).

### Inputs / Fields
- **Style:** 6px, 1px `rule-strong` border, raised graphite (dark) or paper panel (light).
- **Focus:** border turns blue plus a 1px blue ring.
- **Read-only:** sunk step, dim text.

### Chips
- **Summary chip:** 12px 600 dim text, 1px `rule-strong` outline, 5px radius (build pack in the summary strip). Beta / "Try it" badges are the same outline, never a fill.

### Navigation
- **Sidebar:** flat ground, 1px right seam. Items 32px tall, 13px 500, 6px radius; hover is the 4% wash, active the 7% wash at 600 weight in full foreground; no accent rail. Group names as Nav group type. Chevrons and badges stay muted.
- **Collapse toggle:** beside the wordmark, 28px, with a Cmd/Ctrl+B key cap; on the collapsed rail it replaces the logo on hover; tooltip after 400ms.
- **Top bar:** flat ground, bottom seam on scroll, search field 240px by 30px with inset edge and key cap.
- **Status bar:** 28px, ground, top seam, 12px dim text, servers as 7px dot + name + state, 1px separators.
- **Resources column:** 40px header (Panel label + mono count), items as name (13px 600) / state dot and label / build type (12px faint), bottom seams, hover wash, active item on the panel step with the 2px blue inset edge; footer link to the full environment.

### Deployment Log Panel (signature)
The latest deployment's log, docked beside the application and following it live (polls every 2s while live, 20s otherwise). Structure, top to bottom, each band divided by a seam: header (Panel label title, state dot and label, "Full log" and hide actions), meta row (mono short SHA, commit message, relative time), filter row (All / Warnings / Errors as 24px segments with mono counts, active segment on the active wash with a hairline ring; Follow checkbox), body, footer (line count, "following", SHA). The body is JetBrains Mono 12px/1.6 on the log step; lines never wrap, the body scrolls sideways while the 5.4rem timestamp column stays pinned; command lines are blue 600 with a `$` prefix, stderr red, warnings and hidden lines yellow. Follow turns off when the operator scrolls up and back on at the bottom.

### Summary Strip
Top of the workspace centre: resource name (Title), status, build-pack chip, then a facts row (Domain, Source, Server, UUID) at 12.5px with faint terms and mono values; on the panel step with a bottom seam.

## Do's and Don'ts

### Do:
- **Do** put new tokens and component rules in `graphite.css` under `html:root` / `html.dark` / `html:not(#icto-ui)`; answer upstream layered `!important` only inside `@layer utilities`.
- **Do** make every new top-level section a panel: 8px, 1px seam, 40px header bar on the sunk step with an 11px uppercase panel title and right-aligned actions.
- **Do** use JetBrains Mono for logs, SHAs, UUIDs, versions, counts and key caps, with tabular numerals.
- **Do** keep one blue primary key per view; everything else is a neutral key.
- **Do** design dark first and translate to light through the same `--gp-*` tokens.
- **Do** respect reduced motion for every pulse.

### Don't:
- **Don't** use drop shadows, blur, glow or hover lift; overlays get the 1px hairline ring.
- **Don't** use green, yellow or red for anything but live state, and don't fill controls with them.
- **Don't** put a box inside a box; inner sections and rows become seam-divided groups.
- **Don't** bring back brand purple or the stacked-card admin look; the logo stays greyscale.
- **Don't** move docked panels on navigation or let the log panel cover the centre on wide screens.
