**Requirements Table**

| Requirement | Version/Details | Notes |
|-------------|-----------------|-------|
| PHP | 8.1 or higher | Ensures compatibility with modern Laravel features. |
| Laravel | 8.0 or higher | Supports Blade components and Vite integration. |
| Composer | Installed | For package installation. |
| npm/yarn | Installed | For Vite builds, though not directly needed for icons. |
| Tailwind CSS | Configured (via Preline) | Allows styling icons with classes like `w-6 h-6`. |
| Vite | Default in Laravel 9+ | Handles any CSS/JS bundling if custom styles are added. |

**Detailed Installation Steps**
1. **Install the Package**: Open your terminal in the project root and run:
   ```
   composer require mallardduck/blade-lucide-icons
   ```
   This pulls in the package and its dependencies, including Blade Icons.

2. **Publish the Configuration File (Optional but Recommended)**: To customize global settings such as default classes (e.g., `w-4 h-4`), attributes, or icon prefixes, execute:
   ```
   php artisan vendor:publish --tag=blade-lucide-icons-config
   ```
   This creates a `config/blade-lucide-icons.php` file where you can define multiple icon sets or adjust paths.

3. **Using Icons in Blade Views**: Icons are self-closing components prefixed with `x-lucide-`. For example:
   - Basic usage: `<x-lucide-activity />`
   - With classes: `<x-lucide-album class="w-6 h-6 text-gray-500" />`
   - With styles: `<x-lucide-anchor style="color: #555" />`
   - Solid variants: `<x-lucide-bike />` (Lucide supports outline and solid styles where applicable).

   Integrate directly into Preline components. For instance, in a Preline dropdown:
   ```
   <div class="hs-dropdown relative inline-flex">
       <button type="button" class="hs-dropdown-toggle py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
           <x-lucide-menu class="w-4 h-4" /> Actions
       </button>
       <!-- Dropdown menu content -->
   </div>
   ```
   Preline's Tailwind classes will style the icon automatically.

4. **Publishing Raw SVG Assets (Optional)**: If you need icons as static images (e.g., for emails or non-Blade contexts), run:
   ```
   php artisan vendor:publish --tag=blade-lucide-icons --force
   ```
   This places SVGs in `public/vendor/blade-lucide-icons`. Use them like: `<img src="{{ asset('vendor/blade-lucide-icons/cloud-moon.svg') }}" width="24" height="24" />`.

5. **Optimize for Production**: Enable caching for Blade Icons by adding to your `AppServiceProvider` boot method:
   ```php
   use Illuminate\Support\Facades\Blade;
   use BladeUI\Icons\Factory;

   public function boot()
   {
       $this->callAfterResolving(Factory::class, function (Factory $factory, $app) {
           $factory->add('lucide', [
               'path' => __DIR__.'/../resources/svg',
               'prefix' => 'lucide',
           ]);
       });
   }
   ```
   Then cache with `php artisan icons:cache`. This reduces compilation time in production.

6. **Build and Test**: Run `npm run dev` to watch assets with Vite. Refresh your app to see icons in action. If using Preline's JS features (e.g., dropdowns), ensure `import 'preline';` remains in `app.js`.

#### Alternative: Client-Side Integration with npm and Vite
If your project involves more JavaScript-heavy components or you want dynamic icon loading, use Lucide's vanilla JS package. This complements Preline's JS import.

**Steps**
1. **Install Lucide**: `npm install lucide`
2. **Configure Tree-Shaking in Vite**: In `vite.config.js`, add an alias:
   ```javascript
   import { defineConfig } from 'vite';
   import laravel from 'laravel-vite-plugin';

   export default defineConfig({
       plugins: [laravel(['resources/js/app.js'])],
       resolve: {
           alias: {
               'lucide-icons': 'lucide/dist/esm/icons',
           },
       },
   });
   ```
   This ensures only used icons are bundled.

3. **Import in app.js**: 
   ```javascript
   import { createIcons, icons } from 'lucide';
   import 'preline'; // Keep your Preline import

   createIcons({ icons }); // Or import specific: import { Activity } from 'lucide-icons/activity.js';
   ```

4. **Use in HTML/Blade**: `<i data-lucide="activity"></i>`. Lucide will replace it with an SVG on page load.

**Comparison Table: Server-Side vs. Client-Side**

| Aspect | Server-Side (Blade Package) | Client-Side (npm + JS) |
|--------|-----------------------------|------------------------|
| Installation | Composer | npm |
| Rendering | Server (Blade compilation) | Client (JS replacement) |
| Performance | Faster initial load; no JS overhead | Tree-shakable; good for dynamic apps |
| Customization | Via config file and attributes | Via JS imports and data attributes |
| Preline Compatibility | High; direct in HTML | High; works alongside Preline JS |
| Best For | Static views | Interactive components |

#### Potential Issues and Troubleshooting
- **Conflicts with Preline**: If Preline components have hardcoded icons, manually replace them in copied code from Preline docs. Tailwind classes like `text-primary` will override Lucide defaults.
- **Vite Bundling Errors**: If tree-shaking fails, verify aliases and restart `npm run dev`.
- **Icon Not Found**: Check the full list at https://lucide.dev/icons for correct names.
- **Laravel Version Mismatch**: If using older Laravel, consider upgrading or fallback to static SVGs.

This integration should elevate your project's UI without complexity, leveraging Lucide's versatility.