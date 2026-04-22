<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Ordonnance_<?php echo e($prescription->reference); ?></title>
    <style>
        @page { margin: 1.5cm; }
        body { 
            font-family: 'Helvetica', Arial, sans-serif; 
            color: #1a202c; 
            font-size: 13px;
            line-height: 1.4;
        }
        
        /* 1. Bloc Médecin (En-tête) */
        .header-table { width: 100%; border-bottom: 2px solid #2d3748; padding-bottom: 10px; margin-bottom: 20px; }
        .doctor-info { width: 60%; }
        .doctor-name { font-size: 18px; font-weight: bold; color: #2b6cb0; text-transform: uppercase; }
        .doctor-detail { color: #4a5568; font-size: 11px; margin-top: 2px; }
        .clinic-logo { width: 40%; text-align: right; font-weight: 900; font-size: 20px; color: #cbd5e0; }

        /* 2. Bloc Patient & Date */
        .patient-box { 
            background-color: #f7fafc; 
            border: 1px solid #edf2f7; 
            padding: 15px; 
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .patient-table { width: 100%; }
        .label { color: #718096; font-weight: bold; text-transform: uppercase; font-size: 10px; }
        .value { font-size: 14px; font-weight: bold; }

        /* 3. Corps de l'Ordonnance */
        .prescription-title { 
            text-align: center; 
            text-decoration: underline; 
            font-size: 16px; 
            font-weight: bold; 
            margin-bottom: 25px; 
            letter-spacing: 1px;
        }
        .medication-list { min-height: 400px; padding-left: 10px; }

        /* 4. Bas de page */
        .footer-table { width: 100%; margin-top: 30px; }
        .city-date { font-size: 12px; margin-bottom: 15px; }
        .signature-box { text-align: right; }
        .stamp-zone { 
            margin-top: 10px; 
            height: 100px; 
            width: 200px; 
            border: 1px dashed #e2e8f0; 
            display: inline-block;
            text-align: center;
            color: #cbd5e0;
            line-height: 100px;
            font-size: 10px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td class="doctor-info">
                
                <div class="doctor-name">
                    <?php if(str_contains(strtoupper($prescription->medecin->name), 'DR.')): ?>
                        <?php echo e($prescription->medecin->name); ?>

                    <?php else: ?>
                        Dr. <?php echo e($prescription->medecin->name); ?>

                    <?php endif; ?>
                </div>
                
                
                <div class="doctor-detail">
                    <?php if(is_array($prescription->medecin->specialite) || is_object($prescription->medecin->specialite)): ?>
                        <?php echo e($prescription->medecin->specialite->nom_specialite ?? 'Médecin Généraliste'); ?>

                    <?php else: ?>
                        <?php echo e($prescription->medecin->specialite ?? 'Médecin Généraliste'); ?>

                    <?php endif; ?>
                </div>

                <div class="doctor-detail">Ordre des Médecins : <?php echo e($prescription->medecin->ordre_id ?? 'N° 12.455/2026'); ?></div>
                <div class="doctor-detail">Clinique Béni DE Dieu, Gbedjromede, Cotonou</div>
                <div class="doctor-detail">Tel: +229 0160613363</div>
            </td>
            <td class="clinic-logo">Santé +</td>
        </tr>
    </table>

    <div class="patient-box">
        <table class="patient-table">
            <tr>
                <td width="50%">
                    <span class="label">Patient :</span><br>
                    <span class="value"><?php echo e($prescription->patient->name); ?></span>
                </td>
                <td width="25%">
                    <span class="label">Âge :</span><br>
                    <span class="value"><?php echo e($prescription->age ?? '--'); ?> ans</span>
                </td>
                <td width="25%">
                    <span class="label">Poids :</span><br>
                    <span class="value"><?php echo e($prescription->poids ?? '--'); ?> kg</span>
                </td>
            </tr>
        </table>
    </div>

    <div class="city-date">
        Fait à <strong>Cotonou</strong>, le <strong><?php echo e(\Carbon\Carbon::parse($prescription->date_emission)->format('d/m/Y')); ?></strong>
    </div>

    <div class="prescription-title">ORDONNANCE MEDICALE</div>

    <div class="medication-list">
        <div style="white-space: pre-line; font-size: 14px; color: #2d3748; line-height: 1.6;">
            <?php echo nl2br(e($prescription->contenu)); ?>

        </div>
    </div>

    <table class="footer-table">
        <tr>
            <td width="50%" style="vertical-align: bottom; font-size: 10px; color: #a0aec0;">
                Réf: <?php echo e($prescription->reference); ?><br>
                Généré électroniquement par Don DE DEIEU le <?php echo e(date('d/m/Y à H:i')); ?>

            </td>
            <td class="signature-box">
                <p style="margin-bottom: 5px; font-weight: bold;">Signature et Cachet :</p>
                <div class="stamp-zone">Zone de Cachet</div>
            </td>
        </tr>
    </table>

</body>
</html><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/doctor/prescriptions/pdf.blade.php ENDPATH**/ ?>