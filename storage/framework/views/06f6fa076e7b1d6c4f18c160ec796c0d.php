<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ordonnance Médicale - <?php echo e(optional($prescription)->reference ?? '---'); ?></title>
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

    
    <div class="main-title">ORDONNANCE MÉDICALE</div>
    <div class="sub-title">Document sécurisé — Signature numérique certifiée</div>

    
    <div class="ref-number">N° <?php echo e(optional($prescription)->reference ?? '---'); ?></div>

    
    <div class="doctor-info">
        <div class="doctor-name">Dr. <?php echo e(optional($prescription->medecin)->name ?? 'Médecin inconnu'); ?></div>
        <div class="doctor-specialty">
            <?php echo e(optional(optional($prescription->medecin)->specialite)->nom_specialite ?? ''); ?>

        </div>
        
        <?php if(optional($prescription->medecin)->numero_ordre): ?>
            <div class="doctor-details">
                N° Inscription à l'Ordre des Médecins : <?php echo e(optional($prescription->medecin)->numero_ordre); ?>

            </div>
        <?php endif; ?>
        
        <?php if(optional($prescription->medecin)->cabinet_nom): ?>
            <div class="doctor-details">
                Cabinet : <?php echo e(optional($prescription->medecin)->cabinet_nom); ?>

            </div>
        <?php endif; ?>
        
        <?php if(optional($prescription->medecin)->cabinet_adresse): ?>
            <div class="doctor-details">
                <?php echo e(optional($prescription->medecin)->cabinet_adresse); ?>

            </div>
        <?php endif; ?>
        
        <?php if(optional($prescription->medecin)->cabinet_ville): ?>
            <div class="doctor-details">
                <?php echo e(optional($prescription->medecin)->cabinet_ville); ?>

            </div>
        <?php endif; ?>
        
        <div class="doctor-details">
            <?php if(optional($prescription->medecin)->cabinet_telephone): ?>
                Tél : <?php echo e(optional($prescription->medecin)->cabinet_telephone); ?>

            <?php endif; ?>
            <?php if(optional($prescription->medecin)->cabinet_telephone && !empty($medecinEmail)): ?>
                | 
            <?php endif; ?>
            <?php if(!empty($medecinEmail)): ?>
                Email : <?php echo e($medecinEmail); ?>

            <?php endif; ?>
        </div>
    </div>

    
    <div class="date-lieu">
        Fait à <strong><?php echo e(optional($prescription->medecin)->cabinet_ville ?? 'Ville inconnue'); ?></strong>, le <strong>
            <?php if(optional($prescription)->date_emission): ?>
                <?php echo e(\Carbon\Carbon::parse($prescription->date_emission)->translatedFormat('d F Y')); ?>

            <?php elseif(optional($prescription)->created_at): ?>
                <?php echo e(optional($prescription)->created_at->translatedFormat('d F Y')); ?>

            <?php else: ?>
                <?php echo e(now()->translatedFormat('d F Y')); ?>

            <?php endif; ?>
        </strong>
    </div>

    
    <div class="patient-title">PATIENT :</div>
    <div class="patient-info">
        <?php echo e(strtoupper(optional($prescription->patient)->name ?? 'PATIENT')); ?>

        <?php if(optional($prescription->patient)->date_naissance): ?>
            | Né(e) le : <?php echo e(\Carbon\Carbon::parse(optional($prescription->patient)->date_naissance)->format('d/m/Y')); ?>

        <?php endif; ?>
        <?php if(optional($prescription->patient)->numero_securite_sociale): ?>
            | N° SS : <?php echo e(optional($prescription->patient)->numero_securite_sociale); ?>

        <?php endif; ?>
    </div>
    <div class="patient-info">
        <?php if(optional($prescription->patient)->adresse): ?>
            Adresse : <?php echo e(optional($prescription->patient)->adresse); ?> |
        <?php endif; ?>
        Poids : <?php echo e(optional($prescription)->poids ?? '--'); ?> kg
    </div>
    <?php if(optional($prescription->patient)->allergies): ?>
        <div class="patient-info" style="color: #dc2626;">
            ⚠️ Allergies connues : <?php echo e(optional($prescription->patient)->allergies); ?>

        </div>
    <?php endif; ?>

    
    <div class="rp-symbol">Rp/</div>
    
    <div>
        <?php if(!empty(optional($prescription)->contenu)): ?>
            <?php
                $lines = explode("\n", $prescription->contenu);
            ?>
            <?php $__currentLoopData = $lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(trim($line)): ?>
                    <div class="medication-item">
                        <div class="med-name"><?php echo e(trim($line)); ?></div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div style="color: #94a3b8; font-style: italic;">Aucun médicament prescrit</div>
        <?php endif; ?>
    </div>

    
    <div class="verification-title">CODE DE VÉRIFICATION</div>
    <div class="sha256-code">
        <?php echo e($sha256 ?? hash('sha256', (optional($prescription)->reference ?? '') . (optional($prescription)->created_at ?? now()) . (optional($prescription)->verification_token ?? ''))); ?>

    </div>

    
    <div class="signature-box">
        <div class="doctor-signature">Dr. <?php echo e(optional($prescription->medecin)->name ?? 'Médecin inconnu'); ?></div>
        
        <?php if(optional(optional($prescription->medecin)->specialite)->nom_specialite): ?>
            <div class="doctor-details" style="margin-bottom: 5px;">
                <?php echo e(optional(optional($prescription->medecin)->specialite)->nom_specialite); ?>

            </div>
        <?php endif; ?>
        
        <?php if(optional($prescription->medecin)->numero_ordre): ?>
            <div class="doctor-details">
                N° Inscription à l'Ordre des Médecins : <?php echo e(optional($prescription->medecin)->numero_ordre); ?>

            </div>
        <?php endif; ?>
        
        <?php if(optional($prescription->medecin)->cabinet_nom || optional($prescription->medecin)->cabinet_ville): ?>
            <div class="doctor-details">
                Établissement : 
                <?php if(optional($prescription->medecin)->cabinet_nom): ?><?php echo e(optional($prescription->medecin)->cabinet_nom); ?><?php endif; ?>
                <?php if(optional($prescription->medecin)->cabinet_nom && optional($prescription->medecin)->cabinet_ville): ?>, <?php endif; ?>
                <?php if(optional($prescription->medecin)->cabinet_ville): ?><?php echo e(optional($prescription->medecin)->cabinet_ville); ?><?php endif; ?>
            </div>
        <?php endif; ?>
        
        <?php if(optional($prescription->medecin)->cabinet_telephone): ?>
            <div class="doctor-details">
                Tél : <?php echo e(optional($prescription->medecin)->cabinet_telephone); ?>

            </div>
        <?php endif; ?>
        
        <div class="signature-date">
            Signé le :
            <?php if(optional($prescription)->created_at): ?>
                <?php echo e(optional($prescription)->created_at->format('d/m/Y à H:i:s')); ?>

            <?php else: ?>
                <?php echo e(now()->format('d/m/Y à H:i:s')); ?>

            <?php endif; ?>
        </div>
        <div class="valid-badge">SIGNATURE NUMÉRIQUE VALIDE</div>
    </div>

    
    <?php if(!empty($qrCodeSvg)): ?>
        <div class="qr-container">
            <?php echo $qrCodeSvg; ?>

            <div class="qr-label">Scanner pour vérifier l'authenticité</div>
        </div>
    <?php endif; ?>

    
    <div class="sha256-code" style="font-size: 7px; margin-top: 20px;">
        Empreinte SHA-256 : <?php echo e($sha256 ?? hash('sha256', (optional($prescription)->reference ?? '') . (optional($prescription)->created_at ?? now()) . (optional($prescription)->verification_token ?? ''))); ?>

    </div>

    
    <div class="footer">
        Document valable 3 mois. Ordonnance générée par MonEspaceSanté — Système sécurisé.<br>
        Toute falsification est punie par la loi.
    </div>

</body>
</html><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/patient/prescriptions/pdf.blade.php ENDPATH**/ ?>