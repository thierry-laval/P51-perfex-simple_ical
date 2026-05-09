<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php init_head(); ?>

<style>
.ical-card{
    background:#fff;
    padding:25px;
    border-radius:14px;
    max-width:900px;
    box-shadow:0 6px 25px rgba(0,0,0,0.08);
}

.ical-title{
    font-size:20px;
    font-weight:600;
    margin-bottom:15px;
}

.ical-input{
    width:100%;
    padding:12px;
    border-radius:8px;
    border:1px solid #ddd;
    margin-bottom:15px;
}

.ical-btn{
    padding:10px 14px;
    border:none;
    border-radius:8px;
    cursor:pointer;
    margin-right:8px;
    color:#fff;
    text-decoration:none;
    display:inline-block;
}

.copy{
    background:#10b981;
}

.test{
    background:#3b82f6;
}

.download{
    background:#6366f1;
}

.check{
    background:#f59e0b;
}

.status{
    margin-top:15px;
    font-weight:600;
}

.ok{
    color:#10b981;
}

.error{
    color:#ef4444;
}

.ical-preview {
    margin-top: 20px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    padding: 15px;
    border-radius: 8px;
    max-height: 300px;
    overflow-y: auto;
    display: none;
    font-family: monospace;
    white-space: pre-wrap;
    font-size: 12px;
}

.date-group { margin-bottom: 20px; }
.date-group label { display: block; margin-bottom: 5px; font-weight: 600; }
</style>

<div id="wrapper">
    <div class="content">

        <div class="ical-card">

            <div class="ical-title">
                iCal Export
            </div>

            <?php echo form_open($this->uri->uri_string()); ?>
            <div class="row">
                <div class="col-md-6 date-group">
                    <label>Date de début (optionnel)</label>
                    <input type="date" name="date_from" class="form-control" value="<?php echo $date_from; ?>">
                </div>
                <div class="col-md-6 date-group">
                    <label>Date de fin (optionnel)</label>
                    <input type="date" name="date_to" class="form-control" value="<?php echo $date_to; ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-info mbot20">Enregistrer les filtres</button>
            <?php echo form_close(); ?>

            <hr>

            <label>URL de votre flux</label>
            <input
                id="icalUrl"
                class="ical-input"
                value="<?php echo $ical_url; ?>"
                readonly
            >

            <button
                class="ical-btn copy"
                onclick="copyLink()">
                Copier
            </button>

            <button
                class="ical-btn test"
                onclick="testFeed()">
                Tester
            </button>

            <a 
                class="ical-btn download" 
                href="<?php echo $ical_url; ?>&download=1" 
                download="calendar.ics">
                Télécharger
            </a>

            <button
                class="ical-btn check"
                onclick="checkFeed()">
                Diagnostic
            </button>

            <div id="status" class="status ok">
                ✔ Flux prêt
            </div>

            <div id="icalPreview" class="ical-preview"></div>

        </div>

    </div>
</div>

<script>
function copyLink()
{
    let i = document.getElementById('icalUrl');

    i.select();
    i.setSelectionRange(0, 99999);

    navigator.clipboard.writeText(i.value);

    alert('Lien copié');
}

function testFeed()
{
    const preview = document.getElementById('icalPreview');
    preview.style.display = 'block';
    preview.innerHTML = 'Chargement...';

    fetch("<?php echo $ical_url; ?>")
    .then(response => response.text())
    .then(data => {
        preview.textContent = data || 'Le flux a renvoyé une réponse vide.';
    })
    .catch(() => {
        preview.innerHTML = 'Erreur lors du test du flux.';
    });
}

function checkFeed()
{
    fetch("<?php echo $ical_url; ?>")
    .then(response => response.text())
    .then(data => {

        if (data && data.includes('BEGIN:VCALENDAR')) {

            document.getElementById('status').innerHTML =
                '✔ Flux iCal valide';

            document.getElementById('status').className =
                'status ok';

        } else {

            document.getElementById('status').innerHTML =
                '✖ Flux invalide';

            document.getElementById('status').className =
                'status error';
        }
    })
    .catch(() => {

        document.getElementById('status').innerHTML =
            '✖ Erreur serveur';

        document.getElementById('status').className =
            'status error';
    });
}
</script>

<?php init_tail(); ?>