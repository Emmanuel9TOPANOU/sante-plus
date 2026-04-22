<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Rapport d'Analyse - Santé+</title>
    <style>
        /* Configuration de la page PDF */
        @page { margin: 100px 50px; }
        
        body { 
            font-family: 'Helvetica', Arial, sans-serif; 
            color: #1e293b; 
            line-height: 1.6; 
            margin: 0;
            padding: 0;
        }

        /* En-tête avec ligne décorative */
        .header { 
            text-align: center; 
            margin-bottom: 40px; 
            border-bottom: 3px solid #2563eb; 
            padding-bottom: 20px; 
        }
        .clinic-name { 
            color: #2563eb; 
            font-size: 28px; 
            font-weight: bold; 
            margin: 0; 
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .clinic-info { font-size: 10px; color: #64748b; margin-top: 5px; }
        .doc-title { 
            background-color: #f1f5f9;
            display: inline-block;
            padding: 8px 25px;
            border-radius: 50px;
            text-transform: uppercase; 
            font-size: 14px; 
            font-weight: bold;
            letter-spacing: 2px; 
            margin-top: 15px; 
            color: #0f172a;
        }
        
        /* Sections d'informations */
        .info-section { width: 100%; margin-bottom: 40px; border-bottom: 1px solid #f1f5f9; padding-bottom: 20px; }
        .info-table { width: 100%; border-collapse: collapse; }
        .info-td { width: 50%; vertical-align: top; font-size: 12px; }
        .label { color: #64748b; font-weight: bold; text-transform: uppercase; font-size: 10px; }
        .value { color: #0f172a; font-weight: bold; font-size: 13px; }
        
        /* Table des résultats - Style Premium */
        .results-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .results-table th { 
            background-color: #2563eb; 
            color: white;
            padding: 15px; 
            text-align: left; 
            font-size: 11px; 
            text-transform: uppercase; 
            letter-spacing: 1px;
        }
        .results-table td { 
            border-bottom: 1px solid #e2e8f0; 
            padding: 15px; 
            font-size: 13px; 
        }
        .result-value { font-size: 16px; font-weight: 800; color: #2563eb; }
        
        /* Zone d'interprétation */
        .interpretation-box { 
            background-color: #f8fafc; 
            padding: 20px; 
            border-left: 5px solid #2563eb;
            border-radius: 4px; 
            font-size: 12px; 
            margin-top: 30px;
        }
        .interpretation-title { font-weight: 900; color: #0f172a; margin-bottom: 10px; display: block; }
        
        /* Signature et Pied de page */
        .footer { 
            position: fixed; 
            bottom: 0; 
            width: 100%; 
            border-top: 1px solid #e2e8f0;
            padding-top: 20px;
        }
        .signature-block { float: right; text-align: right; width: 250px; }
        .signature-text { font-size: 12px; font-weight: bold; color: #0f172a; margin-bottom: 5px; }
        .validation-stamp { font-size: 10px; color: #94a3b8; font-style: italic; }
        
        /* Filigrane discret */
        .watermark {
            position: fixed;
            top: 45%;
            left: 20%;
            transform: rotate(-45deg);
            font-size: 80px;
            color: rgba(226, 232, 240, 0.4);
            z-index: -1000;
            font-weight: bold;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

    <div class="watermark">SANTÉ+</div>

    <div class="header">
        <p class="clinic-name">SANTÉ+ CLINIQUE</p>
        <p class="clinic-info">Boulevard de la Marina, Cotonou, Bénin | contact@santeplus.bj | Tél: +229 21 00 00 00</p>
        <div class="doc-title">Rapport d'Analyse Biologique</div>
    </div>

    <div class="info-section">
        <table class="info-table">
            <tr>
                <td class="info-td">
                    <span class="label">Informations Patient</span><br>
                    <span class="value"><?php echo e($analyse->user->name); ?></span><br>
                    ID : #<?php echo e(str_pad($analyse->user->id, 6, '0', STR_PAD_LEFT)); ?><br>
                    Sexe : <?php echo e($analyse->user->sexe ?? 'Non spécifié'); ?>

                </td>
                <td class="info-td" style="text-align: right;">
                    <span class="label">Détails Examen</span><br>
                    Prélèvement : <span class="value"><?php echo e(\Carbon\Carbon::parse($analyse->date_prelevement)->format('d/m/Y H:i')); ?></span><br>
                    Émis le : <?php echo e(now()->format('d/m/Y')); ?><br>
                    Laboratoire : <span class="value"><?php echo e($analyse->laboratoire_nom ?? 'Interne'); ?></span>
                </td>
            </tr>
        </table>
    </div>

    <table class="results-table">
        <thead>
            <tr>
                <th style="width: 40%;">Examen réalisé</th>
                <th style="text-align: center;">Résultat</th>
                <th style="text-align: center;">Unité</th>
                <th style="text-align: center;">Valeurs de Référence</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-weight: bold; color: #0f172a;"><?php echo e($analyse->type_analyse); ?></td>
                <td style="text-align: center;" class="result-value"><?php echo e($analyse->valeur); ?></td>
                <td style="text-align: center; color: #64748b;"><?php echo e($analyse->unite); ?></td>
                <td style="text-align: center; color: #64748b; font-family: monospace;"><?php echo e($analyse->norme); ?></td>
            </tr>
        </tbody>
    </table>

    <div class="interpretation-box">
        <span class="interpretation-title">INTERPRÉTATION CLINIQUE :</span>
        <p style="margin: 0; color: #334155; font-style: italic;">
            "<?php echo e($analyse->interpretation ?? 'Les résultats doivent être interprétés par votre médecin traitant.'); ?>"
        </p>
    </div>

    <div class="footer">
        <div class="signature-block">
            <div class="signature-text">Dr. <?php echo e($analyse->biologiste_nom); ?></div>
            <div style="font-size: 11px; color: #2563eb;">Biologiste Responsable</div>
            <div class="validation-stamp">
                Validé électroniquement le <?php echo e(\Carbon\Carbon::parse($analyse->date_validation ?? now())->format('d/m/Y à H:i')); ?>

            </div>
        </div>
        <div style="clear: both;"></div>
        <p style="text-align: center; font-size: 9px; color: #94a3b8; margin-top: 30px;">
            Ce document est un rapport officiel généré par la plateforme Santé+. <br>
            L'authenticité de ce document peut être vérifiée via notre portail sécurisé.
        </p>
    </div>

</body>
</html><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/doctor/analyses/pdf.blade.php ENDPATH**/ ?>