<div style="font-family: sans-serif; padding: 20px; color: #333;">
    <h2 style="color: #4f46e5;">Rappel de votre Rendez-vous</h2>
    <p>Bonjour <strong><?php echo e($rdv->patient->name); ?></strong>,</p>
    <p>Ceci est un rappel pour votre consultation prévue avec le <strong>Dr. <?php echo e($rdv->medecin->name); ?></strong>.</p>
    <div style="background: #f3f4f6; padding: 15px; border-radius: 10px; margin: 15px 0;">
        <p><strong> Date :</strong> <?php echo e(\Carbon\Carbon::parse($rdv->date_rdv)->translatedFormat('l d F Y')); ?></p>
        <p><strong> Heure :</strong> <?php echo e($rdv->heure_rdv); ?></p>
    </div>
    <p>Merci de nous prévenir en cas d'empêchement.</p>
</div><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/emails/rappel_rdv.blade.php ENDPATH**/ ?>