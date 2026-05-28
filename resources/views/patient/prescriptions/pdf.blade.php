<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ordonnance Médicale - {{ $prescription->reference }}</title>
    <style>
        @page {
            margin: 1.5cm;
            size: A4;
        }
        
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #1a202c;
            line-height: 1.4;
            font-size: 12px;
            background: white;
        }
        
        .main-title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        
        .sub-title {
            text-align: center;
            font-size: 10px;
            color: #2563eb;
            font-weight: bold;
            margin-bottom: 20px;
        }
        
        .ref-number {
            text-align: right;
            font-size: 11px;
            font-family: monospace;
            margin-bottom: 20px;
        }
        
        .doctor-info {
            margin-bottom: 20px;
            line-height: 1.5;
        }
        
        .doctor-name {
            font-size: 16px;
            font-weight: bold;
            color: #0f172a;
        }
        
        .doctor-specialty {
            font-size: 12px;
            font-weight: bold;
            color: #2563eb;
        }
        
        .doctor-details {
            font-size: 10px;
            color: #475569;
        }
        
        .date-lieu {
            text-align: right;
            margin-bottom: 25px;
            font-size: 11px;
            font-style: italic;
        }
        
        .patient-title {
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 8px;
        }
        
        .patient-info {
            font-size: 11px;
            margin-bottom: 5px;
            line-height: 1.4;
        }
        
        .rp-symbol {
            font-size: 32px;
            font-style: italic;
            font-family: 'Times New Roman', serif;
            margin: 25px 0 15px 0;
        }
        
        .medication-item {
            margin-bottom: 20px;
            padding-left: 15px;
        }
        
        .med-name {
            font-weight: bold;
            font-size: 13px;
        }
        
        .med-details {
            font-size: 11px;
            color: #475569;
            margin-top: 3px;
        }
        
        .warning-note {
            font-size: 10px;
            color: #dc2626;
            margin-top: 3px;
            font-style: italic;
        }
        
        .verification-title {
            font-weight: bold;
            font-size: 11px;
            margin: 30px 0 10px 0;
            text-align: center;
        }
        
        .sha256-code {
            font-family: monospace;
            font-size: 9px;
            word-break: break-all;
            text-align: center;
            background: #f8fafc;
            padding: 10px;
            margin: 10px 0;
        }
        
        .signature-box {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
        }
        
        .doctor-signature {
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 5px;
        }
        
        .valid-badge {
            color: #10b981;
            font-weight: bold;
            font-size: 11px;
        }
        
        .signature-date {
            font-size: 9px;
            color: #94a3b8;
        }
        
        .qr-container {
            text-align: center;
            margin: 20px 0;
        }
        
        .qr-label {
            font-size: 8px;
            color: #64748b;
            margin-top: 5px;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 8px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            padding-top: 15px;
        }
        
        .clearfix {
            clear: both;
        }
    </style>
</head>
<body>

    {{-- TITRE --}}
    <div class="main-title">ORDONNANCE MÉDICALE</div>
    <div class="sub-title">Document sécurisé — Signature numérique certifiée</div>

    {{-- NUMÉRO DE RÉFÉRENCE --}}
    <div class="ref-number">N° {{ $prescription->reference }}</div>

    {{-- INFORMATIONS MÉDECIN (100% dynamique) --}}
    <div class="doctor-info">
        <div class="doctor-name">Dr. {{ $prescription->medecin->name }}</div>
        <div class="doctor-specialty">
            {{ $prescription->medecin->specialite->nom_specialite ?? '' }}
        </div>
        
                @if($prescription->medecin->numero_ordre)
                <div class="doctor-details">
        N° Inscription à l'Ordre des Médecins : {{ $prescription->medecin->numero_ordre }}       
        </div>
                @endif
        
        @if($prescription->medecin->cabinet_nom)
        <div class="doctor-details">
            Cabinet : {{ $prescription->medecin->cabinet_nom }}
        </div>
        @endif
        
        @if($prescription->medecin->cabinet_adresse)
        <div class="doctor-details">
            {{ $prescription->medecin->cabinet_adresse }}
        </div>
        @endif
        
        @if($prescription->medecin->cabinet_ville)
        <div class="doctor-details">
            {{ $prescription->medecin->cabinet_ville }}
        </div>
        @endif
        
<div class="doctor-details">
    @if($prescription->medecin->cabinet_telephone)
        Tél : {{ $prescription->medecin->cabinet_telephone }}
    @endif
    @if($prescription->medecin->cabinet_telephone && $medecinEmail)
        | 
    @endif
    @if($medecinEmail)
        Email : {{ $medecinEmail }}
    @endif
</div>
    </div>

    {{-- DATE ET LIEU (ville dynamique) --}}
    <div class="date-lieu">
        Fait à <strong>{{ $prescription->medecin->cabinet_ville ?? '' }}</strong>, le <strong>{{ $prescription->date_emission->translatedFormat('d F Y') }}</strong>
    </div>

    {{-- INFORMATIONS PATIENT (dynamique) --}}
    <div class="patient-title">PATIENT :</div>
    <div class="patient-info">
        {{ strtoupper($prescription->patient->name) }}
        @if($prescription->patient->date_naissance)
            | Né(e) le : {{ \Carbon\Carbon::parse($prescription->patient->date_naissance)->format('d/m/Y') }}
        @endif
        @if($prescription->patient->numero_securite_sociale)
            | N° SS : {{ $prescription->patient->numero_securite_sociale }}
        @endif
    </div>
    <div class="patient-info">
        @if($prescription->patient->adresse)
            Adresse : {{ $prescription->patient->adresse }} |
        @endif
        Poids : {{ $prescription->poids ?? '--' }} kg
    </div>
    @if($prescription->patient->allergies)
    <div class="patient-info" style="color: #dc2626;">
        ⚠️ Allergies connues : {{ $prescription->patient->allergies }}
    </div>
    @endif

    {{-- PRESCRIPTION --}}
    <div class="rp-symbol">Rp/</div>
    
    <div>
        @if(!empty($prescription->contenu))
            @php
                $lines = explode("\n", $prescription->contenu);
            @endphp
            @foreach($lines as $index => $line)
                @if(trim($line))
                    <div class="medication-item">
                        <div class="med-name">{{ trim($line) }}</div>
                    </div>
                @endif
            @endforeach
        @else
            <div style="color: #94a3b8; font-style: italic;">Aucun médicament prescrit</div>
        @endif
    </div>

    {{-- CODE DE VÉRIFICATION --}}
    <div class="verification-title">CODE DE VÉRIFICATION</div>
    <div class="sha256-code">
        {{ $sha256 ?? hash('sha256', $prescription->reference . $prescription->created_at . ($prescription->verification_token ?? '')) }}
    </div>

    {{-- SIGNATURE ET CACHET --}}
    <div class="signature-box">
        <div class="doctor-signature">Dr. {{ $prescription->medecin->name }}</div>
        
        @if($prescription->medecin->specialite->nom_specialite)
        <div class="doctor-details" style="margin-bottom: 5px;">
            {{ $prescription->medecin->specialite->nom_specialite }}
        </div>
        @endif
        
        @if($prescription->medecin->numero_ordre)
        <div class="doctor-details">
            N° Inscription à l'Ordre des Médecins : {{ $prescription->medecin->numero_ordre }}
        </div>
        @endif
        
        @if($prescription->medecin->cabinet_nom || $prescription->medecin->cabinet_ville)
        <div class="doctor-details">
            Établissement : 
            @if($prescription->medecin->cabinet_nom){{ $prescription->medecin->cabinet_nom }}@endif
            @if($prescription->medecin->cabinet_nom && $prescription->medecin->cabinet_ville), @endif
            @if($prescription->medecin->cabinet_ville){{ $prescription->medecin->cabinet_ville }}@endif
        </div>
        @endif
        
        @if($prescription->medecin->cabinet_telephone)
        <div class="doctor-details">
            Tél : {{ $prescription->medecin->cabinet_telephone }}
        </div>
        @endif
        
        <div class="signature-date">
            Signé le : {{ $prescription->created_at->format('d/m/Y à H:i:s') }}
        </div>
        <div class="valid-badge"> SIGNATURE NUMÉRIQUE VALIDE</div>
    </div>

  {{-- QR Code --}}
@if(isset($qrCodeSvg))
<div class="qr-container">
    {!! $qrCodeSvg !!}
    <div class="qr-label">Scanner pour vérifier l'authenticité</div>
</div>
@endif

    {{-- SHA-256 (bas de page) --}}
    <div class="sha256-code" style="font-size: 7px; margin-top: 20px;">
        Empreinte SHA-256 : {{ $sha256 ?? hash('sha256', $prescription->reference . $prescription->created_at . ($prescription->verification_token ?? '')) }}
    </div>

    {{-- FOOTER --}}
    <div class="footer">
        Document valable 3 mois. Ordonnance générée par MonEspaceSanté — Système sécurisé.<br>
        Toute falsification est punie par la loi.
    </div>

</body>
</html>