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

- Scope is visual only: same screens, flows, labels, features, and copy as
  upstream. Navigation and page structure stay as upstream defines them.
- Stack is upstream's: Laravel + Livewire + Blade + Alpine + Tailwind v4
  (`resources/css/app.css` `@theme` tokens, `resources/css/utilities.css`,
  shared Blade components in `resources/views/components`).
- The fork must stay mergeable with upstream releases. Prefer changes to
  tokens, shared utilities, and shared components over per-screen edits.
- Based on upstream `v4.5.0`. The image is built for `linux/arm64`.

## Brand Commitments

- The product keeps the name "Coolify" and its logo.
- Apache 2.0 license and notices stay intact.

## Evidence on Hand

- Upstream's current design system: `DESIGN.md` (incumbent visual world,
  evidence for the redesign, not the target).
- No user research, analytics, or screenshots of the user's own pain points
  were provided.

## Product Principles

1. Operations first: status and the next action are readable at a glance.
2. Same product, new look: never change what a screen does or says.
3. Stay mergeable: concentrate the change in shared layers.
4. Logs and data are the hero; chrome stays quiet.
