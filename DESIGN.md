---
name: Coolify (icto-ui "Pace")
description: Upstream Coolify v4.5.0 in PaceUI's shadcn neutral system; an inset shell of soft 14px cards, ink keys, blue charts, colour only for state.
colors:
  ink-primary: "#171717"
  ink-primary-hover: "#333333"
  ink-primary-fg: "#fafafa"
  ink-primary-dark: "#e5e5e5"
  ink-primary-dark-hover: "#cfcfcf"
  ink-primary-dark-fg: "#171717"
  link-blue: "#155dfc"
  link-blue-dark: "#54a2ff"
  chart-blue-light: "#92c5ff"
  chart-blue: "#3a81f6"
  state-ok: "#00a544"
  state-busy: "#dd7400"
  state-bad: "#e40014"
  state-ok-dark: "#05df72"
  state-busy-dark: "#fcbb00"
  state-bad-dark: "#ff6568"
  canvas: "#fafafa"
  page: "#ffffff"
  card: "#ffffff"
  muted: "#f5f5f5"
  border: "#e5e5e5"
  ring: "#a1a1a1"
  fg: "#0a0a0a"
  fg-muted: "#737373"
  fg-faint: "#8a8a8a"
  log-bg: "#fafafa"
  canvas-dark: "#121212"
  page-dark: "#0a0a0a"
  card-dark: "#171717"
  muted-dark: "#262626"
  hover-dark: "#1f1f1f"
  border-dark: "#282828"
  input-dark: "#343434"
  ring-dark: "#737373"
  fg-dark: "#fafafa"
  fg-muted-dark: "#a1a1a1"
  log-bg-dark: "#0d0d0d"
typography:
  stat-value:
    fontFamily: "DM Sans, ui-sans-serif, system-ui, sans-serif"
    fontSize: "30px"
    fontWeight: 600
    lineHeight: "36px"
    letterSpacing: "-0.02em"
    fontFeature: "tnum"
  headline:
    fontFamily: "DM Sans, ui-sans-serif, system-ui, sans-serif"
    fontSize: "22px"
    fontWeight: 600
    lineHeight: "28px"
    letterSpacing: "-0.02em"
  title:
    fontFamily: "DM Sans, ui-sans-serif, system-ui, sans-serif"
    fontSize: "15px"
    fontWeight: 600
    lineHeight: "20px"
    letterSpacing: "-0.01em"
  title-sm:
    fontFamily: "DM Sans, ui-sans-serif, system-ui, sans-serif"
    fontSize: "14px"
    fontWeight: 600
    letterSpacing: "-0.01em"
  body:
    fontFamily: "DM Sans, ui-sans-serif, system-ui, sans-serif"
    fontSize: "14px"
    fontWeight: 400
    lineHeight: "20px"
  ui:
    fontFamily: "DM Sans, ui-sans-serif, system-ui, sans-serif"
    fontSize: "13px"
    fontWeight: 500
  label:
    fontFamily: "DM Sans, ui-sans-serif, system-ui, sans-serif"
    fontSize: "12px"
    fontWeight: 500
  axis:
    fontFamily: "DM Sans, ui-sans-serif, system-ui, sans-serif"
    fontSize: "11px"
    fontWeight: 400
    fontFeature: "tnum"
  log:
    fontFamily: "JetBrains Mono, ui-monospace, SFMono-Regular, Menlo, monospace"
    fontSize: "12px"
    fontWeight: 400
    lineHeight: 1.65
  mono-meta:
    fontFamily: "JetBrains Mono, ui-monospace, SFMono-Regular, Menlo, monospace"
    fontSize: "12px"
    fontWeight: 400
    lineHeight: 1
  key-cap:
    fontFamily: "JetBrains Mono, ui-monospace, SFMono-Regular, Menlo, monospace"
    fontSize: "10.5px"
    fontWeight: 500
    lineHeight: 1
rounded:
  key-cap: "4px"
  inner: "6px"
  control: "8px"
  card: "14px"
  pill: "999px"
spacing:
  xs: "4px"
  sm: "8px"
  md: "12px"
  lg: "16px"
  xl: "20px"
  gutter: "8px"
  card-header: "52px"
  top-bar: "48px"
  status-bar: "36px"
  sidebar: "224px"
  sidebar-rail: "64px"
  resource-rail: "240px"
components:
  button-primary:
    backgroundColor: "{colors.ink-primary}"
    textColor: "{colors.ink-primary-fg}"
    rounded: "{rounded.control}"
  button-primary-hover:
    backgroundColor: "{colors.ink-primary-hover}"
  button-primary-dark:
    backgroundColor: "{colors.ink-primary-dark}"
    textColor: "{colors.ink-primary-dark-fg}"
    rounded: "{rounded.control}"
  button-primary-dark-hover:
    backgroundColor: "{colors.ink-primary-dark-hover}"
  button-outline:
    backgroundColor: "{colors.page}"
    textColor: "{colors.fg}"
    rounded: "{rounded.control}"
  button-outline-hover:
    backgroundColor: "{colors.muted}"
  input:
    textColor: "{colors.fg}"
    rounded: "{rounded.control}"
  card:
    backgroundColor: "{colors.card}"
    rounded: "{rounded.card}"
  card-dark:
    backgroundColor: "{colors.card-dark}"
    rounded: "{rounded.card}"
  card-header:
    typography: "{typography.title}"
    height: "52px"
    padding: "12px 12px 12px 20px"
  stat-card:
    backgroundColor: "{colors.card}"
    rounded: "{rounded.card}"
    padding: "18px 20px"
  stat-value:
    textColor: "{colors.fg}"
    typography: "{typography.stat-value}"
  status-badge:
    textColor: "{colors.fg}"
    typography: "{typography.label}"
    rounded: "{rounded.pill}"
    height: "22px"
    padding: "0 8px"
  nav-item-active:
    backgroundColor: "{colors.muted}"
    textColor: "{colors.fg}"
    rounded: "{rounded.control}"
  resource-rail-item:
    textColor: "{colors.fg}"
    rounded: "{rounded.control}"
    padding: "8px 10px"
  resource-rail-item-active:
    backgroundColor: "{colors.muted}"
  log-panel-body:
    backgroundColor: "{colors.log-bg}"
    textColor: "{colors.fg}"
    typography: "{typography.log}"
  topbar-search:
    textColor: "{colors.fg-muted}"
    rounded: "{rounded.control}"
    width: "240px"
    height: "30px"
  status-bar:
    backgroundColor: "{colors.canvas}"
    textColor: "{colors.fg-muted}"
    typography: "{typography.label}"
    height: "36px"
    padding: "6px 20px 0"
---

# Design System: Coolify (icto-ui "Pace")

> **Fork note.** This is the `icto-ui` fork of upstream Coolify v4.5.0. The design is one layer, `resources/css/pace.css`, imported near the top of `resources/css/app.css` and winning over upstream by specificity: tokens on `html:root` (light) and `html.dark` (dark); component rules nested under `html:not(#icto-ui)`; `@layer utilities` blocks only where upstream uses layered `!important` utilities. Fork-owned templates include `layouts/app.blade.php`, `components/status-bar.blade.php`, `components/resource-rail.blade.php`, `livewire/project/application/log-panel.blade.php`, `livewire/dashboard/overview.blade.php` and `livewire/dashboard/active-deployments.blade.php`. Fonts are self-hosted variable woff2 in `resources/fonts` (DM Sans and JetBrains Mono, OFL files alongside). **Prefer changes in `pace.css` and the fork-owned components**; on an upstream merge conflict in this file, the fork's version wins.

## Overview

**Creative North Star: "The Pace Workbench"**

Coolify reads as PaceUI's take on shadcn's neutral system: a quiet grey canvas holding one rounded page panel, and inside it white (or near-black) cards with a 1px border and a soft shadow. From `lg` the shell is inset: the sidebar, brand and status bar sit directly on the canvas, and the top bar's working half plus the page form a single 14px-cornered panel beside them. Everything a user acts on lives in a card with a header row; nothing is boxed twice.

Colour is restrained. Keys are ink, not blue: the primary is near-black on light and near-white on dark. Blue belongs to charts, links and command lines in the log; green, amber and red report state and nothing else. Motion is short and springy: cards rise in on arrival, keys and rows press in, grid cards lift on hover, chart bars grow from the axis. All of it stops under reduced motion.

**Key Characteristics:**
- Inset shell: sidebar on the canvas, the page in one rounded panel with an 8px gutter.
- Every section is a 14px card with a 1px border, a soft shadow and a header row; inner boxes lose their frames.
- Ink primary key; outline secondary keys; blue only for charts, links and log commands.
- DM Sans for the interface, JetBrains Mono for logs, times, SHAs, versions, counts and key caps.
- Spring motion (rise, press, lift, grow) with reduced-motion handling.

## Colors

shadcn's neutral ramp with a single blue chart family and three state colours; dark mode re-points the same roles.

### Primary
- **Ink Key** (`ink-primary` on light, `ink-primary-dark` on dark): the filled key (Deploy split action, highlighted buttons), checked checkboxes, selected controls, the collapse tooltip. Hover steps to `ink-primary-hover` / `ink-primary-dark-hover`; text on it is `ink-primary-fg` / `ink-primary-dark-fg`.

### Secondary
- **Chart Blue** (`chart-blue`, with `chart-blue-light` for the secondary series): finished deployments in the activity chart, the deployments sparkline (2px stroke over a 40%-to-0 gradient fill), and the text selection wash at 24%.
- **Link Blue** (`link-blue` / `link-blue-dark`): links in fact rows, helper text, and `$` command lines in the log.

### Tertiary (state)
- **OK Green** (`state-ok` / `state-ok-dark`): running, finished, server online, positive deltas.
- **Busy Amber** (`state-busy` / `state-busy-dark`): queued, building, starting, degraded, unhealthy; warning and hidden log lines.
- **Bad Red** (`state-bad` / `state-bad-dark`): exited, failed, unreachable, negative deltas; stderr lines; the failed chart series; the destructive focus ring.

### Neutral
- **Canvas** (`canvas` / `canvas-dark`): behind the shell from `lg`: sidebar, brand cell, top bar strip, status bar.
- **Page** (`page` / `page-dark`): the inset page panel, the top bar's working half, outline keys on light, the selected segment of toggles.
- **Card** (`card` / `card-dark`): every card, popover, toast, chart tooltip and docked column.
- **Muted** (`muted` / `muted-dark`): hover and active fills (nav items, rail items, menu rows), segmented-control tracks, chips, read-only inputs, empty meter segments. Debug log lines sit on `hover-dark` in dark mode.
- **Border** (`border` / `border-dark`): every card edge, header seam and divider. Dark inputs and outline keys use `input-dark` for the edge and a 30% wash of it as fill.
- **Ring** (`ring` / `ring-dark`): focus outlines at 50% strength.
- **Text** (`fg`, `fg-muted`, `fg-faint`; dark `fg-dark`, `fg-muted-dark`): titles and values; descriptions, meta and axis labels; log timestamps. In dark mode body copy defaults to the muted step and titles to full foreground.
- **Log** (`log-bg` / `log-bg-dark`): the log body and its pinned time column.

### Named Rules
**The Ink Key Rule.** The filled key is ink, never blue. Blue is for data and links; a blue button is off-system.

**The State-Only Colour Rule.** Green, amber and red appear only to report live state (lamps, badges, rail and feed dots, meters, deltas, log lines, the failed chart series). They never fill a control or mark a category.

## Typography

**Display Font:** none; the largest role is the 30px stat figure.
**Body Font:** DM Sans (with ui-sans-serif, system-ui), variable 100 to 1000, stylistic set `ss01` off.
**Label/Mono Font:** JetBrains Mono (with ui-monospace, SFMono-Regular, Menlo).

**Character:** A soft, open geometric grotesque in mid weights against a programmer's mono; it reads like a modern product dashboard that still prints its logs honestly.

### Hierarchy
- **Stat value** (600, 30px/36px, -0.02em, tabular): dashboard stat figures; units in `small` at 15px 500 muted.
- **Headline** (600, 22px/28px, -0.02em): page `h1` and the resource name in the summary card.
- **Title** (600, 15px/20px, -0.01em): card header titles (sections, settings sections, chart and console cards).
- **Title small** (600, 14px, -0.01em): the log panel and Resources column titles. Stat card heads use 14px at 500.
- **Body** (400, 14px/20px): default copy and form text.
- **UI** (500, 13px): card descriptions (400, muted), actions, rail names (13.5px 500), feed rows, rail footer.
- **Label** (500, 12px): badges, table headers, sidebar group names (60% foreground, sentence case), status bar, rail status, stat notes.
- **Axis** (400, 11px, tabular): chart axes.
- **Log** (JetBrains Mono 400, 12px/1.65): log lines; command lines at 600.
- **Mono meta** (JetBrains Mono 400, 12px/1): feed times and meta, short SHAs, UUIDs, the version.
- **Key cap** (JetBrains Mono 500, 10.5px/1): `kbd` hints (Ctrl B, Ctrl K) and filter counts.

### Named Rules
**The Machine-Text Rule.** Anything a machine wrote (log lines, SHAs, UUIDs, times in the feed, versions, counts, key caps) is JetBrains Mono. Labels and prose never are.

**The Sentence-Case Rule.** Titles, group names and badges are sentence case with no tracking; uppercase labels are off-system.

## Layout

Below `lg` (1024px) upstream's stacked layout stays, with a sticky mobile bar. From `lg` the shell is inset: a 48px top bar whose brand cell tracks the sidebar (224px, collapsing to a 64px rail with Cmd/Ctrl+B, remembered); the page panel is drawn by a fixed pseudo-element behind the content (top and right inset by the 8px gutter, bottom resting on the 36px status bar, left on the sidebar edge), so the document still scrolls normally. The top bar's working half is the panel's head (14px top corners, bottom seam on scroll). The status bar sits on the canvas below the panel: up to four servers as dot, name, state and proxy, then the version at the right.

Inside the panel, content uses upstream's page grid; card stacks and grids gap at 16px. The dashboard opens with a stat row (`auto-fit, minmax(220px, 1fr)`), then the deployment activity chart, then the console and lists.

From `xl` (1280px) an application page is three cards across the panel with 16px gaps and 16px insets: a 240px Resources column, the centre stack (summary card, then settings cards), and, when open, the log column at `minmax(340px, 34%)`. Side columns are sticky and fill the height between top bar and status bar. Below `xl` the log opens as a right-edge sheet (`min(440px, 90vw)`) with a vertical "Log" tab to reopen it.

Rhythm: 4, 8, 12, 16, 20px. Card headers are 52px minimum with 20px left padding; card bodies pad 16 to 20px.

**The One Panel Rule.** From `lg` the page is a single rounded panel on the canvas; chrome (sidebar, brand, status bar) never sits inside it and cards never sit outside it.

## Elevation & Depth

Soft and shallow. Cards and docked columns carry a small two-layer shadow over a 1px border; overlays carry a 1px border ring plus a larger diffuse shadow; buttons and inputs carry a hairline 1px shadow. Shadows deepen in dark mode only for overlays. Tailwind's `shadow-xs/sm` utilities are re-pointed to the card shadow and `shadow-md` and above to the overlay shadow; the top bar has no blur.

### Shadow Vocabulary
- **Control** (`box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.05)`): buttons, inputs.
- **Card** (`box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1)`): cards, the page panel, the selected segment in segmented controls, active tabs.
- **Overlay** (`box-shadow: 0 0 0 1px <border>, 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 8px 24px -6px rgb(0 0 0 / 0.14)`; dark `0 1px 3px 0 rgb(0 0 0 / 0.3), 0 12px 32px -8px rgb(0 0 0 / 0.6)`): popovers, menus, toasts, the command palette, chart tooltips, the log sheet, grid cards on hover.
- **Focus** (`outline: 3px solid <ring at 50%>; outline-offset: 1px`; inputs: ring-coloured border plus `0 0 0 3px` ring at 50%; destructive keys: red at 40%).
- **Lamp halo** (`box-shadow: 0 0 0 3px <state at 18%>`): status lamps and status bar dots.

### Named Rules
**The Soft Lift Rule.** Depth is a border plus a soft shadow, never a hard offset or a glow. Only grid cards lift on hover (2px up, overlay shadow); everything else stays put.

## Shapes

Rounded and consistent: cards, the page panel, toasts and docked columns 14px; buttons, inputs, menu items, rail items, segmented tracks and tooltips 8px; segments, log line highlights, the collapse tooltip and chart bar tops 6px; key caps 4px; badges, chips, counts and meter segments are pills. A box never sits inside another box: section bodies, nested groups and boxes inside a card lose their frames and become seam-divided rows. The stat card's inner well (8px, 1px border, 20% muted wash) is the one sanctioned inset.

## Components

### Buttons
- **Shape:** 8px, 1px border, sentence case, 500 weight, control shadow.
- **Primary:** ink fill and border, light text; hover steps to the hover ink. The Deploy split action uses the same key, its caret divided by a 20% foreground seam.
- **Outline (default):** page fill with border on light, hover to muted; on dark a 30% wash of the input edge, 50% on hover, icons at 85%.
- **Press / Focus:** keys scale to 0.97 on press (spring, 120ms); no hover lift. Focus is the 3px ring at 50%, offset 1px; destructive keys take a red ring.

### Status
- **Badge:** 22px pill, 1px border, transparent, 12px 500 text, an 8px lamp inside.
- **Lamp:** 8px dot in the state colour with an 18% halo; stopped or unknown is an empty 1.5px ring. In-progress states pulse at 1.6s.
- **Dots:** rail, log and feed status use a 6 to 8px dot beside 12px 500 text tinted in the state colour.

### Cards / Containers
- **Corner Style:** 14px.
- **Background:** card step.
- **Shadow Strategy:** card shadow; see Elevation.
- **Border:** 1px border; the header row is divided by a 1px bottom seam.
- **Header:** 52px minimum, title on the left, description below it in 13px muted, actions on the right.
- Applies to settings sections, `section-heading` sections, the environment resource list (toolbar as header, pagination behind a top seam), empty states and dialogs (no shadow).

### Inputs / Fields
- **Style:** 8px, 1px input edge, transparent fill (dark: 30% wash of the input edge), control shadow.
- **Focus:** border takes the ring colour plus a 3px ring at 50%.
- **Read-only:** muted fill, muted text.

### Segmented controls
- View toggles, tabs and log filters: a muted track (8px), segments 6px; the selected segment is page-filled with the card shadow. Counts inside segments are mono pills on a 7% foreground wash.

### Navigation
- **Sidebar:** on the canvas, no edge. Items 8px, hover and active on the muted fill, active at 500 in full foreground; press scales to 0.98. Group names 12px 500 at 60% foreground. The search field is page-filled with an inset border.
- **Collapse toggle:** beside the wordmark, 28px, with a key cap; tooltip is an ink chip that springs in after 400ms.
- **Top bar:** canvas strip; its working half is the page panel's head with a 240px by 30px search field (muted wash, inset border, key cap).
- **Status bar:** 36px on the canvas, 12px muted text, tabular, 7px dots with halo, 1px separators.

### Dashboard stat card
Card at 18px by 20px padding: a 14px 500 head with an 18px muted icon, then an inner well holding the stat value and a 12px note (deltas in green or red at 500) beside a visual: the blue sparkline, or a pill meter of 8px segments in state colours.

### Deployment activity chart
Card with a 15px title, 13px description and a legend of 10px swatches. Stacked bars up to 28px wide on a 180px plot with four 1px border grid bands; finished in chart blue, failed in red, other in light blue; tops rounded 6px. Bars grow from the axis with a 25ms per-day stagger. Hovering a day washes its column at 6% and shows a tooltip card with overlay shadow.

### Deployment console (live feed)
Card with a terminal icon, title and a mono count. Rows are a grid of mono time, 8px state dot (busy pulses), application name at 500 with its environment muted, and mono status and duration; rows are 8px, hover to muted, and slide in from the left.

### Resources column and summary card
- **Resources column:** a sticky 240px card; 48px header (14px title, mono count pill), rows of name, state dot and label, build type in 12px muted; hover muted; active row muted with a 1px inset border; footer link behind a top seam.
- **Summary card:** top of the centre stack, 20px by 24px padding: resource name as Headline, status, a pill chip for the build pack, then a facts row (13px, muted terms, values in foreground, links blue).

### Deployment Log Panel (signature)
The latest deployment's log as a card docked beside the application. Bands top to bottom: 48px header (title, outline status pill tinted by state, "Full log" and hide actions), meta row (mono SHA, commit message, relative time), segmented filter row (All / Warnings / Errors with mono counts; Follow checkbox), body, footer (line count and SHA). The body is JetBrains Mono 12px/1.65 on the log step behind a top seam; lines never wrap, the body scrolls sideways while the 5.4rem time column stays pinned; command lines are link blue at 600 with a `$` prefix, stderr red, warnings and hidden lines amber; hovered lines take the muted fill.

### Motion
Spring easing `cubic-bezier(0.22, 1.25, 0.36, 1)`. Cards rise in (420ms, 8px up from 99.5% scale, staggered 40ms to a 160ms cap); the log card follows 80ms behind the rail. Colour transitions run 150ms; the sidebar collapses in 200ms. Under `prefers-reduced-motion` animations stop and transitions drop to 0s inside the page, and the lamp pulse, docks and log sheet stop animating.

## Do's and Don'ts

### Do:
- **Do** put new tokens and component rules in `pace.css` under `html:root` / `html.dark` / `html:not(#icto-ui)`; answer upstream layered `!important` only inside `@layer utilities`.
- **Do** make every new section a card: 14px, 1px border, card shadow, 52px header row with a 15px 600 title.
- **Do** keep the filled key ink; outline keys for everything else.
- **Do** use the chart blues for data series and keep green, amber and red for state.
- **Do** use JetBrains Mono for logs, SHAs, UUIDs, times, versions, counts and key caps, with tabular numerals.
- **Do** give new entrances the spring and the rise, and cover every animation with the reduced-motion rule.

### Don't:
- **Don't** fill a button blue or with a state colour.
- **Don't** put a box inside a box; inner groups become seam-divided rows.
- **Don't** use hard offset shadows, glows or blur; depth is border plus soft shadow.
- **Don't** set labels in uppercase with tracking; titles and group names are sentence case.
- **Don't** place chrome inside the page panel or cards outside it from `lg`.
- **Don't** bring back brand purple; the logo stays greyscale.
