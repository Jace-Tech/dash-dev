<?php $LINK = "parcel"; ?>
<?php require_once("./addons/Session.php"); ?>
<?php
$ALL_PARCELS = listAllParcels();

if(isset($_GET['search'])) $ALL_PARCELS = getSearchParcel($_GET['search']);
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>ADMIN DSD - Parcel</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="./assets/css/style.311cc0a03ae53c54945b.css" rel="stylesheet">
  <link rel="stylesheet" href="./assets/date/jquery.datetimepicker.min.css">
</head>

<body class="font-inter antialiased bg-gray-100 text-gray-600" :class="{ 'sidebar-expanded': sidebarExpanded }" x-data="{ page: 'dashboard', sidebarOpen: false, sidebarExpanded: localStorage.getItem('sidebar-expanded') == 'true' }" x-init="$watch('sidebarExpanded', value => localStorage.setItem('sidebar-expanded', value))">
  <script>
    localStorage.setItem('sidebar-expanded', 'true')
  </script>
  <script>
    if (localStorage.getItem('sidebar-expanded') == 'true') {
      document.querySelector('body').classList.add('sidebar-expanded');
    } else {
      document.querySelector('body').classList.remove('sidebar-expanded');
    }
  </script>
  <div class="flex h-screen overflow-hidden">
    <?php include("./inc/Sidebar.php") ?>
    <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
      <?php include("./inc/Header.php"); ?>
      <main>
        <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
          <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
              <h1 class="text-2xl md:text-3xl text-gray-800 font-bold">Parcels ✨</h1>
            </div>
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
              <form class="relative">
                <label for="action-search" class="sr-only">Search</label>
                <input name="search" id="action-search" class="form-input pl-9 focus:border-gray-300" type="search" placeholder="Search id, title" />
                <button class="absolute inset-0 right-auto group" type="submit" aria-label="Search">
                  <svg class="w-4 h-4 shrink-0 fill-current text-gray-400 group-hover:text-gray-500 ml-3 mr-2" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z" />
                    <path d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z" />
                  </svg>
                </button>
              </form>

              <a href="./create-parcel.php" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                  <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                </svg>
                <span class="hidden xs:block ml-2">Create Parcel</span>
              </a>
            </div>
          </div>
          <div class="grid grid-cols-12 gap-6">
            <?php if (count($ALL_PARCELS)) : ?>
              <?php foreach ($ALL_PARCELS as $parcel) : ?>
                <div class="col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm align-start border border-gray-200">
                  <div class="flex flex-col h-full p-5">
                    <header>
                      <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 bg-red-500">
                          <svg class="w-9 h-9 fill-current text-red-50" viewBox="0 0 36 36">
                            <path d="M25 24H11a1 1 0 01-1-1v-5h2v4h12v-4h2v5a1 1 0 01-1 1zM14 13h8v2h-8z" />
                          </svg>
                        </div>
                        <div class="relative inline-flex" x-data="{ open: false }">
                          <button class="text-gray-400 hover:text-gray-500 rounded-full" :class="{ 'bg-gray-100 text-gray-500': open }" haspopup="true" @click.prevent="open = !open" :aria-expanded="open">
                            <span class="sr-only">Menu</span>
                            <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                              <circle cx="16" cy="16" r="2" />
                              <circle cx="10" cy="16" r="2" />
                              <circle cx="22" cy="16" r="2" />
                            </svg>
                          </button>
                          <div class="origin-top-right z-10 absolute top-full right-0 min-w-36 bg-white border border-gray-200 py-1.5 rounded shadow-lg overflow-hidden mt-1" @click.outside="open = false" @keydown.escape.window="open = false" x-show="open" x-transition:enter="transition ease-out duration-200 transform" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak>
                            <ul>
                              <li>
                                <a class="font-medium text-sm text-gray-600 hover:text-gray-800 flex py-1 px-3" href="./edit-parcel?parcel_id=<?= $parcel['id']; ?>" @focus="open = true" @focusout="open = false">Edit Parcel</a>
                              </li>
                              <li>
                                <div x-data="{ modalOpen: false }">
                                  <button class="font-medium text-sm text-red-500 hover:text-red-600 flex py-1 px-3" @click.prevent="modalOpen = true" aria-controls="danger-modal">Remove Parcel</button>
                                  <div class="fixed inset-0 bg-gray-900 bg-opacity-30 z-50 transition-opacity" x-show="modalOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true" style="display: none;"></div>
                                  <div id="danger-modal" class="fixed inset-0 z-50 overflow-hidden flex items-center my-4 justify-center transform px-4 sm:px-6" role="dialog" aria-modal="true" x-show="modalOpen" x-transition:enter="transition ease-in-out duration-200" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in-out duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4" style="display: none;">
                                    <div class="bg-white rounded shadow-lg overflow-auto max-w-lg w-full max-h-full" @click.outside="modalOpen = false" @keydown.escape.window="modalOpen = false">
                                      <div class="p-5 flex space-x-4">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 bg-red-100"><svg class="w-4 h-4 shrink-0 fill-current text-red-500" viewBox="0 0 16 16">
                                            <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z"></path>
                                          </svg></div>
                                        <div>
                                          <div class="mb-2">
                                            <div class="text-lg font-semibold text-gray-800">Delete Parcel?</div>
                                          </div>
                                          <div class="text-sm mb-10">
                                            <div class="space-y-2">
                                              <p>You can't undo this action once it has been performed.</p>
                                            </div>
                                          </div>
                                          <div class="flex flex-wrap justify-end space-x-2">
                                            <button class="btn-sm border-gray-200 hover:border-gray-300 text-gray-600" @click="modalOpen = false">Cancel</button>
                                            <form action="./handler/parcel.handler.php" method="post">
                                              <button name="delete-parcel" value="<?= $parcel['id'] ?>" class="btn-sm bg-red-500 hover:bg-red-600 text-white">Yes, Delete it</button>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </li>
                              <div class="my-2" style="height: 1px; border-top: 1px solid #eee;"></div>
                              <li>
                                <a data-btn data-id="<?= $parcel['id'] ?>" class="font-medium text-sm text-indigo-500 hover:text-indigo-600 flex py-1 px-3" @focus="open = true" @focusout="open = false">Copy parcel id</a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </header>
                    <div class="grow mt-2">
                      <a class="inline-flex text-gray-800 hover:text-gray-900 mb-1" href="#0">
                        <h2 class="text-xl leading-snug font-semibold"><?= $parcel['title']; ?></h2>
                      </a>
                      <div class="mt-2">
                        <div class="flex items-center gap-2">
                          <p class="text-sm text-gray-600 font-semibold">Sender:</p>
                          <p class="text-sm text-gray-500"><?= $parcel['sender_name'] ?></p>
                        </div>

                        <div class="flex items-center gap-2">
                          <p class="text-sm text-gray-600 font-semibold">Receiver:</p>
                          <p class="text-sm text-gray-500"><?= $parcel['receiver_name'] ?></p>
                        </div>
                      </div>
                    </div>
                    <footer class="mt-5">
                      <div class="text-sm font-medium text-gray-500 mb-2"><?= date("M d", strtotime($parcel['date_shipment'])) ?> <span class="text-gray-400">-&gt;</span> <?= date("M d", strtotime($parcel['date_arrival'])) ?></div>
                      <div class="flex justify-between items-center">
                        <div>
                          <?php if (!strchr(strtolower($parcel['status']), "not")) : ?>
                            <div class="text-xs text-capitalize inline-flex font-medium bg-green-100 text-green-600 rounded-full text-center px-2.5 py-1">
                              <?= $parcel['status'] ?>
                            </div>
                          <?php else : ?>
                            <div class="text-xs text-capitalize inline-flex font-medium bg-red-100 text-red-600 rounded-full text-center px-2.5 py-1">
                              <?= $parcel['status'] ?>
                            </div>
                          <?php endif; ?>
                        </div>
                        <div>
                          <a class="text-sm font-medium text-indigo-500 hover:text-indigo-600" href="./parcel-details?parcel_id=<?= $parcel['id']; ?>">View -&gt;</a>
                        </div>
                      </div>
                    </footer>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else : ?>
              <div class="col-span-full">
                <p class="text-sm py-3 text-gray-500">No parcel found!</p>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </main>
    </div>
  </div>
  <script src="./assets/js/main.75545896273710c7378c.js"></script>
  <script>
		const copyBtns = document.querySelectorAll("[data-btn]")
    copyBtns && copyBtns.forEach(btn => {
      btn.addEventListener("click", async () => {
        const id = btn.dataset.id
        await navigator.clipboard.writeText(id)
        alert("Text copied")
      })
    })
  </script>
</body>

</html>