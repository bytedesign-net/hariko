#!/usr/bin/env node
/**
 * Hariko contrast gate (WCAG 2.2 relative-luminance ratios).
 *
 * Checks every text/background colour pair the theme uses against the
 * palette in theme.json and every colour variation in styles/colors/*.json.
 * The hero Cover uses the `primary` palette token as a solid background,
 * so it is checked like any other token pair and automatically follows
 * whichever palette variation is active.
 *
 * Usage: npm run contrast   (exits 1 on any FAIL)
 */
const fs = require('fs');
const path = require('path');

const ROOT = path.resolve(__dirname, '..');

function hexToRgb(hex) {
  const h = hex.replace('#', '');
  const full = h.length === 3 ? h.split('').map((c) => c + c).join('') : h;
  const n = parseInt(full, 16);
  return [(n >> 16) & 255, (n >> 8) & 255, n & 255];
}

// WCAG 2.x relative luminance.
function luminance(rgb) {
  const a = rgb.map((v) => {
    v /= 255;
    return v <= 0.03928 ? v / 12.92 : Math.pow((v + 0.055) / 1.055, 2.4);
  });
  return 0.2126 * a[0] + 0.7152 * a[1] + 0.0722 * a[2];
}

// WCAG 2.x contrast ratio between two hex colours.
function contrastRatio(hex1, hex2) {
  const l1 = luminance(hexToRgb(hex1));
  const l2 = luminance(hexToRgb(hex2));
  const lighter = Math.max(l1, l2);
  const darker = Math.min(l1, l2);
  return (lighter + 0.05) / (darker + 0.05);
}

// [name, text slug, background slug, minimum ratio]
// 4.5 = AA normal text; 3 = AA large text / non-text contrast (focus, UI).
const RULES = [
  ['Hero title on hero cover (primary)', 'base-2', 'primary', 4.5],
  ['Body text on base', 'contrast', 'base', 4.5],
  ['Body text on base-2', 'contrast', 'base-2', 4.5],
  ['Body text on light-gray', 'contrast', 'light-gray', 4.5],
  ['Link on base', 'primary', 'base', 4.5],
  ['Link on base-2', 'primary', 'base-2', 4.5],
  ['Link hover on base', 'tertiary', 'base', 4.5],
  ['Link hover on base-2', 'tertiary', 'base-2', 4.5],
  ['Gray text on base', 'gray', 'base', 4.5],
  ['Gray text on base-2', 'gray', 'base-2', 4.5],
  ['Dark gray text on base', 'dark-gray', 'base', 4.5],
  ['Dark gray text on base-2', 'dark-gray', 'base-2', 4.5],
  ['Button text on primary', 'base-2', 'primary', 4.5],
  ['Button hover text on tertiary', 'base-2', 'tertiary', 4.5],
  ['Focus outline on base', 'contrast', 'base', 3],
  ['Focus outline on base-2', 'contrast', 'base-2', 3],
  ['Primary button on base', 'primary', 'base', 3],
  ['Primary button on base-2', 'primary', 'base-2', 3],
];

function readJson(file) {
  return JSON.parse(fs.readFileSync(file, 'utf8'));
}

// Collect palettes: theme.json plus every colour variation.
const palettes = [];

const theme = readJson(path.join(ROOT, 'theme.json'));
palettes.push({
  label: 'theme.json (Hariko)',
  palette: Object.fromEntries(
    theme.settings.color.palette.map((c) => [c.slug, c.color]),
  ),
});

const variationsDir = path.join(ROOT, 'styles', 'colors');
if (fs.existsSync(variationsDir)) {
  for (const file of fs.readdirSync(variationsDir).sort()) {
    if (!file.endsWith('.json')) continue;
    const v = readJson(path.join(variationsDir, file));
    const merged = { ...palettes[0].palette };
    if (v.settings && v.settings.color && v.settings.color.palette) {
      for (const c of v.settings.color.palette) merged[c.slug] = c.color;
    }
    palettes.push({ label: `${file} (${v.title || 'Variation'})`, palette: merged });
  }
}

let failures = 0;
const totalChecks = RULES.length * palettes.length;

for (const { label, palette } of palettes) {
  console.log(`\n== ${label} ==`);
  for (const [name, textSlug, bgSlug, min] of RULES) {
    const fg = palette[textSlug];
    const bg = palette[bgSlug];
    if (!fg || !bg) {
      console.log(`FAIL missing token (${textSlug}/${bgSlug})  ${name}`);
      failures += 1;
      continue;
    }
    const ratio = contrastRatio(fg, bg);
    const pass = ratio >= min;
    if (!pass) failures += 1;
    console.log(
      `${pass ? 'PASS' : 'FAIL'} ${ratio.toFixed(2)}:1 (>= ${min}:1)  ${name}`,
    );
  }
}

console.log(
  `\n${totalChecks - failures}/${totalChecks} checks passed across ${palettes.length} palettes.`,
);
if (failures > 0) {
  console.error(`CONTRAST CHECK FAILED: ${failures} failure(s).`);
  process.exit(1);
}
console.log('All contrast checks passed.');
