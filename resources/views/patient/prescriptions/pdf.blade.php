<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        /* Configuration de la page pour le PDF */
        @page { margin: 0; }
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            color: #1e293b; 
            margin: 0;
            padding: 0;
            line-height: 1.5;
        }

        /* Barre latérale décorative Premium */
        .sidebar {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 8px;
            background: #2563eb;
        }

        .container { padding: 50px 60px; }

        /* En-tête */
        .header { 
            border-bottom: 1px solid #e2e8f0; 
            padding-bottom: 30px;
            margin-bottom: 40px;
        }
        .doctor-info h1 { 
            margin: 0; 
            font-size: 24px; 
            color: #0f172a; 
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .specialty { 
            color: #2563eb; 
            font-weight: bold; 
            font-size: 14px; 
            margin-top: 4px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .clinic-name { font-size: 12px; color: #64748b; margin-top: 5px; }

        /* Détails Ordonnance */
        .meta-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 50px;
            font-size: 13px;
        }
        .patient-box {
            background: #f8fafc;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #f1f5f9;
        }

        /* Corps de l'ordonnance */
        .content { min-height: 450px; }
        .rp-symbol { 
            font-family: serif; 
            font-style: italic; 
            font-size: 45px; 
            color: #cbd5e1; 
            margin-bottom: 20px;
        }
        
        .prescription-list { margin-left: 20px; }
        .item { 
            margin-bottom: 25px; 
            position: relative;
        }
        .med-name { 
            font-size: 17px; 
            font-weight: 800; 
            color: #1e3a8a; 
            display: block;
        }
        .posology { 
            font-size: 14px; 
            color: #475569; 
            display: block;
            margin-top: 3px;
        }
        .duration {
            font-size: 12px;
            color: #94a3b8;
            font-weight: bold;
        }

        /* Pied de page */
        .footer { 
            margin-top: 60px;
            border-top: 1px solid #f1f5f9;
            padding-top: 20px;
        }
        .signature-box { 
            float: right; 
            text-align: center; 
            width: 250px;
        }
        .signature-label {
            font-size: 10px;
            text-transform: uppercase;
            color: #94a3b8;
            margin-bottom: 50px;
            display: block;
            font-weight: bold;
        }
        .signature-line { border-bottom: 1px dashed #cbd5e1; width: 100%; }
        .footer-note { font-size: 10px; color: #94a3b8; margin-top: 40px; }
    </style>
</head>
<body>
    <div class="sidebar"></div>

    <div class="container">
        <div class="header">
            <table width="100%">
                <tr>
                    <td class="doctor-info">
                        <h1>Dr. {{ $prescription->medecin->name }}</h1>
                        <div class="specialty">{{ $prescription->medecin->specialite->nom ?? 'Médecine Générale' }}</div>
                        <div class="clinic-name">Santé + Medical Center | Bénin</div>
                    </td>
                    <td align="right" style="vertical-align: top;">
                        <div style="font-size: 12px; color: #64748b;">
                            Réf: #ORD-{{ str_pad($prescription->id, 5, '0', STR_PAD_LEFT) }}<br>
                            Fait le : <strong>{{ $prescription->created_at->format('d/m/Y') }}</strong>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="meta-info">
            <div class="patient-box">
                <span style="color: #94a3b8; font-size: 10px; text-transform: uppercase; font-weight: bold;">Patient</span><br>
                <strong style="font-size: 16px;">{{ Auth::user()->name }}</strong>
            </div>
        </div>

        <div class="content">
            <div class="rp-symbol">Rp/</div>
            
            <div class="prescription-list">
                {{-- On gère ici le cas où le contenu est une chaîne simple ou un tableau JSON --}}
                @if(is_array($prescription->contenu_prescription))
                    @foreach($prescription->contenu_prescription as $medicament)
                        <div class="item">
                            <span class="med-name">{{ $medicament['nom'] }}</span>
                            <span class="posology">{{ $medicament['posologie'] }}</span>
                            <span class="duration">— Pendant {{ $medicament['duree'] }}</span>
                        </div>
                    @endforeach
                @else
                    <div class="item" style="font-size: 16px; white-space: pre-line;">
                        {!! nl2br(e($prescription->contenu)) !!}
                    </div>
                @endif
            </div>
        </div>

        <div class="footer">
            <div class="signature-box">
                <span class="signature-label">Cachet et Signature du Médecin</span>
                <div class="signature-line"></div>
                <p style="font-size: 12px; margin-top: 10px;">Dr. {{ $prescription->medecin->name }}</p>
            </div>
            
            <div style="clear: both;"></div>
            
            <div class="footer-note">
                Cette ordonnance est valable 3 mois. Document officiel généré par le système Santé +.
            </div>
        </div>
    </div>
</body>
</html>