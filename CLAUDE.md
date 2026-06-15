# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Overview

**SAP Sales Hub** is a single-file React application for managing SAP projects and sales opportunities. The entire app runs in `index.html` using CDN-loaded dependencies—**no build step, npm, or bundler needed**.

- **Entry point**: `index.html` (320+ lines of HTML + embedded React JSX)
- **Runtime**: Browser, via `<script type="text/babel">` with Babel standalone
- **Framework**: React 18 (UMD), Tailwind CSS, Lucide Icons (all CDN)
- **State**: React hooks + LocalStorage persistence
- **Data key**: `sap-sales-hub:v1` (JSON-serialized leads array)

## Running the App

**Quick start:**
```bash
# Just open in browser (double-click index.html)
# OR use a static server:
python -m http.server 8000
# Then visit http://localhost:8000
```

Requires internet on first run to load React, Tailwind, and Lucide from CDN.

## Code Architecture (`index.html`)

The `<script type="text/babel">` section is organized as:

1. **Constants** — storage key, SAP module list (FI, CO, MM, SD, PP, HCM, WM, QM, S/4HANA), scale options (Nhỏ/Vừa/Lớn), styling maps.
2. **Utilities**
   - `Icon(name, className, size)` — wraps Lucide UMD icons into React components.
   - `loadLeads()` — reads from LocalStorage, returns array or `[]`.
3. **UI Components** (function-based, no external files)
   - `StatCard` — dashboard stat box (icon + label + value).
   - `LeadForm` — form to add new lead (Tên KH, Phân hệ SAP, Quy mô).
   - `LeadTable` — renders lead rows with delete button.
   - `App` — main component (state management, LocalStorage sync, export JSON).

### Key Patterns

**LocalStorage sync:**
```javascript
useEffect(() => {
  localStorage.setItem(STORAGE_KEY, JSON.stringify(leads));
}, [leads]);
```
Leads auto-persist whenever the array changes.

**Icon integration:**
```javascript
function Icon({ name, className, size }) {
  const ref = useRef(null);
  useEffect(() => {
    if (ref.current && window.lucide) {
      // Renders Lucide icon dynamically into DOM
      ref.current.innerHTML = "";
      const el = document.createElement("i");
      el.setAttribute("data-lucide", name);
      ref.current.appendChild(el);
      window.lucide.createIcons({ ... });
    }
  }, [name, className, size]);
  return <span ref={ref} className="inline-flex" />;
}
```
Uses Lucide's UMD API to render icons after component mount.

**Export JSON:**
```javascript
function exportJSON() {
  const blob = new Blob([JSON.stringify(leads, null, 2)], { type: "application/json" });
  const url = URL.createObjectURL(blob);
  const a = document.createElement("a");
  a.href = url;
  a.download = `sap-sales-hub-${date}.json`;
  a.click();
  URL.revokeObjectURL(url);
}
```
Creates and downloads a timestamped JSON file.

## Adding New Modules

The app is designed for future modules (Opportunity, Quotation, Project Tracking). To add a new module:

1. Define constants at the top (module name, fields, styling).
2. Create UI components (Form, Table) following the Lead pattern.
3. Extend `App` state to include new entity (e.g., `opportunities`).
4. Add LocalStorage key for the new entity.
5. Add new section in the Dashboard and main area.
6. Update export to include all entities.

Example for Opportunity module:
```javascript
// Add to App state
const [opportunities, setOpportunities] = useState(loadOpportunities);

// Add to export
function exportJSON() {
  const data = { leads, opportunities, // ... more entities
  };
  // ... create and download
}
```

## Tailwind & Icon Classes

- **Tailwind**: Via CDN `<script src="https://cdn.tailwindcss.com"></script>`. All utility classes available (grid, flex, hover states, etc.).
- **Lucide icons**: Via `<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>`. Use icon names directly in the `Icon` component (e.g., `<Icon name="plus" />`).

## LocalStorage Data Shape

```json
[
  {
    "id": 1718470800000,
    "name": "Công ty ABC",
    "module": "FI",
    "scale": "Lớn",
    "createdAt": "2026-06-15T14:13:20.000Z"
  }
]
```

To inspect/clear in DevTools: `localStorage.getItem('sap-sales-hub:v1')` or `localStorage.removeItem('sap-sales-hub:v1')`.

## Development Notes

- **No hot-reload**: Changes require browser refresh. For rapid iteration, edit `index.html`, save, and reload the page.
- **No TypeScript**: Plain JavaScript. Type hints can be added via JSDoc if needed.
- **No testing framework**: Manually test features in the browser or refactor to use a test runner if scope grows.
- **CDN reliability**: The app requires internet to load React, Tailwind, and Lucide. For offline use, consider downloading and serving files locally.
- **Browser DevTools**: Use Console to inspect state (`localStorage`), and React DevTools extension for component debugging.

## Future Improvements

Per README:
- Search / filter / sort leads.
- Import JSON to restore data.
- Add Opportunity, Quotation, Project Tracking modules.
- Consider migrating to a proper build setup (Vite + npm) once complexity grows beyond single-file limits.
