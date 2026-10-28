# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Users

A single operator: the owner of the instance, deploying and watching their own
projects and icto.io's apps on one ARM VPS (linerx, icto.io, portfolio). The
job is routine operations: check that apps are up, push-to-deploy, read build
and runtime logs when something breaks, and occasionally change domains,
environment variables, or resources. No team members or clients log in.

## Product Purpose

Coolify is a self-hosted platform to deploy applications, databases, and
services on your own servers over SSH: an open-source alternative to Heroku,
Netlify, and Vercel. This fork (`icto-io/coolify`, branch `icto-ui`) exists to
give the same product a new visual design. Success is a UI that is faster to
scan and calmer to operate day to day, while staying a drop-in replacement for
upstream Coolify.

## Positioning

Unchanged from upstream: the user's configurations and running resources stay
on their own servers, and keep working if Coolify itself goes away.

## Operating Context

- Accessed at `https://coolify.icto.io`, from a Mac browser.
- Deployments are triggered by GitHub pushes through GitHub Apps; the UI is
  mostly used to monitor deployments, read logs, and edit configuration.
- One server (`localhost`), one project (`production`), a handful of
  applications, including Docker Compose stacks.

## Capabilities and Constraints

- Scope (revised 2026-10-27): a full redesign, not a recolour. Layouts,
  components, page structure and the app shell may change, and Blade
  templates may be edited. Behaviour must not change: same routes, Livewire
  and Alpine wiring, features, flows, and labels.
- The sidebar must be clearly collapsible (prominent toggle, keyboard
  shortcut, polished collapsed rail).
- Stack is upstream's: Laravel + Livewire + Blade + Alpine + Tailwind v4
  (`resources/css/app.css` `@theme` tokens, `resources/css/utilities.css`,
  shared Blade components in `resources/views/components`).
- Upstream merges are accepted to cost template conflicts. Still prefer
  shared components and layers where they give the same result.
- Based on upstream `v4.5.0`. The image is built for `linux/arm64`.

## Brand Commitments

- The product keeps the name "Coolify" and its logo.
- Apache 2.0 license and notices stay intact.

## Evidence on Hand

- Upstream's current design system: `DESIGN.md` (incumbent visual world,
  evidence for the redesign, not the target).
- The owner's own words: needs status at a glance, following deployments,
  debugging and changing config; logs are painful; the stock UI looks
  generic and dated; avoid losing density and anything flashy. The first
  redesign ("Appliance", a Braun recolour) was rejected as "just changed the
  colors".

## Product Principles

1. Operations first: status and the next action are readable at a glance.
2. Same product, new design: never change what a screen does.
3. Shared layers first; edit a screen's template when the design needs it.
4. Logs and data are the hero; chrome stays quiet.
