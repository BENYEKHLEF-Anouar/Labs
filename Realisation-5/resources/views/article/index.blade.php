<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Editeur Dashboard Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/preline/dist/preline.js"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
      integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap"
      rel="stylesheet"
    />

    <style>
      body {
        font-family: "Inter", sans-serif;
        background-color: #f8fafc;
        transition: background-color 0.3s ease;
      }
      .apexcharts-tooltip.apexcharts-theme-light {
        background-color: transparent !important;
        border: none !important;
        box-shadow: none !important;
      }
      /* Styles pour le tableau */
      .table-container {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        margin: 0 -1rem;
        padding: 0 1rem;
      }
      /* Réduire la largeur des colonnes */
      .w-72 {
        width: 120px !important;
        max-width: 120px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
      }
      /* Ajuster la largeur du contenu */
      .content-cell {
        max-width: 150px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }
      /* Ajuster le padding des cellules */
      .px-6 {
        padding-left: 0.75rem !important;
        padding-right: 0.75rem !important;
      }
      /* Style du bouton Ajouter */
      .btn-ajouter {
        padding: 0.4rem 0.75rem !important;
        font-size: 0.75rem !important;
        white-space: nowrap;
      }
      /* Styles pour les bordures visibles */
      .search-box input,
      .category-select select {
        border: 1px solid #d1d5db !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
      }
      /* Styles pour les icônes d'action */
      .action-icon {
        transition: color 0.2s ease;
        cursor: pointer;
      }
      .action-icon.info {
        color: #3b82f6; /* Bleu */
      }
      .action-icon.edit {
        color: #10b981; /* Vert */
      }
      .action-icon.delete {
        color: #ef4444; /* Rouge */
      }
      .action-icon:hover {
        opacity: 0.8;
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
        <a href="{{ route('article.index') }}" class="flex items-center gap-3 text-gray-700 p-2 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition" >
          <i class="fa-solid fa-newspaper"></i> Articles
        </a>  

        <a href="dashboard_editeur_categories.html" class="flex items-center gap-3 text-gray-700 p-2 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition" >
          <i class="fa-solid fa-newspaper"></i> Catégories
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
          <h2 class="text-lg font-semibold text-slate-800">Dashboard - articles</h2>
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
  <main class="flex-1 px-6 overflow-y-auto">


<!-- Table Section -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Card -->
  <div class="flex flex-col">
    <div class="overflow-x-auto [&::-webkit-scrollbar]:h-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-300">
      <div class="min-w-full inline-block align-middle">
        <div class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden">
          <!-- Header -->
          <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
            <div>
              <h2 class="text-xl font-semibold text-gray-800">
                Articles
              </h2>
              <p class="text-sm text-gray-500 whitespace-nowrap">Voir et gérer les articles</p>
            </div>

            <div class="flex items-center gap-3 w-full justify-end">
              <!-- SearchBox -->
              <div class="relative w-64 search-box">
                <div class="relative">
                  <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-3.5">
                    <svg class="shrink-0 size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <circle cx="11" cy="11" r="8"></circle>
                      <path d="m21 21-4.3-4.3"></path>
                    </svg>
                  </div>
                  <input id="searchInput" class="py-2 pl-10 pr-4 block w-full border rounded-lg text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-200 disabled:opacity-50 disabled:pointer-events-none bg-white" type="text" placeholder="Rechercher..." value="">
                </div>
              </div>
              <!-- End SearchBox -->

              <!-- Select Categories -->
              <div class="w-48">
                <select id="categoryFilter" class="category-select py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 focus:ring-1 focus:ring-blue-200 disabled:opacity-50 disabled:pointer-events-none bg-white">
                  <option value="">Toutes catégories</option>
                  @foreach($categories as $category)
                    <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                  @endforeach
                </select>
              </div>
              <!-- End Select Categories -->

              <!-- Add Button -->
              <div class="flex-shrink-0">
                <a class="btn-ajouter inline-flex items-center gap-x-1.5 text-xs font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="{{ route('article.edit', 0) }}">
                  <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                  Ajouter article
                </a>
              </div>
              <!-- End Add Button -->
            </div>
          </div>
          <!-- End Header -->

          <!-- Table -->
          <div class="table-container">
          <table class="w-full divide-y divide-gray-200" style="min-width: 1200px;">
            <thead class="bg-gray-50 ">
              <tr> 
                <th scope="col" class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start ">
                  <div class="flex items-center gap-x-2 px-4">
                    <span class="text-xs font-semibold uppercase text-gray-800">
                      Titre
                    </span>
                  </div>
                </th>

                <th scope="col" class="px-6 py-3 text-start">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase text-gray-800">
                      Slug
                    </span>
                  </div>
                </th>

                <th scope="col" class="px-6 py-3 text-start">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase text-gray-800">
                      Auteur
                    </span>
                  </div>
                </th>

                <th scope="col" class="px-6 py-3 text-start">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase text-gray-800">
                      Vues
                    </span>
                  </div>
                </th>

                <th scope="col" class="px-6 py-3 text-start">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase text-gray-800">
                      Partages
                    </span>
                  </div>
                </th>

                <th scope="col" class="px-6 py-3 text-start">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase text-gray-800">
                      Catégorie
                    </span>
                  </div>
                </th>

                <th scope="col" class="px-6 py-3 text-start">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase text-gray-800">
                      Statut
                    </span>
                  </div>
                </th>

                <th scope="col" class="px-6 py-3 text-start">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase text-gray-800">
                      Date
                    </span>
                  </div>
                </th>
                 
                <th scope="col" class="px-6 py-3 text-start">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase text-gray-800">
                      Actions
                    </span>
                  </div>
                </th>

                <th scope="col" class="px-6 py-3 text-end"></th>
              </tr>
            </thead>

            <tbody class="divide-y divide-gray-200" id="articlesTable">
              @forelse($articles as $article)
              <tr class="article-row" data-category="{{ $article->category_id }}" data-title="{{ strtolower($article->title) }}">
                <td class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start ">
                  <div class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3">
                    <div class="flex items-center gap-x-3">
                      <div class="grow p-s-6 py-3 px-4">
                        <span class="block text-sm font-semibold text-gray-800 content-cell">{{ $article->title }}</span>
                      </div>
                    </div>
                  </div>
                </td>

                <td class="h-px w-72 whitespace-nowrap">
                  <div class="px-6 py-3">
                    <span class="block text-sm font-semibold text-gray-800 content-cell">{{ $article->slug }}</span>
                  </div>
                </td>

                <td class="h-px w-72 whitespace-nowrap">
                  <div class="px-6 py-3">
                    <span class="block text-sm font-semibold text-gray-800 content-cell">{{ $article->author->name ?? 'N/A' }}</span>
                  </div>
                </td>

                <td class="h-px w-72 whitespace-nowrap">
                  <div class="px-6 py-3">
                    <span class="block text-sm font-semibold text-gray-800">{{ $article->views }}</span>
                  </div>
                </td>

                <td class="h-px w-72 whitespace-nowrap">
                  <div class="px-6 py-3">
                    <span class="block text-sm font-semibold text-gray-800">{{ $article->shares }}</span>
                  </div>
                </td>

                <td class="h-px w-72 whitespace-nowrap">
                  <div class="px-6 py-3">
                    <span class="py-1 px-2 inline-flex items-center text-xs font-medium bg-orange-100 text-orange-800 rounded-full">
                      {{ $article->category->name ?? 'N/A' }}
                    </span>
                  </div>
                </td>

                <td class="size-px whitespace-nowrap">
                  <div class="px-6 py-3">
                    <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium {{ $article->status === 'Publié' ? 'bg-teal-100 text-teal-800' : 'bg-yellow-100 text-yellow-800' }} rounded-full">
                      <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                      </svg>
                      {{ $article->status }}
                    </span>
                  </div>
                </td>

                <td class="size-px whitespace-nowrap">
                  <div class="px-6 py-3">
                    <span class="text-sm text-gray-500">{{ $article->created_at->format('d M, H:i') }}</span>
                  </div>
                </td>

                <td class="size-px whitespace-nowrap">
                  <div class="flex justify-center space-x-4 px-6 py-1.5">
                      <a href="{{ route('article.detail', $article->article_id) }}" title="Voir">
                        <i class="fa-solid fa-circle-info action-icon info"></i>
                      </a>
                      <a href="{{ route('article.edit', $article->article_id) }}" title="Éditer">
                        <i class="fa-solid fa-pen-to-square action-icon edit"></i>
                      </a>
                      <form action="{{ route('article.delete', $article->article_id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Supprimer" style="background: none; border: none; cursor: pointer;">
                          <i class="fa-solid fa-trash action-icon delete"></i>
                        </button>
                      </form>
                  </div>
                </td>

              </tr>
              @empty
              <tr>
                <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                  Aucun article trouvé
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
          </div>
          <!-- End Table -->

          <!-- Footer -->
          <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200">
            <div>
              <p class="text-sm text-gray-600">
                <span class="font-semibold text-gray-800" id="articlesCount">{{ count($articles) }}</span> résultats
              </p>
            </div>

            <div>
              <div class="inline-flex gap-x-2">
                <button type="button" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50">
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                  Précédent
                </button>

                <button type="button" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50">
                  Suivant
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                </button>
              </div>
            </div>
          </div>
          <!-- End Footer -->
        </div>
      </div>
    </div>
  </div>
  <!-- End Card -->
</div>
<!-- End Table Section -->

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

      // Search and filter functionality
      const searchInput = document.getElementById('searchInput');
      const categoryFilter = document.getElementById('categoryFilter');
      const articlesTable = document.getElementById('articlesTable');
      const articlesCount = document.getElementById('articlesCount');

      function filterArticles() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedCategory = categoryFilter.value;
        let visibleCount = 0;

        document.querySelectorAll('.article-row').forEach(row => {
          const title = row.getAttribute('data-title');
          const category = row.getAttribute('data-category');
          
          const matchesSearch = title.includes(searchTerm);
          const matchesCategory = !selectedCategory || category === selectedCategory;
          
          if (matchesSearch && matchesCategory) {
            row.style.display = '';
            visibleCount++;
          } else {
            row.style.display = 'none';
          }
        });

        articlesCount.textContent = visibleCount;
      }

      searchInput.addEventListener('input', filterArticles);
      categoryFilter.addEventListener('change', filterArticles);
    </script>

  </body>
</html>
