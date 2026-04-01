@extends('themes.default.common.master')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap');

    .booking-success-wrap {
        font-family: 'DM Sans', sans-serif;
        min-height: 85vh;
        background: #f4f1ec;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 60px 20px;
        position: relative;
        overflow: hidden;
    }

    /* Mountain silhouette background — teal tones */
    .booking-success-wrap::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 260px;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 260'%3E%3Cpath fill='%231a3d52' fill-opacity='0.7' d='M0,260 L0,160 L120,80 L240,140 L360,40 L480,120 L600,60 L720,140 L840,20 L960,110 L1080,50 L1200,130 L1320,70 L1440,140 L1440,260 Z'/%3E%3Cpath fill='%23163345' fill-opacity='0.5' d='M0,260 L0,200 L180,130 L360,180 L540,100 L720,170 L900,90 L1080,160 L1260,110 L1440,170 L1440,260 Z'/%3E%3C/svg%3E") no-repeat bottom center;
        background-size: cover;
        pointer-events: none;
    }

    .success-card {
        background: #fff;
        border-radius: 4px;
        max-width: 860px;
        width: 100%;
        position: relative;
        z-index: 1;
        box-shadow: 0 30px 80px rgba(0,0,0,0.12), 0 4px 16px rgba(0,0,0,0.06);
        overflow: hidden;
    }

    /* Top accent strip */
    .success-card-header {
        background: linear-gradient(135deg, #0d2233 0%, #163d55 50%, #1a4a65 100%);
        padding: 34px 60px 28px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .success-card-header::before {
        content: '';
        position: absolute;
        top: -40px;
        right: -40px;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }

    .success-card-header::after {
        content: '';
        position: absolute;
        bottom: -60px;
        left: -20px;
        width: 160px;
        height: 160px;
        background: rgba(255,255,255,0.04);
        border-radius: 50%;
    }

    .check-circle {
        width: 64px;
        height: 64px;
        background: rgba(255,255,255,0.12);
        border: 2px solid rgba(255,255,255,0.4);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        animation: popIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
    }

    .check-circle svg {
        width: 30px;
        height: 30px;
        stroke: #fff;
        fill: none;
        stroke-width: 3;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke-dasharray: 60;
        stroke-dashoffset: 60;
        animation: drawCheck 0.5s 0.4s ease forwards;
    }

    @keyframes popIn {
        from { transform: scale(0); opacity: 0; }
        to   { transform: scale(1); opacity: 1; }
    }

    @keyframes drawCheck {
        to { stroke-dashoffset: 0; }
    }

    .success-heading {
        font-family: 'Playfair Display', serif;
        font-size: 34px;
        font-weight: 900;
        color: #fff;
        margin: 0 0 8px;
        letter-spacing: -0.5px;
        line-height: 1.1;
    }

    .success-subtext {
        color: rgba(255,255,255,0.72);
        font-size: 15px;
        font-weight: 300;
        margin: 0;
        letter-spacing: 0.2px;
    }

    /* Body section */
    .success-card-body {
        padding: 50px 60px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 36px;
    }

    .info-block {
        background: #f4f8fb;
        border: 1px solid #d8e8f0;
        border-radius: 3px;
        padding: 28px 30px;
    }

    .info-block-label {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: #7a9baf;
        margin-bottom: 10px;
    }

    .info-block-value {
        font-size: 15px;
        color: #2c2c2c;
        font-weight: 400;
        line-height: 1.6;
    }

    .info-block-value a {
        color: #1a5276;
        text-decoration: none;
        font-weight: 500;
    }

    .info-block-value a:hover {
        text-decoration: underline;
    }

    /* Timeline note */
    .timeline-note {
        display: flex;
        align-items: flex-start;
        gap: 18px;
        background: #eaf3f8;
        border-left: 4px solid #1a6690;
        border-radius: 0 3px 3px 0;
        padding: 22px 28px;
        margin-bottom: 36px;
    }

    .timeline-icon {
        font-size: 24px;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .timeline-text {
        font-size: 15px;
        color: #3a3a3a;
        line-height: 1.65;
        margin: 0;
    }

    .timeline-text strong {
        color: #1a5276;
        font-weight: 600;
    }

    /* Divider */
    .divider {
        border: none;
        border-top: 1px solid #dce9f0;
        margin: 0 0 32px;
    }

    /* Footer row */
    .success-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
    }

    .brand-sig {
        font-size: 13px;
        color: #7a9baf;
    }

    .brand-sig strong {
        display: block;
        font-size: 15px;
        color: #2c2c2c;
        font-weight: 600;
        margin-bottom: 2px;
    }

    .btn-home {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #1a6690;
        color: #fff;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        font-weight: 500;
        letter-spacing: 0.3px;
        padding: 14px 32px;
        border-radius: 2px;
        text-decoration: none;
        transition: background 0.2s ease, transform 0.15s ease;
        border: none;
        cursor: pointer;
    }

    .btn-home:hover {
        background: #1f80b0;
        transform: translateY(-1px);
        color: #fff;
        text-decoration: none;
    }

    .btn-home svg {
        width: 16px;
        height: 16px;
    }

    /* Responsive */
    @media (max-width: 640px) {
        .success-card-header { padding: 26px 28px 22px; }
        .success-card-body { padding: 32px 28px; }
        .success-heading { font-size: 26px; }
        .info-grid { grid-template-columns: 1fr; gap: 16px; }
        .success-footer { flex-direction: column; align-items: flex-start; }
        .btn-home { width: 100%; justify-content: center; }
    }
</style>

<div class="booking-success-wrap">
    <div class="success-card">

        <!-- Header -->
        <div class="success-card-header">
            <div class="check-circle">
                <svg viewBox="0 0 24 24">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </div>
            <h1 class="success-heading">Booking Confirmed</h1>
            <p class="success-subtext">Your adventure request has been successfully submitted.</p>
        </div>

        <!-- Body -->
        <div class="success-card-body">

            <!-- What's next note -->
            <div class="timeline-note">
                <span class="timeline-icon">🏔️</span>
                <p class="timeline-text">
                    Thank you for choosing us for your Himalayan adventure.
                    Our team will review your booking and reach out to you within <strong>24 hours</strong> to confirm all details and next steps.
                </p>
            </div>

            <!-- Info blocks -->
            <div class="info-grid">
                <div class="info-block">
                    <div class="info-block-label">Phone</div>
                    <div class="info-block-value">
                        <a href="tel:{{ optional($setting)->phone }}">
                            {{ optional($setting)->phone ?? '+977 984-6484-4676' }}
                        </a><br>
                        <a href="tel:{{ optional($setting)->phone_secondary ?? '+977984556565' }}">
                            {{ optional($setting)->phone_secondary ?? '+977 984-556-5565' }}
                        </a>
                    </div>
                </div>
                <div class="info-block">
                    <div class="info-block-label">Email</div>
                    <div class="info-block-value">
                        <a href="mailto:{{ optional($setting)->email_primary ?? 'info@maxterk.com' }}">
                            {{ optional($setting)->email_primary ?? 'info@maxterk.com' }}
                        </a>
                    </div>
                </div>
            </div>

            <hr class="divider">

            <!-- Footer row -->
            <div class="success-footer">
                <div class="brand-sig">
                    <strong>{{ optional($setting)->site_name ?? 'Max Trekking' }}</strong>
                    We look forward to seeing you in Nepal 🇳🇵
                </div>
                <a class="btn-home" href="{{ url('/') }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    Back to Home
                </a>
            </div>

        </div>
    </div>
</div>

@endsection
