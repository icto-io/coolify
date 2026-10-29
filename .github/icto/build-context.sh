#!/usr/bin/env bash
# build-context.sh <upstream-tag> <out-dir>
# Stages the icto-ui layer for an image built on coollabsio/coolify:<version>:
# the built assets, every view, and each app/route/config file that differs from
# the upstream tag. Run `npm run build` first.
set -euo pipefail

TAG=$1
OUT=$2
VERSION=${TAG#v}
ROOT=$(git rev-parse --show-toplevel)

rm -rf "$OUT"
mkdir -p "$OUT/layer/public" "$OUT/layer/resources"
cp -r "$ROOT/public/build" "$OUT/layer/public/build"
cp -r "$ROOT/resources/views" "$OUT/layer/resources/views"

git -C "$ROOT" diff --name-only --diff-filter=AMR "$TAG" HEAD -- app routes config bootstrap |
    while read -r file; do
        mkdir -p "$OUT/layer/$(dirname "$file")"
        cp "$ROOT/$file" "$OUT/layer/$file"
    done

cat > "$OUT/Dockerfile" <<DOCKERFILE
FROM docker.io/coollabsio/coolify:$VERSION
LABEL org.opencontainers.image.source="https://github.com/icto-io/coolify" \\
      org.opencontainers.image.revision="$(git -C "$ROOT" rev-parse HEAD)" \\
      org.opencontainers.image.description="Coolify $VERSION with the icto-ui Pace layer"
COPY --chown=www-data:www-data layer/ /var/www/html/
DOCKERFILE
