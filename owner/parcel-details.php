<?php $LINK = "parcel"; ?>
<?php require_once("./addons/Session.php"); ?>

<?php
if (!isset($_GET['parcel_id'])) redirect($_SERVER['HTTP_REFERER']);
$PARCEL_ID = $_GET['parcel_id'];
$PARCEL_DETAILS = getParcel($PARCEL_ID);

$activeClass = "text-indigo-500 font-semibold";
$inActiveClass = "text-gray-500";

$currencySymbol = [
  "USD" => "$",
  "GBP" => "£",
  "EUR" => "€",
  "NGN" => "₦",
];
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>ADMIN DSD - Edit Parcel</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="./assets/css/style.311cc0a03ae53c54945b.css" rel="stylesheet">
  <link rel="stylesheet" href="./assets/date/jquery.datetimepicker.min.css">
  <script src="./assets/js/jquery.js"></script>
  <style>
    .capitalize {
      text-transform: capitalize;
    }
  </style>
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
            <div class="mb-4 sm:mb-0 flex gap-4 items-center">

              <div x-data="{ modalOpen: false }">
                <button class="btn hover:bg-white border-gray-200 hover:border-gray-300" @click.prevent="modalOpen = true" aria-controls="info-modal">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#9e9e9e" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                    <line x1="5" y1="12" x2="11" y2="18" />
                    <line x1="5" y1="12" x2="11" y2="6" />
                  </svg>
                </button>
                <div class="fixed inset-0 bg-gray-900 bg-opacity-30 z-50 transition-opacity" x-show="modalOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true" style="display: none;"></div>
                <div id="info-modal" class="fixed inset-0 z-50 overflow-hidden flex items-center my-4 justify-center transform px-4 sm:px-6" role="dialog" aria-modal="true" x-show="modalOpen" x-transition:enter="transition ease-in-out duration-200" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in-out duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4" style="display: none;">
                  <div class="bg-white rounded shadow-lg overflow-auto max-w-lg w-full max-h-full" @click.outside="modalOpen = false" @keydown.escape.window="modalOpen = false">
                    <div class="p-5 flex space-x-4">
                      <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 bg-indigo-100">
                        <svg class="w-4 h-4 shrink-0 fill-current text-indigo-500" viewBox="0 0 16 16">
                          <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm1 12H7V7h2v5zM8 6c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1z"></path>
                        </svg>
                      </div>
                      <div>
                        <div class="mb-2">
                          <div class="text-lg font-semibold text-gray-800">You have unsaved changes?</div>
                        </div>
                        <div class="text-sm mb-10">
                          <div class="space-y-2">
                            <p>Are you sure you wanna leave the page?</p>
                          </div>
                        </div>
                        <div class="flex flex-wrap justify-end space-x-2">
                          <button class="btn-sm border-gray-200 hover:border-gray-300 text-gray-600" @click="modalOpen = false">Cancel</button>
                          <a href="<?= $_SERVER['HTTP_REFERER']; ?>" class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white">Yes, Leave</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <h1 class="text-2xl md:text-3xl font-semibold">Parcel Detail</h1>
            </div>
          </div>

          <div class="bg-white shadow-lg rounded-sm mb-8">
            <div class="flex flex-col md:flex-row md:-mr-px">
              <div class="grow">
                <div class="p-6">
                  <h2 class="text-2xl text-gray-800 font-bold mb-5"> Parcel ID: <?= $PARCEL_ID ?> </h2>
                  <div class="mb-4 border-b border-gray-200"></div>
                  <section class="pb-6 relative">
                    <a href="edit-parcel?parcel_id=<?= $PARCEL_ID ?>" class="btn border-gray-200 absolute top-0 right-0 hover:border-gray-300">
                      <svg class="w-4 h-4 fill-current text-gray-400 shrink-0" viewBox="0 0 16 16">
                        <path d="M11.7.3c-.4-.4-1-.4-1.4 0l-10 10c-.2.2-.3.4-.3.7v4c0 .6.4 1 1 1h4c.3 0 .5-.1.7-.3l10-10c.4-.4.4-1 0-1.4l-4-4zM4.6 14H2v-2.6l6-6L10.6 8l-6 6zM12 6.6L9.4 4 11 2.4 13.6 5 12 6.6z"></path>
                      </svg>
                    </a>

                    <div class="grid grid-cols-12 gap-6">
                      <div class="col-span-full bg-white">
                        <h2 class="text-lg font-medium">Parcel Information</h2>
                      </div>

                      <div class="col-span-full sm:col-span-6 xl:col-span-4 bg-white">
                        <h2 class="text-sm text-blue-600 font-semibold capitalize">Parcel title</h2>
                        <p class="text-sm font-light mt-2 text-gray-500"><?= $PARCEL_DETAILS['title'] ?></p>
                      </div>

                      <div class="col-span-full sm:col-span-6 xl:col-span-4 bg-white">
                        <h2 class="text-sm text-blue-600 font-semibold capitalize">Parcel weight</h2>
                        <p class="text-sm font-light mt-2 text-gray-500"><?= $PARCEL_DETAILS['weight'] ?></p>
                      </div>

                      <div class="col-span-full sm:col-span-6 xl:col-span-4 bg-white">
                        <h2 class="text-sm text-blue-600 font-semibold capitalize">Parcel size</h2>
                        <p class="text-sm font-light mt-2 text-gray-500"><?= $PARCEL_DETAILS['size'] ?></p>
                      </div>

                      <div class="col-span-full sm:col-span-6 xl:col-span-4 bg-white">
                        <h2 class="text-sm text-blue-600 font-semibold capitalize">From</h2>
                        <p class="text-sm font-light mt-2 text-gray-500"><?= $PARCEL_DETAILS['from'] ?></p>
                      </div>

                      <div class="col-span-full sm:col-span-6 xl:col-span-4 bg-white">
                        <h2 class="text-sm text-blue-600 font-semibold capitalize">To</h2>
                        <p class="text-sm font-light mt-2 text-gray-500"><?= $PARCEL_DETAILS['to'] ?></p>
                      </div>

                      <div class="col-span-full sm:col-span-6 xl:col-span-4 bg-white">
                        <h2 class="text-sm text-blue-600 font-semibold capitalize">Parcel status</h2>
                        <p class="text-sm font-light mt-2 text-gray-500"><?= $PARCEL_DETAILS['status'] ?></p>
                      </div>

                      <div class="col-span-full sm:col-span-6 xl:col-span-4 bg-white">
                        <h2 class="text-sm text-blue-600 font-semibold capitalize">Parcel shipment date</h2>
                        <p class="text-sm font-light mt-2 text-gray-500"><?= date("M jS, Y h:i a", strtotime($PARCEL_DETAILS['date_shipment'])) ?></p>
                      </div>

                      <div class="col-span-full sm:col-span-6 xl:col-span-4 bg-white">
                        <h2 class="text-sm text-blue-600 font-semibold capitalize">Parcel arrival date</h2>
                        <p class="text-sm font-light mt-2 text-gray-500"><?= date("M jS, Y h:i a", strtotime($PARCEL_DETAILS['date_arrival'])) ?></p>
                      </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-16">
                      <div class="col-span-full bg-white">
                        <h2 class="text-lg font-medium">Sender Information</h2>
                      </div>

                      <div class="col-span-full sm:col-span-6 xl:col-span-4 bg-white">
                        <h2 class="text-sm text-blue-600 font-semibold capitalize">Sender name</h2>
                        <p class="text-sm font-light mt-2 text-gray-500"><?= ucwords($PARCEL_DETAILS['sender_name']) ?></p>
                      </div>

                      <div class="col-span-full sm:col-span-6 xl:col-span-4 bg-white">
                        <h2 class="text-sm text-blue-600 font-semibold capitalize">Sender email</h2>
                        <p class="text-sm font-light mt-2 text-gray-500"><?= $PARCEL_DETAILS['sender_email'] ? $PARCEL_DETAILS['sender_email'] : "NILL" ?></p>
                      </div>

                      <div class="col-span-full sm:col-span-6 xl:col-span-4 bg-white">
                        <h2 class="text-sm text-blue-600 font-semibold capitalize">Sender Address</h2>
                        <p class="text-sm font-light mt-2 text-gray-500"><?= $PARCEL_DETAILS['sender_address'] ? $PARCEL_DETAILS['sender_address'] : "NILL" ?></p>
                      </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-16">
                      <div class="col-span-full bg-white">
                        <h2 class="text-lg font-medium">Receiver Information</h2>
                      </div>

                      <div class="col-span-full sm:col-span-6 xl:col-span-4 bg-white">
                        <h2 class="text-sm text-blue-600 font-semibold capitalize">Receiver name</h2>
                        <p class="text-sm font-light mt-2 text-gray-500"><?= ucwords($PARCEL_DETAILS['receiver_name']) ?></p>
                      </div>

                      <div class="col-span-full sm:col-span-6 xl:col-span-4 bg-white">
                        <h2 class="text-sm text-blue-600 font-semibold capitalize">receiver email</h2>
                        <p class="text-sm font-light mt-2 text-gray-500"><?= $PARCEL_DETAILS['receiver_email'] ? $PARCEL_DETAILS['receiver_email'] : "NILL" ?></p>
                      </div>

                      <div class="col-span-full sm:col-span-6 xl:col-span-4 bg-white">
                        <h2 class="text-sm text-blue-600 font-semibold capitalize">receiver Address</h2>
                        <p class="text-sm font-light mt-2 text-gray-500"><?= $PARCEL_DETAILS['receiver_address'] ? $PARCEL_DETAILS['receiver_address'] : "NILL" ?></p>
                      </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-16">
                      <div class="col-span-full bg-white">
                        <h2 class="text-lg font-medium">Payment Information</h2>
                      </div>

                      <div class="col-span-full sm:col-span-6 xl:col-span-4 bg-white">
                        <h2 class="text-sm text-blue-600 font-semibold capitalize">Amount</h2>
                        <p class="text-sm font-light mt-2 text-gray-500"> <?= $currencySymbol[$PARCEL_DETAILS['currency_code']] . number_format($PARCEL_DETAILS['amount']) ?></p>
                      </div>

                      <div class="col-span-full sm:col-span-6 xl:col-span-4 bg-white">
                        <h2 class="text-sm text-blue-600 font-semibold capitalize">Currency Code</h2>
                        <p class="text-sm font-light mt-2 text-gray-500"> <?= $PARCEL_DETAILS['currency_code'] ?></p>
                      </div>

                      <div class="col-span-full sm:col-span-6 xl:col-span-4 bg-white">
                        <h2 class="text-sm text-blue-600 font-semibold capitalize">Pay on delivery</h2>
                        <p class="text-sm font-light mt-2 text-gray-500"><?= $PARCEL_DETAILS['pay_on_delivery'] ? "YES" : "NO" ?></p>
                      </div>
                    </div>
                  </section>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
  <script src="./assets/js/main.75545896273710c7378c.js"></script>
  <script src="./assets/js/functions.js"></script>
  <script>
    $('#generator').click(() => {
      $('#id').val(generateID())
    })
  </script>
</body>

</html>