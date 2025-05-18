#!/usr/bin/env bash
echo "Skipping Chromium download during build"
export PUPPETEER_SKIP_CHROMIUM_DOWNLOAD=true
npm install
