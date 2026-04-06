<div style="font-family: sans-serif; padding: 20px; color: #333;">
    <h2 style="color: #4f46e5;">Rappel de votre Rendez-vous</h2>
    <p>Bonjour <strong>{{ $rdv->patient->name }}</strong>,</p>
    <p>Ceci est un rappel pour votre consultation prévue avec le <strong>Dr. {{ $rdv->medecin->name }}</strong>.</p>
    <div style="background: #f3f4f6; padding: 15px; border-radius: 10px; margin: 15px 0;">
        <p><strong> Date :</strong> {{ \Carbon\Carbon::parse($rdv->date_rdv)->translatedFormat('l d F Y') }}</p>
        <p><strong> Heure :</strong> {{ $rdv->heure_rdv }}</p>
    </div>
    <p>Merci de nous prévenir en cas d'empêchement.</p>
</div>