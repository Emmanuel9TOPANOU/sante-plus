<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #F4F7FA; color: #1e293b; margin: 0; padding: 0;">
    <div class="container" style="max-width: 600px; margin: 40px auto; background: #ffffff; border-radius: 24px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px rgba(0,0,0,0.03);">
        
        
        <div class="header" style="background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%); padding: 40px; text-align: center; color: white;">
            <h1 style="margin: 0; font-size: 28px; font-weight: 900; letter-spacing: -0.05em; text-transform: uppercase;">Santé +</h1>
            <p style="margin-top: 8px; opacity: 0.9; font-weight: 500; font-size: 16px;">
                <?php if($rdv->statut === 'confirme'): ?>
                    Confirmation de rendez-vous
            
                <?php endif; ?>
            </p>
        </div>
        
        <div class="content" style="padding: 40px;">
            <p style="font-size: 16px; line-height: 1.6;">Bonjour <strong><?php echo e($rdv->patient->name); ?></strong>,</p>
            
            <p style="font-size: 15px; line-height: 1.6; color: #475569;">
                <?php if($rdv->statut === 'confirme'): ?>
                    Nous avons le plaisir de vous confirmer que votre rendez-vous a été validé par le praticien. 
                <?php else: ?>
                    Ceci est un rappel concernant votre séance médicale prévue prochainement.
                <?php endif; ?>
                Voici le récapitulatif de votre rendez-vous :
            </p>
            
            
            <div class="rdv-card" style="background-color: #f8fafc; border-radius: 20px; padding: 24px; margin: 24px 0; border-left: 6px solid #4f46e5;">
                <div style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.1em; color: #64748b; font-weight: 800; margin-bottom: 4px;">Médecin Traitant</div>
                <div style="font-size: 18px; font-weight: 800; color: #0f172a; margin-bottom: 16px;">Dr. <?php echo e($rdv->medecin->name); ?></div>
                
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="vertical-align: top; width: 50%;">
                            <div style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.1em; color: #64748b; font-weight: 800; margin-bottom: 4px;">Date</div>
                            <div style="font-size: 15px; font-weight: 700; color: #0f172a;"><?php echo e(\Carbon\Carbon::parse($rdv->date_rdv)->translatedFormat('d F Y')); ?></div>
                        </td>
                        <td style="vertical-align: top; width: 50%;">
                            <div style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.1em; color: #64748b; font-weight: 800; margin-bottom: 4px;">Heure</div>
                            <div style="font-size: 15px; font-weight: 700; color: #0f172a;"><?php echo e(\Carbon\Carbon::parse($rdv->heure_rdv)->format('H:i')); ?></div>
                        </td>
                    </tr>
                </table>

                <?php if($rdv->motif): ?>
                    <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid #e2e8f0;">
                        <div style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.1em; color: #64748b; font-weight: 800; margin-bottom: 4px;">Motif de consultation</div>
                        <div style="font-size: 14px; font-weight: 500; font-style: italic; color: #475569;">"<?php echo e($rdv->motif); ?>"</div>
                    </div>
                <?php endif; ?>
            </div>

            <div style="background-color: #eff6ff; border-radius: 12px; padding: 15px; margin-bottom: 30px;">
                <p style="margin: 0; color: #1e40af; font-size: 13px; font-weight: 600; text-align: center;">
                     Présentez-vous 15 minutes avant le début de la consultation.
                </p>
            </div>
            
            
            <div style="text-align: center;">
                <a href="<?php echo e(url('/dashboard')); ?>" style="display: inline-block; padding: 16px 36px; background-color: #0f172a; color: #ffffff; text-decoration: none; border-radius: 16px; font-weight: 700; font-size: 14px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    Accéder à mon espace santé
                </a>
                <div style="margin-top: 24px;">
                    <a href="<?php echo e(route('patient.rendezvous.index')); ?>" style="color: #e11d48; text-decoration: none; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1.5px solid #e11d48; padding-bottom: 2px;">
                        Gérer mes rendez-vous
                    </a>
                </div>
            </div>
        </div>
        
        
        <div style="padding: 32px; text-align: center; font-size: 12px; color: #94a3b8; background-color: #f8fafc; border-top: 1px solid #e2e8f0;">
            <p style="margin: 0; font-weight: 600;">&copy; <?php echo e(date('Y')); ?> Santé+</p>
            <p style="margin: 4px 0;">Plateforme de santé numérique - Bénin</p>
            <p style="margin-top: 12px; font-size: 10px; opacity: 0.7;">Développé par la Direction Technique Santé+</p>
        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/emails/confirmation_rdv.blade.php ENDPATH**/ ?>