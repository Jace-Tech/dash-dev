<?php $LINK = "parcel"; ?>
<?php require_once("./addons/Session.php"); ?>

<?php
if (!isset($_GET['parcel_id'])) redirect($_SERVER['HTTP_REFERER']);
$PARCEL_ID = $_GET['parcel_id'];
$PARCEL_DETAILS = getParcel($PARCEL_ID);

// print_r($PARCEL_DETAILS);
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

              <h1 class="text-2xl md:text-3xl font-semibold">Edit Parcel ( ID: <?= $PARCEL_ID ?> )</h1>
            </div>
          </div>

          <div class="col-span-full bg-white shadow-lg p-6 pb-8 rounded-sm border border-gray-200">
            <form action="./handler/parcel.handler.php" method="POST">
              <div class="flex items-center gap-2 mb-5">
                <h3 class="uppercase tracking-widest font-bold text-xs text-indigo-600">Parcel Information</h3>
                <div class="border-b border-indigo-200 flex-1"></div>
              </div>
              <div class="grid grid-cols-12 w-full gap-4">
                <div class="col-span-full sm:col-span-6">
                  <label for="title" class="mb-1 font-bold flex text-xs text-gray-500">Title *</label>
                  <input type="text" name="title" id="title" value="<?= $PARCEL_DETAILS['title'] ?>" placeholder="eg: Muskettes Biscuits" class="form-input w-full" required>
                </div>

                <div class="col-span-full sm:col-span-6">
                  <label for="account" class="mb-1 font-bold flex text-xs text-gray-500" for="id">Parcel ID *</label>
                  <div class="relative">
                    <input id="id" class="form-input w-full pr-8" name="id" value="<?= $PARCEL_DETAILS['id'] ?>" disabled readonly placeholder="eg: DSD1690781..." required>
                  </div>
                </div>

                <div class="col-span-full sm:col-span-6">
                  <label for="weight" class="mb-1 font-bold flex text-xs text-gray-500">Weight</label>
                  <input type="text" name="weight" id="weight" placeholder="eg: 10.45kg" value="<?= $PARCEL_DETAILS['weight'] ?>" class="form-input w-full">
                </div>

                <div class="col-span-full sm:col-span-6">
                  <label for="size" class="mb-1 font-bold flex text-xs text-gray-500">Size</label>
                  <input type="text" name="size" id="size" placeholder="eg: 19x21x1 in." value="<?= $PARCEL_DETAILS['size'] ?>" class="form-input w-full">
                </div>

                <div class="col-span-full sm:col-span-6">
                  <label for="from" class="mb-1 font-bold flex text-xs text-gray-500">From</label>
                  <input type="text" name="from" id="from" placeholder="eg: United Arab Emirate" value="<?= $PARCEL_DETAILS['from'] ?>" class="form-input w-full">
                </div>

                <div class="col-span-full sm:col-span-6">
                  <label for="to" class="mb-1 font-bold flex text-xs text-gray-500">To</label>
                  <input type="text" name="to" id="to" placeholder="eg: Ontario, Canada." value="<?= $PARCEL_DETAILS['to'] ?>" class="form-input w-full">
                </div>


                <div class="col-span-full sm:col-span-6">
                  <label for="date" class="mb-1 font-bold flex text-xs text-gray-500">Date of shipment *
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                      <button type="button" class="block ml-2" aria-haspopup="true" :aria-expanded="open" @focus="open = true" @focusout="open = false" @click.prevent="" aria-expanded="false">
                        <svg class="w-4 h-4 fill-current text-gray-400" viewBox="0 0 16 16">
                          <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z"></path>
                        </svg>
                      </button>
                      <div class="z-10 absolute bottom-full left-1/2 transform -translate-x-1/2">
                        <div class="min-w-56 bg-gray-800 p-2 rounded overflow-hidden mb-2" x-show="open" x-transition:enter="transition ease-out duration-200 transform" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;">
                          <div class="text-xs text-gray-200">The date the person brought the parcel for shipping</div>
                        </div>
                      </div>
                    </div>
                  </label>
                  <input type="datetime-local" value="<?= $PARCEL_DETAILS['date_shipment'] ?>" name="date-shipment" id="date-shipment" placeholder="eg: 01/01/2023 12:00" class="form-input w-full" required>
                </div>

                <div class="col-span-full sm:col-span-6">
                  <label for="date" class="mb-1 font-bold flex text-xs text-gray-500">Date of arrival *
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                      <button type="button" class="block ml-2" aria-haspopup="true" :aria-expanded="open" @focus="open = true" @focusout="open = false" @click.prevent="" aria-expanded="false">
                        <svg class="w-4 h-4 fill-current text-gray-400" viewBox="0 0 16 16">
                          <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z"></path>
                        </svg>
                      </button>
                      <div class="z-10 absolute bottom-full left-1/2 transform -translate-x-1/2">
                        <div class="min-w-56 bg-gray-800 p-2 rounded overflow-hidden mb-2" x-show="open" x-transition:enter="transition ease-out duration-200 transform" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;">
                          <div class="text-xs text-gray-200">The date the parcel arrived for collection.</div>
                        </div>
                      </div>
                    </div>
                  </label>
                  <input type="datetime-local" name="date-arrival" value="<?= $PARCEL_DETAILS['date_arrival'] ?>" id="date-arrival" placeholder="eg: 01/01/2023 12:00" class="form-input w-full" required>
                </div>
              </div>

              <!-- SENDER'S INFO -->
              <div class="flex items-center gap-2 mt-8 mb-5">
                <h3 class="uppercase tracking-widest font-bold text-xs text-indigo-600">Sender's Information</h3>
                <div class="border-b border-indigo-200 flex-1"></div>
              </div>

              <div class="grid grid-cols-12 w-full gap-4">
                <div class="col-span-full">
                  <label for="sender-name" class="mb-1 font-bold flex text-xs text-gray-500">Name *</label>
                  <input type="text" name="sender-name" id="sender-name" value="<?= $PARCEL_DETAILS['sender_name'] ?>" placeholder="eg: Jane Doe" required class="form-input w-full">
                </div>

                <div class="col-span-full sm:col-span-6">
                  <label for="sender-email" class="mb-1 font-bold flex text-xs text-gray-500">Email</label>
                  <input type="text" name="sender-email" id="sender-email" value="<?= $PARCEL_DETAILS['sender_email'] ?>" placeholder="eg: janedoe@test.com" class="form-input w-full">
                </div>

                <div class="col-span-full sm:col-span-6">
                  <label for="sender-address" class="mb-1 font-bold flex text-xs text-gray-500">Address</label>
                  <input type="text" name="sender-address" id="sender-address" value="<?= $PARCEL_DETAILS['sender_address'] ?>" placeholder="eg: No. 23 street name..." class="form-input w-full">
                </div>

              </div>

              <!-- RECEIVER'S INFO -->
              <div class="flex items-center gap-2 mt-8 mb-5">
                <h3 class="uppercase tracking-widest font-bold text-xs text-indigo-600">Receiver's Information</h3>
                <div class="border-b border-indigo-200 flex-1"></div>
              </div>

              <div class="grid grid-cols-12 w-full gap-4">
                <div class="col-span-full">
                  <label for="receiver-name" class="mb-1 font-bold flex text-xs text-gray-500">Name *</label>
                  <input type="text" name="receiver-name" id="receiver-name" value="<?= $PARCEL_DETAILS['receiver_name'] ?>" placeholder="eg: Jane Doe" required class="form-input w-full">
                </div>

                <div class="col-span-full sm:col-span-6">
                  <label for="receiver-email" class="mb-1 font-bold flex text-xs text-gray-500">Email</label>
                  <input type="text" name="receiver-email" id="receiver-email" value="<?= $PARCEL_DETAILS['receiver_email'] ?>" placeholder="eg: janedoe@test.com" class="form-input w-full">
                </div>

                <div class="col-span-full sm:col-span-6">
                  <label for="receiver-address" class="mb-1 font-bold flex text-xs text-gray-500">Address </label>
                  <input type="text" name="receiver-address" id="receiver-address" value="<?= $PARCEL_DETAILS['receiver_address'] ?>" placeholder="eg: No. 23 street name..." class="form-input w-full">
                </div>

              </div>


              <!-- PAYMENT INFO -->
              <div class="flex items-center gap-2 mt-8 mb-5">
                <h3 class="uppercase tracking-widest font-bold text-xs text-indigo-600">Payment Information</h3>
                <div class="border-b border-indigo-200 flex-1"></div>
              </div>

              <div class="grid grid-cols-12 w-full gap-4">
                <div class="col-span-full">
                  <label for="amount" class="mb-1 font-bold flex text-xs text-gray-500">Amount *</label>
                  <input type="number" inputmode="numeric" value="<?= $PARCEL_DETAILS['amount'] ?>" name="amount" id="amount" placeholder="eg: 50" required class="form-input w-full">
                </div>

                <div class="col-span-full sm:col-span-6">
                  <label for="currency-code" class="mb-1 font-bold flex text-xs text-gray-500">Currency Code</label>
                  <select name="currency-code" id="" class="form-input w-full">
                    <option value="">Choose a currency code</option>
                    <?php foreach($currencySymbol as $code => $symbol): ?>
                      <option value="<?= $code ?>" <?= $code === $PARCEL_DETAILS['currency_code'] ? "selected" : "" ?>>
                        <?= $code . " " . $symbol ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="col-span-full sm:col-span-6">
                  <label for="sender-address" class="mb-1 font-bold flex text-xs text-gray-500">Pay on delivery</label>
                  <div class="flex items-center" x-data="{ checked: <?= $PARCEL_DETAILS['pay_on_delivery'] == 1 ? 'true' : 'false' ?> }">
                    <div class="form-switch">
                      <input type="checkbox" id="switch-1" name="payment-on-delivery" class="sr-only" checked value="1" x-model="checked" />
                      <label class="bg-gray-400" for="switch-1">
                        <span class="bg-white shadow-sm" aria-hidden="true"></span>
                        <span class="sr-only">Switch label</span>
                      </label>
                    </div>
                    <div class="text-sm text-gray-400 italic ml-2" x-text="checked ? 'On' : 'Off'"></div>
                  </div>
                </div>

              </div>

              <div class="mt-6">
                <button name="edit-parcel" value="<?= $PARCEL_DETAILS['id']; ?>" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                  <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                    <path d="M11.7.3c-.4-.4-1-.4-1.4 0l-10 10c-.2.2-.3.4-.3.7v4c0 .6.4 1 1 1h4c.3 0 .5-.1.7-.3l10-10c.4-.4.4-1 0-1.4l-4-4zM4.6 14H2v-2.6l6-6L10.6 8l-6 6zM12 6.6L9.4 4 11 2.4 13.6 5 12 6.6z"></path>
                  </svg>
                  <span class="ml-2">Update Parcel</span>
                </button>
              </div>
            </form>
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