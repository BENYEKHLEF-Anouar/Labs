 Preline UI is a Tailwind CSS-based component library, so Tailwind must be installed (it is by default in new Laravel 12 projects). You'll need Node.js and npm.
 

 * 01 - Install Preline UI via npm:
 ```
 npm install preline
 ```

 * 02 - Add the Preline UI CSS Variants and @source for Preline UI JavaScript

  Import the Preline UI CSS Variants file variants.css into your app.css file, ensuring it comes after the tailwindcss import and add source for Preline UI JavaScript.
```
@import "tailwindcss";

/* Preline UI */
@import "../../node_modules/preline/variants.css";
@source "../../node_modules/preline/dist/*.js";

/* Plugins */
/* @plugin "@tailwindcss/forms"; */
```


 * 03 - Add the Preline UI JavaScript

 Add the Preline UI JavaScript in your app entry point app.js
 ```
 // index.js
import 'preline'
```

 * 04 - Loading your scripts
 
 With your Vite entry points configured, you only need reference them in a @vite() Blade directive that you add to the <head> of your application's root template
 ```
 <!doctype html>
<head>
    {{-- ... --}}
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
```
    
 * 05 - Run npm run dev for development and test components from Preline's docs.


 Documentaion: https://preline.co/docs/frameworks-laravel.html