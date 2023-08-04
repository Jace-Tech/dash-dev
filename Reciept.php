<!DOCTYPE html>
<html lang="en">

<head>
  <title>Nile - Transportation and Logistics Responsive HTML5 Template</title>
  <meta name="author" content="Nile-Theme">
  <meta name="robots" content="index follow">
  <meta name="googlebot" content="index follow">

  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="keywords" content="cargo, clean, contractor, corporate, freight, industry, localization, logistics, modern, shipment, transport, transportation, truck, trucking">
  <meta name="description" content="Transportation and Logistics Responsive HTML5 Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- google fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800%7CPoppins:300i,300,400,500,600,700,400i,500%7CDancing+Script:700%7CDancing+Script:700%7CGreat+Vibes:400%7CPoppins:400%7CDosis:800%7CRaleway:400,700,800&amp;subset=latin-ext" rel="stylesheet">
  <!-- animate -->
  <link rel="stylesheet" href="assets/css/animate.css" />
  <!-- owl Carousel assets -->
  <link href="assets/css/owl.carousel.css" rel="stylesheet">
  <link href="assets/css/owl.theme.css" rel="stylesheet">
  <!-- bootstrap -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <!-- hover anmation -->
  <link rel="stylesheet" href="assets/css/hover-min.css">
  <!-- flag icon -->
  <link rel="stylesheet" href="assets/css/flag-icon.min.css">
  <!-- main style -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/colors/color-2.css">
  <!-- elegant icon -->
  <link rel="stylesheet" href="assets/css/elegant_icon.css">
  <!-- fontawesome  -->
  <link rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">

  <!-- ICON -->
  <link rel="shortcut icon" href="./logo.png" type="image/png">
  <!-- REVOLUTION STYLE SHEETS -->
  <link rel="stylesheet" type="text/css" href="assets/rslider/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
  <link rel="stylesheet" type="text/css" href="assets/rslider/fonts/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="assets/rslider/css/settings.css">
  <script src="./assets/js/h2c.min.js"></script>

  <!-- <script src="./assets/jprint.js"></script> -->
  <style>
    :root {
      --blue: #0c3c8e;
      --gray: #495057;
      --white: #f4f4f4;
      --f-size: 12px;
    }

    body {
      overflow-x: hidden;
    }

    .reciept-container {
      width: 100%;
      overflow: hidden;
      overflow-x: auto;
    }

    .receipt-body::after {
      content: "";
      z-index: 1;
      display: flex;
      position: absolute;
      background: linear-gradient(to right, #0c3c8e20, #0c3c8e20), url(./logo.png);
      background-size: 120px;
      background-position: center;
      opacity: .25;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
    }

    .receipt-body {
      position: relative;
      /* max-width: 1120px; */
      /* width: 100%; */
      min-width: 1000px;
      border: 4px solid #000;
      min-height: 700px;
      line-height: 1.9;
      margin: 0 auto;
    }

    .receipt-body * {
      white-space: nowrap;
    }

    .header-logo>img {
      width: 150px;
      object-fit: contain;
    }

    .receipt-header {
      padding: calc(var(--f-size) * 2);
      display: flex;
      align-items: center;
      border-bottom: 2px solid #000;
    }

    .header-slogan {
      font-size: calc(var(--f-size) * .9);
      color: #495057;
      font-weight: 300;
      letter-spacing: 2px;
      margin: 0;
    }

    .header-content {
      flex: 1;
      text-align: center;
    }

    .header-title {
      font-size: calc(var(--f-size) * 2.3);
      margin-bottom: calc(var(--f-size) * 1);
      letter-spacing: 5px;
      font-style: italic;
      font-weight: 800;
      text-transform: uppercase;
      color: var(--blue)
    }

    .contact-detail {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .contact-name {
      font-weight: 500;
      margin-right: calc(var(--f-size) * .6);
    }

    .contact-no {
      text-decoration: underline;
      letter-spacing: 1px;
    }

    .header-right {
      display: flex;
    }

    .reciept-name {
      font-size: calc(var(--f-size) * 2);
      font-weight: 600;
      color: var(--blue);
      align-self: flex-end;
    }

    .main {
      display: flex;
    }

    .main-item {
      flex: 1;
      border-right: 2px solid #000;
    }

    .main-item:last-of-type {
      border-right: none;
    }

    .part-head {
      background: var(--blue);
      color: var(--white);
      font-size: calc(var(--f-size) *.85);
      font-weight: 500;
      letter-spacing: 1px;
      text-transform: uppercase;
      padding: 1;
    }

    .part-details {
      display: flex;
      padding: calc(var(--f-size) * .5) calc(var(--f-size) *1);
      flex-direction: column;
    }

    .bordered {
      border-bottom: 2px solid #000;
    }

    .part-title {
      font-size: calc(var(--f-size), .8);
      letter-spacing: 1px;
      color: var(--gray);
      font-weight: 400;
    }

    .part-value {
      font-size: calc(var(--f-size) * .95);
      font-weight: 600;
      letter-spacing: 1px;
      margin: 0;
    }

    .m-0 {
      margin: 0;
    }

    .shift-right {
      margin-right: calc(var(--f-size) * 1);
    }

    .shift-bottom {
      margin-bottom: calc(var(--f-size) * .6);
    }

    .check-part {
      display: flex;
      align-items: center;
    }

    .check-label {
      font-size: calc(var(--f-size) * .85);
      margin-right: calc(var(--f-size) * .3);
    }

    .cell {
      width: 16px;
      height: 16px;
      background-color: #ccc;
    }

    .cell.active {
      background-color: var(--blue);
    }

    .code {
      width: 90%;
      display: flex;
      margin: 0 auto;
      object-fit: contain;
    }

    .double {
      display: flex;
    }

    .double>* {
      flex: 1;
    }

    .border-right {
      border-right: 2px solid #000;
    }
  </style>

</head>

<body>
  <div class="reciept-container">
    <div class="receipt-body" id="receipt">
      
      <header class="receipt-header">
        <div class="header-logo">
          <img src="logo.png" alt="logo">
        </div>

        <div class="header-content">
          <h2 class="header-title">Dash Delivery</h2>
          <p class="header-slogan">Delivering Excellence, Beyond Boundaries</p>
          <div class="contact-detail">
            <span class="contact-name">Phone No:</span>
            <a class="contact-no" href="https://api.whatsapp.com/send?phone=17572352012&text=Hi%2C%20my%20name%20is%20____.%20I%20want%20to%20make%20an%20enquiry%20about%20https%3A%2F%2Fdash-delivery.com">+17572352012</a>
          </div>
        </div>

        <div class="header-right">
          <h2 class="reciept-name">AIR BILL</h2>
        </div>
      </header>

      <section class="main">
        <div class="main-item">
          <!-- RECIEVER PART -->
          <div class="part-body">
            <header class="part-head">1. Form (Reciever)</header>
            <div class="part-details bordered">
              <h4 class="part-title">Reciever name:</h4>
              <p class="part-value">Jace Alex</p>
            </div>

            <div class="part-details bordered">
              <h4 class="part-title">Address:</h4>
              <p class="part-value">Jace Alex</p>
            </div>

            <div class="part-details">
              <h4 class="part-title">Email:</h4>
              <p class="part-value">Jace Alex</p>
            </div>
          </div>

          <!-- SENDER PART -->
          <div class="part-body">
            <header class="part-head">2. Form (Sender)</header>


            <div class="part-details bordered">
              <h4 class="part-title">Address:</h4>
              <p class="part-value">Jace Alex</p>
            </div>

            <div class="part-details">
              <h4 class="part-title">Email:</h4>
              <p class="part-value">Jace Alex</p>
            </div>
          </div>

          <!-- SENDER AUTH PART -->
          <div class="part-body">
            <header class="part-head">3. SENDER AUTHORIZATION & SIGNATURE</header>
            <div class="part-details bordered">
              <h4 class="part-title">Deliver to:</h4>
              <p class="part-value">Ghana</p>
            </div>

            <div class="part-details">
              <h4 class="part-title">Sign:</h4>
              <p class="part-value"></p>
            </div>
          </div>

        </div>

        <div class="main-item">
          <div class="part-body">
            <div class="part-details">
              <h4 class="part-title m-0">Full Description of group A Parcel Box Containing Valuables</h4>
            </div>
          </div>


          <!--  -->
          <div class="part-body">
            <header class="part-head">4. SECURITY CHECKED</header>
            <!--  -->
            <div class="part-details bordered">
              <div class="check-part shift-bottom">
                <div class="check-part shift-right">
                  <span class="check-label">YES</span>
                  <div class="cell active"></div>
                </div>

                <div class="check-part shift-right">
                  <span class="check-label">NO</span>
                  <div class="cell"></div>
                </div>
                <span class="">Sender's VAT/GST No:</span>
              </div>

              <h4 class="part-value shift-bottom">MARCHANISED COMMUNITY</h4>
              <div class="check-part">
                <span class="check-label shift-right">CODE APPLIES</span>
                <span class="check-label">Receiver's VAT/GST No. ENSSN</span>
              </div>
            </div>

            <!--  -->
            <div class="part-details bordered">
              <h4 class="part-title shift-bottom">Destination duties/taxes, if left blank receiver pay duties/tax</h4>
              <div class="check-part">
                <div class="check-part shift-right">
                  <span class="check-label">Receiver</span>
                  <div class="cell active"></div>
                </div>

                <div class="check-part shift-right">
                  <span class="check-label">Sender</span>
                  <div class="cell"></div>
                </div>

                <div class="check-part shift-right">
                  <span class="check-label">Other</span>
                  <div class="cell"></div>
                </div>
              </div>
            </div>
          </div>

          <!-- BARCODE -->
          <div class="part-details bordered" style="padding-bottom: 1rem;">
            <div class="part-value text-center shift-bottom">Quote This Shipment Number At Enquiry</div>
            <img class="code" src="./assets/barcode.png" alt="barcode">
          </div>

          <div class="part-details">
            <div class="part-value text-center">PACKAGED BY DASH DELIVERY</div>

            <div class="check-part">
              <div class="check-label shift-right">Departure Date:</div>
              <div class="part-value">20-04-2022</div>
            </div>

            <div class="check-part">
              <div class="check-label shift-right">Departure Date:</div>
              <div class="part-value">20-04-2022</div>
            </div>
          </div>

        </div>

        <div class="main-item">
          <!--  -->
          <div class="double">
            <div class="header-double">
              <header class="part-head">4. Origin</header>
              <div class="part-details border-right">
                <div class="part-value text-center">Nigeria</div>
              </div>
            </div>

            <div class="header-double">
              <header class="part-head">5. Destination</header>
              <div class="part-details">
                <div class="part-value text-center">UK</div>
              </div>
            </div>
          </div>


          <!--  -->
          <div class="double bordered">
            <div class="header-double">
              <header class="part-head">6. Size</header>
              <div class="part-details border-right">
                <div class="part-value text-center">Nigeria</div>
              </div>
            </div>

            <div class="header-double">
              <header class="part-head">7. Weight</header>
              <div class="part-details">
                <div class="part-value text-center">UK</div>
              </div>
            </div>
          </div>

          <div class="part-details bordered">
            <div class="part-value text-center">VOLUME TRIC/CHARGED WEIGHT</div>
          </div>

          <div class="part-details">
            <div class="part-value text-center">CODES CLEARING CHARGE SERVICES</div>
          </div>
          <div class="part-body">
            <header class="part-head">8. Payment Info</header>
            <div class="part-details bordered">
              <h4 class="part-title">Currency Code:</h4>
              <p class="part-value">USD</p>
            </div>

            <div class="part-details bordered">
              <h4 class="part-title">Amount:</h4>
              <p class="part-value">$50</p>
            </div>

            <div class="part-details bordered">
              <h4 class="part-title">Reciever name:</h4>
              <p class="part-value">Jace Alex</p>
            </div>

            <div class="part-details">
              <h4 class="part-title">Payment at destination</h4>
              <div class="check-part shift-bottom">
                <div class="check-part shift-right">
                  <span class="check-label">YES</span>
                  <div class="cell active"></div>
                </div>

                <div class="check-part">
                  <span class="check-label">NO</span>
                  <div class="cell"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    </section>
  </div>
  <button onclick="html2canvas(document.querySelector('#receipt')).then(canvas => {
    const url = canvas.toDataURL();
    console.log('URL', url)
    });">Print</button>
  <script>
    
  </script>
</body>

</html>