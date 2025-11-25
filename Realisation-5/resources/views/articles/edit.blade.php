<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter un article - Editeur Dashboard</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <!-- Summernote CSS -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <!-- Flatpickr for date picker -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f3f4f6;
      font-size: 0.875rem;
    }

    .card {
      background: white;
      border-radius: 0.375rem;
      box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
      max-width: 900px;
      margin: 0 auto;
    }
    .form-control {
      border: 1px solid #d1d5db;
      border-radius: 0.25rem;
      padding: 0.375rem 0.5rem;
      width: 100%;
      font-size: 0.875rem;
    }
    .form-control:focus {
      border-color: #3b82f6;
      box-shadow: 0 0 0 1px #3b82f6;
    }
    .btn-primary {
      background-color: #3b82f6;
      color: white;
      padding: 0.375rem 0.75rem;
      border-radius: 0.25rem;
      border: none;
      cursor: pointer;
    }
    .btn-primary:hover {
      background-color: #2563eb;
    }
    .form-group {
      margin-bottom: 0.75rem;
    }
    .form-label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      color: #4b5563;
    }
    .note-editor.note-frame {
      border: 1px solid #d1d5db !important;
      border-radius: 0.25rem !important;
      margin: 0 !important;
    }
    .note-editor.note-frame .note-editing-area .note-editable {
      min-height: 200px !important;
    }
    .checkbox-group, .radio-group {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }
    .checkbox-item, .radio-item {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    
  .ProseMirror:focus {
    outline: none;
  }

  .tiptap ul p,
  .tiptap ol p {
    display: inline;
  }

  .tiptap p.is-editor-empty:first-child::before {
    content: attr(data-placeholder);
    float: left;
    height: 0;
    pointer-events: none;
  }
</style>
 
</head>
<body class="flex h-screen overflow-hidden">
  <!-- Sidebar -->
  <aside
    id="sidebar"
    class="bg-white w-64 h-full border-r border-gray-200 transition-transform duration-300 ease-in-out transform -translate-x-64 lg:translate-x-0 fixed lg:static z-50"
  >
    <div
      class="flex items-center justify-between p-6 border-b border-gray-100"
    >
      <h1 class="text-xl font-semibold text-blue-700">Blog Groupe 1</h1>
      <button id="closeSidebar" class="lg:hidden text-gray-600 text-xl">
        ✕
      </button>
    </div>

    <nav class="p-4 space-y-2">
      <a
        href="dashboard_Editeur.html"
        class="flex items-center gap-3 text-gray-700 p-2 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="w-5 h-5"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          viewBox="0 0 24 24"
        >
          <path d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8M5 10v10h14V10"></path>
        </svg>
        Dashboard
      </a>
      <a href="dashboard_editeur_articles.html" class="flex items-center gap-3 text-gray-700 p-2 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition" >
        <i class="fa-solid fa-newspaper"></i> Articles
      </a>

      <a href="dashboard_editeur_categories.html" class="flex items-center gap-3 text-gray-700 p-2 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition" >
        <i class="fa-solid fa-newspaper"></i> Categories
      </a>
      
      <a href="dashboard_editeur_users.html" class="flex items-center gap-3 text-gray-700 p-2 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition" >
        <i class="fa-solid fa-newspaper"></i> Users
      </a>

      <a
        href="dashboard_editeur_settings.html"
        class="flex items-center gap-3 text-gray-700 p-2 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition"
      >
        <i class="fa-solid fa-gear"></i>Settings
      </a>
    </nav>
  </aside>

  <!-- Main Content -->
  <div class="flex flex-col flex-1 w-full">
    <!-- Navbar -->
      <header
        class="flex items-center justify-between bg-white shadow-sm px-6 py-4 border-b border-gray-200"
      >
        <div class="flex items-center gap-3">
          <button id="openSidebar" class="lg:hidden text-gray-700 text-2xl">
            ☰
          </button>
          <h2 class="text-lg font-semibold text-slate-800">Dashboard - ajout des articles</h2>
        </div>
        <div class="flex items-center gap-4">
          <button class="text-gray-600 hover:text-blue-600 transition">
            <i class="fa-solid fa-bell"></i>
          </button>
               <!-- Account Dropdown -->
      <div class="hs-dropdown relative inline-block" data-hs-dropdown>
        <button class="flex items-center gap-2 rounded-full hover:bg-gray-200 p-1">
          <img class="w-10 h-10 rounded-full" src="https://images.unsplash.com/photo-1659482633369-9fe69af50bfb" alt="Avatar">
        </button>

        <div class="hs-dropdown-menu hidden absolute right-0 mt-2 min-w-48 bg-white border border-gray-200 rounded-xl shadow-lg z-10">
          <div class="p-4">
            <span class="font-medium text-gray-800">Salma Akajou</span>
            <p class="text-sm text-gray-500">salma@gmail.com</p>
          </div>
          <div class="border-t border-gray-200 py-2">
            <a href="dashboard_editeur_settings.html" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100"><i class="fa-solid fa-gear"></i> Settings</a>
            <a href="../login.html" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100"><i class="fa-solid fa-arrow-right-from-bracket"></i>Log out</a>
          </div>
        </div>
      </div>
      <!-- End Dropdown -->
        </div>
      </header>

    <!-- Dashboard -->
    <main class="flex-1 p-6 overflow-y-auto">
      <div class="max-w-5xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
          <div>
            <h1 class="text-2xl font-semibold text-gray-800">Ajouter un article</h1>
          </div>
          <a href="dashboard_editeur_articles.html" class="text-blue-600 hover:text-blue-800 font-medium">
            <i class="fas fa-arrow-left mr-1"></i>Retour
          </a>
        </div>

        <!-- Formulaire -->
        <div class="card p-6">
          <form>
            <!-- Titre de l'article -->
            <div class="form-group">
              <label for="titre" class="form-label">Titre</label>
              <input type="text" id="titre" class="form-control" placeholder="Entrez le titre de l'article">
            </div>

            <!-- Slug -->
            <div class="form-group">
              <label for="slug" class="form-label">Slug</label>
              <div class="flex">
                <span class="inline-flex items-center px-3 bg-gray-100 border border-r-0 border-gray-300 rounded-l text-gray-600">
                  https://example.com/
                </span>
                <input type="text" id="slug" class="form-control rounded-l-none" placeholder="titre-de-l-article">
              </div>
            </div>

            <!-- Image de couverture -->
            <div class="form-group">
              <label class="form-label">Image de couverture</label>
              <div class="border-2 border-dashed border-gray-300 rounded p-4 text-center">
                <div class="space-y-2">
                  <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 48 48" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" />
                  </svg>
                  <div class="flex justify-center text-sm text-gray-600">
                    <label class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                      <span>Choisir un fichier</span>
                      <input type="file" class="sr-only">
                    </label>
                    <p class="pl-1">ou glisser-déposer</p>
                  </div>
                  <p class="text-xs text-gray-500">PNG, JPG, GIF jusqu'à 10MB</p>
                </div>
              </div>
            </div>

       <div class="form-group mb-6">
  <!-- Tiptap -->
  <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
    <div id="hs-editor-tiptap">

      <!-- Toolbar -->
      <div class="sticky top-0 bg-white flex align-middle gap-x-0.5 border-b border-gray-200 p-2 text-black">
        <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-bold="">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14 12a4 4 0 0 0 0-8H6v8"></path>
            <path d="M15 20a4 4 0 0 0 0-8H6v8Z"></path>
          </svg>
        </button>

        <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-italic="">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" x2="10" y1="4" y2="4"></line>
            <line x1="14" x2="5" y1="20" y2="20"></line>
            <line x1="15" x2="9" y1="4" y2="20"></line>
          </svg>
        </button>

        <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-underline="">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M6 4v6a6 6 0 0 0 12 0V4"></path>
            <line x1="4" x2="20" y1="20" y2="20"></line>
          </svg>
        </button>

        <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-strike="">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M16 4H9a3 3 0 0 0-2.83 4"></path>
            <path d="M14 12a4 4 0 0 1 0 8H6"></path>
            <line x1="4" x2="20" y1="12" y2="12"></line>
          </svg>
        </button>

        <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-link="">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
          </svg>
        </button>

        <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-ol="">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="10" x2="21" y1="6" y2="6"></line>
            <line x1="10" x2="21" y1="12" y2="12"></line>
            <line x1="10" x2="21" y1="18" y2="18"></line>
            <path d="M4 6h1v4"></path>
            <path d="M4 10h2"></path>
            <path d="M6 18H4c0-1 2-2 2-3s-1-1.5-2-1"></path>
          </svg>
        </button>

        <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-ul="">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="8" x2="21" y1="6" y2="6"></line>
            <line x1="8" x2="21" y1="12" y2="12"></line>
            <line x1="8" x2="21" y1="18" y2="18"></line>
            <line x1="3" x2="3.01" y1="6" y2="6"></line>
            <line x1="3" x2="3.01" y1="12" y2="12"></line>
            <line x1="3" x2="3.01" y1="18" y2="18"></line>
          </svg>
        </button>

        <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-blockquote="">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17 6H3"></path>
            <path d="M21 12H8"></path>
            <path d="M21 18H8"></path>
            <path d="M3 12v6"></path>
          </svg>
        </button>

        <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-code="">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m18 16 4-4-4-4"></path>
            <path d="m6 8-4 4 4 4"></path>
            <path d="m14.5 4-5 16"></path>
          </svg>
        </button>
      </div>

      <!-- Editor Field -->
      <div class="h-40 overflow-auto text-black text-gary-400" data-hs-editor-field="" style="color: rgb(142, 139, 139);"></div>


    </div>
  </div>
  <!-- End Tiptap -->
</div>


            <!-- Date de publication -->
            <div class="form-group mb-6">
              <label for="date" class="form-label">Date de publication</label>
              <input type="date" id="date" class="form-control">
            </div>

            <div class="form-group">
              <label for="titre" class="form-label">Tags</label>
              <input type="text" id="titre" class="form-control" placeholder="Entrez les tags de l'article">
            </div>

            <!-- Ligne Catégories et Statut -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
              <!-- Catégories -->
              <div class="form-group">
                <label class="form-label">Catégories</label>
                <div class="checkbox-group">
                  <label class="checkbox-item">
                    <input type="checkbox" name="categories" value="1" class="rounded border-gray-300 text-blue-600">
                    <span>Voyage</span>
                  </label>
                  <label class="checkbox-item">
                    <input type="checkbox" name="categories" value="2" class="rounded border-gray-300 text-blue-600">
                    <span>Technologie</span>
                  </label>
                  <label class="checkbox-item">
                    <input type="checkbox" name="categories" value="3" class="rounded border-gray-300 text-blue-600">
                    <span>Cuisine</span>
                  </label>
                </div>
              </div>

              <!-- Statut -->
              <div class="form-group">
                <label class="form-label">Statut</label>
                <div class="radio-group">
                  <label class="radio-item">
                    <input type="radio" name="statut" value="brouillon" class="text-blue-600" checked>
                    <span>Brouillon</span>
                  </label>
                  <label class="radio-item">
                    <input type="radio" name="statut" value="edition" class="text-blue-600">
                    <span>En édition</span>
                  </label>
                  <label class="radio-item">
                    <input type="radio" name="statut" value="a_valider" class="text-blue-600">
                    <span>À valider</span>
                  </label>
                </div>
              </div>
            </div>

            <!-- Bouton de soumission -->
            <div class="mt-8 pt-4 border-t border-gray-200">
              <button type="submit" class="btn-primary">
                <i class="fas fa-save mr-2"></i>Enregistrer
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Scripts -->
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
      <script>
        // Initialisation de Summernote
        $(document).ready(function() {
          $('#summernote').summernote({
            height: 250,
            toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
              ['fontname', ['fontname']],
              ['fontsize', ['fontsize']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['height', ['height']],
              ['table', ['table']],
              ['insert', ['link', 'picture', 'video']],
              ['view', ['fullscreen', 'codeview', 'help']]
            ],
            placeholder: 'Saisissez le contenu de l\'article ici...',
            dialogsInBody: true,
            fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '24', '36'],
            lineHeights: ['1.0', '1.2', '1.4', '1.5', '1.6', '1.8', '2.0', '3.0']
          });
        });
      </script>
    </main>
  </div>

  <!-- JS for sidebar toggle -->
  <script>
    const sidebar = document.getElementById("sidebar");
    const openSidebar = document.getElementById("openSidebar");
    const closeSidebar = document.getElementById("closeSidebar");

    openSidebar.addEventListener("click", () => {
      sidebar.classList.remove("-translate-x-64");
    });

    closeSidebar.addEventListener("click", () => {
      sidebar.classList.add("-translate-x-64");
    });


    
  </script>
  <script type="module">
  import { Editor } from 'https://esm.sh/@tiptap/core@2.11.0';
  import StarterKit from 'https://esm.sh/@tiptap/starter-kit@2.11.0';
  import Placeholder from 'https://esm.sh/@tiptap/extension-placeholder@2.11.0';
  import Paragraph from 'https://esm.sh/@tiptap/extension-paragraph@2.11.0';
  import Bold from 'https://esm.sh/@tiptap/extension-bold@2.11.0';
  import Underline from 'https://esm.sh/@tiptap/extension-underline@2.11.0';
  import Link from 'https://esm.sh/@tiptap/extension-link@2.11.0';
  import BulletList from 'https://esm.sh/@tiptap/extension-bullet-list@2.11.0';
  import OrderedList from 'https://esm.sh/@tiptap/extension-ordered-list@2.11.0';
  import ListItem from 'https://esm.sh/@tiptap/extension-list-item@2.11.0';
  import Blockquote from 'https://esm.sh/@tiptap/extension-blockquote@2.11.0';

  const editor = new Editor({
    element: document.querySelector('#hs-editor-tiptap [data-hs-editor-field]'),
    editorProps: {
      attributes: {
        class: 'relative min-h-40 p-3'
      }
    },
    extensions: [
      StarterKit.configure({
        history: false
      }),
      Placeholder.configure({
        placeholder: 'Add a message, if you\'d like.',
        emptyNodeClass: 'before:text-gray-300'
      }),
      Paragraph.configure({
        HTMLAttributes: {
          class: 'text-inherit text-black-400 leading-6 mb-3'
        }
      }),
      Bold.configure({
        HTMLAttributes: {
          class: 'font-bold'
        }
      }),
      Underline,
      Link.configure({
        HTMLAttributes: {
          class: 'inline-flex items-center gap-x-1 text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-white'
        }
      }),
      BulletList.configure({
        HTMLAttributes: {
          class: 'list-disc list-inside text-gray-800 dark:text-white'
        }
      }),
      OrderedList.configure({
        HTMLAttributes: {
          class: 'list-decimal list-inside text-gray-800 dark:text-white'
        }
      }),
      ListItem.configure({
        HTMLAttributes: {
          class: 'marker:text-sm'
        }
      }),
      Blockquote.configure({
        HTMLAttributes: {
          class: 'relative border-s-4 ps-4 sm:ps-6 dark:border-neutral-700 sm:[&>p]:text-lg'
        }
      })
    ]
  });
  const actions = [
    {
      id: '#hs-editor-tiptap [data-hs-editor-bold]',
      fn: () => editor.chain().focus().toggleBold().run()
    },
    {
      id: '#hs-editor-tiptap [data-hs-editor-italic]',
      fn: () => editor.chain().focus().toggleItalic().run()
    },
    {
      id: '#hs-editor-tiptap [data-hs-editor-underline]',
      fn: () => editor.chain().focus().toggleUnderline().run()
    },
    {
      id: '#hs-editor-tiptap [data-hs-editor-strike]',
      fn: () => editor.chain().focus().toggleStrike().run()
    },
    {
      id: '#hs-editor-tiptap [data-hs-editor-link]',
      fn: () => {
        const url = window.prompt('URL');
        editor.chain().focus().extendMarkRange('link').setLink({ href: url }).run();
      }
    },
    {
      id: '#hs-editor-tiptap [data-hs-editor-ol]',
      fn: () => editor.chain().focus().toggleOrderedList().run()
    },
    {
      id: '#hs-editor-tiptap [data-hs-editor-ul]',
      fn: () => editor.chain().focus().toggleBulletList().run()
    },
    {
      id: '#hs-editor-tiptap [data-hs-editor-blockquote]',
      fn: () => editor.chain().focus().toggleBlockquote().run()
    },
    {
      id: '#hs-editor-tiptap [data-hs-editor-code]',
      fn: () => editor.chain().focus().toggleCode().run()
    }
  ];

  actions.forEach(({ id, fn }) => {
    const action = document.querySelector(id);

    if (action === null) return;

    action.addEventListener('click', fn);
  });
</script>
</body>
</html>