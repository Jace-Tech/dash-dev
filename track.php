<?php
session_start();

require_once("./owner/db/config.php");
require_once("./owner/utils/helpers.php");
require_once("./owner/store/parcel.store.php");

$TRACK_DETAILS = null;
if (isset($_GET['track'])) {
	$TRACK_DETAILS = getParcel($_GET['track']);

	$INTERVAL = (new DateTime($TRACK_DETAILS['date_shipment']))->diff(new DateTime($TRACK_DETAILS['date_arrival']));
}
$currencySymbol = [
	"USD" => "$",
	"GBP" => "£",
	"EUR" => "€",
	"NGN" => "₦",
];


?>
<?php include("./components/Heading.php") ?>
<link rel="stylesheet" href="./assets/css/receipt.css">
<link rel="stylesheet" type="text/css" href="./assets/print/print.min.css" />
<script src="./assets/print/print.min.js"></script>
<script src="./assets/js/h2c.min.js"></script>

<body>
	<style>
		.capped-width {
			max-width: 768px;
		}

		.timeline li::marker {
			display: inline-block;
			position: relative;
		}

		.parcel-id {
			font-size: calc(var(--f-size) * 1.3);
		}
	</style>
	<?php include("./components/Header.php") ?>


	<div class="page-title">
		<div class="container">
			<div class="padding-tb-120px">
				<h1>Track Parcel</h1>
				<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li class="active">Track Parcel</li>
				</ol>
			</div>
		</div>
	</div>

	<?php if (!isset($_GET['track'])) : ?>
		<div class="padding-tb-100px">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<form id="FORM" method="get" action="" class="capped-width mx-auto">
							<div class="form-group">
								<label for="track">Track ID <sup class="text-danger">*</sup> </label>
								<input type="text" id="track" name="track" class="form-control py-3" placeholder="eg: DSD1234567..." required>
							</div>
							<div class="mt-3">
								<input type="submit" id="FORMBTN" class="btn btn-primary px-5 py-3" style="cursor: pointer;" value="Track" />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	<?php else : ?>
		<div class="padding-tb-100px">
			<div class="container">
				<?php if (!empty($TRACK_DETAILS)) : ?>
					<h2 class="h2 mb-5">Parcel Details</h2>
					<input type="hidden" value="<?= $_GET['track']; ?>" id="ID">
					<div class="row">
						<div class="col-4">
							<h3 class="text-uppercase font-bold text-main-color" style="font-size: .8rem; letter-spacing: 1px; ">Items</h3>
							<p class="text-muted"><?= $TRACK_DETAILS['title'] ?></p>
						</div>

						<div class="col-4">
							<h3 class="text-uppercase font-bold text-main-color" style="font-size: .8rem; letter-spacing: 1px; ">Weight</h3>
							<p class="text-muted"><?= $TRACK_DETAILS['weight'] ?></p>
						</div>

						<div class="col-4">
							<h3 class="text-uppercase font-bold text-main-color" style="font-size: .8rem; letter-spacing: 1px; ">Size</h3>
							<p class="text-muted"><?= $TRACK_DETAILS['size'] ?></p>
						</div>
					</div>


					<div class="row">
						<div class="col-4">
							<h3 class="text-uppercase font-bold text-main-color" style="font-size: .8rem; letter-spacing: 1px; ">From</h3>
							<p class="text-muted"><?= $TRACK_DETAILS['from'] ?></p>
						</div>

						<div class="col-4">
							<h3 class="text-uppercase font-bold text-main-color" style="font-size: .8rem; letter-spacing: 1px; ">To</h3>
							<p class="text-muted"><?= $TRACK_DETAILS['to'] ?></p>
						</div>

						<div class="col-4">
							<h3 class="text-uppercase font-bold text-main-color" style="font-size: .8rem; letter-spacing: 1px; ">Status</h3>
							<p class="badge <?= strstr(strtolower($TRACK_DETAILS['status']), 'not') ? 'badge-danger' : 'badge-success' ?>"><?= $TRACK_DETAILS['status'] ?></p>
						</div>
					</div>


					<div class="">
						<h2 class="h2 my-5">Delivery Information</h2>
						<div class="row">
							<div class="col-sm-12 col-md-4">
								<h3 class="text-uppercase font-bold text-main-color" style="font-size: .8rem; letter-spacing: 1px; ">Time</h3>
							</div>
							<div class="col-sm-12 col-md-8">
								<h3 class="text-uppercase font-bold text-main-color" style="font-size: .8rem; letter-spacing: 1px; ">Status</h3>
							</div>
						</div>

						<div class="row mwb-2">
							<div class="col-sm-12 col-md-4">
								<p class="text-muted"><?= humanReadableTimeFormat($TRACK_DETAILS['date_shipment']); ?></p>
							</div>

							<div class="col-sm-12 col-md-8">
								<p class="text-muted">Processing Parcel</p>
								<p class="text-muted">Confirmed Parcel</p>
								<p class="text-muted">Processing Shipment</p>
								<p class="text-muted">Departed from <?= $TRACK_DETAILS['from']; ?> airport</p>
							</div>
						</div>

						<?php if (!isReadyForClaiming($TRACK_DETAILS['date_arrival'])) : ?>
							<div class="row mb-2">
								<div class="col-sm-12 col-md-4">
									<p class="text-muted"><?= humanReadableTimeFormat($TRACK_DETAILS['date_arrival']); ?></p>
								</div>

								<div class="col-sm-12 col-md-8">
									<p class="text-muted">To arrive at <?= $TRACK_DETAILS['to']; ?> airport</p>
								</div>
							</div>
						<?php endif; ?>

						<?php if (isReadyForClaiming($TRACK_DETAILS['date_arrival'])) : ?>
							<div class="row mb-2">
								<div class="col-sm-12 col-md-4">
									<p class="text-muted"><?= humanReadableTimeFormat($TRACK_DETAILS['date_arrival']); ?></p>
								</div>

								<div class="col-sm-12 col-md-8">
									<p class="text-muted">Arrived at <?= $TRACK_DETAILS['to']; ?> airport</p>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-12 col-md-4">
									<p class="text-muted">Now</p>
								</div>

								<div class="col-sm-12 col-md-8">
									<p class="text-muted">Ready for claiming</p>
								</div>
							</div>
						<?php endif; ?>
					</div>

					<h2 class="h2 my-5">Receipt</h2>
					<div class="reciept-container">
						<div class="receipt-body" id="receipt">

							<!-- FLOATINGS -->
							<!-- <img class="paid" src="./assets/images/paid.png" alt=""> -->
							<img class="stamp" src="./assets/images/stamp.png" alt="">
							<img class="stamp sign" src="./assets/images/sign.png" alt="">
							<img class="stamp print" src="./assets/images/print.png" alt="">
							<!-- <img src="./assets/images/original.png" class="paid original"  alt=""> -->
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

								<div class="header-right" style="flex-direction: column;">
									<h2 class="reciept-name">AIR BILL</h2>
									<div class="mt-4">
										<h3 class="parcel-id">Tracking ID: <b> <?= $_GET['track']; ?></b></h3>
									</div>
								</div>
							</header>

							<section class="main">
								<div class="main-item">
									<!-- RECIEVER PART -->
									<div class="part-body">
										<header class="part-head">1. Form (Reciever)</header>
										<div class="part-details bordered">
											<h4 class="part-title">Reciever name:</h4>
											<p class="part-value"><?= $TRACK_DETAILS['receiver_name'] ?></p>
										</div>

										<div class="part-details bordered">
											<h4 class="part-title">Address:</h4>
											<p class="part-value"><?= $TRACK_DETAILS['receiver_address'] ? $TRACK_DETAILS['receiver_address'] : 'Nill' ?></p>
										</div>

										<div class="part-details">
											<h4 class="part-title">Email:</h4>
											<p class="part-value"><?= $TRACK_DETAILS['receiver_email'] ? $TRACK_DETAILS['receiver_email'] : 'Nill' ?></p>
										</div>
									</div>

									<!-- SENDER PART -->
									<div class="part-body">
										<header class="part-head">2. Form (Sender)</header>


										<div class="part-details bordered">
											<h4 class="part-title">Name:</h4>
											<p class="part-value"><?= $TRACK_DETAILS['sender_name'] ?></p>
										</div>

										<div class="part-details">
											<h4 class="part-title">Email:</h4>
											<p class="part-value"><?= $TRACK_DETAILS['sender_email'] ? $TRACK_DETAILS['sender_email'] : 'Nill' ?></p>
										</div>
									</div>

									<!-- SENDER AUTH PART -->
									<div class="part-body">
										<header class="part-head">3. SENDER AUTHORIZATION & SIGNATURE</header>
										<div class="part-details bordered">
											<h4 class="part-title">Deliver to:</h4>
											<p class="part-value"><?= $TRACK_DETAILS['to']  ?></p>
										</div>

										<div class="part-details">
											<h4 class="part-title">Sign:</h4>
											<p class="part-value">---</p>
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
											<div class="part-value"><?= date("d-m-Y", strtotime($TRACK_DETAILS['date_shipment'])) ?></div>
										</div>

										<div class="check-part">
											<div class="check-label shift-right">Arrival Date:</div>
											<div class="part-value"><?= date("d-m-Y", strtotime($TRACK_DETAILS['date_arrival'])) ?></div>
										</div>
									</div>

								</div>

								<div class="main-item">
									<!--  -->
									<div class="double">
										<div class="header-double">
											<header class="part-head">4. Origin</header>
											<div class="part-details border-right">
												<div class="part-value text-center"><?= $TRACK_DETAILS['from'] ?></div>
											</div>
										</div>

										<div class="header-double">
											<header class="part-head">5. Destination</header>
											<div class="part-details">
												<div class="part-value text-center"><?= $TRACK_DETAILS['to'] ?></div>
											</div>
										</div>
									</div>


									<!--  -->
									<div class="double bordered">
										<div class="header-double">
											<header class="part-head">6. Size</header>
											<div class="part-details border-right">
												<div class="part-value text-center"><?= $TRACK_DETAILS['size'] ?></div>
											</div>
										</div>

										<div class="header-double">
											<header class="part-head">7. Weight</header>
											<div class="part-details">
												<div class="part-value text-center"><?= $TRACK_DETAILS['weight'] ?></div>
											</div>
										</div>
									</div>
									<header class="part-head">8. Content of item</header>
									<div class="part-details bordered">
										<p class="part-value" style="text-transform: uppercase; line-height: 1.5; font-size: 1.2rem;"><?= $TRACK_DETAILS['title'] ?></p>
									</div>

									<div class="part-details bordered">
										<div class="part-value text-center">VOLUME TRIC/CHARGED WEIGHT</div>
									</div>

									<div class="part-details">
										<div class="part-value text-center">CODES CLEARING CHARGE SERVICES</div>
									</div>
									<div class="part-body">
										<header class="part-head">9. Payment Info</header>
										<div class="part-details bordered">
											<h4 class="part-title">Currency Code:</h4>
											<p class="part-value"><?= $TRACK_DETAILS['currency_code'] ?></p>
										</div>

										<div class="part-details bordered">
											<h4 class="part-title">Amount:</h4>
											<p class="part-value"><?= $currencySymbol[$TRACK_DETAILS['currency_code']] . number_format($TRACK_DETAILS['amount']) ?></p>
										</div>

										<div class="part-details bordered">
											<h4 class="part-title">Reciever name:</h4>
											<p class="part-value"><?= $TRACK_DETAILS['receiver_name'] ?></p>
										</div>

										<div class="part-details">
											<h4 class="part-title">Payment at destination</h4>
											<div class="check-part shift-bottom">
												<div class="check-part shift-right">
													<span class="check-label">YES</span>
													<div class="cell <?= $TRACK_DETAILS['pay_on_delivery'] == 1 ? 'active' : '' ?>"></div>
												</div>

												<div class="check-part">
													<span class="check-label">NO</span>
													<div class="cell <?= $TRACK_DETAILS['pay_on_delivery'] != 1 ? 'active' : '' ?>"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="d-flex my-4">
								<?php if (isReadyForClaiming($TRACK_DETAILS['date_arrival'])) : ?>
									<a href="https://api.whatsapp.com/send?phone=17572352012&text=Hi%2C%20my%20name%20is%20____.%20I%20want%20to%20claim%20this%20parcel%20with%20id%20*<?= $TRACK_DETAILS['id'] ?>*%20https%3A%2F%2Fdash-delivery.com" class="btn text-sm btn-primary mr-3" style="font-size: .8rem">Claim Parcel</a>
								<?php endif; ?>
								<button id="print-btn" style="cursor: pointer; font-size: .8rem;" class="text-sm btn btn-secondary">Download Receipt</button>
							</div>
						</div>
					</div>
				<?php else : ?>
					<div class="row">
						<div class="col-lg-12">
							<p class="text-muted">No parcel found!</p>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>

	<?php include("./components/Footer.php"); ?>

	<script>
		const printBtn = document.querySelector("#print-btn")
		const form = document.querySelector("#FORM")
		const formBtn = document.querySelector("#FORMBTN")



		formBtn && formBtn.addEventListener("click", () => {
			form && form.submit();
		})

		const downloadReceipt = (id) => {
			return new Promise((resolve, reject) => {
				html2canvas(document.querySelector('#receipt')).then(canvas => {
					const url = canvas.toDataURL();
					const a = document.createElement('a');
					a.href = url
					a.download = `${id}-receipt.png`
					a.click()
					a.remove()
					resolve(true)
				})?.catch(err => reject(err))
			})
		}


		printBtn && printBtn.addEventListener("click", async (e) => {
			printBtn.innerHTML = "downloading..."
			printBtn.disabled = true
			const id = document.getElementById("ID").value
			await downloadReceipt(id)
			printBtn.innerHTML = "Download Receipt"
			printBtn.disabled = false
		})
	</script>
</body>


<!-- service-single01:34-->

</html>