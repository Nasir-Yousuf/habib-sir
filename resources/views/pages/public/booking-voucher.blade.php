<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Voucher #{{ $booking->booking_reference }} | Bongo Tanbo Travels</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            background-color: #f8fafc;
            color: #1e293b;
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            padding: 30px 15px;
        }
        .voucher-card {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        .voucher-header {
            background: linear-gradient(135deg, #16251b, #2b422a);
            color: #ffffff;
            padding: 30px 40px;
        }
        .voucher-body {
            padding: 40px;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-confirmed { background-color: #dcfce7; color: #166534; }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-contacted { background-color: #e0f2fe; color: #075985; }
        .status-cancelled { background-color: #fee2e2; color: #991b1b; }
        
        .info-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            font-weight: 600;
            margin-bottom: 4px;
        }
        .info-value {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
        }

        @media print {
            body {
                background: #ffffff;
                padding: 0;
            }
            .voucher-card {
                border: none;
                box-shadow: none;
                max-width: 100%;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="voucher-card">
        <!-- Actions Toolbar (Hidden during print) -->
        <div class="no-print bg-light p-3 border-bottom d-flex justify-content-between align-items-center">
            <a href="{{ route('my-bookings') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                <i class="fas fa-arrow-left me-1"></i> Back to My Bookings
            </a>
            <div class="d-flex gap-2">
                <button onclick="window.print()" class="btn btn-success btn-sm rounded-pill px-3 fw-bold">
                    <i class="fas fa-print me-1"></i> Print / Save as PDF
                </button>
            </div>
        </div>

        <!-- Voucher Header -->
        <div class="voucher-header">
            <div class="row align-items-center">
                <div class="col-sm-7">
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ asset('assets/images/logo.webp') }}" alt="Logo" width="48" height="48" class="bg-white rounded-circle p-1">
                        <div>
                            <h4 class="fw-bold mb-0 text-white">Bongo Tanbo Travels</h4>
                            <p class="small text-white-50 mb-0">Bangladesh & Japan Tour Specialist</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5 text-sm-end mt-3 mt-sm-0">
                    <span class="info-label text-white-50 d-block">Booking Reference</span>
                    <span class="fs-4 fw-bold font-monospace text-warning">{{ $booking->booking_reference }}</span>
                </div>
            </div>
        </div>

        <!-- Voucher Body -->
        <div class="voucher-body">
            <div class="row mb-4 pb-3 border-bottom">
                <div class="col-6">
                    <div class="info-label">Reservation Status</div>
                    <span class="status-badge status-{{ $booking->status }}">
                        {{ strtoupper($booking->status) }}
                    </span>
                </div>
                <div class="col-6 text-end">
                    <div class="info-label">Booking Created</div>
                    <div class="info-value">{{ $booking->created_at->format('F d, Y') }}</div>
                </div>
            </div>

            <!-- Traveler Details -->
            <h6 class="fw-bold text-uppercase text-muted mb-3" style="font-size: 13px; letter-spacing: 0.5px;">Traveler Information</h6>
            <div class="row g-3 mb-4 pb-3 border-bottom">
                <div class="col-sm-4">
                    <div class="info-label">Lead Traveler</div>
                    <div class="info-value">{{ $booking->customer_name }}</div>
                </div>
                <div class="col-sm-4">
                    <div class="info-label">Email Address</div>
                    <div class="info-value">{{ $booking->customer_email }}</div>
                </div>
                <div class="col-sm-4">
                    <div class="info-label">Phone Contact</div>
                    <div class="info-value">{{ $booking->customer_phone }}</div>
                </div>
            </div>

            <!-- Tour Details -->
            <h6 class="fw-bold text-uppercase text-muted mb-3" style="font-size: 13px; letter-spacing: 0.5px;">Tour & Itinerary Details</h6>
            <div class="row g-3 mb-4 pb-3 border-bottom">
                <div class="col-sm-8">
                    <div class="info-label">Selected Tour Package</div>
                    <div class="info-value fs-5 text-success">
                        {{ $booking->tour->title ?? ($booking->destination_interest ?? 'Customized Package Request') }}
                    </div>
                    @if($booking->tour && $booking->tour->category)
                        <span class="badge bg-light text-muted border mt-1">{{ $booking->tour->category->name }}</span>
                    @endif
                </div>
                <div class="col-sm-4 text-sm-end">
                    <div class="info-label">Departure Date</div>
                    <div class="info-value text-dark">
                        {{ $booking->departure_date ? \Carbon\Carbon::parse($booking->departure_date)->format('l, F d, Y') : 'Schedule upon confirmation' }}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="info-label">Party Size</div>
                    <div class="info-value">{{ $booking->adults_count }} Adult{{ $booking->adults_count > 1 ? 's' : '' }} @if($booking->children_count > 0), {{ $booking->children_count }} Child{{ $booking->children_count > 1 ? 'ren' : '' }} @endif</div>
                </div>
                <div class="col-sm-4">
                    <div class="info-label">Time Slot Preference</div>
                    <div class="info-value">{{ $booking->time_slot ?? 'Standard / Flexible' }}</div>
                </div>
                <div class="col-sm-4 text-sm-end">
                    <div class="info-label">Estimated Price</div>
                    <div class="info-value text-dark">
                        @if($booking->tour && $booking->tour->starting_price)
                            ৳{{ number_format($booking->tour->starting_price * max(1, $booking->adults_count)) }} BDT
                        @else
                            Custom Quote
                        @endif
                    </div>
                </div>
            </div>

            @if($booking->special_requests)
                <div class="mb-4 pb-3 border-bottom">
                    <div class="info-label">Special Inquiries / Traveler Requests</div>
                    <div class="p-3 bg-light rounded-3 text-muted fst-italic">
                        "{{ $booking->special_requests }}"
                    </div>
                </div>
            @endif

            <!-- Contact & Terms Notice -->
            <div class="bg-light p-3 rounded-3 small text-muted">
                <div class="row">
                    <div class="col-md-6 mb-2 mb-md-0">
                        <strong class="text-dark d-block mb-1">Bangladesh Liaison Office:</strong>
                        House No. 6, Road No. 8, Sector 11, Uttara, Dhaka 1230<br>
                        Phone: +88028991482 | WhatsApp: +8801577509112
                    </div>
                    <div class="col-md-6">
                        <strong class="text-dark d-block mb-1">Japan Headquarters:</strong>
                        Fukuoka Ken Fukuoka City Chuo-ku-Kego 2-9-10-201, Japan<br>
                        Email: bongotanbo@gmail.com
                    </div>
                </div>
            </div>

            <div class="text-center mt-4 text-muted small">
                <em>Thank you for traveling with Bongo Tanbo Travels! Please present this voucher or reference ID upon trip coordination.</em>
            </div>
        </div>
    </div>
</body>
</html>
